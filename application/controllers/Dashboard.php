<?php
/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 07-Mar-16
 * Time: 2:15 PM
 */

class Dashboard extends Root_Controller{
    function __construct(){
        parent::__construct();
    }
    public function index(){
//        $this->load->helper('My_menu_tree');


        $this->template->load('admin_default_template', 'admin/page_content', null);
    }
    public function test(){
        var_dump(User_helper::get_user());exit;;
        $this->data['my_name'] = 'potatanveer';

        $this->template->load('admin_default_template', 'admin/page_content', $this->data);
    }
}