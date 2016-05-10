<!-- BEGIN LOGIN FORM -->
<form class="login-form" action="<?php echo base_url();?>auth/user_login" method="post">
    <h3 class="form-title">Sign In</h3>
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
			<span>
			Enter username and password. </span>
    </div>
    <div>
        <?php $fl_message = $this->session->flashdata('fl_message');?>
        <?php if($fl_message != NULL){?>
            <div class="alert alert-warning"> <strong><?php echo $fl_message; ?></strong> </div>
        <?php }?>
    </div>
    <?php if(isset($message) && $message != NULL){?>
        <div class="alert alert-warning"> <strong><?php echo $message; ?></strong> </div>
    <?php }?>
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Username</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-success uppercase">Login</button>
        <!--            <label class="rememberme check">-->
        <!--                <input type="checkbox" name="remember" value="1"/>Remember </label>-->
        <!--            <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>-->
    </div>
    <!--<div class="login-options">
        <h4>Or login with</h4>
        <ul class="social-icons">
            <li>
                <a class="social-icon-color facebook" data-original-title="facebook" href="#"></a>
            </li>
            <li>
                <a class="social-icon-color twitter" data-original-title="Twitter" href="#"></a>
            </li>
            <li>
                <a class="social-icon-color googleplus" data-original-title="Goole Plus" href="#"></a>
            </li>
            <li>
                <a class="social-icon-color linkedin" data-original-title="Linkedin" href="#"></a>
            </li>
        </ul>
    </div>-->
    <div class="create-account">
        <p>
            &nbsp;
            <!--<a href="<?php /*echo base_url();*/?>auth/register_user" class="uppercase">Create an account</a>-->
        </p>
    </div>
</form>
<!-- END LOGIN FORM -->
<!-- BEGIN FORGOT PASSWORD FORM -->
<form class="forget-form" action="index.html" method="post">
    <h3>Forget Password ?</h3>
    <p>
        Enter your e-mail address below to reset your password.
    </p>
    <div class="form-group">
        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
    </div>
    <div class="form-actions">
        <button type="button" id="back-btn" class="btn btn-default">Back</button>
        <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
    </div>
</form>
<!-- END FORGOT PASSWORD FORM -->