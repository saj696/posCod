<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <?php
        echo  My_menu_tree_helper::page_breadcrumb();
        echo  My_menu_tree_helper::page_access_button_new($new_button_name);
        ?>
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus-circle"></i><?php echo isset($task_title)?$task_title:null?>
                </div>
                <div class="tools"></div>
            </div>
            <div class="portlet-body">

                <div class="row">
                    <div class="col-md-12">
                        <?php $fl_message = $this->session->flashdata('fl_message');?>
                        <?php if($fl_message != NULL){?>
                            <div class="alert alert-warning"> <strong><?php echo $fl_message; ?></strong> </div>
                        <?php }?>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-condensed table-responsive">
                            <tr class="active">
                                <td>Serial</td>
                                <td>User Group</td>
                                <td>Created by</td>
                                <td>Created time</td>
                                <td>Updated by</td>
                                <td>Updated time</td>
                                <td>Actions</td>
                            </tr>
                            <?php $sn = 1; ?>

                            <?php foreach($user_groups as $ug){?>
                                <tr>
                                    <td><?php echo($sn++); ?></td>
                                    <td><?php echo($ug['title']); ?></td>
                                    <td>
                                        <a  href="<?php echo base_url().'user_group_create/edit_record_role/'.$ug['id']; ?>"><button class="btn-default btn">ROLE</button></a>
                                        <a  href="<?php echo base_url().'user_group_create/show_record/'.$ug['id']; ?>"><button class="btn-default btn">Show</button></a>
                                        <a  href="<?php echo base_url().'user_group_create/edit_record/'.$ug['id']; ?>"><button class="btn-info btn">Edit</button></a>
                                        <a  href="<?php echo base_url().'user_group_create/delete_record/'.$ug['id']; ?>"><button class="btn-danger btn">Delete</button></a>
                                    </td>
                                </tr>
                            <?php }?>
                        </table>
                    </div>
                </div>


            </div>
        </div>




        <div class="clearfix">
        </div>
    </div>
</div>
<!-- END CONTENT -->


<!--//var_dump($user_groups);-->
