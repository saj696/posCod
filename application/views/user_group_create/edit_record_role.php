<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus-circle"></i><?php echo isset($task_title)?$task_title:null?>
                </div>
                <div class="tools"></div>
            </div>
            <div class="portlet-body">
                <div class="row form-group">
                    <div class="col-md-12">
                        <button class="button btn btn-success" onclick="check_all_checkbox()">Check All Checkbox</button>
                        <button class="button btn btn-success" onclick="uncheck_all_checkbox()">Uncheck All Checkbox</button>
                    </div>
                </div>

                <form action="<?php echo base_url().'user_group_create/edit_record_role/'.$group_id ?>" method="post" name="user_access_form">

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tbody>
                                <?php foreach ($classes as $class_name => $class) { ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" onchange="row_checkbox(this)">
                                            <?php echo $class_name; ?>
                                        </td>
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
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="button btn btn-success pull-right"
                                    onclick="document.user_access_form.submit()">Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="clearfix">
        </div>
    </div>
</div>
<!-- END CONTENT -->
<script>
    function row_checkbox(cbox){
        $(cbox).closest("td").next().find("input[type='checkbox']").each(function(){
            $(this).prop('checked', $(cbox).prop("checked"));
        })
        $.uniform.update();
    }
    function check_all_checkbox() {
        $("input[type='checkbox']").prop('checked', true);
        $.uniform.update();
    }
    function uncheck_all_checkbox() {
        $("input[type='checkbox']").prop('checked', false);
        $.uniform.update();
    }
</script>
