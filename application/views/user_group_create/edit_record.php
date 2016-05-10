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


        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus-circle"></i><?php echo isset($task_title)?$task_title:null?>
                </div>
                <div class="tools"></div>
            </div>
            <div class="portlet-body">

                <div class="form-group">
                    <?php if($message != null)echo 'create user.'; else echo $message; ?>
                </div>
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        <form role="form" action="<?php echo base_url()?>user_manage/create_user_group" method="post">
                            <div class="form-group">
                                <label for="username">TITLE:</label>
                                <input type="text" class="form-control" name="title" value="<?php echo $user_group_info['title'];?>">
                            </div>
                            <div class="form-group">
                                <label for="namebn">ORDERING:</label>
                                <input type="number" min="0" class="form-control" name="ordering" value="<?php echo $user_group_info['ordering'];?>">
                            </div>
                            <div class="form-group">
                                <label for="nameen">STATUS:</label>
                                <div class="col-md-3">
                                    <select class="form-control input-medium" name="status">
                                        <option value="<?php echo $this->config->item('STATUS_ACTIVE');?>" <?php if($user_group_info['status']==$this->config->item('STATUS_ACTIVE')){echo "selected='selected'";}?>><?php echo $this->lang->line('ACTIVE');?></option>
                                        <option value="<?php echo $this->config->item('STATUS_INACTIVE');?>" <?php if($user_group_info['status']==$this->config->item('STATUS_INACTIVE')){echo "selected='selected'";}?>><?php echo $this->lang->line('INACTIVE');?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" class="btn btn-danger pull-right">
                            </div>
                        </form>
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
