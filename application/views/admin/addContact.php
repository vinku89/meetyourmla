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
                                <h3 class="page-header">Add Contact</h3> </div>
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
                                                            <form class="form-horizontal" method='post' action="<?php echo base_url('adminLocalization/addContact'); ?>">
                                                                <div class="form-group">
                                                                    <label for="inputEmail" class="control-label col-xs-4">Name Of Person</label>
                                                                    <div class="col-xs-8">
                                                                        <input type="text" class="form-control" id="name" placeholder="Name Of Person" name="name" required pattern="[A-Za-z0-9-. ]{1,30}" title="Contact Name Must be Alphanumeric and -,.space Only"> </div>
                                                                </div>
																<div class="form-group">
                                                                    <label for="inputEmail" class="control-label col-xs-4">Phone Number</label>
                                                                    <div class="col-xs-8">
                                                                        <input type="text" class="form-control" id="phone" placeholder="Phone Number" name="phone" required pattern="[0-9]{10}" title="Phone Number Must be Numeric and 10 Numbers"> </div>
                                                                </div>
																<div class="form-group">
                                                                    <label for="inputEmail" class="control-label col-xs-4"> Designation</label>
                                                                    <div class="col-xs-8">
																		<select class="form-control" id="designation_id" name="designation_id">
																			<option value="">Select Designation</option>
																			<?php if(isset($designations) && count($designations)>0){
																				foreach($designations as $designation){?>
																				<option value="<?php echo $designation['id'];?>"><?php echo ucwords($designation['name']);?></option>
																			<?php }
																			}?>
																		</select>
																	</div>
                                                                </div>
																<div class="form-group">
                                                                    <label for="inputEmail" class="control-label col-xs-4"> Select Mandal</label>
                                                                    <div class="col-xs-8">
																		<select class="form-control" id="mandal_id" name="mandal_id">
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
																		<select class="form-control" id="village_id" name="village_id">
																			<option value="">Select Village</option>
																		</select>
																	</div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-xs-offset-4 col-xs-8">
                                                                        <button type="submit" class="btn btn-primary" name="contactPost" value="Submit">Submit</button>
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