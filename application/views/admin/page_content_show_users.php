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
        <?php if (User_helper::has_access(null, 'task_manage', 'create_task')) { ?>
            <div class="row form-group">
                <div class="col-md-12">
                    <a href="<?php echo base_url() . 'user_manage/create_user'; ?>">
                        <button class="btn btn-success pull-right">Create User</button>
                    </a>
                </div>
            </div>
        <?php } ?>
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
                        <td>ID</td>
                        <td>Username</td>
                        <td>Name BN</td>
                        <td>Name EN</td>
                        <td>User Group</td>
                        <td>Designation</td>
                        <td>Actions</td>
                    </tr>
                    <?php $sn = 1; ?>
                    <?php foreach($users as $ug){?>
                    <tr>
                        <td><?php echo($sn++); ?></td>
                        <td><?php echo($ug['id']); ?></td>
                        <td><?php echo($ug['username']); ?></td>
                        <td><?php echo($ug['name_bn']); ?></td>
                        <td><?php echo($ug['name_en']); ?></td>
                        <td><?php echo($ug['user_group_id']); ?></td>
                        <td><?php echo($ug['designation']); ?></td>
                        <td>
                            <?php if (User_helper::has_access(null, 'user_manage', 'show_user_info')) { ?>
                            <a  href="<?php echo base_url().'user_manage/show_user_info/'.$ug['id']; ?>"><button class="btn-default btn">Show</button></a>
                            <?php } ?>
                            <?php if (User_helper::has_access(null, 'user_manage', 'edit_user')) { ?>
                            <a  href="<?php echo base_url().'user_manage/edit_user/'.$ug['id']; ?>"><button class="btn-info btn">Edit</button></a>
                            <?php } ?>
                            <?php if (User_helper::has_access(null, 'user_manage', 'delete_user')) { ?>
                            <a  href="<?php echo base_url().'user_manage/delete_user/'.$ug['id']; ?>"><button class="btn-danger btn">Delete</button></a>
                            <?php } ?>
                        </td>
                    </tr>
                        <?php }?>

                </table>
                <?php if (User_helper::has_access(null, 'task_manage', 'create_task')) { ?>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <a href="<?php echo base_url() . 'user_manage/create_user'; ?>">
                                <button class="btn btn-success pull-right">Create User</button>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="clearfix">
        </div>
    </div>
</div>
<!-- END CONTENT -->


<!--//var_dump($user_groups);-->
