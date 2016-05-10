<?php

/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 06-Mar-16
 * Time: 12:10 PM
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class users_library
{
    public function __construct(){
        $this->load->model('users_model');
//        $this->load->config('aaaaa', TRUE);
//        $this->users_model->trigger_events('library_constructor');
    }
    public function __call($method, $arguments){
        if (!method_exists($this->users_model, $method)){
            throw new Exception('Undefined method ::' . $method . '() called in users_model');
        }
        return call_user_func_array(array($this->users_model, $method), $arguments);
    }
    public function __get($var) {
        return get_instance()->$var;
    }


    public function get_all_users(){
        return $this->users_model->get_all_users();
    }
    public function user_logged_in(){

    }
    public function is_user(){
        $user = $this->user_model->ger_user_info();
        if( !empty($user) ){
            return true;
        } else return false;
    }
    public function library_test(){
        echo "test successful."; exit();
    }
}


?>