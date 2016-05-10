<?php

/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 08-Mar-16
 * Time: 4:18 PM
 */
class Fiscal_year_create extends Root_Controller
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
        $this->model_name = "Fiscal_year_create_model";
        $this->list_link = "record_list";
        $this->grid_link = "get_record_list";
        $this->add_link = "add_record";
        $this->edit_link = "edit_record";
        $this->view_link = "view_record";
        $this->delete_link = "delete_record";
        $this->message = "";

        $this->load->model($this->model_name);
        //$this->lang->load($this->controller_name);
        /*$this->permissions=Menu_helper::get_permission($this->controller_name);*/

    }

    public function record_list()
    {
        $data['task_title']=$this->lang->line('FISCAL_YEAR_LIST');
        $data['new_button_name']=$this->lang->line('FISCAL_YEAR_CREATE');
        $this->template->load('admin_default_template', 'fiscal_year_create/record_list',$data);
    }

    public function get_record_list()
    {
        //$model=$this->model_name;
        $record_list=Query_helper::get_info($this->config->item('table_fiscal_year'),
            "
            pos_fiscal_year.id,
            pos_fiscal_year.fiscal_year_code,
            pos_fiscal_year.start_date,
            pos_fiscal_year.end_date,
            CASE
            WHEN pos_fiscal_year.status = 1 THEN 'Active'
            WHEN pos_fiscal_year.status = 0 THEN 'InActive'
            ELSE ' ' END status
            ",array('pos_fiscal_year.status != 99'));
        echo json_encode($record_list);
    }

    public function add_record()
    {
        $controller_name=$this->controller_name;
        $list_record=$this->list_link;
        $add_record=$this->add_link;

        $active_present = Query_helper::get_info(
            $this->config->item('table_fiscal_year'),
            'id',
            array('status = '.$this->config->item('STATUS_ACTIVE')),
            1
        );
        if(!empty($active_present)){
            $this->session->set_flashdata('fl_message_error', "One fiscal year is already active.");
            $data['new_button_name']=$this->lang->line('FISCAL_YEAR_CREATE');
            $data['task_title']=$this->lang->line('FISCAL_YEAR_CREATE');
            $this->template->load('admin_default_template', $controller_name.'/'.$list_record, $data);
            return;
        }

        if($this->input->post())
        {

            if(!$this->check_validation())
            {
                $this->session->set_flashdata('fl_message_error', $this->message);
                $data['record_info']=$this->input->post();
                $data['task_title']=$this->lang->line('FISCAL_YEAR_CREATE');
                $this->template->load('admin_default_template', 'fiscal_year_create/add_record', $data);
            }
            else
            {
                $user_id=User_helper::get_user()->id;
                $time=time();

                $input_data = $this->input->post();
                $record_data['fiscal_year_code'] = $input_data['fiscal_year_code'];
                $record_data['start_date'] = System_helper::get_sql_date($input_data['start_date']);
                $record_data['end_date'] = System_helper::get_sql_date($input_data['end_date']);
                $record_data['status'] = $this->config->item('STATUS_ACTIVE');
                $record_data['created_time'] = $time;
                $record_data['created_by'] = $user_id;

                $this->db->trans_start();  //DB Transaction Handle START

                Query_helper::add($this->config->item('table_fiscal_year'), $record_data);

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
                'fiscal_year_code'=>'',
                'start_date'=>'',
                'end_date'=>'',
                'status'=>1,
            );
            $data['task_title']=$this->lang->line('FISCAL_YEAR_CREATE');
            $this->template->load('admin_default_template', 'fiscal_year_create/add_record', $data);
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

            if(!$this->check_validation($record_id))
            {
                $this->session->set_flashdata('fl_message_error', $this->message);
                $data['record_id']=$record_id;
                $data['record_info']=Query_helper::get_info($this->config->item('table_fiscal_year'),'*',array('id = '.$record_id),1);
                $data['task_title']=$this->lang->line('FISCAL_YEAR_EDIT');
                $this->template->load('admin_default_template', 'fiscal_year_create/edit_record', $data);
            }
            else
            {
                $user_id=User_helper::get_user()->id;
                $time=time();

                $input_data = $this->input->post();
                $record_data['fiscal_year_code'] = $input_data['fiscal_year_code'];
                $record_data['start_date'] = System_helper::get_sql_date($input_data['start_date']);
                $record_data['end_date'] = System_helper::get_sql_date($input_data['end_date']);
                $record_data['status'] = $input_data['status'];

                if($input_data['status'] == $this->config->item('STATUS_ACTIVE'))
                {
                    $active_present = Query_helper::get_info(
                        $this->config->item('table_fiscal_year'),
                        'id',
                        array('status = ' . $this->config->item('STATUS_ACTIVE')),
                        1
                    );
                    if (!empty($active_present)) {
                        $this->session->set_flashdata('fl_message_error', "One fiscal year is already active.");
                        $data['task_title'] = $this->lang->line('FISCAL_YEAR_CREATE');
                        $this->template->load('admin_default_template', $controller_name . '/' . $edit_record, $data);
                        return;
                    }
                }

                $record_data['updated_by'] = $user_id;
                $record_data['updated_time'] = $time;

                $this->db->trans_start();  //DB Transaction Handle START

                Query_helper::update($this->config->item('table_fiscal_year'), $record_data, array('id ='.$record_id));

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
            $data['record_info']=Query_helper::get_info($this->config->item('table_fiscal_year'),'*',array('id = '.$record_id),1);
            if(empty($data['record_info']))
            {
                redirect($controller_name.'/'.$list_record);
            }
            $data['task_title']=$this->lang->line('FISCAL_YEAR_EDIT');
            $this->template->load('admin_default_template', 'fiscal_year_create/edit_record', $data);
        }
    }
    public function view_record()
    {

    }
    public function delete_record()
    {
        if($this->input->post())
        {
            if(!empty($this->input->post('record_id')))
            {
                $id = $this->input->post('record_id');
                Query_helper::delete($this->config->item('table_users'), array('id' => $id));
            }
        }
    }
    private function check_validation($record_id='')
    {

        $this->load->library('form_validation');
        if(empty($record_id))
        {
            /*$user=Query_helper::get_info($this->config->item('table_fiscal_year'), '*',array("counter_name = '".$this->input->post('counter_name')."'"), 1);
            if(!empty($user))
            {
                $this->message =  $this->lang->line('MSG_DATA_EXIST');
                return false;
            }*/
        }
        else
        {

        }
        $this->form_validation->set_rules('fiscal_year_code',$this->lang->line('FISCAL_YEAR_CODE'),'required');
        $this->form_validation->set_rules('start_date',$this->lang->line('START_DATE'),'required');
        $this->form_validation->set_rules('end_date',$this->lang->line('END_DATE'),'required');
        if($this->form_validation->run() == FALSE)
        {
            $this->message = validation_errors();
            return false;
        }
        return true;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////

}