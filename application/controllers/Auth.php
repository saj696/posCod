<?php
/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 09-Mar-16
 * Time: 10:08 AM
 */
//session_start(); //we need to start session in order to access it through CI

Class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('auth_model');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        //$this->data['message'] = 'You have been logged out Successfully.';
        if(User_helper::is_logged_in())$this->session->set_flashdata('fl_message_success', $this->lang->line('MSG_LOGOUT_SUCCESS'));
        $this->template->load('login_page_template', 'auth/login_page');

    }

    //default method to handle login url request
    public function login()
    {
        if(User_helper::is_logged_in()) redirect('dashboard');
        $fl_last_page = $this->session->flashdata('fl_last_page');
        if( !empty($fl_last_page) )
        {
            $this->session->set_flashdata('fl_message_error', $this->lang->line('MSG_LOGIN_PROMPT'));
        }
        $this->session->keep_flashdata('fl_last_page');
        $this->template->load('login_page_template', 'auth/login_page');
    }

    //recieves form submit from login page
    public function user_login()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            $is_logged_in = $this->session->userdata('is_logged_in');
            if (isset($is_logged_in) && $is_logged_in == TRUE)
            {
                redirect('dashboard');
            }
            else
            {
                $this->session->set_flashdata('fl_message_error', validation_errors());
                //$this->data['message'] = validation_errors();
                $this->template->load('login_page_template', 'auth/login_page');
                //                $this->load->view('auth/login_page', $this->data);
            }
        }
        else
        {
            $data = array
            (
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password'))
            );
            $db_user_id = $this->auth_model->login($data);
            if ( !empty($db_user_id) )
            {
                $session_user_id = $this->encrypt->encode( $db_user_id );
                $this->session->set_userdata('session_user_id', $session_user_id );
                $this->session->set_userdata('user_logged_in_time', time() );
                $fl_last_page = $this->session->flashdata('fl_last_page');
                if( !is_null($fl_last_page) )
                {
                    redirect($fl_last_page);
                }
                else
                {
                    redirect('dashboard');
                }
            }
            else
            {
                $this->session->set_flashdata('fl_message_error', $this->lang->line('MSG_WRONG_USER_PASSWORD'));
                //$this->data['message'] = 'Wrong Username / Password.';
                $this->template->load('login_page_template', 'auth/login_page');
                //                $this->load->view('auth/login_page', $this->data);
            }
        }
    }

    public function register_user()
    {
        $this->load->view('auth/registration_page');
    }

}
