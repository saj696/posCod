<?php

/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 08-Mar-16
 * Time: 5:04 PM
 */
class User_create_model extends CI_Model
{
    function __construct()
    {
    }

    public function get_all_records()
    {
        $CI =& get_instance();
        $CI->db->select
        ("
            sys_users.id,
            pos_counters.counter_name,
            sys_users.username user_name,
            sys_users.user_code,
            sys_user_groups.title user_group_name,
            sys_employees.name_en employee_name,
            sys_users.`status`,
            sys_users.created_time,
            CASE
            WHEN sys_users.status = 1 THEN 'Active'
            WHEN sys_users.status = 0 THEN 'InActive'
            ELSE ' ' END status,
            CASE
            WHEN sys_users.user_type = 1 THEN 'General'
            WHEN sys_users.user_type = 2 THEN 'Counter'
            ELSE ' ' END user_type
        ");
        $CI->db->from($CI->config->item('table_users').' sys_users');
        $CI->db->join($CI->config->item('table_counters').' pos_counters','pos_counters.id = sys_users.counter_id', 'LEFT');
        $CI->db->join($CI->config->item('table_user_group').' sys_user_groups','sys_user_groups.id = sys_users.user_group_id', 'LEFT');
        $CI->db->join($CI->config->item('table_employees').' sys_employees','sys_employees.id = sys_users.employee_id', 'LEFT');
        $CI->db->where('sys_users.status !=',$CI->config->item('STATUS_DELETE'));
        $CI->db->order_by('sys_users.username');
        $query=$CI->db->get()->result_array();
        //echo $this->db->last_query();
        return $query;
    }
}