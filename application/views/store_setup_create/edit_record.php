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
                            <input type="text" name="store_name" value="<?php echo $record_info['store_name'];?>" placeholder="<?php echo $this->lang->line('NAME');?>" class="form-control">
                        </div>
                        <span class="star_required">*</span>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('MOTTO');?>:</label>
                        <div class="col-md-7">
                            <textarea name="motto" class="form-control"><?php echo $record_info['motto'];?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('ADDRESS');?>:</label>
                        <div class="col-md-7">
                            <textarea name="address" class="form-control"><?php echo $record_info['address'];?></textarea>
                        </div>
                        <span class="star_required">*</span>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('STATUS');?>:</label>
                        <div class="col-md-3">
                            <select class="form-control input-medium" name="status">
                                <option value="<?php echo $this->config->item('STATUS_ACTIVE');?>" <?php if($record_info['status']==$this->config->item('STATUS_ACTIVE')){echo " selected";}?>><?php echo $this->lang->line('ACTIVE');?></option>
                                <option value="<?php echo $this->config->item('STATUS_INACTIVE');?>" <?php if($record_info['status']==$this->config->item('STATUS_INACTIVE')){echo " selected";}?>><?php echo $this->lang->line('INACTIVE');?></option>
                            </select>
                        </div>
                        <span class="star_required">*</span>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('PICTURE');?>:</label>
                        <div class="col-md-7">
                            <input type="file" name="picture" class="form-control">
                        </div>
                    </div>

                    <?php
                    echo  My_menu_tree_helper::page_access_button_update();
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>