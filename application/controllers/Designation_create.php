<?php

/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 08-Mar-16
 * Time: 4:18 PM
 */
class Designation_create extends Root_Controller
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
        $this->model_name = "designation_create_model";
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
        $data['task_title']=$this->lang->line('DESIGNATION_LIST');
        $data['new_button_name']=$this->lang->line('DESIGNATION_CREATE');
        $this->template->load('admin_default_template', 'designation_create/record_list',$data);
    }

    public function get_record_list()
    {
        $model=$this->model_name;
        echo json_encode($this->$model->get_all_records());
    }

    public function add_record()
    {
        $controller_name=$this->controller_name;
        $list_record=$this->list_link;
        $add_record=$this->add_link;
        $data['task_title']=$this->lang->line('DESIGNATION_CREATE');
        if($this->input->post())
        {
            if(!$this->check_validation())
            {
                $this->session->set_flashdata('fl_message_error', $this->message);
                $data['record_info']=$this->input->post();
                $this->template->load('admin_default_template', $controller_name.'/'.$add_record, $data);
            }
            else
            {
                $input_data = $this->input->post();
                $record_data['name_en'] = $input_data['name_en'];
                $record_data['name_bn'] = $input_data['name_bn'];
                $record_data['ordering'] = $input_data['ordering'];
                $record_data['status'] = $input_data['status'];
                $record_data['created_time'] = time();
                $record_data['created_by'] = User_helper::get_user()->id;

                $this->db->trans_start();  //DB Transaction Handle START
                Query_helper::add($this->config->item('table_designations'), $record_data);
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
            $this->template->load('admin_default_template', $controller_name.'/'.$add_record, $data);
        }
    }
    public function edit_record($record_id)
    {
        $controller_name=$this->controller_name;
        $list_record=$this->list_link;
        $edit_record=$this->edit_link;
        $data['task_title']=$this->lang->line('DESIGNATION_EDIT');
        $data['record_id']=$record_id;
        if($record_id<=0)
        {
            $this->session->set_flashdata('fl_message_error', $this->lang->line('SELECT_ONE_ITEM'));
            redirect($controller_name.'/'.$list_record);
        }
        if($this->input->post())
        {
            if($this->check_validation($record_id))
            {
                $input_data = $this->input->post();
                if(!empty($input_data['password']))
                {
                    $record_data['password'] = md5($input_data['password']);
                }
                $input_data = $this->input->post();
                $record_data['name_en'] = $input_data['name_en'];
                $record_data['name_bn'] = $input_data['name_bn'];
                $record_data['ordering'] = $input_data['ordering'];
                $record_data['status'] = $input_data['status'];
                $record_data['updated_time'] = time();
                $record_data['updated_by'] = User_helper::get_user()->id;

                $this->db->trans_start();  //DB Transaction Handle START
                Query_helper::update($this->config->item('table_designations'), $record_data, array('id ='.$record_id));
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
            else
            {
                $this->session->set_flashdata('fl_message_error', $this->message);
                $data['record_info']=$this->input->post();
                $this->template->load('admin_default_template', $controller_name.'/'.$edit_record, $data);
                return;
            }
        }
        else
        {
            $data['task_title']=$this->lang->line('DESIGNATION_EDIT');
            $data['record_id']=$record_id;
            $data['record_info']=Query_helper::get_info($this->config->item('table_designations'), '*',array('id = '.$record_id),1);
            if(empty($data['record_info']))
            {
                redirect($controller_name.'/'.$list_record);
            }
            $this->template->load('admin_default_template', $controller_name.'/'.$edit_record, $data);
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
                $record_id = $this->input->post('record_id');
                $dependent = Query_helper::record_dependency_check(
                    $this->config->item('table_employees'),
                    'employee_id',
                    $record_id
                );
                if($dependent)
                {
                    $data['status'] = 'fail';
                    $data['message'] = 'One or more children are still active.';
                    echo json_encode($data);
                }
                else
                {
                    $record_data = array(
                        'status' => 99
                    );
                    $this->db->trans_start();  //DB Transaction Handle START
                    Query_helper::update($this->config->item('table_designations'), $record_data, array('id ='.$record_id));
                    $this->db->trans_complete();   //DB Transaction Handle END

                    $data['status'] = 'success';
                    $data['message'] = $this->lang->line('MSG_DELETE_SUCCESS');
                    echo json_encode($data);
                }
            }
        }
    }

    private function check_validation($record_id='')
    {

        $this->load->library('form_validation');
        if(empty($record_id))
        {

        }
        else
        {

        }
        $this->form_validation->set_rules('name_en',$this->lang->line('NAME_EN'),'required');
        $this->form_validation->set_rules('ordering',$this->lang->line('ORDERING'),'required');
        if($this->form_validation->run() == FALSE)
        {
            $this->message = validation_errors();
            return false;
        }
        return true;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////

}