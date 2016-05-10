<?php

/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 08-Mar-16
 * Time: 5:04 PM
 */
class Designation_create_model extends CI_Model
{
    function __construct()
    {
    }

    public function get_all_records()
    {
        $CI =& get_instance();
        $CI->db->select
        ("
            sys_designations.id,
            sys_designations.name_en,
            sys_designations.name_bn,
            sys_designations.ordering,
            sys_designations.`status`,
            sys_designations.created_time,
            CASE
            WHEN sys_designations.status = 1 THEN 'Active'
            WHEN sys_designations.status = 0 THEN 'InActive'
            ELSE ' ' END status,
        ");
        $CI->db->from($CI->config->item('table_designations').' sys_designations');
        $CI->db->where('sys_designations.status !=',$CI->config->item('STATUS_DELETE'));
        $CI->db->order_by('sys_designations.ordering');
        $query=$CI->db->get()->result_array();
        //echo $this->db->last_query();
        return $query;
    }
}