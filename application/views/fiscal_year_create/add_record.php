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
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('FISCAL_YEAR_CODE');?>:</label>
                        <div class="col-md-7">
                            <input type="text" name="fiscal_year_code" value="<?php echo $record_info['fiscal_year_code'];?>" placeholder="<?php echo $this->lang->line('FISCAL_YEAR_CODE');?>" class="form-control">
                        </div>
                        <span class="star_required">*</span>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('START_DATE');?>:</label>
                        <div class="col-md-7">
                            <input type="text" name="start_date" value="<?php echo $record_info['start_date'];?>" placeholder="<?php echo $this->lang->line('START_DATE');?>" class="form-control" id="from">
                        </div>
                        <span class="star_required">*</span>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('END_DATE');?>:</label>
                        <div class="col-md-7">
                            <input type="text" name="end_date" value="<?php echo $record_info['end_date'];?>" placeholder="<?php echo $this->lang->line('END_DATE');?>" class="form-control" id="to">
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
<script>
    $(function () {
        $("#from").datepicker({
            dateFormat: "yy-mm-dd",
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3,
            onClose: function (selectedDate) {
                $("#to").datepicker("option", "minDate", selectedDate);
            }
        });
        $("#to").datepicker({
            dateFormat: "yy-mm-dd",
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3,
            onClose: function (selectedDate) {
                $("#from").datepicker("option", "maxDate", selectedDate);
            }
        });
    });
</script>