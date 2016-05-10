<?php

/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 08-Mar-16
 * Time: 4:18 PM
 */
class Product_category_create extends Root_Controller
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
        $this->model_name = "product_category_create_model";
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

        $data['task_title']=$this->lang->line('PRODUCT_CATEGORY_LIST');
        $data['new_button_name']=$this->lang->line('PRODUCT_CATEGORY_CREATE');
        $this->template->load('admin_default_template', 'product_category_create/record_list',$data);
    }

    public function get_record_list()
    {
        $model=$this->model_name;
        echo json_encode($this->$model->get_record_list());
    }

    public function add_record()
    {
        $controller_name=$this->controller_name;
        $list_record=$this->list_link;
        $add_record=$this->add_link;

        if($this->input->post())
        {
            if(!$this->check_validation())
            {
                $this->session->set_flashdata('fl_message_error', $this->message);
                $data['record_info']=$this->input->post();
                $data['task_title']=$this->lang->line('PRODUCT_CATEGORY_CREATE');
                $this->template->load('admin_default_template', 'product_category_create/add_record', $data);
            }
            else
            {
                $user_id=User_helper::get_user()->id;
                $time=time();

                $input_data = $this->input->post();
                $record_data['category_name'] = $input_data['category_name'];
                if( !isset($input_data['parent_id']) || $input_data['parent_id'] <= 0 ){
                    $record_data['parent_id'] = 1;
                } else $record_data['parent_id'] = $input_data['parent_id'];

                $record_data['status'] = $input_data['status'];
                $record_data['created_time'] = $time;
                $record_data['created_by'] = $user_id;

                $this->db->trans_start();  //DB Transaction Handle START
                Query_helper::add($this->config->item('table_product_categories'), $record_data);
                $this->db->trans_complete();   //DB Transaction Handle END

                if ($this->db->trans_status() === TRUE)
                {
                    $this->session->set_flashdata('fl_message_success', $this->lang->line('MSG_CREATE_SUCCESS'));
                    redirect(base_url().$controller_name.'/'.$list_record);
                }
                else
                {
                    $this->session->set_flashdata('fl_message_error', $this->lang->line('MSG_CREATE_FAIL'));
                    redirect(base_url().$controller_name.'/'.$add_record);
                }
            }
        }
        else
        {
            $data['record_info']=array
            (
                'category_name'=>'',
                'status'=>1,
            );
            $data['task_title']=$this->lang->line('PRODUCT_CATEGORY_CREATE');

            $data['parent_list']=Query_helper::get_list($this->config->item('table_product_categories'),'category_name', array());
            if(empty($data['record_info']))
            {
                redirect($controller_name.'/'.$list_record);
            }

            $this->template->load('admin_default_template', 'product_category_create/add_record', $data);
        }
    }
    public function edit_record($record_id)
    {
        $controller_name=$this->controller_name;
        $list_record=$this->list_link;
        $edit_record=$this->edit_link;

        if($record_id<=0)
        {
            $this->session->set_flashdata('fl_message_error', $this->lang->line('SELECT_ONE_ITEM'));
            redirect($controller_name.'/'.$list_record);
        }
        if($this->input->post())
        {
            if ( $this->input->post('parent_id') == $record_id)
            {
                $this->session->set_flashdata('fl_message_error', 'parent and product category is same.');
                $data['record_id']=$record_id;
                $data['record_info']=Query_helper::get_info($this->config->item('table_product_categories'),'*',array('id = '.$record_id),1);
                $data['task_title']=$this->lang->line('PRODUCT_CATEGORY_EDIT');
                $this->template->load('admin_default_template', 'product_category_create/edit_record', $data);
                return;
            }
            if(!$this->check_validation($record_id))
            {
                $this->session->set_flashdata('fl_message_error', $this->message);
                $data['record_id']=$record_id;
                $data['parent_list']=Query_helper::get_list($this->config->item('table_product_categories'),'category_name', array('id != '.$record_id));
                $data['record_info']=Query_helper::get_info($this->config->item('table_product_categories'),'*',array('id = '.$record_id),1);
                $data['task_title']=$this->lang->line('PRODUCT_CATEGORY_EDIT');
                $this->template->load('admin_default_template', 'product_category_create/edit_record', $data);
            }
            else
            {
                $user_id=User_helper::get_user()->id;
                $time=time();

                $input_data = $this->input->post();
                $record_data['category_name'] = $input_data['category_name'];
                $record_data['parent_id'] = $input_data['parent_id'];
                $record_data['status'] = $input_data['status'];
                if($this->input->post('status') == $this->config->item('STATUS_INACTIVE'))
                {
                    $dependent = Query_helper::record_dependency_check(
                        $this->config->item('table_product_categories'),
                        'parent_id',
                        $record_id
                    );
                    if( $dependent )
                    {
                        $this->session->set_flashdata('fl_message_error', 'One or more Children are still active.');
                        $data['record_id']=$record_id;
                        $data['record_info']=$this->input->post();
                        $data['task_title']=$this->lang->line('EMPLOYEE_EDIT');
                        $this->template->load('admin_default_template', $controller_name.'/'.$edit_record, $data);
                        return;
                    }
                }
                $record_data['updated_by'] = $user_id;
                $record_data['updated_time'] = $time;

                $this->db->trans_start();  //DB Transaction Handle START
                Query_helper::update($this->config->item('table_product_categories'), $record_data, array('id ='.$record_id));
                $this->db->trans_complete();   //DB Transaction Handle END

                if ($this->db->trans_status() === TRUE)
                {
                    $this->session->set_flashdata('fl_message_success', $this->lang->line('MSG_UPDATE_SUCCESS'));
                    redirect(base_url().$controller_name.'/'.$list_record);
                }
                else
                {
                    $this->session->set_flashdata('fl_message_error', $this->lang->line('MSG_UPDATE_FAIL'));
                    redirect(base_url().$controller_name.'/'.$edit_record);
                }
            }
        }
        else
        {
            $data['record_id']=$record_id;
            $data['record_info']=Query_helper::get_info($this->config->item('table_product_categories'),'*',array('id = '.$record_id),1);
            $data['parent_list']=Query_helper::get_list($this->config->item('table_product_categories'),'category_name', array('id != '.$record_id));
            $data['task_title']=$this->lang->line('PRODUCT_CATEGORY_EDIT');
            $this->template->load('admin_default_template', 'product_category_create/edit_record', $data);
        }
    }
//    public function record_dependency_check($table_name, $field_name, $field_value)
//    {
//        $result = Query_helper::get_info($table_name, 'id', array( $field_name.' = '.$field_value, 'status = ' . $this->config->item('STATUS_ACTIVE') ), 1);
//        if(!empty($result)){
//            return true;
//        }
//        else
//        {
//            return false;
//        }
//    }

    public function delete_record()
    {
        if($this->input->post())
        {
            if(!empty($this->input->post('record_id')))
            {
                $table_name = $this->config->item('table_product_categories');
                $record_id = $this->input->post('record_id');
                $dependent = Query_helper::record_dependency_check(
                    $table_name,
                    'parent_id',
                    $record_id
                );
                if($dependent)
                {
                    $data['status'] = 'fail';
                    $data['message'] = 'One or more Children are still active.';
                    echo json_encode($data);
                }
                else
                {
                    $record_data = array(
                        'status' => 99
                    );
                    $this->db->trans_start();  //DB Transaction Handle START
                    Query_helper::update($table_name, $record_data, array('id ='.$record_id));
                    $this->db->trans_complete();   //DB Transaction Handle END

                    $data['status'] = 'success';
                    $data['message'] = $this->lang->line('MSG_DELETE_SUCCESS');
                    echo json_encode($data);
                }
            }











            if(!empty($this->input->post('record_id')))
            {
                $id = $this->input->post('record_id');
                Query_helper::delete($this->config->item('table_product_categories'), array('id' => $id));
            }
        }
    }

    private function check_validation($record_id='')
    {
        $this->load->library('form_validation');
        if(empty($record_id))
        {
            $user=Query_helper::get_info($this->config->item('table_product_categories'), '*',array("category_name = '".$this->input->post('category_name')."'"), 1);
            if(!empty($user))
            {
                $this->message =  $this->lang->line('MSG_DATA_EXIST');
                return false;
            }
        }
        else
        {

        }
        $this->form_validation->set_rules('category_name',$this->lang->line('NAME'),'required');
        if($this->form_validation->run() == FALSE)
        {
            $this->message = validation_errors();
            return false;
        }
        return true;
    }
}