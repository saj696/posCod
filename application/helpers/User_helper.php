<?php

/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 14-Mar-16
 * Time: 5:57 PM
 */
class User_helper
{
    public static $logged_user = null;
    function __construct($user)
    {
        $CI = & get_instance();
        foreach ($user as $key => $value)
        {
            $this->$key = $value;
        }
        $user_group_info=$CI->db->get_where($CI->config->item('table_user_group_role'), array('id' => $this->user_group_id))->row();
        $access_array = json_decode($user_group_info->access_info, true);
        $access_array = array_change_key_case($access_array, CASE_LOWER);
        $this->access_info=$access_array;
    }

    public static function get_user()
    {

        $CI = & get_instance();
        if (User_helper::$logged_user)
        {
            return User_helper::$logged_user;
        }
        else
        {
            if($CI->session->has_userdata("session_user_id"))
            {
                $CI->db->select('users.id,
                                users.user_type,
                                users.counter_id,
                                users.username,
                                users.user_code,
                                users.user_group_id,
                                users.employee_id,
                                users.data_access,
                                users.`status`,
                                sys_employees.id,
                                sys_employees.name_en employee_en_name,
                                sys_employees.name_bn employee_bn_name,
                                sys_employees.employee_type,
                                sys_employees.gender,
                                sys_employees.profile_picture,
                                sys_employees.email,
                                sys_employees.phone');
                $CI->db->from($CI->config->item('table_users').' users');
                $CI->db->where('users.id', $CI->encrypt->decode($CI->session->userdata('session_user_id')));
                $CI->db->join($CI->config->item('table_employees').' sys_employees','sys_employees.id = users.employee_id', 'INNER');
                $CI->db->where('users.status',$CI->config->item('STATUS_ACTIVE'));
                $user = $CI->db->get()->row();
                //echo $CI->db->last_query();
                if ($user)
                {
                    /*foreach ($user as $key => $value)
                    {
                        $this->$key = $value;
                    }*/
                    User_helper::$logged_user = new User_helper($user);
                    return User_helper::$logged_user;
                }
                else
                {
                    return null;
                }

            }
            else
            {
                return null;
            }
        }
    }

    public static function has_access( $user_id = null, $controller, $method )
    {
        $controller = strtolower($controller);
        $method = strtolower($method);
        if ($controller == 'dashboard')
        {
            return true;
        }
        if ($user_id == null || $user_id == self::get_user()->id)
        {
            $access_array = User_helper::$logged_user->access_info;
        }
        elseif ($user_id != self::get_user()->id)
        {
            $CI = & get_instance();
            $CI->load->model('user_manage_model');
            $group_id = $CI->user_manage_model->get_user_info($user_id)['user_group_id'];
            $access_array = $CI->user_manage_model->get_user_group_permission_info($group_id)['access_info'];
            $access_array = json_decode($access_array, true);
            $access_array = array_change_key_case($access_array, CASE_LOWER);
        }
        if (!isset($access_array[$controller][$method]) || $access_array[$controller][$method] != 'on') { return false; }
        else { return true; }
    }

    public static function is_logged_in()
    {
        return !empty(User_helper::get_user()->id);
    }

    public static function get_controllers() {
        $Controllers = scandir(APPPATH . '\controllers');
        $results = [];
        $ignore = [ '.', '..', 'index.html', 'Welcome.php' ];
        foreach ($Controllers as $file) {
            if (!in_array($file, $ignore)) {
                $controller = explode('.', $file)[0];
//                $controller = str_replace('Controller', '', $controller);
                $results[] = $controller;
            }
        }
        return $results;
    }

    public static function get_method($controller) {
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

    public static function get_class_method_array(){
        $classes = self::get_controllers();
        $r_array=array();
        foreach($classes as $class)
        {
            $methods = self::get_method($class);
            foreach($methods as $method)
            {
                $r_array[$class][$method] = "off";
            }
        }
        return array_change_key_case($r_array, CASE_LOWER);
    }



}