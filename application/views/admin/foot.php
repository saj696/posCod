</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">
        2016 © Soft BD Ltd. Point of Sale Management System.
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
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
<script>
    $(document).ready(function()
    {
        $(document).on("click", ".footer-nav-border", function(event) {
            $(this).slideUp();
        });
    })
</script>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url();?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<!--<script src="--><?php //echo base_url();?><!--assets/global/plugins/jquery.min.js" type="text/javascript"></script>-->
<script src="<?php echo base_url();?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url();?>assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="<?php echo base_url();?>assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>

<!--Thi is for Category tree which is use @ item create section added by Antu Rozario.-->
<script src="<?php echo base_url();?>assets/admin/pages/scripts/jquery.livequery.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<!-- Custom scripts -->

<!-- end Custom scripts -->
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        QuickSidebar.init(); // init quick sidebar
        Demo.init(); // init demo features
        Index.init();
        Index.initDashboardDaterange();
        Index.initJQVMAP(); // init index page's custom scripts
        Index.initCalendar(); // init index page's custom scripts
        Index.initCharts(); // init index page's custom scripts
        Index.initChat();
        Index.initMiniCharts();
        Tasks.initDashboardWidget();
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>