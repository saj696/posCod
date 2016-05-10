<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<div class="row form-group">
    <div class="col-md-offset-3 col-md-6 ">
        <a id="alert_show" class="btn btn-primary " href="javascript:;" onclick="history.go(-1);">
            <?php echo $this->lang->line('BACK');?>
        </a>
        <button type="reset" class="btn btn-danger" ><?php echo $this->lang->line('RESET_FIELD');?></button>
        <button class="btn btn-success" ><?php echo $this->lang->line('SAVE');?></button>
    </div>
</div>