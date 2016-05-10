<?php
/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 08-Mar-16
 * Time: 10:47 AM
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Template {
    var $template_data = array();

    function set($name, $value) {
        $this->template_data[$name] = $value;
    }

    function load($template = null, $view = '', $view_data = array(), $return = FALSE) {
        $this->CI = &get_instance();
        if (!empty($view)) {
            $this->set('contents', $this->CI->load->view($view, $view_data, TRUE));
        }
        return $this->CI->load->view('templates/'.$template, $this->template_data, $return);
    }
}

