<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<div class="row form-group">
    <div class="col-md-12">
        <?php
        if (User_helper::has_access(null, $this->controller_name, $this->add_link))
        {
            ?>
            <a href="<?php echo base_url() .$this->controller_name.'/'.$this->add_link; ?>">
                <button class="btn btn-success pull-right"><i class="fa fa-plus-circle"></i>  <?php echo $button_name;?></button>
            </a>
            <?php
        }
        ?>
    </div>
</div>