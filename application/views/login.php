<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Login</title>
        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url('vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="<?php echo base_url('vendor/metisMenu/metisMenu.min.css'); ?>" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?php echo base_url('dist/css/sb-admin-2.css'); ?>" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="<?php echo base_url('vendor/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Admin Sign In</h3>
                        </div>
                        <?php
                                                $message = $this->session->flashdata('message');
                                                $class = $this->session->flashdata('msg_class');
                                                if (!empty($message) && !empty($class)) {?>
                                                    <div class="alert <?php echo $class; ?>">
                                                        <button class="close" data-close="alert"></button>
                                                        <?php  echo $message;?>
                                                    </div>
                                                <?php }?>
                                                        
                                                <div class="clear"></div>
                        <div class="panel-body">
                            <form role="form" action="<?php echo base_url('adminLogin/index'); ?>" method="post" autocomplete="off">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Username" name="username" type="username" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password" required>
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <button type="submit" name="adminLogin" class="btn btn-lg btn-success btn-block" value="Login">Login</button>
                                    
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- jQuery -->
        <script src="<?php echo base_url('vendor/jquery/jquery.min.js'); ?>"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url('vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo base_url('vendor/metisMenu/metisMenu.min.js'); ?>"></script>
        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url('dist/js/sb-admin-2.js'); ?>"></script>
    </body>
</html>
