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
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('NAME');?>:</label>
                        <div class="col-md-7">
                            <input type="text" name="account_name" value="<?php echo $record_info['account_name'];?>" placeholder="<?php echo $this->lang->line('NAME');?>" class="form-control">
                        </div>
                        <span class="star_required">*</span>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('ACCOUNT_CODE');?>:</label>
                        <div class="col-md-7">
                            <input type="text" name="account_code" value="<?php echo $record_info['account_code'];?>" placeholder="<?php echo $this->lang->line('ACCOUNT_CODE');?>" class="form-control">
                        </div>
                        <span class="star_required">*</span>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('PARENT_ACCOUNT');?>:</label>
                        <div class="col-md-7">
                            <select name="parent_account" class="form-control input-medium">
                                <?php $this->load->view('dropdown', array('drop_down_options'=>$parent_account_list, 'drop_down_selected'=>$record_info['parent_account'])); ?>
                            </select>
                        </div>
                        <span class="star_required">*</span>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('ACCOUNT_TYPE');?>:</label>
                        <div class="col-md-3">
                            <select class="form-control input-medium" name="account_type" onchange="acc_type_changed()" id="acc_type_dd">
                                <option value="<?php echo $this->config->item('ACCOUNT_TYPE_NORMAL');?>"
                                    <?php if($record_info['account_type'] == $this->config->item('ACCOUNT_TYPE_NORMAL')){echo " selected";}?>
                                >
                                    <?php echo $this->lang->line('NORMAL_ACCOUNT');?>
                                </option>
                                <option value="<?php echo $this->config->item('ACCOUNT_TYPE_CONTRA');?>"
                                    <?php if($record_info['account_type'] == $this->config->item('ACCOUNT_TYPE_CONTRA')){echo " selected";}?>
                                >
                                    <?php echo $this->lang->line('CONTRA_ACCOUNT');?>
                                </option>
                            </select>
                        </div>
                        <span class="star_required">*</span>
                    </div>

                    <div class="form-group contra_hide">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('CONTRA_ACCOUNT');?>:</label>
                        <div class="col-md-7">
                            <select name="contra_account" class="form-control input-medium">
                                <?php $this->load->view('dropdown', array('drop_down_options'=>$contra_account_list, 'drop_down_selected'=>$record_info['contra_account'])); ?>

<!--                                --><?php //foreach ($record_info['contra_account_list'] as $item) { ?>
<!--                                    <option value="--><?php //echo $item['id'];?><!--"-->
<!--                                        --><?php //if($record_info['contra_account'] == $item['id']){ echo " selected"; }?><!-- >-->
<!--                                        --><?php //echo $item['title'];?>
<!--                                    </option>-->
<!--                                --><?php //}?>

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


<script>
    $(window).ready(acc_type_changed());
    function acc_type_changed(){
        var selected = $("#acc_type_dd").val();
        if(selected == <?php echo $this->config->item('ACCOUNT_TYPE_NORMAL');?>){
            $('.contra_hide').find('select').val('');
            $(".contra_hide").hide();
        }
        else if(selected == <?php echo $this->config->item('ACCOUNT_TYPE_CONTRA');?>){
            $(".contra_hide").show();
        }
    }
</script>