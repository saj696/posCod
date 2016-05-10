<?php

/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 08-Mar-16
 * Time: 4:18 PM
 */
class Product_purchase extends Root_Controller
{
    public $permissions;
    public $controller_name;
    public $model_name;
    public $list_link;
    public $grid_link;
    public $view_link;
    public $add_link;
    public $edit_link;
    public $delete_link;
    public $message;

    function __construct()
    {
        parent::__construct();

        $this->controller_name = $this->router->fetch_class();

        $this->model_name = "product_purchase_model";

        $this->list_link = "record_list";
        $this->grid_link = "get_record_list";
        $this->add_link = "add_record";
        $this->edit_link = "edit_record";
        $this->view_link = "view_record";
        $this->delete_link = "delete_record";
        $this->message = "";

        $this->load->model($this->model_name);

    }

    public function record_list()
    {

        $data['task_title'] = $this->lang->line('PRODUCT_PURCHASE_LIST');
        $data['new_button_name'] = $this->lang->line('PRODUCT_PURCHASE_CREATE');
        $this->template->load('admin_default_template', 'product_purchase/record_list', $data);
    }

    public function get_record_list()
    {
        $model = $this->model_name;
        echo json_encode($this->$model->get_record_list());
    }

    public function add_record()
    {
        $model = $this->model_name;
        $controller_name = $this->controller_name;
        $list_record = $this->list_link;
        $add_record = $this->add_link;

        if ($this->input->post()) {

            if (!$this->check_validation()) {
                $this->session->set_flashdata('fl_message_error', $this->message);
                $data['record_info'] = $this->input->post();
                $data['task_title'] = $this->lang->line('PRODUCT_PURCHASE');
                $this->template->load('admin_default_template', 'product_purchase/add_record', $data);
            } else {
                $total_paid = 0;
                $user_id = User_helper::get_user()->id;
                $time = time();
                $input_data = $this->input->post();

                foreach ($input_data['payment_methods'] as $val) {
                    $total_paid += $val['paid_amount'];
                }
                $purchase_transactions = array(
                    'fiscal_year' => System_helper::get_active_fiscal_year(),
                    'purchase_date' => strtotime($input_data['purchase_date']),
                    'person_id' => $input_data['person_id'],
                    'transaction_type' => $this->config->item('PURCHASE'),
                    'total_amount' => $input_data['total_amount'],
                    'gross_discount' => $input_data['gross_discount'],
                    'paid_amount' => $total_paid,
                    'due_amount' => $input_data['due_amount'],
                    'created_by' => $user_id,
                    'created_time' => $time
                );

                $this->db->trans_start();  //DB Transaction Handle START

                //Insert data in table_purchase_transactions
                $purchase_transaction_id = Query_helper::add($this->config->item('table_purchase_transactions'), $purchase_transactions);
                //END Insert data in table_purchase_transactions

                // Insert data in table_purchase_related_items table
                foreach ($input_data['product'] as $single_product_info) {

                    $purchase_related_items = array(
                        'purchase_transaction_id' => $purchase_transaction_id,
                        'item_id' => $single_product_info['item_id'],
                        'quantity' => $single_product_info['quantity'],
                        'unit_price' => $single_product_info['unit_price']
                    );

                    if ($single_product_info['item_discount_percent'] > 0) {
                        $purchase_related_items['item_discount'] = (($purchase_related_items['quantity'] * $purchase_related_items['unit_price']) * $single_product_info['item_discount_percent']) / 100;
                    } else {
                        $purchase_related_items['item_discount'] = $single_product_info['item_discount'];
                    }

                    Query_helper::add($this->config->item('table_purchase_related_items'), $purchase_related_items);
                }
                //END of Insert data in table_purchase_related_items table

                // Insert data in table_pos_purchase_transactions_payment_method table
                foreach ($input_data['payment_methods'] as $val) {
                    $purchase_transactions_payment_method = array(
                        'purchase_transaction_id' => $purchase_transaction_id,
                        'payment_method' => $val['payment_method'],
                        'paid_amount' => $val['paid_amount']
                    );

                    Query_helper::add($this->config->item('table_pos_purchase_transactions_payment_method'), $purchase_transactions_payment_method);
                }


                // End of Insert data in table_pos_purchase_transactions_payment_method table

                // Insert data in table_pos_general_journals table

                foreach ($input_data['payment_methods'] as $val) {
                    if ($val['payment_method'] == $this->config->item('PAYMENT_METHOD_CASH')) {
                        $data_general_journals = array(
                            'fiscal_year_id' => System_helper::get_active_fiscal_year(),
                            'transaction_date' => strtotime($input_data['purchase_date']),
                            'transaction_type' => $this->config->item('PURCHASE'),
                            'reference_id' => $purchase_transaction_id,
                            'account_code' => $this->config->item('CASH'),
                            'amount' => $val['paid_amount'],
                            'dr_cr_indicator' => $this->config->item('CR'),
                            'created_by' => $user_id,
                            'created_at' => $time,
                        );
                        Query_helper::add($this->config->item('table_pos_general_journals'), $data_general_journals);
                    } else {

                        $result = $this->$model->get_personal_balance($input_data['person_id']);

                        if ($result->balance >= $val['paid_amount']) {

                            $data_general_journals = array(
                                'fiscal_year_id' => System_helper::get_active_fiscal_year(),
                                'transaction_date' => strtotime($input_data['purchase_date']),
                                'transaction_type' => $this->config->item('PURCHASE'),
                                'reference_id' => $purchase_transaction_id,
                                'account_code' => $this->config->item('ACCOUNT_RECEIVABLE'),
                                'amount' => $val['paid_amount'],
                                'dr_cr_indicator' => $this->config->item('CR'),
                                'created_by' => $user_id,
                                'created_at' => $time,
                            );
                            $update_balance = $result->balance - $val['paid_amount'];
                            $data = array(  'balance' => $update_balance,
                                            'updated_by' => $user_id,
                                            'updated_time' => $time);
                            $this->$model->update_personal_account_balance($result->id, $data);
                            Query_helper::add($this->config->item('table_pos_general_journals'), $data_general_journals);

                        }
                    }
                }

                $this->db->trans_complete();   //DB Transaction Handle END


                if ($this->db->trans_status() === TRUE) {
                    $this->session->set_flashdata('fl_message_success', $this->lang->line('MSG_CREATE_SUCCESS'));
                    redirect(base_url() . $controller_name . '/' . $list_record);
                } else {
                    $this->session->set_flashdata('fl_message_error', $this->lang->line('MSG_CREATE_FAIL'));
                    redirect(base_url() . $controller_name . '/' . $add_record);
                }
            }
        } else {
            $data['record_info'] = array
            (
                'person_id' => ' ',
                'date' => '',
                'payment_method' => '',
                'status' => 1,
            );
            $data['task_title'] = $this->lang->line('PRODUCT_PURCHASE');

            $data['supplier_list'] = Query_helper::get_list($this->config->item('table_users'), 'username', array("user_type= " . $this->config->item('EMPLOYEE_TYPE_SUPPLIER')));
            if (empty($data['record_info'])) {
                redirect($controller_name . '/' . $list_record);
            }

            $this->template->load('admin_default_template', 'product_purchase/add_record', $data);
        }
    }

    public function edit_record($record_id)
    {
        $controller_name = $this->controller_name;
        $list_record = $this->list_link;
        $edit_record = $this->edit_link;

        if ($record_id <= 0) {
            $this->session->set_flashdata('fl_message_error', $this->lang->line('SELECT_ONE_ITEM'));
            redirect($controller_name . '/' . $list_record);
        }
        if ($this->input->post()) {
            if ($this->input->post('parent_id') == $record_id) {
                $this->session->set_flashdata('fl_message_error', 'parent and product category is same.');
                $data['record_id'] = $record_id;
                $data['record_info'] = Query_helper::get_info($this->config->item('table_product_categories'), '*', array('id = ' . $record_id), 1);
                $data['task_title'] = $this->lang->line('PRODUCT_CATEGORY_EDIT');
                $this->template->load('admin_default_template', 'product_purchase/edit_record', $data);
                return;
            }
            if (!$this->check_validation($record_id)) {
                $this->session->set_flashdata('fl_message_error', $this->message);
                $data['record_id'] = $record_id;
                $data['parent_list'] = Query_helper::get_list($this->config->item('table_product_categories'), 'category_name', array('id != ' . $record_id));
                $data['record_info'] = Query_helper::get_info($this->config->item('table_product_categories'), '*', array('id = ' . $record_id), 1);
                $data['task_title'] = $this->lang->line('PRODUCT_CATEGORY_EDIT');
                $this->template->load('admin_default_template', 'product_purchase/edit_record', $data);
            } else {
                $user_id = User_helper::get_user()->id;
                $time = time();

                $input_data = $this->input->post();
                $record_data['category_name'] = $input_data['category_name'];
                $record_data['parent_id'] = $input_data['parent_id'];
                $record_data['status'] = $input_data['status'];
                if ($this->input->post('status') == $this->config->item('STATUS_INACTIVE')) {
                    $dependent = Query_helper::record_dependency_check(
                        $this->config->item('table_product_categories'),
                        'parent_id',
                        $record_id
                    );
                    if ($dependent) {
                        $this->session->set_flashdata('fl_message_error', 'One or more Children are still active.');
                        $data['record_id'] = $record_id;
                        $data['record_info'] = $this->input->post();
                        $data['task_title'] = $this->lang->line('EMPLOYEE_EDIT');
                        $this->template->load('admin_default_template', $controller_name . '/' . $edit_record, $data);
                        return;
                    }
                }
                $record_data['updated_by'] = $user_id;
                $record_data['updated_time'] = $time;

                $this->db->trans_start();  //DB Transaction Handle START
                Query_helper::update($this->config->item('table_product_categories'), $record_data, array('id =' . $record_id));
                $this->db->trans_complete();   //DB Transaction Handle END

                if ($this->db->trans_status() === TRUE) {
                    $this->session->set_flashdata('fl_message_success', $this->lang->line('MSG_UPDATE_SUCCESS'));
                    redirect(base_url() . $controller_name . '/' . $list_record);
                } else {
                    $this->session->set_flashdata('fl_message_error', $this->lang->line('MSG_UPDATE_FAIL'));
                    redirect(base_url() . $controller_name . '/' . $edit_record);
                }
            }
        } else {
            $data['record_id'] = $record_id;
            $data['record_info'] = Query_helper::get_info($this->config->item('table_product_categories'), '*', array('id = ' . $record_id), 1);
            $data['parent_list'] = Query_helper::get_list($this->config->item('table_product_categories'), 'category_name', array('id != ' . $record_id));
            $data['task_title'] = $this->lang->line('PRODUCT_CATEGORY_EDIT');
            $this->template->load('admin_default_template', 'product_purchase/edit_record', $data);
        }
    }


    public function delete_record()
    {
        if ($this->input->post()) {
            if (!empty($this->input->post('record_id'))) {
                $table_name = $this->config->item('table_product_categories');
                $record_id = $this->input->post('record_id');

                    $record_data = array(   'status' => 99 );

                    $this->db->trans_start();  //DB Transaction Handle START
                    Query_helper::update($table_name, $record_data, array('id =' . $record_id));
                    $this->db->trans_complete();   //DB Transaction Handle END

                    $data['status'] = 'success';
                    $data['message'] = $this->lang->line('MSG_DELETE_SUCCESS');
                    echo json_encode($data);

            }
        }
    }
    public function set_transport_cost($id){

        $model = $this->model_name;
        $controller_name = $this->controller_name;
        $list_record = $this->list_link;
        $add_record = $this->add_link;

        if ($this->input->post()) {


            if (!$this->check_validation()) {
                $this->session->set_flashdata('fl_message_error', $this->message);
                $data['record_info'] = $this->input->post();
                $data['task_title'] = $this->lang->line('PRODUCT_PURCHASE');
                $this->template->load('admin_default_template', 'product_purchase/add_record', $data);
            } else
            {

            }
        } else {
            $data['record_info'] = array
            (

                'date' => '',
                'payment_method' => '',
                'status' => 1,
            );
            $data['task_title'] = $this->lang->line('ADD_TRANSPORT_COST');
            $data['transactions_details']=Query_helper::get_info($this->config->item('table_purchase_transactions'),'*', array('transaction_type =' .$this->config->item('PURCHASE'),'id =' .$id),1);
            $data['single_products']=$this->$model->get_products_by_transaction($id);

            $data['supplier_list'] = Query_helper::get_list($this->config->item('table_users'), 'username', array("user_type= " . $this->config->item('EMPLOYEE_TYPE_SUPPLIER')));
            if (empty($data['record_info'])) {
                redirect($controller_name . '/' . $list_record);
            }

            $this->template->load('admin_default_template', 'product_purchase/add_transport_cost', $data);
        }
    }
    public function get_product_name($id = null)
    {

        $model = $this->model_name;
        $str = $this->input->get('term');
        $supplier_id = $this->input->get('supplier_id');
        $data = $this->$model->get_all_item_name_by_str($str);

        echo json_encode($data);
    }

    public function get_personal_balance()
    {
        $model = $this->model_name;
        $person_id = $_POST['person_id'];
        if ($person_id > 0) {
            $result = $this->$model->get_personal_balance($person_id);
            if ($result->balance > 0) {
                echo $result->balance;
            } else {
                echo 00;
            }
        }
    }

    private function check_validation($record_id = '')
    {
//        $this->load->library('form_validation');
//        if(empty($record_id))
//        {
//            $user=Query_helper::get_info($this->config->item('table_product_categories'), '*',array("category_name = '".$this->input->post('category_name')."'"), 1);
//            if(!empty($user))
//            {
//                $this->message =  $this->lang->line('MSG_DATA_EXIST');
//                return false;
//            }
//        }
//        else
//        {
//
//        }
//        $this->form_validation->set_rules('category_name',$this->lang->line('NAME'),'required');
//        if($this->form_validation->run() == FALSE)
//        {
//            $this->message = validation_errors();
//            return false;
//        }
        return true;
    }
}