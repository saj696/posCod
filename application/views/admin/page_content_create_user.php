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
                <?php if(isset($message) && $message != NULL){?>
                    <div class="alert alert-warning"> <strong><?php echo $message; ?></strong> </div>
                <?php }?>
                <form role="form" action="<?php echo base_url()?>user_manage/create_user" method="post">
                    <div class="form-group">
                        <label for="username">UserID:</label>
                        <input type="text" class="form-control" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label for="namebn">User group:</label>
                        <select class="form-control" name="user_group_id">
                            <?php foreach($user_groups as $ug){?>
                            <option value="<?php echo $ug['id'];?>"><?php echo $ug['title'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="namebn">Name BN:</label>
                        <input type="text" class="form-control" name="namebn">
                    </div>
                    <div class="form-group">
                        <label for="nameen">Name EN:</label>
                        <input type="text" class="form-control" name="nameen">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <input type="text" class="form-control" name="gender">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="email">Office Phone:</label>
                        <input type="text" class="form-control" name="office_phone">
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile:</label>
                        <input type="text" class="form-control" name="mobile">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label for="email">National ID:</label>
                        <input type="text" class="form-control" name="national_id_no">
                    </div>
                    <div class="form-group">
                        <label >Present Address:</label>
                        <textarea class="form-control" name="address"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth:</label>
                        <input type="text" class="form-control" name="dob" id="datepicker">
                    </div>
                    <div class="form-group">
                        <label for="email">Status:</label>
                        <input type="text" class="form-control" name="status">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-danger pull-right">
                    </div>
                </form>

            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-offset-3 col-md-6">
                <button class="btn btn-info" onclick="history.go(-1);">Go Back</button>
                <button class="btn btn-danger" onclick="resetfields()">Reset fields</button>
            </div>
        </div>
        <div class="clearfix">
        </div>
    </div>
</div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    function resetfields(){
        var elements = document.getElementsByTagName("input");
        for (var ii=0; ii < elements.length; ii++) {
            if (elements[ii].type == "text") {
                elements[ii].value = "";
            }
        }
    }
    $(function() {
        $( "#datepicker" ).datepicker();
    });
</script>
<!-- END CONTENT -->


<!--//var_dump($user_groups);-->
