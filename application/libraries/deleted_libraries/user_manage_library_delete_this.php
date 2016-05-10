<?php
/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 08-Mar-16
 * Time: 5:35 PM
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class user_manage_library
{
    public function __construct()
    {
        $this->load->model('user_manage_model');
    }

    public function __call($method, $arguments) {
        if (!method_exists($this->user_manage_model, $method)) {
            throw new Exception('Undefined method ::' . $method . '() called in user_manage_model');
        }
        return call_user_func_array(array($this->user_manage_model, $method), $arguments);
    }

    public function __get($var) {
        return get_instance()->$var;
    }

    public function get_user_info_by_username($username){
        return $this->user_manage_model->get_user_info_by_username($username);
    }

    public function get_user_group_id($user_id) {
        $user_info = $this->user_manage_model->get_user_info($user_id);
        return $user_info['user_group_id'];
    }


    public function get_user_name($user_id) {
        $user_info = $this->user_manage_model->get_user_info($user_id);
        return $user_info['username'];
    }

    public function get_access_array_for_user_id($user_id)
    {
        $group_id = $this->user_manage_model->get_user_info($user_id)['user_group_id'];
        $access_array = $this->user_manage_model->get_user_group_permission_info($group_id)['access_info'];
        $access_array = json_decode($access_array, true);
        $access_array = array_change_key_case($access_array, CASE_LOWER);
        return $access_array;
    }

    public function get_user_group_name($user_group_id) {
        $user_group_info = $this->user_manage_model->get_user_group_info($user_group_id);
        return $user_group_info['title'];
    }

    public function get_user_group_list() {
        return $this->user_manage_model->get_user_group_list();
    }

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