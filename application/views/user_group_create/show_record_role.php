<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Dashboard <small>reports & statistics</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="index.html">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Dashboard</a>
                </li>
            </ul>
        </div>
        <!-- END PAGE HEADER-->


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
                                    <td><?php echo($ug['created_by']); ?></td>
                                    <td><?php echo($ug['created_time']); ?></td>
                                    <td><?php echo($ug['updated_by']); ?></td>
                                    <td><?php echo($ug['updated_time']); ?></td>
                                    <td>
                                        <a  href="<?php echo base_url().'user_manage/show_user_group_info/'.$ug['id']; ?>"><button class="btn-default btn">Show</button></a>
                                        <a  href="<?php echo base_url().'user_manage/edit_user_group/'.$ug['id']; ?>"><button class="btn-info btn">Edit</button></a>
                                        <a  href="<?php echo base_url().'user_manage/delete_user_group/'.$ug['id']; ?>"><button class="btn-danger btn">Delete</button></a>
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
