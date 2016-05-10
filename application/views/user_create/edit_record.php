<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$controller_name=$this->controller_name;
$edit_record=$this->edit_link;
//echo "<pre>";
//print_r($record_info);
//echo "</pre>";

?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus-circle"></i><?php echo isset($task_title)?$task_title:null?>
                </div>
                <div class="tools"></div>
            </div>
            <div class="portlet-body">
                <form class="form-horizontal" action="<?php echo base_url().$controller_name.'/'.$edit_record.'/'.$record_id;?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('USER_TYPE');?>:</label>
                        <div class="col-md-3">
                            <select class="form-control input-medium" name="user_type" id="user_type" >
                                <option value="<?php echo $this->config->item('USER_TYPE_GENERAL');?>" <?php if($record_info['user_type']==$this->config->item('USER_TYPE_GENERAL')){echo "selected='selected'";}?>><?php echo $this->lang->line('USER_TYPE_GENERAL');?></option>
                                <option value="<?php echo $this->config->item('USER_TYPE_COUNTER');?>" <?php if($record_info['user_type']==$this->config->item('USER_TYPE_COUNTER')){echo "selected='selected'";}?>><?php echo $this->lang->line('USER_TYPE_COUNTER');?></option>
                            </select>
                        </div>
                        <span class="star_required">*</span>
                    </div>
                    <div class="form-group" id="div_counter_id" style="display: <?php if($record_info['user_type']==$this->config->item('USER_TYPE_COUNTER')){echo "block";}else{echo "none";}?>">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('COUNTER_NAME');?>:</label>
                        <div class="col-md-3">
                            <select class="form-control input-medium" name="counter_id">
                                <?php
                                $this->load->view('dropdown', array('drop_down_options'=>$counters,'drop_down_selected'=>$record_info['counter_id']));
                                ?>
                            </select>
                        </div>
                        <span class="star_required">*</span>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('USER_DATA_ACCESS');?>:</label>
                        <div class="col-md-3">
                            <select class="form-control input-medium" name="data_access" id="data_access" >
                                <option value="<?php echo $this->config->item('USER_DATA_ACCESS_ALL');?>" <?php if($record_info['data_access']==$this->config->item('USER_DATA_ACCESS_ALL')){echo "selected='selected'";}?>><?php echo $this->lang->line('USER_DATA_ACCESS_ALL');?></option>
                                <option value="<?php echo $this->config->item('USER_DATA_ACCESS_OWN');?>" <?php if($record_info['data_access']==$this->config->item('USER_DATA_ACCESS_OWN')){echo "selected='selected'";}?>><?php echo $this->lang->line('USER_DATA_ACCESS_OWN');?></option>
                                <option value="<?php echo $this->config->item('USER_DATA_ACCESS_GROUP');?>" <?php if($record_info['data_access']==$this->config->item('USER_DATA_ACCESS_GROUP')){echo "selected='selected'";}?>><?php echo $this->lang->line('USER_DATA_ACCESS_GROUP');?></option>
                            </select>
                        </div>
                        <span class="star_required">*</span>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('USER_NAME');?>:</label>
                        <div class="col-md-7">
                            <input readonly type="text" name="username" value="<?php echo $record_info['username'];?>" placeholder="<?php echo $this->lang->line('USER_NAME');?>" class="form-control">
                        </div>
                        <span class="star_required">*</span>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('PASSWORD');?>:</label>
                        <div class="col-md-7">
                            <input type="password" name="password" placeholder="<?php echo $this->lang->line('PASSWORD');?>" class="form-control" >
                        </div>
                        <span class="star_required">*</span>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('USER_CODE');?>:</label>
                        <div class="col-md-7">
                            <input type="text" name="user_code" value="<?php echo $record_info['user_code'];?>" placeholder="<?php echo $this->lang->line('USER_CODE');?>" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('USER_GROUP');?>:</label>
                        <div class="col-md-3">
                            <select class="form-control input-medium" name="user_group_id">
                                <?php
                                $this->load->view('dropdown', array('drop_down_options'=>$user_groups,'drop_down_selected'=>$record_info['user_group_id']));
                                ?>
                            </select>
                        </div>
                        <span class="star_required">*</span>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('EMPLOYEE_NAME');?>:</label>
                        <div class="col-md-3">
                            <select class="form-control input-medium" name="employee_id">
                                <?php
                                $this->load->view('dropdown', array('drop_down_options'=>$employees,'drop_down_selected'=>$record_info['employee_id']));
                                ?>
                            </select>
                        </div>
                        <span class="star_required">*</span>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('STATUS');?>:</label>
                        <div class="col-md-3">
                            <select class="form-control input-medium" name="status">
                                <option value="<?php echo $this->config->item('STATUS_ACTIVE');?>" <?php if($record_info['status']==$this->config->item('STATUS_ACTIVE')){echo "selected='selected'";}?>><?php echo $this->lang->line('ACTIVE');?></option>
                                <option value="<?php echo $this->config->item('STATUS_INACTIVE');?>" <?php if($record_info['status']==$this->config->item('STATUS_INACTIVE')){echo "selected='selected'";}?>><?php echo $this->lang->line('INACTIVE');?></option>
                            </select>
                        </div>
                        <span class="star_required">*</span>
                    </div>
                    <?php
                    echo  My_menu_tree_helper::page_access_button_update();
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function ()
    {
        //turn_off_triggers();

        $(document).on("change","#user_type",function()
        {
            console.log($(this).val());
            if($(this).val()==2)
            {
                $("#div_counter_id").show();
            }
            else
            {
                $("#div_counter_id").hide();
            }

        });
    });
</script>