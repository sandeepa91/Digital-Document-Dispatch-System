<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>NWS&DB | Login</title>

        <link href="<?php echo base_url('assets'); ?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url('assets'); ?>/font-awesome/css/font-awesome.css" rel="stylesheet">

        <link href="<?php echo base_url('assets'); ?>/css/animate.css" rel="stylesheet">
        <link href="<?php echo base_url('assets'); ?>/css/style.css" rel="stylesheet">

    </head>

    <body style="background-color: skyblue ">

        <div class="middle-box text-center loginscreen  animated fadeInDown">
            <div>
                <div>
                    
                    <h1 class="logo">
                        <center>
                            <img style="margin-top: 45px" alt="image" class="img-responsive" src="<?php echo base_url('assets'); ?>/img/logo9.png" width="170px"/>
                        </center> 
                    </h1>

                </div>
                
                <h3 class="m-t-md"> Digital Document Dispatch System</h3> 
                <h4 class="m-t-md">Log in</h4>
                <?php if (isset($login_fail) && $login_fail): ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        Login Failed.
                    </div>
                <?php endif; ?>

                <form id="login_form" class="m-t" role="form" action="<?php echo base_url('index.php'); ?>/users/login" method="POST">
                    <div class="form-group">
                        <input name="username" type="text" style="color: #FFFFFF; background-color:#005f8d  " class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input name="password" type="password" style="color: #FFFFFF; background-color:#005f8d " class="form-control" placeholder="Password" >
                    </div>
                    <div class="form-group"><p>
                            <input type="checkbox" name="remember" value="remember"/> Remember Me</p>
                    </div>
                    <button type="submit" class="btn btn-success block full-width m-b">Login</button>

                    <a href="<?= base_url('/index.php/users/forgot_pass') ?>">
                        <small>Forgot password?</small>
                    </a>                   
                    <div><br/>
                        <a href="<?= base_url('/index.php/users/register_author') ?>" target="_blank" class="btn btn-success block full-width m-b">New User</a>
                    </div>
                </form>

            </div>
        </div>

        <!-- Mainly scripts -->
        <script src="<?php echo base_url('assets'); ?>/js/jquery-2.1.1.js"></script>
        <script src="<?php echo base_url('assets'); ?>/js/bootstrap.min.js"></script>

        <!-- Jquery Validate -->
        <script src="<?php echo base_url('assets'); ?>/js/plugins/validate/jquery.validate.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#login_form").validate({
                    rules: {
                        username: {
                            required: true,
                            minlength: 3
                        },
                        password: {
                            required: true,
                            minlength: 3
                        }
                    }
                });
            });
        </script>

    </body>

</html>
