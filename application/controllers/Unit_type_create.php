<?php

/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 08-Mar-16
 * Time: 4:18 PM
 */
class Unit_type_create extends Root_Controller
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
        $this->model_name = "unit_type_create_model";
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
        $data['task_title']=$this->lang->line('UNIT_TYPE_LIST');
        $data['new_button_name']=$this->lang->line('UNIT_TYPE_CREATE');
        $this->template->load('admin_default_template', 'unit_type_create/record_list',$data);
    }

    public function get_record_list()
    {
        //$model=$this->model_name;
        $record_list=Query_helper::get_info($this->config->item('table_unit_types'),"id, unit_type_name, CASE
                WHEN status = 1 THEN 'Active'
                WHEN status = 0 THEN 'InActive'
                ELSE ' ' END status",array('status != 99'));
        echo json_encode($record_list);
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
                $data['task_title']=$this->lang->line('UNIT_TYPE_CREATE');
                $this->template->load('admin_default_template', 'unit_type_create/add_record', $data);
            }
            else
            {
                $user_id=User_helper::get_user()->id;
                $time=time();

                $input_data = $this->input->post();
                $record_data['unit_type_name'] = $input_data['unit_type_name'];
                $record_data['status'] = $input_data['status'];
                $record_data['created_time'] = $time;
                $record_data['created_by'] = $user_id;

                $this->db->trans_start();  //DB Transaction Handle START
                Query_helper::add($this->config->item('table_unit_types'), $record_data);
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
                'unit_type_name'=>'',
                'status'=>1,
            );
            $data['task_title']=$this->lang->line('UNIT_TYPE_CREATE');
            $this->template->load('admin_default_template', 'unit_type_create/add_record', $data);
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
                $data['record_info']=Query_helper::get_info($this->config->item('table_unit_types'),'*',array('id = '.$record_id),1);
                $data['task_title']=$this->lang->line('COUNTER_EDIT');
                $this->template->load('admin_default_template', 'unit_type_create/edit_record', $data);
            }
            else
            {
                $user_id=User_helper::get_user()->id;
                $time=time();

                $input_data = $this->input->post();
                $record_data['unit_type_name'] = $input_data['unit_type_name'];
                $record_data['status'] = $input_data['status'];
                $record_data['updated_by'] = $user_id;
                $record_data['updated_time'] = $time;

                $this->db->trans_start();  //DB Transaction Handle START
                Query_helper::update($this->config->item('table_unit_types'), $record_data, array('id ='.$record_id));
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
            $data['record_info']=Query_helper::get_info($this->config->item('table_unit_types'),'*',array('id = '.$record_id),1);
            if(empty($data['record_info']))
            {
                redirect($controller_name.'/'.$list_record);
            }
            $data['task_title']=$this->lang->line('COUNTER_EDIT');
            $this->template->load('admin_default_template', 'unit_type_create/edit_record', $data);
        }
    }
//    public function view_record()
//    {
//
//    }
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
            $user=Query_helper::get_info($this->config->item('table_unit_types'), '*',array("unit_type_name = '".$this->input->post('unit_type_name')."'"), 1);
            if(!empty($user))
            {
                $this->message =  $this->lang->line('MSG_DATA_EXIST');
                return false;
            }
        }
        else
        {

        }
        $this->form_validation->set_rules('unit_type_name',$this->lang->line('NAME'),'required');
        if($this->form_validation->run() == FALSE)
        {
            $this->message = validation_errors();
            return false;
        }
        return true;
    }
}