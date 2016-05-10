<?php

/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 08-Mar-16
 * Time: 5:04 PM
 */
class Auth_model extends CI_Model
{
    function __construct()
    {
        $this->load->database();
    }

    // Insert registration data in database
    public function registration_insert($data)
    {

        // Query to check whether username already exist or not
        $condition = "user_name =" . "'" . $data['user_name'] . "'";
        $this->db->select('*');
        $this->db->from('user_login');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {

            // Query to insert data in database
            $this->db->insert('user_login', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            return false;
        }
    }

    public function login($data)
    {

        $condition = "username =" . "'" . $data['username'] . "' AND " . "password =" . "'" . $data['password'] . "'";
        $this->db->select('*');
        $this->db->from('sys_users');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get()->row_array();
        if (!empty($query))
        {

            if($query['password']==$data['password'])
            {
                $user_info['user_id']=$query['id'];
                $user_info['login_time']=time();
                $user_info['ip_address']=$this->input->ip_address();
                $user_info['request_headers']=json_encode($this->input->request_headers());
                Query_helper::add($this->config->item('table_user_login_history'),$user_info);
                return $query['id'];
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
//
//// Read data from database to show data in admin page
//    public function read_user_information($username){
//        $condition = "username =" . "'" . $username . "'";
//        $this->db->select('*');
//        $this->db->from('sys_users');
//        $this->db->where($condition);
//        $this->db->limit(1);
//        $query = $this->db->get();
//
//        if ($query->num_rows() == 1) {
//            return $query->result();
//        } else {
//            return false;
//        }
//    }

}