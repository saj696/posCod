<?php

/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 12-Mar-16
 * Time: 3:01 PM
 */
class Root_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $req_class = $this->router->fetch_class();
        $req_method = $this->router->fetch_method();
        if ( !User_helper::is_logged_in() )
        {
            $this->session->set_flashdata('fl_last_page', $req_class.'/'.$req_method);
            $this->session->set_flashdata('fl_message_error', $this->lang->line('LOGIN_TO_YOUR_ACCOUNT'));
            redirect('auth/login');
        }
        else
        {
            $session_user_id = User_helper::get_user()->id;
            $has_access = User_helper::has_access( $session_user_id, $req_class, $req_method); //return value from has access function
            if( !$has_access )
            {
                $this->session->set_flashdata('fl_message_error', $this->lang->line('ACCESS_NOT_GRANTED'));
                redirect('dashboard');
            }
        }
    }
}