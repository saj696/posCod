<?php
/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 08-Mar-16
 * Time: 12:29 PM
 */
$this->load->view('admin/head', $data_head);
    $this->load->view('admin/side_bar', $data_side_bar);
    $this->load->view('admin/page_content_show_user_groups', $data_page_content);
    //$this->load->view('admin/page_content_everything', $data_page_content);
    $this->load->view('admin/side_bar_quick', $data_side_bar_quick);
$this->load->view('admin/foot', $data_foot);

