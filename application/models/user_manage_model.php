<?php

/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 08-Mar-16
 * Time: 5:04 PM
 */
class User_manage_model extends CI_Model {
    function __construct()
    {
        //$this->load->database();
    }

    public function get_all_records()
    {

        return $this->db->get($this->config->item('table_users'))->result_array();
    }

    public function create_user_group($data) {
        $data['created_time'] = now();
        $this->db->insert('sys_user_groups', $data);
    }

    public function create_user($data) {
        $this->db->insert('sys_users', $data);
        return true;
    }

    public function edit_user($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('sys_users', $data);
        return true;
    }

    public function edit_user_group($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('sys_user_groups', $data);
        return true;
    }

    public function delete_user($id) {
        $this->db->where('id', $id);
        $this->db->delete('sys_users');
        return true;
    }

    public function delete_user_group($id) {
        $this->db->where('id', $id);
        $this->db->delete('sys_user_groups');
        return true;
    }

    public function get_all_user_groups() {
        return $this->db->get('sys_user_groups')->result_array();
    }

    public function get_all_users() {
        return $this->db->get('sys_users')->result_array();
    }

    public function get_user_info($user_id) {
        return $this->db
            ->select('*')
            ->from('sys_users')
            ->where('id', $user_id)
            ->get()
            ->row_array();
    }

    public function get_group_id_of_user($user_id) {
        return $this->db
            ->select('user_group_id')
            ->from('sys_users')
            ->where('id', $user_id)
            ->get()
            ->row_array();

    }

    public function get_user_info_by_username($username) {
        return $this->db
            ->select('*')
            ->from('sys_users')
            ->where('username', $username)
            ->get()
            ->row_array();
    }

    public function get_user_group_info($user_group_id) {
        return $this->db
            ->select('*')
            ->from('sys_user_groups')
            ->where('id', $user_group_id)
            ->get()
            ->row_array();
    }

    public function get_user_group_list() {
        return $this->db->get('sys_user_groups')
            ->result_array();
    }

    public function get_user_group_permission_info($user_group_id) {
        return $this->db
            ->select('*')
            ->from($this->config->item('table_user_group_role'))
            ->where('user_group_id', $user_group_id)
            ->get()
            ->row_array();
    }

    public function update_user_group_role($user_group_id, $data)
    {
        return $data;
        $this->db
            ->where('user_group_id', $user_group_id)
            ->update($this->config->item('table_user_group_role'), $data);
    }
}