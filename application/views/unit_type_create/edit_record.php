<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$controller_name=$this->controller_name;
$edit_record=$this->edit_link;

?>
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
                <form class="form-horizontal" action="<?php echo base_url().$controller_name.'/'.$edit_record.'/'.$record_id;?>" method="post" enctype="multipart/form-data" >
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('NAME');?>:</label>
                        <div class="col-md-7">
                            <input type="text" name="unit_type_name" value="<?php echo $record_info['unit_type_name'];?>" placeholder="<?php echo $this->lang->line('NAME');?>" class="form-control">
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