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
        <div class="row">
            <div class="col-md-12">
                <?php $fl_message = $this->session->flashdata('fl_message');?>
                <?php if($fl_message != NULL){?>
                    <div class="alert alert-warning"> <strong><?php echo $fl_message; ?></strong> </div>
                <?php }?>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <form role="form" action="<?php echo base_url().'user_manage/edit_user/'.$user_id?>" method="post">
                    <div class="form-group">
                        <label for="username">ID:</label>
                        <input type="text" class="form-control" name="username" value="<?php echo $user_info['username'];?>">
                    </div>
                    <div class="form-group">
                        <label for="password">New Password (If you want to change):</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label for="name_bn">Name BN:</label>
                        <input type="text" class="form-control" name="name_bn" value="<?php echo $user_info['name_bn'];?>">
                    </div>
                    <div class="form-group">
                        <label for="name_en">Name EN:</label>
                        <input type="text" class="form-control" name="name_en" value="<?php echo $user_info['name_en'];?>">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <input type="text" class="form-control" name="gender" value="<?php echo $user_info['gender'];?>">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" name="phone" value="<?php echo $user_info['phone'];?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Office Phone:</label>
                        <input type="text" class="form-control" name="office_phone" value="<?php echo $user_info['office_phone'];?>">
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile:</label>
                        <input type="text" class="form-control" name="mobile" value="<?php echo $user_info['mobile'];?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $user_info['email'];?>">
                    </div>
                    <div class="form-group">
                        <label for="email">National ID:</label>
                        <input type="text" class="form-control" name="national_id_no" value="<?php echo $user_info['national_id_no'];?>">
                    </div>
                    <div class="form-group">
                        <label >Present Address:</label>
                        <textarea class="form-control" name="present_address"><?php echo $user_info['present_address'];?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth:</label>
                        <input type="text" class="form-control" id="datepicker" name="dob" value="<?php echo $user_info['dob'];?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Status:</label>
                        <input type="text" class="form-control" name="status" value="<?php echo $user_info['status'];?>">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-danger pull-right">
                    </div>
                </form>
            </div>
        </div>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script>
            $(function() {
                $( "#datepicker" ).datepicker();
            });
        </script>
        <div class="clearfix">
        </div>
    </div>
</div>
<!-- END CONTENT -->


<!--//var_dump($user_groups);-->
