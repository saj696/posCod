<?php

/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 08-Mar-16
 * Time: 5:04 PM
 */
class employee_manage_model extends CI_Model {
    function __construct() {
        $this->load->database();
    }

    public function create_employee_group($data) {
        $data['created_time'] = now();
        $this->db->insert('sys_employee_groups', $data);
    }

    public function create_employee($data) {
        $this->db->insert('sys_employees', $data);
        return true;
    }

    public function edit_employee($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('sys_employees', $data);
        return true;
    }

    public function edit_employee_group($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('sys_employee_groups', $data);
        return true;
    }

    public function delete_employee($id) {
        $this->db->where('id', $id);
        $this->db->delete('sys_employees');
        return true;
    }

    public function delete_employee_group($id) {
        $this->db->where('id', $id);
        $this->db->delete('sys_employee_groups');
        return true;
    }

    public function get_all_employee_groups() {
        return $this->db->get('sys_employee_groups')->result_array();
    }

    public function get_all_employees() {
        $CI =& get_instance();

        $CI->db->select("
        sys_designations.name_en,
        sys_employees.*,
        sys_employees.`status`,
        pos_payscales.payscales_title,
        CASE
            WHEN sys_employees.status = 1 THEN 'Active'
            WHEN sys_employees.status = 0 THEN 'InActive'
            ELSE ' ' END status,
        CASE
            WHEN gender = 1 THEN 'Male'
            WHEN gender = 0 THEN 'Female'
            ELSE '' END gender,
        CASE
            WHEN employee_type = 1 THEN 'Employee'
            WHEN employee_type = 2 THEN 'Supplier'
            WHEN employee_type = 3 THEN 'Customer'
            ELSE '' END employee_type

          ");
        $CI->db->from( $this->config->item('table_employees') );
        $CI->db->where("sys_employees.status != 99");
        $CI->db->join("sys_designations", "sys_designations.id = sys_employees.designation_id", "Left" );
        $CI->db->join("pos_payscales", "pos_payscales.id = sys_employees.payscale_id", "Left" );

        return $CI->db->get()->result_array();
    }

    public function get_employee_info($employee_id) {
        return $this->db
            ->select('*')
            ->from('sys_employees')
            ->where('id', $employee_id)
            ->get()
            ->row_array();
    }

    public function get_group_id_of_employee($employee_id) {
        return $this->db
            ->select('employee_group_id')
            ->from('sys_employees')
            ->where('id', $employee_id)
            ->get()
            ->row_array();

    }

//    public function get_employee_info_by_employeename($employeename) {
//        return $this->db
//            ->select('*')
//            ->from('sys_employees')
//            ->where('employeename', $employeename)
//            ->get()
//            ->row_array();
//    }

    public function get_employee_group_info($employee_group_id) {
        return $this->db
            ->select('*')
            ->from('sys_employee_groups')
            ->where('id', $employee_group_id)
            ->get()
            ->row_array();
    }

//    public function get_employee_group_list() {
//        return $this->db->get('sys_employee_groups')
//            ->result_array();
//    }

    public function get_employee_group_permission_info($employee_group_id) {
        return $this->db
            ->select('*')
            ->from('employee_group_role')
            ->where('employee_group_id', $employee_group_id)
            ->get()
            ->row_array();
    }

    public function update_employee_group_role($employee_group_id, $data) {
        $this->db
            ->where('employee_group_id', $employee_group_id)
            ->update('employee_group_role', $data);
    }
}