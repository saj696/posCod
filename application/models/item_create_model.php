<?php

/**
 * Created by PhpStorm.
 * User:
 * Date: 08-Mar-16
 * Time: 5:04 PM
 */
class Item_create_model extends CI_Model
{
    function __construct()
    {
    }

    public function get_all_records()
    {
        $CI =& get_instance();
        $CI->db->select('items.*');
       $CI->db->select('category.category_name'  );

        $CI->db->from($CI->config->item('table_pos_items').' items');
         $CI->db->join($CI->config->item('table_product_categories').' category','category.id = items.last_category_id', 'LEFT');
        $CI->db->where('items.status !=',$CI->config->item('STATUS_DELETE'));

        $query=$CI->db->get()->result_array();
        foreach($query as &$q)
        {
            if($q['status']==1) {
                $q['status_text']=$CI->lang->line('ACTIVE');
            } else if($q['status']==0) {
                $q['status_text']=$CI->lang->line('INACTIVE');
            } else {
                $q['status_text']=$q['status'];
            }



             if($q['item_type']==1){
                 $q['item_type_text']=$CI->lang->line('NORMAL');
             }elseif($q['item_type']==2){
                 $q['item_type_text']=$CI->lang->line('ITEM_KITS');
             }else{
                 $q['item_type_text']=$q['item_type'];
             }



            switch ($q['unit_type']) {
                case "1":
                    $q['unit_type_text']=$CI->lang->line('ML');
                    break;
                case "2":
                    $q['unit_type_text']=$CI->lang->line('L');
                    break;
                case "3":
                    $q['unit_type_text']=$CI->lang->line('KG');
                    break;
                case "4":
                    $q['unit_type_text']=$CI->lang->line('FEET');
                    break;
                default:
                    $q['unit_type_text']=$q['unit_type'];

            }

            switch ($q['unit_size']) {
                case "1":
                    $q['unit_size_text']=$CI->lang->line('L');
                    break;
                case "2":
                    $q['unit_size_text']=$CI->lang->line('M');
                    break;
                case "3":
                    $q['unit_size_text']=$CI->lang->line('S');
                    break;
                default:
                    $q['unit_size_text']=$q['unit_size'];

            }
        }
        //echo $this->db->last_query();
        return $query;
    }
}