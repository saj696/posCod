
<?php

/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 08-Mar-16
 * Time: 4:18 PM
 */
class Task_create extends Root_Controller
{
    public $controller_name;
    public $model_name;
    public $add_link;
    public $edit_link;
    public $list_link;
    public $ajax_link_methods;
    public $delete_link;
    function __construct()
    {
        parent::__construct();
        $this->list_link = "record_list";
        $this->add_link = "add_record";
        $this->edit_link = "edit_record";
        $this->delete_link = "delete_record";
        $this->ajax_link_methods = "ajax_get_methods";
        $this->controller_name = "task_create";
        $this->model_name = "task_manage_model";
        $this->load->model('task_manage_model');
        $this->load->helper('form');
    }

    public function record_list() {
        $controller_name =  $this->controller_name;
        $list_record =      $this->list_link;
        $add_record =       $this->add_link;
        $delete_record =    $this->delete_link;

        $all_tasks = $this->task_manage_model->get_all_tasks();
        $this->data['tasks'] = $all_tasks;
        $this->template->load('admin_default_template', 'task_create/record_list', $this->data);
    }

    public function add_record()
    {
        $controller_name=$this->controller_name;
        $list_record=$this->list_link;
        $add_record=$this->add_link;

        if($this->input->post())
        {
//            echo "<pre>";
//            print_r($this->input->post('controller'));
//            print_r($this->input->post('method'));
//            print_r(User_helper::has_access(null, $this->input->post('controller'), $this->input->post('method')));exit;
//            echo "</pre>";
            if(!User_helper::has_access(null, $this->input->post('controller'), $this->input->post('method')))
            {
                $this->session->set_flashdata('fl_message_error', $this->lang->line('ACCESS_NOT_GRANTED'));
                $data['max_order'] = Query_helper::get_max_ordering( $this->config->item('table_task') );
                $data['record_info']=$this->input->post();
                $data['task_title']=$this->lang->line('CREATE_NEW_TASK');
                $this->template->load('admin_default_template', $controller_name.'/'.$add_record, $data);
            }
            else
            {
                $user_id=User_helper::get_user()->id;
                $time=time();
                $input_data = $this->input->post();
                $record_data['parent_id'] = $input_data['parent_id'];
                $record_data['name_en'] = $input_data['name_en'];
                $record_data['name_bn'] = $input_data['name_bn'];
                $record_data['description'] = $input_data['description'];
                $record_data['icon'] = $input_data['icon'];
                $record_data['controller'] = $input_data['controller'];
                $record_data['method'] = $input_data['method'];
                $record_data['ordering'] = $input_data['ordering'];
                if(!empty($input_data['position_left_01'])) $record_data['position_left_01'] = $input_data['position_left_01'];
                if(!empty($input_data['position_top_01'])) $record_data['position_top_01'] = $input_data['position_top_01'];
                $record_data['status'] = $input_data['status'];
                $record_data['create_date'] = $time;
                $record_data['create_by'] = $user_id;

                $this->db->trans_start();  //DB Transaction Handle START
                Query_helper::add($this->config->item('table_task'), $record_data);
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
                'parent_id'=>'',
                'name_en'=>'',
                'name_bn'=>'',
                'description'=>'',
                'icon'=>'',
                'controller'=>'',
                'method'=>'',
                'ordering'=>'',
                'position_left_01'=>'',
                'position_top_01'=>'',
                'status'=>1,
            );
            $all_tasks = $this->task_manage_model->get_all_tasks();
            $all_controllers = User_helper::get_controllers();
            $data['all_tasks'] = $all_tasks;
            $data['all_controllers'] = $all_controllers;
            $data['max_order'] = Query_helper::get_max_ordering( $this->config->item('table_task') );
            $data['task_title']=$this->lang->line('WAREHOUSE_CREATE');
            $this->template->load('admin_default_template', $controller_name.'/'.$add_record, $data);
        }
    }

    public function add_record_old() {
        $this->data['message'] = null;
        $this->form_validation->set_rules('name_en', 'Name EN', 'trim|required');
        if ($this->input->post()) {
            if ($this->form_validation->run() == TRUE) {
                $id = $this->task_manage_model->create_task($_POST);
                if ($id !== FALSE) {
                    $this->session->set_flashdata('fl_message', 'Task created successfully');
                    redirect('task_create/record_list');
                    return;
                } else {
                    $this->session->set_flashdata('fl_message', 'Failed to create task. ' . $id);
                    redirect('task_create/add_record');
                    return;
                }
            } else {
                $this->data['message'] = validation_errors();
                $this->template->load('admin_default_template', 'task_create/add_record', $this->data);
                return;
            }

        } else {
            $all_tasks = $this->task_manage_model->get_all_tasks();
            $all_controllers = User_helper::get_controllers();
            $this->data['all_tasks'] = $all_tasks;
            $this->data['all_controllers'] = $all_controllers;
            $this->template->load('admin_default_template', 'task_create/add_record', $this->data);
        }
    }

    public function edit_record($task_id = 0) {
        if ($task_id == 0) redirect('task_create/record_list');
        $this->data['message'] = null;

        $this->form_validation->set_rules('name_en', 'Name EN', 'trim|required');

        if ($this->input->post()) {
            if ($this->form_validation->run() == TRUE) {
                $post = $_POST;
                if(!isset($post['position_left_01'])) $post['position_left_01'] = 'off';
                if(!isset($post['position_top_01'])) $post['position_top_01'] = 'off';
                $id = $this->task_manage_model->edit_task($task_id, $post);
                if ($id !== FALSE) {
                    $this->session->set_flashdata('fl_message', 'Task edited successfully');
                    redirect('task_create/record_list');
                    return;
                } else {
                    $this->session->set_flashdata('fl_message', 'Failed to edit task. ' . $id);
                    redirect(edit_task . '/' . $task_id);
                    return;
                }
            } else {
                $this->session->set_flashdata('fl_message', validation_errors());
                redirect(edit_task . '/' . $task_id);
                return;
            }

        } else {
            $all_tasks = $this->task_manage_model->get_all_tasks();
            $all_controllers = User_helper::get_controllers();
            $task_info = $this->task_manage_model->get_task_info($task_id);
            $this->data['task_info'] = $task_info;
            $this->data['task_id'] = $task_id;
            $this->data['all_tasks'] = $all_tasks;
            $this->data['all_controllers'] = $all_controllers;
            $this->template->load('admin_default_template', 'task_create/edit_record', $this->data);
        }
    }

    public function delete_record() {

        if(!empty($this->input->post('record_id')))
        {
            $record_id = $this->input->post('record_id');
            $dependent = Query_helper::record_dependency_check(
                $this->config->item('table_task'),
                'parent_id',
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
                Query_helper::update($this->config->item('table_task'), $record_data, array('id ='.$record_id));
                $this->db->trans_complete();   //DB Transaction Handle END

                $data['status'] = 'success';
                $data['message'] = $this->lang->line('MSG_DELETE_SUCCESS');
                echo json_encode($data);
            }
        }

    }

    public function show_record($task_id) {
        $task_info = $this->task_manage_model->get_task_info($task_id);
        $this->data['task_info'] = $task_info;
        $this->template->load('admin_default_template', 'task_create/show_record', $this->data);
    }

    public function ajax_get_methods()
    {
        $controller = $_POST['controller_name'];
        echo json_encode(User_helper::get_method($controller));
    }

}