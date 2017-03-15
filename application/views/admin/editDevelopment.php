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
                                <h3 class="page-header">Update Development</h3> </div>
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
                                                        <?php }?>
                                                            <div class="clear"></div>
                                                            <form class="form-horizontal" method='post' action="<?php echo base_url('adminLocalization/editDevelopment/'.$department['id']); ?>">
                                                                <div class="form-group">
                                                                    <label for="inputEmail" class="control-label col-xs-4">Contractor Name</label>
                                                                    <div class="col-xs-8">
                                                                        <input type="text" class="form-control" id="contrator" placeholder="Contractor Name" name="contrator" required pattern="[A-Za-z0-9-. ]{1,30}" title="Contractor Name Name Must be Alphanumeric and -,.space Only"> </div>
                                                                </div>
																<div class="form-group">
                                                                    <label for="inputEmail" class="control-label col-xs-4">Work</label>
                                                                    <div class="col-xs-8">
                                                                        <input type="text" class="form-control" id="work" placeholder="Work" name="work" required pattern="[A-Za-z0-9-. ]{1,30}" title="Work Must be Alphanumeric and -,.space Only"> </div>
                                                                </div>
																<div class="form-group">
                                                                    <label for="inputEmail" class="control-label col-xs-4">Cost</label>
                                                                    <div class="col-xs-8">
                                                                        <input type="text" class="form-control" id="cost" placeholder="Cost" name="cost" required pattern="\d*" title="Cost Must Numeric letters Only"> </div>
                                                                </div>
																<div class="form-group">
                                                                    <label for="inputEmail" class="control-label col-xs-4"> Department</label>
                                                                    <div class="col-xs-8">
																		<select class="form-control" id="department_id" name="department_id" required>
																			<option value="">Select Department</option>
																			<?php if(isset($departments) && count($departments)>0){
																				foreach($departments as $department){?>
																				<option value="<?php echo $department['id'];?>"><?php echo ucwords($department['name']);?></option>
																			<?php }
																			}?>
																		</select>
																	</div>
                                                                </div>
																<div class="form-group">
                                                                    <label for="inputEmail" class="control-label col-xs-4"> Select Mandal</label>
                                                                    <div class="col-xs-8">
																		<select class="form-control" id="mandal_id" name="mandal_id" required>
																			<option value="">Select Mandal</option>
																			<?php if(isset($mandals) && count($mandals)>0){
																				foreach($mandals as $mandal){?>
																				<option value="<?php echo $mandal['id'];?>"><?php echo ucwords($mandal['name']);?></option>
																			<?php }
																			}?>
																		</select>
																	</div>
                                                                </div>
																<div class="form-group">
                                                                    <label for="inputEmail" class="control-label col-xs-4"> Select Village</label>
                                                                    <div class="col-xs-8">
																		<select class="form-control" id="village_id" name="village_id" required>
																			<option value="">Select Village</option>
																		</select>
																	</div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-xs-offset-4 col-xs-8">
                                                                        <button type="submit" class="btn btn-primary" name="developmentPost" value="Submit">Submit</button>
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