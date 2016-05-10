<?php
/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 22-Mar-16
 * Time: 12:04 PM
 */
class User_group_create extends Root_Controller {
    public $permissions;
    public $controller_name;
    public $model_name;
    public $list_link;
    public $grid_link;
    public $view_link;
    public $add_link;
    public $edit_link;
    public $delete_link;

    function __construct() {
        parent::__construct();
        $this->controller_name = $this->router->fetch_class();
        $this->model_name = "user_group_manage_model";
        $this->load->model($this->model_name);
        $this->list_link = "record_list";
        $this->grid_link = "edit_record_role";
        $this->add_link = "add_record";
        $this->edit_link = "edit_record";
        $this->view_link = "view_record";
        $this->delete_link = "delete_record";
        //$this->lang->load($this->controller_name);
        /*$this->permissions=Menu_helper::get_permission($this->controller_name);*/
    }

    public function record_list() {
        $model_name = $this->model_name;
        $all_user_groups = $this->$model_name->get_all_user_groups();
        $this->data['task_title'] = $this->lang->line('USER_GROUP_LIST');
        $this->data['new_button_name'] = $this->lang->line('USER_GROUP_CREATE');
        $this->data['user_groups'] = $all_user_groups;
        $this->template->load('admin_default_template', 'user_group_create/record_list', $this->data);
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
                $data['task_title']=$this->lang->line('USER_GROUP_CREATE');
                $this->template->load('admin_default_template', 'user_group_create/add_record', $data);
            }
            else
            {
                $user_id=User_helper::get_user()->id;
                $time=time();
                $record_data = array(
                    'title' => $this->input->post('title'),
                    'ordering' => $this->input->post('ordering'),
                    'status' => $this->input->post('status'),
                );
                $record_data['created_time'] = $time;
                $record_data['created_by'] = $user_id;

                $this->db->trans_start();  //DB Transaction Handle START
                Query_helper::add($this->config->item('table_user_group'), $record_data);
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
                'title'=>'',
                'ordering'=>'',
                'status'=>1,
            );
            $data['task_title']=$this->lang->line('USER_GROUP_CREATE');
            $this->template->load('admin_default_template', 'user_group_create/add_record', $data);
        }

    }

    public function edit_record($user_id = 0)
    {
        $model_name = $this->model_name;
        if ($user_id <= 0) redirect('user_group_create/record_list');
        $this->data['message'] = null;
        $user_group_info_array = $this->$model_name->get_user_group_info($user_id);
        if (empty($user_group_info_array))
        {
            $this->session->set_flashdata('fl_message_error', $this->lang->line('USER_GROUP_DOESNT_EXSIST'));
            redirect('user_group_create/record_list');
        }
        $this->data['user_group_info'] = $user_group_info_array;

        if ($this->input->post())
        {
            $id = $this->$model_name->edit_user_group($user_id, $_POST);
            if ($id !== FALSE) {
                $this->data['message'] = "User group edited is successfully";
                redirect('user_manage/show_user_groups');
                return;
            }
            else
            {
                $this->data['message'] = strip_tags($this->$model_name->errors());
                redirect('user_group_create/edit_user_group/' . $user_id);
            }
        }
        else
        {
            $this->data['user_id'] = $user_id;
            $this->template->load('admin_default_template', 'user_group_create/edit_record', $this->data);
        }
    }

    public function delete_record($id = 0) {
        $model_name = $this->model_name;
        if($this->input->post())
        {
            $record_id = $this->input->post('record_id');
            $this->$model_name->delete_user_group($record_id);
        }
        $this->$model_name->delete_user_group($id);
        redirect('user_group_create/record_list');
    }

    public function edit_record_role($group_id=0)
    {
        $controller_name = $this->controller_name;
        $list_record =$this->list_link;
        $grid_link = $this->grid_link;
        $model_name = $this->model_name;
        if($group_id<=0) redirect(base_url().$controller_name.'/'. $list_record);
        if($this->input->post())
        {
            $posted_role_array = array();
            foreach ($_POST as $class__method => $each_permission)
            {
                $class = explode('__', $class__method)[0];
                $method = explode('__', $class__method)[1];
                $posted_role_array[$class][$method] = $each_permission;
            }
            $posted_role_array = json_encode($posted_role_array);
            $data = array
            (
                'access_info' => $posted_role_array
            );

            $this->db->trans_start();       //DB Transaction Handle START
            $this->$model_name->update_user_group_role($group_id, $data);
            $this->db->trans_complete();    //DB Transaction Handle END

            if ($this->db->trans_status() === TRUE)
            {
                $this->session->set_flashdata('fl_message_success', $this->lang->line('MSG_UPDATE_SUCCESS'));
                redirect(base_url().$controller_name .'/'. $grid_link .'/'. $group_id);
            }
            else
            {
                $this->session->set_flashdata('fl_message_error', $this->lang->line('MSG_UPDATE_FAIL'));
                redirect(base_url().$controller_name .'/'. $grid_link .'/'. $group_id);
            }
        }
        $class_method_array = User_helper::get_class_method_array();    //already lower case

        $permissions_from_db = $this->$model_name->get_user_group_role_info($group_id);
        $permissions_from_db = json_decode( $permissions_from_db['access_info'], true );
        if(!empty($permissions_from_db))$permissions_from_db = array_change_key_case($permissions_from_db, CASE_LOWER);

        $new_permissions_to_db = array();
        foreach ($class_method_array as $class_name => $r_class)
        {
            $temp='off';
            foreach ($r_class as $method_name => $r_method)
            {
                if (isset($permissions_from_db[$class_name][$method_name]))
                {
                    if ($permissions_from_db[$class_name][$method_name] == 'on')
                    {
                        $temp = 'on';
                    }
                }
                else
                {
                    $temp = 'off';
                }
                $new_permissions_to_db[$class_name][$method_name] = $temp;
            }
        }
        $this->data['group_id'] = $group_id;
        $this->data['classes'] = $new_permissions_to_db;
        $this->template->load('admin_default_template', 'user_group_create/edit_record_role', $this->data);
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
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('ordering', 'Ordering', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        if($this->form_validation->run() == FALSE)
        {
            $this->message = validation_errors();
            return false;
        }
        return true;
    }
}