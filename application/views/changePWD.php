<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Mandals</title>
        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url('vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="<?php echo base_url('vendor/metisMenu/metisMenu.min.css'); ?>" rel="stylesheet">
        <!-- DataTables CSS -->
        <link href="<?php echo base_url('vendor/datatables-plugins/dataTables.bootstrap.css'); ?>" rel="stylesheet">
        <!-- DataTables Responsive CSS -->
        <link href="<?php echo base_url('vendor/datatables-responsive/dataTables.responsive.css'); ?>" rel="stylesheet">
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
        <div id="wrapper">
            <?php include_once('application/views/includes/navigation.php'); ?>

            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header">Change Password</h3>
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">

                                    </div>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-8">
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
                                                <form role="form" method='post' action="<?php echo base_url('adminUser/changePWD'); ?>">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Old Password
                                                            <span class="required">
                                                                *
                                                            </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <input type="password" name="old_password" id="old_password" data-required="1" class="form-control" autocomplete="off" required/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">New Password
                                                            <span class="required">
                                                                *
                                                            </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <input type="password" name="new_password" id="new_password" data-required="1" class="form-control" autocomplete="off" required/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Confirm Password
                                                            <span class="required">
                                                                *
                                                            </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            <input type="password" name="cnf_password" id="cnf_password" data-required="1" class="form-control" autocomplete="off" required/>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"> </div>
                                            
                                            <div class="form-actions fluid">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn btn-success" name="changePwdPost" value="Submit">Submit</button>

                                                </div>
                                            </div>
                                        </form>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.panel-body -->
                                </div>
                                <!-- /.panel -->
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>
                        <!-- /.row -->
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
        <!-- jQuery -->
        <script src="<?php echo base_url('vendor/jquery/jquery.min.js'); ?>"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url('vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo base_url('vendor/metisMenu/metisMenu.min.js'); ?>"></script>
        <!-- DataTables JavaScript -->
        <script src="<?php  echo base_url('vendor/datatables/js/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('vendor/datatables-plugins/dataTables.bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('vendor/datatables-responsive/dataTables.responsive.js'); ?>"></script>
        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url('dist/js/sb-admin-2.js'); ?>"></script>
        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
            });
        </script>
    </body>
</html>
