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
                            <h3 class="page-header">Village Information</h3>
                        </div>
                        <div class="col-lg-2">
                            <a href="<?php echo base_url('adminLocalization/addVillageInfo'); ?>"><button type="submit" class="btn btn-primary" >Add New</button></a>
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
													<th>Population</th>
                                                    <th>Houses</th>
                                                    <th>Water</th>
													<th>Hospitals</th>
													<th>Govt Buildings</th>
													<th>Roads</th>
													<th>Village</th>
													<th>Mandal</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($villageInfos) && count($villageInfos)) {
                                                    $sno = 1;
                                                    foreach ($villageInfos as $villageInfo) {
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td><?php echo $sno++; ?></td>
															<td><?php echo $villageInfo['population']; ?></td>
                                                            <td><?php echo $villageInfo['houses']; ?></td>
															<td><?php echo $villageInfo['water']; ?></td>
                                                            <td><?php echo $villageInfo['hospitals']; ?></td>
															<td><?php echo $villageInfo['govtbuildings']; ?></td>
															<td><?php echo $villageInfo['roads']; ?></td>
                                                            <td><?php echo $villageInfo['village']; ?></td>
															<td><?php echo $villageInfo['mandal']; ?></td>
                                                            <td><span><a href="<?php echo base_url('adminLocalization/updateVillageInfo/' . $villageInfo['id']); ?>">Edit</a></span> | <span><a href="<?php echo base_url('adminLocalization/deleteVillageInfo/' . $villageInfo['id']); ?>">Delete</a></span></td>
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
