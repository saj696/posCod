<?php

/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 08-Mar-16
 * Time: 5:04 PM
 */
class Fiscal_year_create_model extends CI_Model
{
    function __construct()
    {
    }

    public function get_all_records()
    {
        /*$CI =& get_instance();
        $CI->db->select
        ("
            pos_fiscal_year.id,
            pos_fiscal_year.fiscal_year_code,
            pos_fiscal_year.start_date,
            pos_fiscal_year.end_date,
            CASE
            WHEN pos_fiscal_year.status = 1 THEN 'Active'
            WHEN pos_fiscal_year.status = 0 THEN 'InActive'
            ELSE ' ' END status
        ");
        $CI->db->from($CI->config->item('table_fiscal_year').' pos_fiscal_year');
        $CI->db->where('pos_fiscal_year.status',$CI->config->item('STATUS_ACTIVE'));
        $query=$CI->db->get()->result_array();
        echo $this->db->last_query();
        return $query;*/
    }
}