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
            <div class="col-md-offset-3 col-md-6">

<!--                check isset of these variables before echo, later-->
                <table class="table table-responsive table-striped table-condenced">
                    <tr>
                        <td>Username: </td>
                        <td><?php echo $user_info['username']; ?></td>
                    </tr>
                    <tr>
                        <td>Name Bn	: </td>
                        <td><?php echo $user_info['name_bn']; ?></td>
                    </tr>
                    <tr>
                        <td>Name En: </td>
                        <td><?php echo $user_info['name_en']; ?></td>
                    </tr>
                    <tr>
                        <td>User Group: </td>
                        <td><?php echo $user_info['user_group_name']; ?></td>
                    </tr>
                    <tr>
                        <td>Designation: </td>
                        <td><?php echo $user_info['designation']; ?></td>
                    </tr>
                    <tr>
                        <td>Gender: </td>
                        <td><?php echo $user_info['gender']; ?></td>
                    </tr>
                    <tr>
                        <td>Phone: </td>
                        <td><?php echo $user_info['phone']; ?></td>
                    </tr>
                    <tr>
                        <td>Office Phone: </td>
                        <td><?php echo $user_info['office_phone']; ?></td>
                    </tr>
                    <tr>
                        <td>Mobile: </td>
                        <td><?php echo $user_info['mobile']; ?></td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td><?php echo $user_info['email']; ?></td>
                    </tr>
                    <tr>
                        <td>National Id No: </td>
                        <td><?php echo $user_info['national_id_no']; ?></td>
                    </tr>
<!--                    <tr>-->
<!--                        <td>Picture Alt: </td>-->
<!--                        <td>--><?php //echo $user_info['username']; ?><!--</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td>Picture Name: </td>-->
<!--                        <td>--><?php //echo $user_info['username']; ?><!--</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td>Notifiacation: </td>-->
<!--                        <td>--><?php //echo $user_info['username']; ?><!--</td>-->
<!--                    </tr>-->
                    <tr>
                        <td>Create By: </td>
                        <td><?php echo $user_info['created_by_name']; ?></td>
                    </tr>
                    <tr>
                        <td>Dob: </td>
                        <td><?php echo $user_info['dob']; ?></td>
                    </tr>
                    <tr>
                        <td>Create Date: </td>
                        <td><?php echo $user_info['created_time']; ?></td>
                    </tr>
                    <tr>
                        <td>Update By: </td>
                        <td><?php echo $user_info['updated_by']; ?></td>
                    </tr>
                    <tr>
                        <td>Update Date: </td>
                        <td><?php echo $user_info['updated_time']; ?></td>
                    </tr>
                    <tr>
                        <td>Present Address: </td>
                        <td><?php echo $user_info['present_address']; ?></td>
                    </tr>
                    <tr>
                        <td>Permanent Address: </td>
                        <td><?php echo $user_info['permanent_address']; ?></td>
                    </tr>
                    <tr>
                        <td>Status: </td>
                        <td><?php echo $user_info['status']; ?></td>
                    </tr>
                    <tr>
                        <td>Photo: </td>
                        <td><?php echo $user_info['username']; ?></td>
                    </tr>
                </table>














<!---->
<!---->
<!---->
<!---->
<!---->
<!---->
<!--                <form role="form">-->
<!--                    <div class="form-group">-->
<!--                        <label for="username">ID:</label>-->
<!--                        <input type="text" class="form-control" name="username" value="--><?//?><!--">-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label for="password">Password:</label>-->
<!--                        <input type="password" class="form-control" name="password">-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label for="namebn">Name BN:</label>-->
<!--                        <input type="text" class="form-control" name="namebn">-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label for="nameen">Name EN:</label>-->
<!--                        <input type="text" class="form-control" name="nameen">-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label for="gender">Gender:</label>-->
<!--                        <input type="text" class="form-control" name="gender">-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label for="phone">Phone:</label>-->
<!--                        <input type="text" class="form-control" name="phone">-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label for="email">Office Phone:</label>-->
<!--                        <input type="text" class="form-control" name="office_phone">-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label for="mobile">Mobile:</label>-->
<!--                        <input type="text" class="form-control" name="mobile">-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label for="email">Email:</label>-->
<!--                        <input type="email" class="form-control" name="email">-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label for="email">National ID:</label>-->
<!--                        <input type="text" class="form-control" name="national_id_no">-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label >Present Address:</label>-->
<!--                        <textarea class="form-control" name="address"></textarea>-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label for="dob">Date of Birth:</label>-->
<!--                        <input type="text" class="form-control datepicker" name="dob">-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label for="email">Status:</label>-->
<!--                        <input type="text" class="form-control" name="status">-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <input type="submit" class="btn btn-danger pull-right">-->
<!--                    </div>-->
<!--                </form>-->









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
