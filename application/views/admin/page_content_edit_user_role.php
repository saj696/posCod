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
            <?php if ($message != null) echo 'create user.'; else echo $message; ?>
        </div>
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
                                            <input type="checkbox" name="<?php echo $class_name."__".$method_name?>" <?php if($value==1) echo 'checked'?>>
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
            <div class="col-md-12"><button class="button btn btn-info pull-right">Submit</button></div>
        </div>
        <div class="clearfix">
        </div>
    </div>
</div>
<!-- END CONTENT -->


<!--//var_dump($user_groups);-->
