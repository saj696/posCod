<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <?php if (User_helper::has_access(null, 'task_create', 'add_record')) { ?>
            <div class="row form-group">
                <div class="col-md-12">
                    <a href="<?php echo base_url() . 'task_create/add_record'; ?>">
                        <button class="btn btn-success pull-right">Create Task</button>
                    </a>
                </div>
            </div>
        <?php } ?>

        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus-circle"></i><?php echo isset($task_title)?$task_title:null?>
                </div>
                <div class="tools"></div>
            </div>
            <div class="portlet-body">

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-condensed table-responsive">
                            <tr class="active">
                                <td>#</td>
                                <td>Name</td>
                                <td>Controller</td>
                                <td>Method</td>
                                <td>Parent</td>
                                <td>Status</td>
                                <td>Order</td>
                                <td>Actions</td>
                            </tr>
                            <?php $sn = 1; ?>
                            <?php foreach ($tasks as $ug) { ?>
                                <tr>
                                    <td><?php echo($sn++); ?></td>
                                    <td><?php echo($ug['name_en']); ?></td>
                                    <td><?php echo($ug['controller']); ?></td>
                                    <td><?php echo($ug['method']); ?></td>
                                    <td><?php echo($ug['parent_id']); ?></td>
                                    <td><?php echo($ug['status']); ?></td>
                                    <td><?php echo($ug['ordering']); ?></td>
                                    <td>
                                        <?php if (User_helper::has_access(null, 'task_create', 'show_record')) { ?>
                                            <a href="<?php echo base_url() . 'task_create/show_record/' . $ug['id']; ?>">
                                                <button class="btn-default btn">Show</button>
                                            </a>
                                        <?php } ?>
                                        <?php if (User_helper::has_access(null, 'task_create', 'edit_record')) { ?>
                                            <a href="<?php echo base_url() . 'task_create/edit_record/' . $ug['id']; ?>">
                                                <button class="btn-info btn">Edit</button>
                                            </a>
                                        <?php } ?>
                                        <?php if (User_helper::has_access(null, 'task_create', 'delete_record')) { ?>
                                            <button class="btn-danger btn" onclick="delete_record(<?php echo $ug['id']; ?>)">Delete</button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix">
        </div>
    </div>
</div>
<!-- END CONTENT -->

<script>
    function delete_record(record_id){
        $.ajax({
            dataType: 'json',
            type: "POST",
            url: '<?php echo base_url().$this->controller_name.'/delete_record'; ?>',
            data:
            {
                record_id: record_id
            },
            success: function(data) {
                if(data['status']=='success'){
                    alert(data['message']);
                }
                else
                {
                    alert(data['message']);
                }
                location.reload();
            }
        });
    }
</script>