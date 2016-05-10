<?php
/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 22-Mar-16
 * Time: 12:07 PM
 */
class User_group_manage_model extends CI_Model {
    function __construct() {
    }

    public function create_user_group($data) {
        $data['created_time'] = now();
        $this->db->insert('sys_user_groups', $data);
    }

    public function edit_user_group($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('sys_user_groups', $data);
        return true;
    }

    public function delete_user_group($id) {
        $this->db->where('id', $id);
        $this->db->delete('sys_user_groups');
        return true;
    }

    public function get_user_group_info($user_group_id) {
        return $this->db->get_where('sys_user_groups', array('id'=> $user_group_id))->row_array();
    }

    public function get_all_user_groups() {
        return $this->db->get('sys_user_groups')->result_array();
    }

    public function get_user_group_role_info($user_group_id) {
        return $this->db->get_where($this->config->item('table_user_group_role'), array('id'=> $user_group_id))->row_array();
    }

    public function update_user_group_role($user_group_id, $data) {
        $user_group_info = $this->db
            ->get_where($this->config->item('table_user_group_role'), array('user_group_id'=> $user_group_id))
            ->result_array();
        if(empty($user_group_info))
        {
            $data['user_group_id'] = $user_group_id;
            $this->db->insert( $this->config->item('table_user_group_role'), $data );
        }
        else
        {
            $this->db
                ->where('user_group_id', $user_group_id)
                ->update($this->config->item('table_user_group_role'), $data);
        }


    }



}