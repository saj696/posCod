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
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">

                        <!--                check isset of these variables before echo, later-->
                        <table class="table table-responsive table-striped table-condenced">
                            <tr>
                                <td>Parent: </td>
                                <td><?php echo $task_info['parent_id']; ?></td>
                            </tr>
                            <tr>
                                <td>Name En: </td>
                                <td><?php echo $task_info['name_en']; ?></td>
                            </tr>
                            <tr>
                                <td>Name Bn: </td>
                                <td><?php echo $task_info['name_bn']; ?></td>
                            </tr>
                            <tr>
                                <td>Description: </td>
                                <td><?php echo $task_info['description']; ?></td>
                            </tr>
                            <tr>
                                <td>Controller: </td>
                                <td><?php echo $task_info['controller']; ?></td>
                            </tr>
                            <tr>
                                <td>Method: </td>
                                <td><?php echo $task_info['method']; ?></td>
                            </tr>
                            <tr>
                                <td>Data Access: </td>
                                <td><?php
                                    if( $task_info['data_access'] == $this->config->item('DATA_ACCESS_OWN') )
                                        echo $this->config->item('DATA_ACCESS_STRING_OWN');
                                    elseif( $task_info['data_access'] == $this->config->item('DATA_ACCESS_GROUP') )
                                        echo $this->config->item('DATA_ACCESS_STRING_GROUP');
                                    elseif( $task_info['data_access'] == $this->config->item('DATA_ACCESS_ALL') )
                                        echo $this->config->item('DATA_ACCESS_STRING_ALL');
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Ordering: </td>
                                <td><?php echo $task_info['ordering']; ?></td>
                            </tr>
                            <tr>
                                <td>Position: </td>
                                <td>
                                    Left:
                                    <?php if(!empty($task_info['position_left_01']))echo $task_info['position_left_01']; ?>
                                    &nbsp;
                                    Top:
                                    <?php if(!empty($task_info['position_top_01']))echo $task_info['position_top_01']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Status: </td>
                                <td><?php echo $task_info['status']; ?></td>
                            </tr>
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


<!--//var_dump($user_groups);-->
