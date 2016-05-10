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
                    <div class="col-md-offset-1 col-md-8">
                        <form role="form" action="<?php echo base_url() ?>task_create/add_record" method="post">
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label class="pull-right">Parent:</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" name="parent_id">
                                        <option value=""> --no parent--</option>
                                        <?php foreach ($all_tasks as $task) { ?>
                                            <option
                                                value="<?php echo $task['id']; ?>"
                                                <?php if($record_info['parent_id'] == $task['id']){echo "selected";}?>
                                            >
                                                <?php echo $task['name_en']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label class="pull-right" for="username">Name EN:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="name_en" value="<?php echo $record_info['name_en'];?>" >
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label class="pull-right" for="username">Name BN:</label>
                                    </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="name_bn" value="<?php echo $record_info['name_bn'];?>" >
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label class="pull-right">Description:</label>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="description" class="form-control"><?php echo $record_info['description'];?></textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label class="pull-right" for="username">Icon:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="icon" value="<?php echo $record_info['icon'];?>" >
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label class="pull-right">Controller:</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" id="controller_select" onchange="get_meth()" name="controller">
                                        <option value="">--No Controller--</option>
                                        <?php foreach ($all_controllers as $controller) { ?>
                                            <option value="<?php echo $controller; ?>">
                                                <?php echo $controller; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label class="pull-right">Method:</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" id="method_select" name="method">
                                        <option value="">--Select a controller first--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label class="pull-right" for="namebn">ORDERING:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" min="<?php echo $max_order; ?>" class="form-control" name="ordering" value="<?php echo empty( $record_info['ordering'] )?  $max_order : $record_info['ordering'] ;?>" >
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label class="pull-right" for="nameen">Position left:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="checkbox" class="form-control" name="position_left_01">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label class="pull-right">Position top:</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="checkbox" class="form-control" name="position_top_01">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label class="pull-right">STATUS:</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control input-medium" name="status">
                                        <option value="<?php echo $this->config->item('STATUS_ACTIVE');?>" ><?php echo $this->lang->line('ACTIVE');?></option>
                                        <option value="<?php echo $this->config->item('STATUS_INACTIVE');?>" ><?php echo $this->lang->line('INACTIVE');?></option>
                                    </select>
                                </div>
                            </div>

                            <?php
                            echo  My_menu_tree_helper::page_access_button_save();
                            ?>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <div class="clearfix">
        </div>
    </div>
</div>

<script>
    $(function () {
        get_meth();
    });
    function resetfields()
    {
        var elements = document.getElementsByTagName("input");
        for (var ii=0; ii < elements.length; ii++)
        {
            if (elements[ii].type == "text")
            {
                elements[ii].value = "";
            }
        }
    }
    function get_meth()
    {
        $.ajax({
            dataType: 'json',
            type: "POST",
            url: '<?php echo base_url(); ?>' + 'task_create/ajax_get_methods',
            data: {
                controller_name: $('#controller_select').val()
            },
            success: function (data) {
                $("#method_select").empty();
                var options = '';
                for (var x = 0; x < data.length; x++) {
                    options += '<option value="' + data[x] + '">' + data[x] + '</option>';
                }
                document.getElementById("method_select").innerHTML = options;
            },
        });

    }

</script>


<!-- END CONTENT -->


<!--//var_dump($user_groups);-->
