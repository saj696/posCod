<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Dashboard
            <small>reports & statistics</small>
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
        <div class="form-group">
            <?php $fl_message = $this->session->flashdata('fl_message');?>
            <?php if($fl_message != NULL){?>
                <div class="alert alert-warning"> <strong><?php echo $fl_message; ?></strong> </div>
            <?php }?>
        </div>






        <form action="<?php echo base_url().'user_manage/user_group_role_assign/'.$group_id ?>" method="post" name="user_access_form">

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <tbody>
                        <?php foreach ($classes as $class_name => $class) { ?>
                            <tr>
                                <td> <?php echo $class_name; ?> </td>
                                <td style="background-color: white">
                                    <table class="table-bordered table table-responsive">
                                        <tr>
                                            <?php foreach ($class as $method_name => $value) { ?>
                                                <td>
                                                    <input type="checkbox"
                                                           name="<?php echo $class_name . "__" . $method_name ?>"
                                                            <?php if ($value == 'on') echo 'checked' ?> >
                                                    <?php echo $method_name; ?>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                </div>
                <div class="col-md-12">
                    <button class="button btn btn-info pull-right" onclick="document.user_access_form.submit()">Submit</button>
                </div>
            </div>
        </form>

        <div class="clearfix">
        </div>
    </div>
</div>
<!-- END CONTENT -->


<!--//var_dump($user_groups);-->
