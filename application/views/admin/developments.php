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
                        <div class="col-lg-10">
                            <h3 class="page-header">Developments</h3>
                        </div>
                        <div class="col-lg-2">
                            <a href="<?php echo base_url('adminLocalization/addDevelopment'); ?>"><button type="submit" class="btn btn-primary" >Add New</button></a>
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
													<th>Contractor</th>
                                                    <th>Work</th>
                                                    <th>Cost</th>
													<th>Department</th>
													<th>Village</th>
													<th>Mandal</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($developments) && count($developments)) {
                                                    $sno = 1;
                                                    foreach ($developments as $development) {
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td><?php echo $sno++; ?></td>
															<td><?php echo ucwords($development['contrator']); ?></td>
                                                            <td><?php echo $development['work']; ?></td>
															<td><?php echo $development['cost']; ?></td>
                                                            <td><?php echo $development['department']; ?></td>
															<td><?php echo $development['village']; ?></td>
															<td><?php echo $development['mandal']; ?></td>
                                                            <td><span><a href="<?php echo base_url('adminLocalization/updateDevelopment/' . $development['id']); ?>">Edit</a></span> | <span><a href="<?php echo base_url('adminLocalization/deleteDevelopment/' . $development['id']); ?>">Delete</a></span></td>
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
