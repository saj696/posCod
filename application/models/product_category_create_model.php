<?php

/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 08-Mar-16
 * Time: 5:04 PM
 */
class Product_category_create_model extends CI_Model
{
    function __construct()
    {
    }
    public function get_record_list() {
        $CI =& get_instance();
        $CI->db->select("
            pos_product_categories.id,
            pos_product_categories.category_name,
            pos_product_categories.`status`,
            parent_table.category_name AS parent_name,
            CASE
                WHEN pos_product_categories.status = 1 THEN 'Active'
                WHEN pos_product_categories.status = 0 THEN 'InActive'
                ELSE ' ' END status,
        ");
        $CI->db->from( $this->config->item('table_product_categories') );
        $CI->db->where($this->config->item('table_product_categories').".status != 99");
        $CI->db->join("pos_product_categories AS parent_table", "parent_table.id = pos_product_categories.parent_id", "Left" );

        return $CI->db->get()->result_array();
    }

//    public function get_all_records()
//    {
//        $CI =& get_instance();
//        $CI->db->select
//        ('
//            sys_users.id,
//            sys_users.user_type,
//            pos_counters.counter_name,
//            sys_users.username user_name,
//            sys_users.user_code,
//            sys_user_groups.title user_group_name,
//            sys_employees.name_en employee_name,
//            sys_users.`status`,
//            sys_users.created_time
//        ');
//        $CI->db->from($CI->config->item('table_users').' sys_users');
//        $CI->db->join($CI->config->item('table_counters').' pos_counters','pos_counters.id = sys_users.counter_id', 'LEFT');
//        $CI->db->join($CI->config->item('table_user_group').' sys_user_groups','sys_user_groups.id = sys_users.user_group_id', 'LEFT');
//        $CI->db->join($CI->config->item('table_employees').' sys_employees','sys_employees.id = sys_users.employee_id', 'LEFT');
//        $CI->db->where('sys_users.status',$CI->config->item('STATUS_ACTIVE'));
//        $query=$CI->db->get()->result_array();
//        //echo $this->db->last_query();
//        return $query;
//    }
}