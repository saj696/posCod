<?php
/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 12-Mar-16
 * Time: 3:09 PM
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test_contr extends CI_Controller{
    function __construct() {
        parent::__construct();
    }
    public function index(){
        $this->data['var_dump'] = User_helper::get_user();
        $this->load->view('test_view', $this->data);
//        $this->template->load('admin_default_template', 'test_view', $this->data);
    }
    public function ajax_resp(){
        $value = array(
            'module_name' => 'Modeile name',
            'component_name' => 'Component_name name'
        );
        echo json_encode($value);
    }
}