<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$controller_name=$this->controller_name;
$add_record=$this->add_link;
$find_sub_category = $this->sub_category;
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
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('CATEGORY');?>:</label>
                        <div class="col-md-5">
                            <select class="form-control parent mother_parent" name="category_id[]" id="" required>

                                <?php
                                $this->load->view('dropdown', array('drop_down_options'=>$category,'drop_down_selected'=>$record_info['category']));
                                ?>
                            </select>
                            <div id="show_sub_categories" class="show_sub_categories"></div>

                        </div>
                        <span class="star_required">*</span>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('ITEM_NAME');?>:</label>
                        <div class="col-md-5">
                            <input type="text" name="item_name" value="<?php echo $record_info['item_name'];?>" class="form-control">
                        </div>
                        <span class="star_required">*</span>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('DESCRIPTION');?>:</label>
                        <div class="col-md-5">
                            <input type="text" name="description" value="<?php echo $record_info['description'];?>"  class="form-control">
                        </div>
                        <span class="star_required">*</span>
                    </div>

<!--                    <div class="form-group">-->
<!--                        <label for="title" class="col-md-3 control-label">--><?php //echo $this->lang->line('SUPPLIER');?><!--:</label>-->
<!--                        <div class="col-md-5">-->
<!--                            <select class="form-control" name="supplier_id" >-->
<!---->
<!--                                --><?php
//                                $this->load->view('dropdown', array('drop_down_options'=>$supplier,'drop_down_selected'=>$record_info['supplier_id']));
//                                ?>
<!--                            </select>-->
<!--                        </div>-->
<!--                        <span class="star_required">*</span>-->
<!--                    </div>-->

                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('TRACK_TYPE');?>:</label>
                        <div class="col-md-5">
                            <select class="form-control " name="track_type" >
                                <option value="<?php echo $this->config->item('Test');?>" <?php if($record_info['track_type']==$this->config->item('Test')){echo "selected='selected'";}?>><?php echo $this->lang->line('Test');?></option>
                                <option value="<?php echo $this->config->item('Test2');?>" <?php if($record_info['track_type']==$this->config->item('Test2')){echo "selected='selected'";}?>><?php echo $this->lang->line('Test2');?></option>

                            </select>
                        </div>
                        <span class="star_required">*</span>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('ITEM_TYPE');?>:</label>
                        <div class="col-md-5">
                            <select class="form-control " name="item_type" >
                                <option value="<?php echo $this->config->item('NORMAL');?>" <?php if($record_info['item_type']==$this->config->item('NORMAL')){echo "selected='selected'";}?>><?php echo $this->lang->line('NORMAL');?></option>
                                <option value="<?php echo $this->config->item('ITEM_KITS');?>" <?php if($record_info['item_type']==$this->config->item('ITEM_KITS')){echo "selected='selected'";}?>><?php echo $this->lang->line('ITEM_KITS');?></option>

                            </select>
                        </div>
                        <span class="star_required">*</span>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('UNIT_TYPE');?>:</label>
                        <div class="col-md-5">
                            <select class="form-control " name="unit_type" >
                                <option value="<?php echo $this->config->item('ML');?>" <?php if($record_info['unit_type']==$this->config->item('ML')){echo "selected='selected'";}?>><?php echo $this->lang->line('ML');?></option>
                                <option value="<?php echo $this->config->item('L');?>" <?php if($record_info['unit_type']==$this->config->item('L')){echo "selected='selected'";}?>><?php echo $this->lang->line('L');?></option>
                                <option value="<?php echo $this->config->item('KG');?>" <?php if($record_info['unit_type']==$this->config->item('KG')){echo "selected='selected'";}?>><?php echo $this->lang->line('KG');?></option>
                                <option value="<?php echo $this->config->item('FEET');?>" <?php if($record_info['unit_type']==$this->config->item('FEET')){echo "selected='selected'";}?>><?php echo $this->lang->line('FEET');?></option>
                            </select>
                        </div>
                        <span class="star_required">*</span>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('UNIT_SIZE');?>:</label>
                        <div class="col-md-5">
                            <select class="form-control " name="unit_size" >
                                <option value="<?php echo $this->config->item('L');?>" <?php if($record_info['unit_size']==$this->config->item('L')){echo "selected='selected'";}?>><?php echo $this->lang->line('L');?></option>
                                <option value="<?php echo $this->config->item('M');?>" <?php if($record_info['unit_size']==$this->config->item('M')){echo "selected='selected'";}?>><?php echo $this->lang->line('M');?></option>
                                <option value="<?php echo $this->config->item('S');?>" <?php if($record_info['unit_size']==$this->config->item('S')){echo "selected='selected'";}?>><?php echo $this->lang->line('S');?></option>
                            </select>
                        </div>
                        <span class="star_required">*</span>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('RETAIL_PRICE');?>:</label>
                        <div class="col-md-5">
                            <input type="text" name="retail_price" value="<?php echo $record_info['retail_price'];?>" class="form-control">
                        </div>
                        <span class="star_required">*</span>
                    </div>


                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('WHOLE_SALE_PRICE');?>:</label>
                        <div class="col-md-5">
                            <input type="text" name="whole_sale_price" value="<?php echo $record_info['whole_sale_price'];?>" class="form-control">
                        </div>
                        <span class="star_required">*</span>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('DISCOUNT_TYPE');?>:</label>
                        <div class="col-md-5">
                            <select class="form-control " name="discount_type">
                                <option value="<?php echo $this->config->item('DISCOUNT_PERCENTAGE');?>" <?php if($record_info['discount_type']==$this->config->item('DISCOUNT_PERCENTAGE')){echo "selected='selected'";}?>><?php echo $this->lang->line('DISCOUNT_PERCENTAGE');?></option>
                                <option value="<?php echo $this->config->item('DISCOUNT_AMOUNT');?>" <?php if($record_info['discount_type']==$this->config->item('DISCOUNT_AMOUNT')){echo "selected='selected'";}?>><?php echo $this->lang->line('DISCOUNT_AMOUNT');?></option>
                            </select>
                        </div>
                        <span class="star_required">*</span>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('DISCOUNT');?>:</label>
                        <div class="col-md-5">
                            <input type="text" name="discount" value="<?php echo $record_info['discount'];?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('DISCOUNT_START_DATE');?>:</label>
                        <div class="col-md-5">
                            <input type="text" name="discount_start_date" value="<?php echo $record_info['discount_start_date'];?>" class="form-control datepicker">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('DISCOUNT_END_DATE');?>:</label>
                        <div class="col-md-5">
                            <input type="text" name="discount_end_date" value="<?php echo $record_info['discount_end_date'];?>" class="form-control datepicker">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('RETURN_WITHIN');?>:</label>
                        <div class="col-md-5">
                            <input type="text" name="return_within" value="<?php echo $record_info['return_within'];?>" class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('STATUS');?>:</label>
                        <div class="col-md-5">
                            <select class="form-control " name="status">
                                <option value="<?php echo $this->config->item('STATUS_ACTIVE');?>" <?php if($record_info['status']==$this->config->item('STATUS_ACTIVE')){echo "selected='selected'";}?>><?php echo $this->lang->line('ACTIVE');?></option>
                                <option value="<?php echo $this->config->item('STATUS_INACTIVE');?>" <?php if($record_info['status']==$this->config->item('STATUS_INACTIVE')){echo "selected='selected'";}?>><?php echo $this->lang->line('INACTIVE');?></option>
                            </select>
                        </div>
                        <span class="star_required">*</span>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-md-3 control-label"><?php echo $this->lang->line('PICTURE');?>:</label>
                        <div class="col-md-5">
                            <!--<input type="file" name="profile_picture" class="form-control " />-->
                            <input type="file" name="picture" class="form-control " value=""/>
                        </div>
                    </div>
                    <?php
                    echo  My_menu_tree_helper::page_access_button_save();
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
        var base_url="<?php echo base_url()?>";


        $(document).on("change",".parent",function()
        {
            if($(this).hasClass('mother_parent')){
                $('#show_sub_categories').html('')
            }

            $(this).nextAll('.parent').hide();
          //  $(this).('.parent').hide();

            var typeFeed=$(this).val();
            console.log(typeFeed)
            $.ajax({
                type: 'post',
                url: base_url+'Item_create/subcategories',
                data:
                {
                    typeFeed:typeFeed
                },
                success: function (response)
                {
                    //$( '#show_sub_categories' ).html( response );
                    console.log(response)
                    $( '#show_sub_categories' ).append( response );
                }
            });

        });

    });
</script>