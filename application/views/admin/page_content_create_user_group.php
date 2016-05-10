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
        <div class="form-group">
            <?php if($message != null)echo 'create user.'; else echo $message; ?>
        </div>
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <form role="form" action="<?php echo base_url()?>user_manage/create_user_group" method="post">
                    <div class="form-group">
                        <label for="username">TITLE:</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="form-group">
                        <label for="namebn">ORDERING:</label>
                        <input type="number" min="0" class="form-control" name="ordering">
                    </div>
                    <div class="form-group">
                        <label for="nameen">STATUS:</label>
                        <input type="number" min="0" class="form-control" name="status">
                    </div>
                    <div class="form-actions">
                        <input type="submit" class="btn btn-danger pull-right">
                    </div>
                </form>
<!--                <script>-->
<!--                    $(function() {-->
<!--                        $( "#datepicker" ).datepicker();-->
<!--                    });-->
<!--                </script>-->
            </div>
        </div>
        <div class="clearfix">
        </div>
    </div>
</div>
<!-- END CONTENT -->


<!--//var_dump($user_groups);-->
