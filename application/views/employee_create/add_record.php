<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$controller_name=$this->controller_name;
$add_record=$this->add_link;
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
                <form class="form-horizontal" action="<?php echo base_url().$controller_name.'/'.$add_record;?>" method="post" enctype="multipart/form-data" >
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('NAME_EN');?>:</label>
                        <div class="col-md-7">
                            <input type="text" name="name_en" value="<?php echo $record_info['name_en'];?>" placeholder="<?php echo $this->lang->line('NAME_EN');?>" class="form-control">
                        </div>
                        <span class="star_required">*</span>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('NAME_BN');?>:</label>
                        <div class="col-md-7">
                            <input type="text" name="name_bn" value="<?php echo $record_info['name_bn'];?>" placeholder="<?php echo $this->lang->line('NAME_BN');?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('EMPLOYEE_TYPE');?>:</label>
                        <div class="col-md-3">
                            <select class="form-control input-medium" name="employee_type" id="employee_type_dd" onchange="employee_type_changed()">
                                <option value="<?php echo $this->config->item('EMPLOYEE_TYPE_EMPLOYEE')?>"><?php echo $this->lang->line('EMPLOYEE_TYPE_EMPLOYEE');?></option>
                                <option value="<?php echo $this->config->item('EMPLOYEE_TYPE_SUPPLIER')?>"><?php echo $this->lang->line('EMPLOYEE_TYPE_SUPPLIER');?></option>
                                <option value="<?php echo $this->config->item('EMPLOYEE_TYPE_CUSTOMER')?>"><?php echo $this->lang->line('EMPLOYEE_TYPE_CUSTOMER');?></option>
                            </select>
                        </div>
                        <span class="star_required">*</span>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('MEMBER_ID');?>:</label>
                        <div class="col-md-7">
                            <input type="text" name="member_id" value="<?php echo $record_info['member_id'];?>" placeholder="<?php echo $this->lang->line('MEMBER_ID');?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group supplier_hide">
                        <label class="col-md-3 control-label"><?php echo $this->lang->line('PAYSCALE_ID');?>:</label>
                        <div class="col-md-7">
                            <input type="text" name="payscale_id" value="<?php echo $record_info['payscale_id'];?>" placeholder="<?php echo $this->lang->line('PAYSCALE_ID');?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group supplier_hide">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('DESIGNATION');?>:</label>
                        <div class="col-md-3">
                            <select class="form-control input-medium" name="designation_id">
                                <?php
                                $this->load->view('dropdown', array('drop_down_options'=>$designations,'drop_down_selected'=>$record_info['designation_id']));
                                ?>
                            </select>
                        </div>
                        <span class="star_required">*</span>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('GENDER');?>:</label>
                        <div class="col-md-3">
                            <select class="form-control input-medium" name="gender">
                                <?php
                                $gender=$this->config->item('GENDER');
                                ?>
                                <option value="1" <?php if($record_info['gender']==1){echo "selected='selected'";}?>><?php echo $gender[1];?></option>
                                <option value="0" <?php if($record_info['gender']==0){echo "selected='selected'";}?>><?php echo $gender[0];?></option>
                            </select>
                        </div>
                        <span class="star_required">*</span>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('DOB');?>:</label>
                        <div class="col-md-7">
                            <input type="text" name="dob" value="<?php echo $record_info['dob'];?>" placeholder="<?php echo $this->lang->line('DOB');?>" class="form-control datepicker" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('PHONE');?>:</label>
                        <div class="col-md-7">
                            <input type="number" min="0" name="phone" value="<?php echo $record_info['phone'];?>" placeholder="<?php echo $this->lang->line('PHONE');?>" class="form-control " >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('MOBILE');?>:</label>
                        <div class="col-md-7">
                            <input type="number" min="0" name="mobile" value="<?php echo $record_info['mobile'];?>" placeholder="<?php echo $this->lang->line('MOBILE');?>" class="form-control " >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('OFFICE_PHONE');?>:</label>
                        <div class="col-md-7">
                            <input type="number" min="0" name="office_phone" value="<?php echo $record_info['office_phone'];?>" placeholder="<?php echo $this->lang->line('OFFICE_PHONE');?>" class="form-control " >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('EMAIL');?>:</label>
                        <div class="col-md-7">
                            <input type="text" name="email" value="<?php echo $record_info['email'];?>" placeholder="<?php echo $this->lang->line('email');?>" class="form-control " >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('NID');?>:</label>
                        <div class="col-md-7">
                            <input type="text" name="nid" value="<?php echo $record_info['nid'];?>" placeholder="<?php echo $this->lang->line('NID');?>" class="form-control " >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('PRESENT_ADDRESS');?>:</label>
                        <div class="col-md-7">
                            <textarea name="present_address" placeholder="<?php echo $this->lang->line('PRESENT_ADDRESS');?>" class="form-control " ><?php echo $record_info['present_address'];?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('PERMANENT_ADDRESS');?>:</label>
                        <div class="col-md-7">
                            <textarea name="permanent_address" placeholder="<?php echo $this->lang->line('PERMANENT_ADDRESS');?>" class="form-control " ><?php echo $record_info['permanent_address'];?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('PROFILE_PICTURE');?>:</label>
                        <div class="col-md-7">
                            <!--<input type="file" name="profile_picture" class="form-control " />-->
                            <input type="file" name="profile_picture" class="form-control " value=""/>
                        </div>
                    </div>
                    <div class="form-group employee_hide">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('BUSINESS_NAME');?>:</label>
                        <div class="col-md-7">
                            <input type="text" name="business_name" value="<?php echo $record_info['business_name'];?>" placeholder="<?php echo $this->lang->line('BUSINESS_NAME');?>" class="form-control " >
                        </div>
                    </div>
                    <div class="form-group employee_hide">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('BUSINESS_MOBILE');?>:</label>
                        <div class="col-md-7">
                            <input type="text" name="business_mobile" value="<?php echo $record_info['business_mobile'];?>" placeholder="<?php echo $this->lang->line('BUSINESS_MOBILE');?>" class="form-control " >
                        </div>
                    </div>
                    <div class="form-group employee_hide">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('BUSINESS_EMAIL');?>:</label>
                        <div class="col-md-7">
                            <input type="email" name="business_email" value="<?php echo $record_info['business_email'];?>" placeholder="<?php echo $this->lang->line('BUSINESS_EMAIL');?>" class="form-control " >
                        </div>
                    </div>
                    <div class="form-group employee_hide">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('CONTACT_PERSON_NAME');?>:</label>
                        <div class="col-md-7">
                            <input type="text" name="contact_person_name" value="<?php echo $record_info['contact_person_name'];?>" placeholder="<?php echo $this->lang->line('CONTACT_PERSON_NAME');?>" class="form-control " >
                        </div>
                    </div>
                    <div class="form-group employee_hide">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('CONTACT_PERSON_ADDRESS');?>:</label>
                        <div class="col-md-7">
                            <textarea name="contact_person_address" class="form-control"><?php echo $record_info['contact_person_address'];?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('BALANCE');?>:</label>
                        <div class="col-md-7">
                            <input type="text" name="balance" value="<?php echo $record_info['balance'];?>" placeholder="<?php echo $this->lang->line('BALANCE');?>" class="form-control " >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('DUE');?>:</label>
                        <div class="col-md-7">
                            <input type="text" name="due" value="<?php echo $record_info['due'];?>" placeholder="<?php echo $this->lang->line('DUE');?>" class="form-control " >
                        </div>
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
                    echo  My_menu_tree_helper::page_access_button_save();
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- END CONTENT -->
<script>
    $(window).ready(employee_type_changed());
    function employee_type_changed(){
        var selected = $("#employee_type_dd").val();
        if(selected == <?php echo $this->config->item('EMPLOYEE_TYPE_EMPLOYEE');?>){
            $('.employee_hide').find('input').val('');
            $(".employee_hide").hide();
        }
        else if(selected == <?php echo $this->config->item('EMPLOYEE_TYPE_SUPPLIER');?>){
            $(".employee_hide").show();
            $(".supplier_hide").find('input').val('');
            $(".supplier_hide").hide();
        }
        else if(selected == <?php echo $this->config->item('EMPLOYEE_TYPE_CUSTOMER');?>){
            $(".employee_hide").show();
            $(".supplier_hide").find('input').val('');
            $(".supplier_hide").hide();
        }
    }
</script>