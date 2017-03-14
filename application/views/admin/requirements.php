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
                            <h3 class="page-header">Requirements</h3>
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">

                                    </div>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Sno</th>
													<th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
													<th>Address</th>
													<th>Message</th>
													<th>Village</th>
													<th>Mandal</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($requirements) && count($requirements)) {
                                                    $sno = 1;
                                                    foreach ($requirements as $requirement) {
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td><?php echo $sno++; ?></td>
															<td><?php echo ucwords($requirement['name']); ?></td>
                                                            <td><?php echo $requirement['phone']; ?></td>
															<td><?php echo $requirement['email']; ?></td>
                                                            <td><?php echo $requirement['address']; ?></td>
															<td><?php echo $requirement['message']; ?></td>
															<td><?php echo $requirement['village']; ?></td>
															<td><?php echo $requirement['mandal']; ?></td>
                                                            <td><span><a href="<?php echo base_url('adminLocalization/deleteRequirement/' . $requirement['id']); ?>">Delete</a></span></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <!-- /.table-responsive -->

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
