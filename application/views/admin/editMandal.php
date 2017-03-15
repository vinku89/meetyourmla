<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin/common/header');?>

    <body>
        <div id="wrapper">
            <?php $this->load->view('admin/common/navigation'); ?>
                <!-- Page Content -->
                <div id="page-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="page-header">Update Mandal</h3> </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"> </div>
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
                                                        <?php }
														?>
                                                            <div class="clear"></div>
                                                            <form class="form-horizontal" method='post' action="<?php echo base_url('adminLocalization/editMandal/'.$mandal['id']); ?>">
                                                                <div class="form-group">
                                                                    <label for="inputEmail" class="control-label col-xs-4">Mandal Name</label>
                                                                    <div class="col-xs-8">
                                                                        <input type="text" class="form-control" id="name" placeholder="Mandal Name" name="name" value="<?php echo ($mandal['name']) ? $mandal['name'] : '';?>" required pattern="[A-Za-z0-9-. ]{1,30}" title="Mandal Name Must be Alphanumeric and -,.space Only" > </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-xs-offset-4 col-xs-8">
                                                                        <button type="submit" class="btn btn-primary" name="mandalPost" value="Submit">Submit</button>
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
        <?php $this->load->view('admin/common/footer');?>
    </body>

</html>