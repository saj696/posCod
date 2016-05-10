<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.1
Version: 3.3.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title><?php echo $this->config->item('LOGIN_PAGE_TITLE');?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="<?php echo base_url(); ?>assets/admin/pages/css/login.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME STYLES -->
    <link href="<?php echo base_url(); ?>assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="<?php echo base_url(); ?>assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon/favicon.ico" type="image/gif" sizes="16x16">
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="<?php echo base_url(); ?>">
        <img src="<?php echo base_url(); ?>assets/images/system_logo/manufacture_logo.png" alt=""/>
    </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
<?php echo $contents; ?>
</div>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<?php
$fl_message_success = $this->session->flashdata('fl_message_success');
if (!empty($fl_message_success))
{
    ?>
    <script>
        $(document).ready(function()
        {
            $("#footer_navigation_success").slideDown('slow');
            setTimeout(function()
            {
                $("#footer_navigation_success").slideUp('slow');
            }, 5000);
        })

    </script>

    <?php
}
?>
<?php
$fl_message_error = $this->session->flashdata('fl_message_error');
if (!empty($fl_message_error))
{
    ?>
    <script>
        $(document).ready(function()
        {
            $("#footer_navigation_error").slideDown('slow');
            setTimeout(function()
            {
                $("#footer_navigation_error").slideUp('slow');
            }, 5000);
        })

    </script>

    <?php
}
?>
<script>
    $(document).ready(function()
    {
        $(document).on("click", ".footer-nav-border", function(event) {
            $(this).slideUp();
        });
    })
</script>
<style>
    .navigation_footer_container
    {
        position: fixed;
        bottom: 5px;
        right: 5px;
        float: right;
        width: 25%;
        /*display: none;*/

    }
    .navigation_footer_container div img
    {
        height: 50px;
        width: 50px;
        margin-top: 10px;
        margin-left: 5px;
        margin-right: 5px;
        float: left;
    }

    .navigation_footer_container div div
    {
        padding: 5px;
        text-align: center;
    }

    .navigation_footer_container div div span
    {
        padding: 5px;
        font-weight: bold;
    }
    .navigation_footer_container div div p
    {
        padding: 5px;
    }
    .footer-nav-border
    {
        margin-bottom: 5px;
        min-height: 70px;
        width: 100%;
        background-color: #F8F6EF;
        border: 5px solid #3ea49d;
        box-shadow: 0px 0px 15px #888888;
        display: none;
        cursor: pointer;
    }
</style>

<div class="navigation_footer_container">
    <div id="footer_navigation_success" class="footer-nav-border">
        <img src="<?php echo base_url();?>assets/images/icons/circle-right.png" />
        <div>
        <span>
            Success Alert
        </span>
            <p>
                <?php echo isset($fl_message_success)?$fl_message_success:'No Message.';?>
            </p>
        </div>
    </div>
    <div id="footer_navigation_error" class=" footer-nav-border">
        <img src="<?php echo base_url();?>assets/images/icons/circle-warning.png" />
        <div>
        <span style="color: rgba(223, 31, 49, 0.79)">
            Warning Alert
        </span>
            <p>
                <?php echo isset($fl_message_error)?$fl_message_error:'No Message.';?>
            </p>
        </div>
    </div>
</div>

<div class="copyright">
    2016 © Soft BD Ltd. Point of Sale Management System.
</div>
<!-- END LOGIN -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/excanvas.min.js"></script>
<![endif]-->

<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/pages/scripts/login.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function()
    {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Login.init();
        Demo.init();
    });
</script>


<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>