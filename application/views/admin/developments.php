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
						<div class="btn-group pull-right p-r-20 p-t-10">
                                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="<?php echo base_url('adminLocalization/exportDevelopments');?>">Export to Excel</a>
                                        </li>
                                        <li>
                                            <a data-toggle="modal" data-target="#myModal" >Import Developments</a>
                                        </li>
                                    </ul>
                                </div>
                        <div class="col-lg-8">
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
		<!-- Modal Pop up starts-->
                  <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Import Developments</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group " style="margin-bottom:20px;">
                                  <form method="post" action="<?php echo base_url('adminLocalization/importDevelopments');?>" enctype="multipart/form-data">
                                    <div class="col-md-12">
                                      <label class="control-label col-md-4">Upload Development Excel Sheet</label>
                                        <div class="input-group input-large " >
                                            <input type="file" class="form-control" name="development" accept="application/vnd.ms-excel" required><span>(.xls,.xlsx formats only)</span>
                                        </div>
                                        <input type="submit" name="Import_developments" value="Import" class="btn btn-default">
                                            <!-- /input-group -->  
                                    </div>
                                  </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      
                    </div>
                  </div>
      <!-- END Modal Pop up -->
		<?php $this->load->view('admin/common/footer');?>
        
    </body>
</html>
