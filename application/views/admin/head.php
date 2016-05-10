<!DOCTYPE html>


<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title><?php echo $this->config->item('ADMIN_PAGE_TITLE');?></title>
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon/favicon.ico" type="image/gif" sizes="16x16">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN PAGE STYLES -->
    <link href="<?php echo base_url();?>assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE STYLES -->
    <!-- BEGIN THEME STYLES -->
    <!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
    <link href="<?php echo base_url();?>assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="<?php echo base_url();?>assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
    <link rel="stylesheet" href="<?php echo base_url().'assets/custom/jquery-ui.css' ?> ">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/jq/jqx.base.css' ?> ">
    <script type="text/javascript" src="http://localhost/posCod/assets/global/plugins/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxcore.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxgrid.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxscrollbar.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxgrid.edit.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxgrid.sort.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxgrid.pager.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxbuttons.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxcheckbox.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq//jqxlistbox.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq//jqxdropdownlist.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq//jqxmenu.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxgrid.filter.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxgrid.selection.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxgrid.columnsresize.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxdata.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxdatatable.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/jq/jqxwindow.js"></script>
    <!--    SYSTEM COMMON SCRIPTING FILE -->
    <script type="text/javascript" src="<?php echo base_url().'assets/'; ?>custom/system_common.js"></script>
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-quick-sidebar-over-content page-style-square">

<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="<?php echo base_url(); ?>">
                <img class="logo-default" alt="logo" src="<?php echo base_url(); ?>assets/images/system_logo/client_logo.png" style="width: 140px;">
            </a>
            <div class="menu-toggler sidebar-toggler hide">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a data-target=".navbar-collapse" data-toggle="collapse" class="menu-toggler responsive-toggler" href="javascript:;">
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN NOTIFICATION DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li id="header_notification_bar" class="dropdown dropdown-extended dropdown-notification">
                    <a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon-bell"></i>
					<span class="badge badge-default">
					7 </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="external">
                            <h3><span class="bold">12 pending</span> notifications</h3>
                            <a href="extra_profile.html">view all</a>
                        </li>
                        <li>
                            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;"><ul data-handle-color="#637283" style="height: 250px; overflow: hidden; width: auto;" class="dropdown-menu-list scroller" data-initialized="1">
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">just now</span>
									<span class="details">
									<span class="label label-sm label-icon label-success">
									<i class="fa fa-plus"></i>
									</span>
									New user registered. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">3 mins</span>
									<span class="details">
									<span class="label label-sm label-icon label-danger">
									<i class="fa fa-bolt"></i>
									</span>
									Server #12 overloaded. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">10 mins</span>
									<span class="details">
									<span class="label label-sm label-icon label-warning">
									<i class="fa fa-bell-o"></i>
									</span>
									Server #2 not responding. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">14 hrs</span>
									<span class="details">
									<span class="label label-sm label-icon label-info">
									<i class="fa fa-bullhorn"></i>
									</span>
									Application error. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">2 days</span>
									<span class="details">
									<span class="label label-sm label-icon label-danger">
									<i class="fa fa-bolt"></i>
									</span>
									Database overloaded 68%. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">3 days</span>
									<span class="details">
									<span class="label label-sm label-icon label-danger">
									<i class="fa fa-bolt"></i>
									</span>
									A user IP blocked. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">4 days</span>
									<span class="details">
									<span class="label label-sm label-icon label-warning">
									<i class="fa fa-bell-o"></i>
									</span>
									Storage Server #4 not responding dfdfdfd. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">5 days</span>
									<span class="details">
									<span class="label label-sm label-icon label-info">
									<i class="fa fa-bullhorn"></i>
									</span>
									System Error. </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">9 days</span>
									<span class="details">
									<span class="label label-sm label-icon label-danger">
									<i class="fa fa-bolt"></i>
									</span>
									Storage server failed. </span>
                                        </a>
                                    </li>
                                </ul><div class="slimScrollBar" style="background: rgb(99, 114, 131) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                        </li>
                    </ul>
                </li>
                <!-- END NOTIFICATION DROPDOWN -->
                <!-- BEGIN INBOX DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li id="header_inbox_bar" class="dropdown dropdown-extended dropdown-inbox">
                    <a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon-envelope-open"></i>
					<span class="badge badge-default">
					4 </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="external">
                            <h3>You have <span class="bold">7 New</span> Messages</h3>
                            <a href="page_inbox.html">view all</a>
                        </li>
                        <li>
                            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 275px;"><ul data-handle-color="#637283" style="height: 275px; overflow: hidden; width: auto;" class="dropdown-menu-list scroller" data-initialized="1">
                                    <li>
                                        <a href="inbox.html?a=view">
									<span class="photo">
									<img alt="" class="img-circle" src="../../assets/admin/layout3/img/avatar2.jpg">
									</span>
									<span class="subject">
									<span class="from">
									Lisa Wong </span>
									<span class="time">Just Now </span>
									</span>
									<span class="message">
									Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="inbox.html?a=view">
									<span class="photo">
									<img alt="" class="img-circle" src="../../assets/admin/layout3/img/avatar3.jpg">
									</span>
									<span class="subject">
									<span class="from">
									Richard Doe </span>
									<span class="time">16 mins </span>
									</span>
									<span class="message">
									Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="inbox.html?a=view">
									<span class="photo">
									<img alt="" class="img-circle" src="../../assets/admin/layout3/img/avatar1.jpg">
									</span>
									<span class="subject">
									<span class="from">
									Bob Nilson </span>
									<span class="time">2 hrs </span>
									</span>
									<span class="message">
									Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="inbox.html?a=view">
									<span class="photo">
									<img alt="" class="img-circle" src="../../assets/admin/layout3/img/avatar2.jpg">
									</span>
									<span class="subject">
									<span class="from">
									Lisa Wong </span>
									<span class="time">40 mins </span>
									</span>
									<span class="message">
									Vivamus sed auctor 40% nibh congue nibh... </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="inbox.html?a=view">
									<span class="photo">
									<img alt="" class="img-circle" src="../../assets/admin/layout3/img/avatar3.jpg">
									</span>
									<span class="subject">
									<span class="from">
									Richard Doe </span>
									<span class="time">46 mins </span>
									</span>
									<span class="message">
									Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                        </a>
                                    </li>
                                </ul><div class="slimScrollBar" style="background: rgb(99, 114, 131) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                        </li>
                    </ul>
                </li>
                <!-- END INBOX DROPDOWN -->
                <!-- BEGIN TODO DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li id="header_task_bar" class="dropdown dropdown-extended dropdown-tasks">
                    <a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon-calendar"></i>
					<span class="badge badge-default">
					3 </span>
                    </a>
                    <ul class="dropdown-menu extended tasks">
                        <li class="external">
                            <h3>You have <span class="bold">12 pending</span> tasks</h3>
                            <a href="page_todo.html">view all</a>
                        </li>
                        <li>
                            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 275px;"><ul data-handle-color="#637283" style="height: 275px; overflow: hidden; width: auto;" class="dropdown-menu-list scroller" data-initialized="1">
                                    <li>
                                        <a href="javascript:;">
									<span class="task">
									<span class="desc">New release v1.2 </span>
									<span class="percent">30%</span>
									</span>
									<span class="progress">
									<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" class="progress-bar progress-bar-success" style="width: 40%;"><span class="sr-only">40% Complete</span></span>
									</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
									<span class="task">
									<span class="desc">Application deployment</span>
									<span class="percent">65%</span>
									</span>
									<span class="progress">
									<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="65" class="progress-bar progress-bar-danger" style="width: 65%;"><span class="sr-only">65% Complete</span></span>
									</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
									<span class="task">
									<span class="desc">Mobile app release</span>
									<span class="percent">98%</span>
									</span>
									<span class="progress">
									<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="98" class="progress-bar progress-bar-success" style="width: 98%;"><span class="sr-only">98% Complete</span></span>
									</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
									<span class="task">
									<span class="desc">Database migration</span>
									<span class="percent">10%</span>
									</span>
									<span class="progress">
									<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="10" class="progress-bar progress-bar-warning" style="width: 10%;"><span class="sr-only">10% Complete</span></span>
									</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
									<span class="task">
									<span class="desc">Web server upgrade</span>
									<span class="percent">58%</span>
									</span>
									<span class="progress">
									<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="58" class="progress-bar progress-bar-info" style="width: 58%;"><span class="sr-only">58% Complete</span></span>
									</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
									<span class="task">
									<span class="desc">Mobile development</span>
									<span class="percent">85%</span>
									</span>
									<span class="progress">
									<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="85" class="progress-bar progress-bar-success" style="width: 85%;"><span class="sr-only">85% Complete</span></span>
									</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
									<span class="task">
									<span class="desc">New UI release</span>
									<span class="percent">38%</span>
									</span>
									<span class="progress progress-striped">
									<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="18" class="progress-bar progress-bar-important" style="width: 38%;"><span class="sr-only">38% Complete</span></span>
									</span>
                                        </a>
                                    </li>
                                </ul><div class="slimScrollBar" style="background: rgb(99, 114, 131) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                        </li>
                    </ul>
                </li>
                <!-- END TODO DROPDOWN -->
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <?php
                    $user=User_helper::get_user();
                    $employee_dir=$this->config->item('file_upload');
                    if(file_exists(FCPATH.$employee_dir['employees'].'/'.$user->profile_picture))
                    {
                        $image_url=base_url().$employee_dir['employees'].'/'.$user->profile_picture;
                    }
                    else
                    {
                        $image_url=base_url().'assets/images/blank.png';
                    }
                    ?>
                    <a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <img src="<?php echo $image_url;?>" class="img-circle" alt="">
                        <span class="username username-hide-on-mobile">
                        <?php
                        echo $user->employee_en_name;
                        ?>
                        </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <!--<li>
                            <a href="extra_profile.html">
                                <i class="icon-user"></i> My Profile </a>
                        </li>
                        <li>
                            <a href="page_calendar.html">
                                <i class="icon-calendar"></i> My Calendar </a>
                        </li>
                        <li>
                            <a href="inbox.html">
                                <i class="icon-envelope-open"></i> My Inbox <span class="badge badge-danger">
							3 </span>
                            </a>
                        </li>
                        <li>
                            <a href="page_todo.html">
                                <i class="icon-rocket"></i> My Tasks <span class="badge badge-success">
							7 </span>
                            </a>
                        </li>
                        <li class="divider">-->
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>Auth/logout">
                                <i class="icon-lock"></i> Lock Screen </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>Auth/logout">
                                <i class="icon-key"></i> Log Out </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
                <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-quick-sidebar-toggler">
                    <a class="dropdown-toggle" href="<?php echo base_url();?>Auth/logout">
                        <i class="icon-logout"></i>
                    </a>
                </li>
                <!-- END QUICK SIDEBAR TOGGLER -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>

<!-- BEGIN CONTAINER -->
<div class="page-container">

