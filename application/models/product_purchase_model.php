<?php

class Product_purchase_model extends CI_Model
{
    function __construct()
    {
    }

    public function get_record_list()
    {
        $CI =& get_instance();
        $CI->db->select('transaction.*');
        $CI->db->select('user.username'  );

        $CI->db->from($CI->config->item('table_purchase_transactions').' transaction');
        $CI->db->join($CI->config->item('table_users').' user','user.id = transaction.person_id', 'LEFT');
        $CI->db->where('transaction.status !=',$CI->config->item('STATUS_DELETE'));
        $CI->db->where('transaction.transaction_type =',$CI->config->item('PURCHASE'));
        $CI->db->order_by("transaction.id", "desc");
        $query=$CI->db->get()->result_array();

        foreach ($query as &$val){
          $val['date']=System_helper::display_date($val['purchase_date']);
        }
        //echo $this->db->last_query();
        return $query;
    }

    public function get_all_item_name_by_str($str)
    {
        $CI =& get_instance();
        $CI->db->from($CI->config->item('table_pos_items'));
        $this->db->like('item_name', $str, 'after');
//        $CI->db->where();
        $CI->db->select('item_name as label');
        $CI->db->select('id as value');
        $CI->db->select('discount_type as discount_type');
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_personal_balance($person_id)
    {
        $this->db->select('balance,id');
        $this->db->where('person_id =', $person_id);
        $result = $this->db->get($this->config->item('table_pos_personal_accounts'))->row();
        return $result;
    }

    public function update_personal_account_balance($id, $data)
    {
        $this->db->where('id',$id);
        $this->db->update($this->config->item('table_pos_personal_accounts'), $data);
    }
    public function get_products_by_transaction($id){

        $CI =& get_instance();
        $CI->db->select('purchase_items.*');
        $CI->db->select('items.item_name');

        $CI->db->from($CI->config->item('table_purchase_related_items').' purchase_items');

        $CI->db->join($CI->config->item('table_pos_items').' items','items.id = purchase_items.item_id', 'LEFT');
        $CI->db->where('purchase_items.status !=',$CI->config->item('STATUS_DELETE'));
        $CI->db->where('purchase_items.purchase_transaction_id =',$id);
        $query=$CI->db->get()->result_array();
        //echo $this->db->last_query();
        return $query;
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