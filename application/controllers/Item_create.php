<?php

/**
 * Created by PhpStorm.
 * User: Tanveer Ahmed
 * Date: 08-Mar-16
 * Time: 4:18 PM
 */
class Item_create extends Root_Controller
{
    public $permissions;
    public $controller_name;
    public $model_name;
    public $list_link;
    public $grid_link;
    public $view_link;
    public $add_link;
    public $edit_link;
    public $delete_link;
    public $message;
    public $table_name;
    public $sub_category;
    private  $parent= array();

    function __construct()
    {
        parent::__construct();

        $this->controller_name = $this->router->fetch_class();
        $this->model_name = "item_create_model";
        $this->list_link = "record_list";
        $this->grid_link = "get_record_list";
        $this->add_link = "add_record";
        $this->edit_link = "edit_record";
        $this->view_link = "view_record";
        $this->delete_link = "delete_record";
        $this->table_name=$this->config->item('table_pos_items') ;
        $this->sub_category='get_child_categories';
        $this->message = "";

        $this->load->model($this->model_name);
        //$this->lang->load($this->controller_name);
        /*$this->permissions=Menu_helper::get_permission($this->controller_name);*/

    }

    public function record_list()
    {
        $data['task_title']=$this->lang->line('ITEM_LIST');
        $data['new_button_name']=$this->lang->line('ITEM_CREATE');
        $this->template->load('admin_default_template', 'item_create/record_list',$data);
    }

    public function get_record_list()
    {
        $model=$this->model_name;
        echo json_encode($this->$model->get_all_records());
    }

    public function add_record()
    {
        $controller_name=$this->controller_name;
        $list_record=$this->list_link;
        $add_record=$this->add_link;

        if($this->input->post())
        {
            if(!$this->check_validation())
            {
                $this->session->set_flashdata('fl_message_error', $this->message);
                $data['record_info']=$this->input->post();
                $data['task_title']=$this->lang->line('item_create');
                $data['category'] = Query_helper::get_list($this->config->item('table_product_categories'),'category_name',array('status = '.$this->config->item('STATUS_ACTIVE'),'parent_id = '.'1'));
                $this->template->load('admin_default_template', 'item_create/add_record', $data);
            }
            else
            {
                $user_id=User_helper::get_user()->id;
                $time=time();


                $input_data = $this->input->post();
             //   $record_data['last_category_id'] = $input_data['last_category_id'];

             $last_category_id = $input_data['category_id'];

                $last_key = count($last_category_id)-1;

                if($last_category_id[$last_key]!=''){
                    $record_data['last_category_id']=$last_category_id[$last_key];
                }else{
                    $record_data['last_category_id']=$last_category_id[$last_key-1];
                }



                $record_data['item_name'] = $input_data['item_name'];
                $record_data['description'] = $input_data['description'];
             //   $record_data['supplier_id'] = $input_data['supplier_id'];
                $record_data['track_type'] = $input_data['track_type'];
                $record_data['item_type'] = $input_data['item_type'];
                $record_data['unit_type'] = $input_data['unit_type'];
                $record_data['unit_size'] = $input_data['unit_size'];
                $record_data['retail_price'] = $input_data['retail_price'];
                $record_data['whole_sale_price'] = $input_data['whole_sale_price'];
                $record_data['discount_type'] = $input_data['discount_type'];
                $record_data['discount'] = $input_data['discount'];
                $record_data['discount_start_date'] = System_helper::get_sql_date($input_data['discount_start_date']);
                $record_data['discount_end_date'] = System_helper::get_sql_date($input_data['discount_end_date']);
                $record_data['return_within'] = $input_data['return_within'];
                $record_data['status'] = $input_data['status'];
                $record_data['created_time'] = $time;
                $record_data['created_by'] = $user_id;

                $dir = $this->config->item("file_upload");
                $uploaded = System_helper::upload_file($dir['item_pictures'],1024,'gif|jpg|png');
                if(array_key_exists('picture',$uploaded))
                {
                    if($uploaded['picture']['status'])
                    {
                        $record_data['picture'] = $uploaded['picture']['info']['file_name'];
                    }
                    else
                    {
                        $this->session->set_flashdata('fl_message_error', $uploaded['picture']['message']);
                    }
                }

                $this->db->trans_start();  //DB Transaction Handle START

                Query_helper::add($this->table_name, $record_data);

                $this->db->trans_complete();   //DB Transaction Handle END


                if ($this->db->trans_status() === TRUE)
                {
                    $this->session->set_flashdata('fl_message_success', $this->lang->line('MSG_CREATE_SUCCESS'));
                    redirect(base_url().$controller_name.'/'.$list_record);
                }
                else
                {
                    $this->session->set_flashdata('fl_message_error', $this->lang->line('MSG_CREATE_FAIL'));
                    redirect(base_url().$controller_name.'/'.$add_record);
                }
            }

        }
        else
        {
            $data['record_info']=array
            (   'category'=>'',
                'item_name'=>'',
                'description'=>'',
                'supplier_id'=>'',
                'track_type'=>'',
                'item_type'=>'',
                'unit_type'=>'',
                'unit_size'=>'',
                'retail_price'=>'',
                'whole_sale_price'=>'',
                'discount_type'=>'',
                'discount'=>'',
                'discount_start_date'=>'',
                'discount_end_date'=>'',
                'return_within'=>'',
                'status'=>1,
            );
            $data['task_title']=$this->lang->line('item_create');
            $data['category'] = Query_helper::get_list($this->config->item('table_product_categories'),'category_name',array('status = '.$this->config->item('STATUS_ACTIVE'),'parent_id = '.'1'));
            $this->template->load('admin_default_template', 'item_create/add_record', $data);
        }

    }
    public function edit_record($record_id)
    {

        $controller_name=$this->controller_name;
        $list_record=$this->list_link;
        $edit_record=$this->edit_link;
        if($record_id<=0)
        {
            $this->session->set_flashdata('fl_message_error', $this->lang->line('SELECT_ONE_ITEM'));
            redirect($controller_name.'/'.$list_record);
        }
        if($this->input->post())
        {
            if(!$this->check_validation($record_id))
            {
                $this->session->set_flashdata('fl_message_error', $this->message);
                $data['record_id']=$record_id;
                $data['record_info']=Query_helper::get_info($this->config->item('table_users'),'*',array('id = '.$record_id),1);
                $data['task_title']=$this->lang->line('USER_EDIT');
                $this->template->load('admin_default_template', 'item_create/edit_record', $data);
            }
            else
            {
                $user_id=User_helper::get_user()->id;
                $time=time();

                $input_data = $this->input->post();

                $last_category_id = $input_data['category_id'];

                $last_key = count($last_category_id)-1;

                if($last_category_id[$last_key]!=''){
                    $record_data['last_category_id']=$last_category_id[$last_key];
                }else{
                    $record_data['last_category_id']=$last_category_id[$last_key-1];
                }

                $record_data['item_name'] = $input_data['item_name'];
                $record_data['description'] = $input_data['description'];
             //   $record_data['supplier_id'] = $input_data['supplier_id'];
                $record_data['track_type'] = $input_data['track_type'];
                $record_data['item_type'] = $input_data['item_type'];
                $record_data['unit_type'] = $input_data['unit_type'];
                $record_data['unit_size'] = $input_data['unit_size'];
                $record_data['retail_price'] = $input_data['retail_price'];
                $record_data['whole_sale_price'] = $input_data['whole_sale_price'];
                $record_data['discount_type'] = $input_data['discount_type'];
                $record_data['discount'] = $input_data['discount'];
                $record_data['discount_start_date'] = System_helper::get_sql_date($input_data['discount_start_date']);
                $record_data['discount_end_date'] = System_helper::get_sql_date($input_data['discount_end_date']);
                $record_data['return_within'] = $input_data['return_within'];
                $record_data['status'] = $input_data['status'];

                $record_data['updated_by'] = $user_id;
                $record_data['updated_time'] = $time;

                $dir = $this->config->item("file_upload");
                $uploaded = System_helper::upload_file($dir['item_pictures'],1024,'gif|jpg|png');
                if(array_key_exists('picture',$uploaded))
                {
                    if($uploaded['picture']['status'])
                    {
                        $record_data['picture'] = $uploaded['picture']['info']['file_name'];
                    }
                    else
                    {
                        $this->session->set_flashdata('fl_message_error', $uploaded['picture']['message']);
                    }
                }

                $this->db->trans_start();  //DB Transaction Handle START

                Query_helper::update($this->table_name, $record_data, array('id ='.$record_id));

                $this->db->trans_complete();   //DB Transaction Handle END


                if ($this->db->trans_status() === TRUE)
                {
                    $this->session->set_flashdata('fl_message_success', $this->lang->line('MSG_UPDATE_SUCCESS'));
                    redirect(base_url().$controller_name.'/'.$list_record);
                }
                else
                {
                    $this->session->set_flashdata('fl_message_error', $this->lang->line('MSG_UPDATE_FAIL'));
                    redirect(base_url().$controller_name.'/'.$edit_record);
                }
            }

        }
        else
        {
            $data['task_title']=$this->lang->line('ITEM_EDIT');
            $data['record_id']=$record_id;
            $data['category'] = Query_helper::get_list($this->config->item('table_product_categories'),'category_name',array('status = '.$this->config->item('STATUS_ACTIVE'),'parent_id = '.'1'));
            $data['all_category']=Query_helper::get_list($this->config->item('table_product_categories'),'category_name',array('status = '.$this->config->item('STATUS_ACTIVE')));
            $data['record_info']=Query_helper::get_info($this->table_name,'*',array('id = '.$record_id),1);

            $cat_id= $data['record_info']['last_category_id'];
            $this->parent[]=$cat_id;
            $category_id= array_reverse($this->has_parent($cat_id));
           //print_r($category_id);die();
            $data['category_id']= $category_id;
//            $sub_cattegory= array();
//            for($i=0;$i<count($category_id);$i++){
//                //echo $category_id[$i].'<br/>';
//            $sub_cattegory[$category_id[$i++]]= Query_helper::get_list($this->config->item('table_product_categories'),'category_name',array('status = '.$this->config->item('STATUS_ACTIVE'),'parent_id = '.$category_id[$i]));
//            }
//            print_r($sub_cattegory);
//            die();

            if(empty($data['record_info']))
            {
                redirect($controller_name.'/'.$list_record);
            }
            $this->template->load('admin_default_template', 'item_create/edit_record', $data);
        }
    }
    public function view_record()
    {

    }
    public function delete_record()
    {
        if($this->input->post())
        {
            if(!empty($this->input->post('record_id')))
            {
                $id = $this->input->post('record_id');
                Query_helper::delete($this->table_name, array('id' => $id));
            }
        }
    }
    private function check_validation($record_id='')
    {

        $this->load->library('form_validation');

       // $this->form_validation->set_rules('category_id[]',$this->lang->line('CATEGORY'),'required');
        $this->form_validation->set_rules('item_name',$this->lang->line('ITEM_NAME'),'required');
        $this->form_validation->set_rules('description',$this->lang->line('DESCRIPTION'),'required');

     //   $this->form_validation->set_rules('supplier_id',$this->lang->line('SUPPLIER'),'required');

        $this->form_validation->set_rules('track_type',$this->lang->line('TRACK_TYPE'),'required');

        $this->form_validation->set_rules('item_type',$this->lang->line('ITEM_TYPE'),'required');

        $this->form_validation->set_rules('unit_type',$this->lang->line('UNIT_TYPE'),'required');

        $this->form_validation->set_rules('retail_price',$this->lang->line('RETAIL_PRICE'),'required');

        $this->form_validation->set_rules('whole_sale_price',$this->lang->line('WHOLE_SALE_PRICE'),'required');
        $this->form_validation->set_rules('discount_type',$this->lang->line('DISCOUNT_TYPE'),'required');


        $this->form_validation->set_rules('status',$this->lang->line('STATUS'),'required');



        if($this->form_validation->run() == FALSE)
        {
            $this->message = validation_errors();
            return false;
        }
        return true;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////

    public function subcategories()
    {
        $id = $this->input->post('typeFeed');

        $query = $this->db->select('categories.*')
            ->from($this->config->item('table_product_categories').' categories')
            ->where('parent_id', $id)
            ->get();

        if ($query->num_rows() > 0):
            $html='';
            $html .= '<select name="category_id[]" class="form-control parent" id="parent">';
            $html .= '<option value="" selected="selected">-- Sub Category --</option>';

            foreach ($query->result() as $row){
                $html .= '<option value="'.$row->id.'">'.$row->category_name.'</option>';
            }

            $html .= '</select>';
            echo $html;

        else:
           // echo 'No Sub Category';
        endif;

    }
//    public function subcategories_edit(){
//        $id = $this->input->post('typeFeed');
//        echo $id;
//    }
        private function has_parent($id){

            $CI =& get_instance();
            $CI->db->select('categories.*');
            $CI->db->from($CI->config->item('table_product_categories') . ' categories');
            $CI->db->where('categories.id =', $id);
            $CI->db->where('categories.status !=', $CI->config->item('STATUS_DELETE'));
            $query = $CI->db->get()->row();
            if ($query->parent_id > 1) {

           $this->parent[]= $query->parent_id;

                $this->has_parent($query->parent_id);

            } else {

            }
            return $this->parent;
        }
}