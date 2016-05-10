<?php

/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 08-Mar-16
 * Time: 4:18 PM
 */
class Employee_create extends Root_Controller
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
        //$this->load->model('employee_manage_model');

        $this->controller_name = $this->router->fetch_class();
        $this->model_name = "employee_manage_model";
        $this->list_link = "record_list";
        $this->grid_link = "get_record_list";
        $this->add_link = "add_record";
        $this->edit_link = "edit_record";
        $this->view_link = "view_record";
        $this->delete_link = "delete_record";
        $this->message = "";

        $this->load->model($this->model_name);
    }

    //show_employee_info

    public function record_list()
    {
        $data['task_title']=$this->lang->line('EMPLOYEE_LIST');
        $data['new_button_name']=$this->lang->line('EMPLOYEE_CREATE');
        $this->template->load('admin_default_template', 'employee_create/record_list',$data);
//        echo "<pre>";
//        echo ($this->user_active_check(5));
//        echo $this->message;
//        echo "</pre>";
//        exit;

    }
    public function get_record_list()
    {
        $model=$this->model_name;
        $record_list = $this->$model->get_all_employees();
        echo json_encode($record_list);
    }

    //create_employee
    public function add_record()
    {
        $controller_name=$this->controller_name;
        $list_record=$this->list_link;
        $add_record=$this->add_link;
        $data['task_title']=$this->lang->line('EMPLOYEE_CREATE');
        $data['designations'] = Query_helper::get_list(
            $this->config->item('table_designations'),
            'name_en',
            array('status = '.$this->config->item('STATUS_ACTIVE'))
        );
        if ($this->input->post())
        {
            if(!$this->check_validation())
            {
                $this->session->set_flashdata('fl_message_error', $this->message);
                $data['record_info']=$this->input->post();
                $this->template->load('admin_default_template', 'employee_create/add_record', $data);
            }
            else
            {
                $user_id=User_helper::get_user()->id;
                $time=time();
                $record_data = array
                (
                    'name_bn' => $this->input->post('name_bn'),
                    'name_en' => $this->input->post('name_en'),
                    'employee_type' => $this->input->post('employee_type'),
                    'member_id' => $this->input->post('member_id'),
                    'payscale_id' => $this->input->post('payscale_id'),
                    'designation_id' => $this->input->post('designation_id'),
                    'gender' => $this->input->post('gender'),
                    'dob' => $this->input->post('dob'),
                    'phone' => $this->input->post('phone'),
                    'mobile' => $this->input->post('mobile'),
                    'office_phone' => $this->input->post('office_phone'),
                    'email' => $this->input->post('email'),
                    'nid' => $this->input->post('nid'),
                    'present_address' => $this->input->post('present_address'),
                    'permanent_address' => $this->input->post('permanent_address'),
                    'business_name' => $this->input->post('business_name'),
                    'business_mobile' => $this->input->post('business_mobile'),
                    'business_email' => $this->input->post('business_email'),
                    'contact_person_name' => $this->input->post('contact_person_name'),
                    'contact_person_address' => $this->input->post('contact_person_address'),
                    'balance' => $this->input->post('balance'),
                    'due' => $this->input->post('due'),
                    'status' => $this->input->post('status'),
                );
                $record_data['created_time'] = $time;
                $record_data['created_by'] = $user_id;

                $dir = $this->config->item("file_upload");
                $uploaded = System_helper::upload_file($dir['employees'],1024,'gif|jpg|png');
                if(array_key_exists('profile_picture',$uploaded))
                {
                    if($uploaded['profile_picture']['status'])
                    {
                        $record_data['profile_picture'] = $uploaded['profile_picture']['info']['file_name'];
                    }
                    else
                    {
                        $this->session->set_flashdata('fl_message_error', $uploaded['profile_picture']['message']);
                    }
                }

                $this->db->trans_start();  //DB Transaction Handle START
                Query_helper::add($this->config->item('table_employees'), $record_data);
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
                'name_bn' => '',
                'name_en' =>'',
                'member_id' =>'',
                'payscale_id' =>'',
                'gender' => '',
                'phone' => '',
                'office_phone' => '',
                'mobile' => '',
                'email' => '',
                'nid' => '',
                'present_address' => '',
                'permanent_address' => '',
                'business_name' =>'',
                'business_mobile' =>'',
                'business_email' =>'',
                'contact_person_name' =>'',
                'contact_person_address' =>'',
                'balance' =>'',
                'due' =>'',
                'dob' => '',
                'status' => 1,
                'gender' => 1
            );
            $this->template->load('admin_default_template', 'employee_create/add_record', $data);
        }
    }

    //edit_employee
    public function edit_record($record_id = 0)
    {
        $controller_name=$this->controller_name;
        $list_record=$this->list_link;
        $edit_record=$this->edit_link;
        $list_link=$this->list_link;
        $data['task_title']=$this->lang->line('EMPLOYEE_EDIT');
        $data['designations'] = Query_helper::get_list(
            $this->config->item('table_designations'),
            'name_en',
            array('status = '.$this->config->item('STATUS_ACTIVE'))
        );
        if ($record_id <= 0) redirect($controller_name.'/'.$list_link);
        //        $employee_info_array = $this->employee_manage_model->get_employee_info($record_id);
        //        if (empty($employee_info_array)) redirect('employee_create/show_employees');
        //        $this->data['employee_info'] = $employee_info_array;
        //        $this->data['employee_id'] = $record_id;
        if ($this->input->post())
        {
            if(!$this->check_validation($record_id))
            {
                $this->session->set_flashdata('fl_message_error', $this->message);
                $data['record_id']=$record_id;
                $data['record_info']=$this->input->post();
                $data['task_title']=$this->lang->line('EMPLOYEE_EDIT');
                $this->template->load('admin_default_template', 'user_create/edit_record', $data);
            }
            else
            {

                $user_id=User_helper::get_user()->id;
                $time=time();
                $record_data = array
                (
                    'name_bn' => $this->input->post('name_bn'),
                    'name_en' => $this->input->post('name_en'),
                    'employee_type' => $this->input->post('employee_type'),
                    'member_id' => $this->input->post('member_id'),
                    'payscale_id' => $this->input->post('payscale_id'),
                    'designation_id' => $this->input->post('designation_id'),
                    'gender' => $this->input->post('gender'),
                    'dob' => $this->input->post('dob'),
                    'phone' => $this->input->post('phone'),
                    'mobile' => $this->input->post('mobile'),
                    'office_phone' => $this->input->post('office_phone'),
                    'email' => $this->input->post('email'),
                    'nid' => $this->input->post('nid'),
                    'present_address' => $this->input->post('present_address'),
                    'permanent_address' => $this->input->post('permanent_address'),
                    'business_name' => $this->input->post('business_name'),
                    'business_mobile' => $this->input->post('business_mobile'),
                    'business_email' => $this->input->post('business_email'),
                    'contact_person_name' => $this->input->post('contact_person_name'),
                    'contact_person_address' => $this->input->post('contact_person_address'),
                    'balance' => $this->input->post('balance'),
                    'due' => $this->input->post('due'),
                    'status' => $this->input->post('status'),
                );
//                $check_result = $this->user_active_check($record_id);
//                if( $this->user_active_check($record_id) )
                if($this->input->post('status') == $this->config->item('STATUS_INACTIVE'))
                {
                    $dependent = Query_helper::record_dependency_check(
                        $this->config->item('table_users'),
                        'employee_id',
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

                $record_data['updated_time'] = $time;
                $record_data['updated_by'] = $user_id;
                $dir = $this->config->item("file_upload");
                $uploaded = System_helper::upload_file($dir['employees'],1024,'gif|jpg|png');
                if(array_key_exists('profile_picture',$uploaded))
                {
                    if($uploaded['profile_picture']['status'])
                    {
                        $record_data['profile_picture'] = $uploaded['profile_picture']['info']['file_name'];
                    }
                    else
                    {
                        $this->session->set_flashdata('fl_message_error', $uploaded['profile_picture']['message']);
                    }
                }

                $this->db->trans_start();  //DB Transaction Handle START
                Query_helper::update($this->config->item('table_employees'), $record_data, array('id ='.$record_id));
                $this->db->trans_complete();   //DB Transaction Handle END

                if ($this->db->trans_status() === TRUE)
                {
                    $this->session->set_flashdata('fl_message_success', $this->lang->line('MSG_EDIT_SUCCESS'));
                    redirect(base_url().$controller_name.'/'.$list_record);
                }
                else
                {
                    $this->session->set_flashdata('fl_message_error', $this->lang->line('MSG_EDIT_FAIL'));
                    redirect(base_url().$controller_name.'/'.$edit_record);
                }
            }
        }
        $data['record_id'] = $record_id;
        $data['record_info'] = Query_helper::get_info($this->config->item('table_employees'),'*',array('id = '.$record_id),1);
        if(empty($data['record_info']))
        {
            redirect($controller_name.'/'.$list_record);
        }
        $this->template->load('admin_default_template', $controller_name.'/'.$edit_record, $data);
    }
    public function view_record($employee_id)
    {
        $employee_info = $this->employee_manage_model->get_employee_info($employee_id);
        $employee_info['created_by_name'] = $this->employee_manage_model->get_employee_name($employee_info['created_by']);
        $employee_info['created_by_name'] = $this->employee_manage_model->get_employee_info($employee_info['created_by'])['name_en'];
        $this->data['employee_info'] = $employee_info;
        $this->template->load('admin_default_template', 'employee_create/show_record', $this->data);
    }

//delete_employee
    public function delete_record()
    {
        if($this->input->post())
        {
            if(!empty($this->input->post('record_id')))
            {
                $record_id = $this->input->post('record_id');
                $dependent = Query_helper::record_dependency_check(
                    $this->config->item('table_users'),
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
                    Query_helper::update($this->config->item('table_employees'), $record_data, array('id ='.$record_id));
                    $this->db->trans_complete();   //DB Transaction Handle END

                    $data['status'] = 'success';
                    $data['message'] = $this->lang->line('MSG_DELETE_SUCCESS');
                    echo json_encode($data);
                }
            }
        }
    }

//    public function user_active_check($employee_id)
//    {
//        $user_id = Query_helper::get_info($this->config->item('table_users'), 'id', array( 'employee_id = '.$employee_id, 'status = ' . $this->config->item('STATUS_ACTIVE') ), 1);
//        if(!empty($user_id)){
//            $this->message = $this->lang->line('EMPLOYEE_USER_ACTIVE');
//            return true;
//        }
//        else
//        {
//            $this->message = 'No user under this employee: '. $employee_id;
//            return false;
//        }
//    }

    public function check_validation($record_id='')
    {
        $this->load->library('form_validation');
        if(empty($record_id))
        {
            /*$user=Query_helper::get_info($this->config->item('table_users'), '*',array("username = '".$this->input->post('username')."'"), 1);
            if(!empty($user))
            {
                $this->message =  $this->lang->line('MSG_DATA_EXIST');
                return false;
            }*/
        }
        else
        {

        }
        $this->form_validation->set_rules('name_en',$this->lang->line('NAME_EN'),'required');
        $this->form_validation->set_rules('designation_id',$this->lang->line('DESIGNATION'),'required');
        $this->form_validation->set_rules('gender',$this->lang->line('GENDER'),'required');
        $this->form_validation->set_rules('status',$this->lang->line('STATUS'),'required');

        if($this->form_validation->run() == FALSE)
        {
            $this->message = validation_errors();
            return false;
        }
        return true;
    }

//    employee module

/*
// employee group module

    public function delete_employee_group($id = 0) {
        $this->employee_manage_model->delete_employee_group($id);
        redirect('employee_create/show_employee_groups');
    }

    public function edit_employee_group($employee_id = 0) {
        if ($employee_id == 0) redirect('employee_create/show_employee_groups');
        $this->data['message'] = null;
        $employee_group_info_array = $this->employee_manage_model->get_employee_group_info($employee_id);
        if (empty($employee_group_info_array)) redirect('employee_create/show_employee_group');
        $this->data['employee_group_info'] = $employee_group_info_array;
        if ($this->input->post()) {
            $id = $this->employee_manage_model->edit_employee_group($employee_id, $_POST);
            if ($id !== FALSE) {
                $this->data['message'] = "employee group edited is successfully";
                redirect('employee_create/show_employee_groups');
                return;
            } else {
                $this->data['message'] = strip_tags($this->employee_manage_model->errors());
                redirect('employee_create/edit_employee_group/' . $employee_id);
            }
        } else {
            $this->data['employee_id'] = $employee_id;
            $this->template->load('admin_default_template', 'edit_record_group', $this->data);
        }
    }

    public function create_employee_group() {
        $this->data['message'] = null;
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('ordering', 'Ordering', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');

        if ($this->input->post()) {
            if ($this->form_validation->run() == TRUE) {
                $employee_info = array(
                    'title' => $this->input->post('title'),
                    'ordering' => $this->input->post('ordering'),
                    'status' => $this->input->post('status'),
                );
                $id = $this->employee_manage_model->create_employee_group($employee_info);
                if ($id == TRUE) {
                    $this->session->set_flashdata('fl_message', 'employee group created is successfully');
                    redirect('employee_create/show_employee_groups');
                    return;
                } else {
                    $this->data['message'] = strip_tags($this->employee_manage_model->errors());
                    $this->template->load('admin_default_template', 'add_record_group', $this->data);
                    return;
                }
            } else {
                $this->data['message'] = validation_errors();
                $this->template->load('admin_default_template', 'add_record_group', $this->data);
            }

        } else {
            $this->template->load('admin_default_template', 'add_record_group', $this->data);
        }
    }

    public function assign_employee_to_group($employee_id) {
        $this->data['message'] = null;
        if ($this->input->post()) {
            $employee_info = array(
                'title' => $this->input->post('title'),
                'ordering' => $this->input->post('ordering'),
                'status' => $this->input->post('status'),
            );
            $id = $this->employee_manage_model->create_employee_group($employee_info);
            if ($id !== FALSE) {
                $this->data['message'] = "employee create is successfully";
                redirect('employee_create/view_employee_groups');
                return;
            } else {
                $this->data['message'] = strip_tags($this->employee_manage_model->errors());
                $this->template->load('admin_default_template', 'add_record_group', $this->data);
                return;
            }
        } else {
            $this->template->load('admin_default_template', 'page_content_assign_employee_to_group', $this->data);
        }
    }

    public function show_employee_groups() {
        $all_employee_groups = $this->employee_manage_model->get_all_employee_groups();
        foreach ($all_employee_groups as $key => $ug) {
            $all_employee_groups[$key]['created_by'] = $this->employee_manage_library->get_employee_name($ug['created_by']);
            $all_employee_groups[$key]['updated_by'] = $this->employee_manage_library->get_employee_name($ug['updated_by']);
        }
        $this->data['employee_groups'] = $all_employee_groups;
        $this->template->load('admin_default_template', 'admin/page_content_show_employee_groups', $this->data);
    }

    public function employee_group_role_assign($group_id=0) {
        if($group_id==0) redirect('employee_create/show_employee_groups');
        if($this->input->post()){
            $posted_role_array = array();
            foreach ($_POST as $class__method => $each_permission) {
                $class = explode('__', $class__method)[0];
                $method = explode('__', $class__method)[1];
                $posted_role_array[$class][$method] = $each_permission;
            }
            $posted_role_array = json_encode($posted_role_array);
            $data = array(
                'access_info' => $posted_role_array
            );
            $this->employee_manage_model->update_employee_group_role($group_id, $data);
            $this->session->set_flashdata('fl_message', 'Updated Successfully.');

        }
        $this->data['message'] = null;
        $class_method_array = $this->employee_manage_library->get_class_method_array();
        $permissions_from_db = $this->employee_manage_model->get_employee_group_permission_info($group_id)['access_info'];
        $permissions_from_db = json_decode($permissions_from_db, true);

        $new_class_method_array = array();
        foreach ($class_method_array as $class_name => $r_class) {
            foreach ($r_class as $method_name => $r_method) {
                if (isset($permissions_from_db[$class_name][$method_name])) {
                    if ($permissions_from_db[$class_name][$method_name] == 'on') {
                        $temp = 'on';
                    }
                } else {
                    $temp = 'off';
                }
                $new_class_method_array[$class_name][$method_name] = $temp;
            }

        }
        $this->data['group_id'] = $group_id;
        $this->data['classes'] = $new_class_method_array;
        $this->template->load('admin_default_template', 'admin/edit_record_group_role', $this->data);

    }

//bsolete functions
    public function show_employees() {
        $all_employees = $this->employee_manage_model->get_all_employees();
        $this->data['employees'] = $all_employees;
        $this->template->load('admin_default_template', 'employee_create/page_content_show_employees', $this->data);
    }



//    employee group module end*/

}