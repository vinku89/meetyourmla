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
                            <h3 class="page-header">Investments</h3>
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
													<th>Category</th>
													<th>Message</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($investments) && count($investments)) {
                                                    $sno = 1;
                                                    foreach ($investments as $investment) {
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td><?php echo $sno++; ?></td>
															<td><?php echo ucwords($investment['name']); ?></td>
                                                            <td><?php echo $investment['phone']; ?></td>
															<td><?php echo $investment['email']; ?></td>
                                                            <td><?php echo $investment['address']; ?></td>
															<td><?php echo $investment['category']; ?></td>
															<td><?php echo $investment['message']; ?></td>
                                                            <td><span><a href="<?php echo base_url('adminLocalization/deleteInvestment/' . $investment['id']); ?>">Delete</a></span></td>
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
