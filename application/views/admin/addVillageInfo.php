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
                                <h3 class="page-header">Add Village Info</h3> </div>
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
                                                            <form class="form-horizontal" method='post' action="<?php echo base_url('adminLocalization/addVillageInfo'); ?>">
                                                                <div class="form-group">
                                                                    <label for="inputEmail" class="control-label col-xs-4">Population</label>
                                                                    <div class="col-xs-8">
                                                                        <input type="text" class="form-control" id="population" placeholder="Population" name="population" required pattern="\d*" title="Population Numeric letters Only"> </div>
                                                                </div>
																<div class="form-group">
                                                                    <label for="inputEmail" class="control-label col-xs-4">Houses</label>
                                                                    <div class="col-xs-8">
                                                                        <input type="text" class="form-control" id="houses" placeholder="Houses" name="houses" required pattern="\d*" title="Houses Must be Numeric letters Only"> </div>
                                                                </div>
																<div class="form-group">
                                                                    <label for="inputEmail" class="control-label col-xs-4">Water</label>
                                                                    <div class="col-xs-8">
                                                                        <input type="text" class="form-control" id="water" placeholder="Water" name="water" required pattern="\d*" title="Water Must be Numeric letters Only"> </div>
                                                                </div>
																<div class="form-group">
                                                                    <label for="inputEmail" class="control-label col-xs-4">Hospitals</label>
                                                                    <div class="col-xs-8">
                                                                        <input type="text" class="form-control" id="hospitals" placeholder="Hospitals" name="hospitals" required pattern="\d*" title="Hospitals Must be Numeric letters Only"> </div>
                                                                </div>
																<div class="form-group">
                                                                    <label for="inputEmail" class="control-label col-xs-4">Govt. Buildings</label>
                                                                    <div class="col-xs-8">
                                                                        <input type="text" class="form-control" id="govtbuildings" placeholder="Govt Buildings" name="govtbuildings" required pattern="\d*" title="Govt Buildings Must be Numeric letters Only"> </div>
                                                                </div>
																<div class="form-group">
                                                                    <label for="inputEmail" class="control-label col-xs-4">Roads</label>
                                                                    <div class="col-xs-8">
                                                                        <input type="text" class="form-control" id="roads" placeholder="Roads" name="cost" required pattern="\d*" title="Roads Must be Numeric letters Only"> </div>
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
                                                                        <button type="submit" class="btn btn-primary" name="villageInfoPost" value="Submit">Submit</button>
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