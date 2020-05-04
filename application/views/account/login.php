<link rel="stylesheet" href="<?php echo css_url("account/login/fonts/iconic/css/material-design-iconic-font.min.css") ?>">
<link rel="stylesheet" href="<?php echo css_url("account/login/vendor/animate/animate.css") ?>">
<link rel="stylesheet" href="<?php echo css_url("account/login/vendor/css-hamburgers/hamburgers.min.css") ?>">
<link rel="stylesheet" href="<?php echo css_url("account/login/vendor/animsition/css/animsition.min.css") ?>">
<link rel="stylesheet" href="<?php echo css_url("account/login/vendor/select2/select2.min.css") ?>">
<link rel="stylesheet" href="<?php echo css_url("account/login/vendor/daterangepicker/daterangepicker.css") ?>">
<link rel="stylesheet" href="<?php echo css_url("account/login/css/util.css") ?>">
<link rel="stylesheet" href="<?php echo css_url("account/login/css/main.css") ?>">



<!-- LOGIN FORM-->
<div class="limiter" id="login-form-whole">
    <div class="container-login100" style="background-image: url('<?php echo img_url("login-bg.jpg") ?>');">
        <div class="wrap-login100">
            <form method="POST" id="login-form" class="login100-form validate-form">


                <span class="login100-form-logo">
                    <i class="zmdi zmdi-landscape"></i>
                </span>

                <span class="login100-form-title p-b-34 p-t-27">

                    <?php echo lang("login") ?>
                </span>

                <div class="wrap-input100 validate-input" data-validate="<?php echo lang("enter_username") ?>">
                    <input class="input100" type="text" name="username" placeholder="<?php echo lang("username") ?>">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="<?php echo lang("enter_password") ?>">
                    <input class="input100" type="password" name="password" placeholder="<?php echo lang("password") ?>">

                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>

                <div class="contact100-form-checkbox">
                    <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                    <label class="label-checkbox100" for="ckb1">
                        <input name="login" class="invisible">
                        <?php echo lang("remember_me") ?>

                    </label>
                </div>

                <div class="container-login100-form-btn">

                    <button class="login100-form-btn" onclick="submit_login()"><input class="login100-form-input" name="login" type="submit" value="<?php echo lang("login") ?>"></button>


                </div>

                <div class="text-center p-t-90">
                    <a class="txt1" onclick="toggle_register()" id="login-form-hider">
                        <?php echo lang("register") ?>
                    </a>
                </div>

            </form>
        </div>
    </div>


</div>
<!--END OF LOGIN FORM-->
<!-- REGISTER FORM-->
<div class="limiter" id="register-form-whole">
    <div class="container-login100" style="background-image: url('<?php echo img_url("login-bg.jpg") ?>');">
        <div class="wrap-login100">
            <form method="POSt" id="register-form" class="login100-form validate-form">


                <span class="login100-form-logo">
                    <i class="zmdi zmdi-landscape"></i>
                </span>

                <span class="login100-form-title p-b-34 p-t-27">

                    <?php echo lang("register") ?>
                </span>

                <div class="wrap-input100 validate-input" data-validate="<?php echo lang("enter_nice_user_name") ?>">
                    <input class="input100" type="text" name="nice_user_name" placeholder="<?php echo lang("nice_user_name") ?>">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="<?php echo lang("enter_email") ?>">
                    <input class="input100" type="text" name="email" placeholder="<?php echo lang("email") ?>">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="<?php echo lang("enter_username") ?>">
                    <input class="input100" type="text" name="username" placeholder="<?php echo lang("username") ?>">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="<?php echo lang("enter_password") ?>">
                    <input class="input100" type="password" name="password" placeholder="<?php echo lang("password") ?>">


                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="<?php echo lang("enter_password_again") ?>">
                    <input class="input100" type="password" name="password-again" placeholder="<?php echo lang("password_again") ?>">

                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>
                <input name="register" class="invisible">

                <div class="container-login100-form-btn">

                    <button class="login100-form-btn" onclick="submit_reg()"><input class="login100-form-input" name="register" type="submit" value="<?php echo lang("register") ?>"></button>


                </div>

                <div class="text-center p-t-90">
                    <a class="txt1" onclick="toggle_login()" id="login-form-hider">
                        <?php echo lang("login") ?>
                    </a>
                </div>

            </form>
        </div>
    </div>


</div>

<!-- END OF REGISTER FORM -->


<script>
    $(document).ready(function(){
        $("#register-form-whole").hide();
    });
    function submit_login() {
        document.getElementById("login-form").submit();
    }

    function submit_reg() {
        document.getElementById("register-form").submit();
    }

    function toggle_register() {
        $("#login-form-whole").hide();
        $("#register-form-whole").show();
    }

    function toggle_login() {
        $("#register-form-whole").hide();
        $("#login-form-whole").show();
    }
</script>

<script src="<?php echo js_url("account/login/fontawesome/all.min.js") ?>" crossorigin="anonymous"></script>
<script src="<?php echo js_url("account/login/vendor/animsition/js/animsition.min.js") ?>"></script>
<script src="<?php echo js_url("account/login/vendor/bootstrap/js/popper.js") ?>"></script>
<script src="<?php echo js_url("account/login/vendor/select2/select2.min.js") ?>"></script>
<script src="<?php echo js_url("account/login/vendor/daterangepicker/moment.min.js") ?>"></script>
<script src="<?php echo js_url("account/login/vendor/daterangepicker/daterangepicker.js") ?>"></script>
<script src="<?php echo js_url("account/login/vendor/countdowntime/countdowntime.js") ?>"></script>
<script src="<?php echo js_url("account/login/js/main.js") ?>"></script>

<div id="dropDownSelect1"></div>