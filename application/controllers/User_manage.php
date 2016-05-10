<?php

/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 08-Mar-16
 * Time: 4:18 PM
 */
class User_manage extends Root_Controller
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
        $this->model_name = "user_manage_model";
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
        $data['task_title']=$this->lang->line('USER_LIST');
        $this->template->load('admin_default_template', 'user_manage/record_list',$data);
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

        if($this->input->post())
        {
            if(!$this->check_validation())
            {
                $this->session->set_flashdata('fl_message_error', $this->message);
                $data['record_info']=$this->input->post();
                $data['task_title']=$this->lang->line('USER_CREATE');
                $data['user_groups'] = Query_helper::get_list($this->config->item('table_user_group'),'title',array('status = '.$this->config->item('STATUS_ACTIVE')));
                $data['employees'] = Query_helper::get_list($this->config->item('table_employees'),'name_en',array('status = '.$this->config->item('STATUS_ACTIVE')));
                $this->template->load('admin_default_template', 'user_manage/add_record', $data);
            }
            else
            {
                $user_id=User_helper::get_user()->id;
                $time=time();

                $input_data = $this->input->post();
                $record_data['username'] = $input_data['username'];
                $record_data['password'] = md5($input_data['password']);
                $record_data['user_code'] = $input_data['user_code'];
                $record_data['user_group_id'] = $input_data['user_group_id'];
                $record_data['employee_id'] = $input_data['employee_id'];
                $record_data['status'] = $input_data['status'];
                $record_data['created_time'] = $time;
                $record_data['created_by'] = $user_id;

                $this->db->trans_start();  //DB Transaction Handle START

                Query_helper::add($this->config->item('table_users'), $record_data);

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
                'username'=>'',
                'user_code'=>'',
                'user_group_id'=>'',
                'employee_id'=>'',
                'status'=>1,
            );
            $data['task_title']=$this->lang->line('USER_CREATE');
            $data['user_groups'] = Query_helper::get_list($this->config->item('table_user_group'),'title',array('status = '.$this->config->item('STATUS_ACTIVE')));
            $data['employees'] = Query_helper::get_list($this->config->item('table_employees'),'name_en',array('status = '.$this->config->item('STATUS_ACTIVE')));
            $this->template->load('admin_default_template', 'user_manage/add_record', $data);
        }

    }
    public function edit_record($record_id)
    {

        $controller_name=$this->controller_name;
        $list_record=$this->list_link;
        $edit_record=$this->edit_link;
        if($this->input->post())
        {
            if(!$this->check_validation($record_id))
            {
                $this->session->set_flashdata('fl_message_error', $this->message);
                $data['record_id']=$record_id;
                $data['record_info']=$this->input->post();
                $data['task_title']=$this->lang->line('USER_EDIT');
                $data['user_groups'] = Query_helper::get_list($this->config->item('table_user_group'),'title',array('status = '.$this->config->item('STATUS_ACTIVE')));
                $data['employees'] = Query_helper::get_list($this->config->item('table_employees'),'name_en',array('status = '.$this->config->item('STATUS_ACTIVE')));
                $this->template->load('admin_default_template', 'user_manage/edit_record', $data);
            }
            else
            {
                $user_id=User_helper::get_user()->id;
                $time=time();

                $input_data = $this->input->post();
                if(!empty($input_data['password']))
                {
                    $record_data['password'] = md5($input_data['password']);
                }
                //$record_data['username'] = $input_data['username'];
                $record_data['user_code'] = $input_data['user_code'];
                $record_data['user_group_id'] = $input_data['user_group_id'];
                $record_data['employee_id'] = $input_data['employee_id'];
                $record_data['status'] = $input_data['status'];
                $record_data['created_time'] = $time;
                $record_data['created_by'] = $user_id;

                $this->db->trans_start();  //DB Transaction Handle START

                Query_helper::update($this->config->item('table_users'), $record_data, array('id ='.$record_id));

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
            $data['task_title']=$this->lang->line('USER_EDIT');
            $data['record_id']=$record_id;
            $data['record_info']=Query_helper::get_info($this->config->item('table_users'),'*',array('id = '.$record_id),1);
            $data['user_groups'] = Query_helper::get_list($this->config->item('table_user_group'),'title',array('status = '.$this->config->item('STATUS_ACTIVE')));
            $data['employees'] = Query_helper::get_list($this->config->item('table_employees'),'name_en',array('status = '.$this->config->item('STATUS_ACTIVE')));
            $this->template->load('admin_default_template', 'user_manage/edit_record', $data);
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
    public function check_validation($record_id)
    {

        $this->load->library('form_validation');
        if(empty($record_id))
        {
            $this->form_validation->set_rules('username',$this->lang->line('USER_NAME'),'required');
            $this->form_validation->set_rules('password',$this->lang->line('PASSWORD'),'required');

            $user=Query_helper::get_info($this->config->item('table_users'), '*',array("username = '".$this->input->post('username')."'"), 1);
            if(!empty($user))
            {
                $this->message =  $this->lang->line('MSG_DATA_EXIST');
                return false;
            }
        }
        else
        {
            $this->form_validation->set_rules('user_group_id',$this->lang->line('USER_GROUP'),'required');
            $this->form_validation->set_rules('employee_id',$this->lang->line('EMPLOYEE_NAME'),'required');
            $this->form_validation->set_rules('status',$this->lang->line('STATUS'),'required');
        }

        if($this->form_validation->run() == FALSE)
        {
            $this->message = validation_errors();
            return false;
        }
        return true;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////

}