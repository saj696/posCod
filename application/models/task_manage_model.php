<?php
/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 08-Mar-16
 * Time: 5:04 PM
 */

class Task_manage_model extends CI_Model{
    function __construct(){
        $this->load->database();
    }

    public function get_task_info($id){
        return $this->db
            ->select('*')
            ->from('sys_tasks')
            ->where('id', $id)
            ->get()
            ->row_array();
    }
//    public function get_task_info(){
//        $query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
//    }
    public function delete_task($id){
        $this->db->where('id', $id);
        $this->db->delete('sys_tasks');
        return true;
    }
    public function create_task($data)
    {
        $data['create_date'] = now();
        $this->db->insert('sys_tasks', $data);
    }
    public function edit_task($id ,$data)
    {
        $this->db->where('id', $id);
        $this->db->update('sys_tasks', $data);
        return true;
    }
    public function get_all_tasks(){
        return $this->db
            ->select("*")
            ->from($this->config->item("table_task"))
            ->where("position_left_01 = 'on'")
            ->where("status != ".$this->config->item('STATUS_DELETE'))
            ->order_by('ordering', 'asc')
            ->get()
            ->result_array();
    }
    public function get_all_task_name(){
        return $this->db
            ->select('name_en')
            ->from('sys_tasks')
            ->get()
            ->result_array();
    }

}