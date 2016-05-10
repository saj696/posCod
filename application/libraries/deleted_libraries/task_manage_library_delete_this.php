<?php
/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 08-Mar-16
 * Time: 5:35 PM
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Task_manage_library {
    public function __construct() {
        $this->load->model('task_manage_model');
    }

    public function __call($method, $arguments) {
        if (!method_exists($this->task_manage_model, $method)) {
            throw new Exception('Undefined method ::' . $method . '() called in task_manage_model');
        }
        return call_user_func_array(array($this->task_manage_model, $method), $arguments);
    }

    public function __get($var) {
        return get_instance()->$var;
    }

    public function get_all_tasks(){
        return $this->task_manage_model->get_all_tasks();
    }
//    public function get_all_task_name(){
//        return $this->task_manage_model->get_all_task_name();
//    }

//    public function get_user_group_id($user_id) {
//        $user_info = $this->task_manage_model->get_user_info($user_id);
//        return $user_info['user_group_id'];
//    }

//    //data is stored in session(route_access) for current user
//    public function get_user_route_access_array_by_username($username) {
//        $user_group_id = User_helper::get_user()->user_group_id;
//        $route_access_array = $this->user_manage_model->get_user_group_permission_info($user_group_id)['access_info'];
////        $route_access_array = json_decode($route_access_array);
//        return $route_access_array;
//    }
//    public function get_user_name($user_id) {
//        $user_info = $this->user_manage_model->get_user_info($user_id);
//        return $user_info['username'];
//    }

//    public function get_user_group_name($user_group_id) {
//        $user_group_info = $this->user_manage_model->get_user_group_info($user_group_id);
//        return $user_group_info['title'];
//    }

    public function get_controllers() {
        $Controllers = scandir(APPPATH . '\controllers');
        $results = [];
        $ignore = [ '.', '..', 'index.html', 'Welcome.php' ];
        foreach ($Controllers as $file) {
            if (!in_array($file, $ignore)) {
                $controller = explode('.', $file)[0];
                $controller = str_replace('Controller', '', $controller);
                $results[] = $controller;
            }
        }
        return $results;
    }

    public function get_method($controller) {
        require_once(APPPATH . '\\controllers\\' . $controller . '.php');
        $controller_class = new ReflectionClass($controller);
        $actions = $controller_class->getMethods(ReflectionMethod::IS_PUBLIC);
        $ignore = ['__construct'];
        $methods = [];
        foreach ($actions as $action) {
            if ($action->class == $controller && !in_array($action->name, $ignore)) {
                $methods[] = $action->name;
            }
        }
        return $methods;
    }

    public function get_class_method_array(){
        $classes = $this->get_controllers();
        $r_array=array();
        foreach($classes as $class){
            $methods = $this->get_method($class);
            foreach($methods as $method){
                $r_array[$class][$method] = 0;
            }
        }
        return $r_array;
    }

}