<!-- jQuery -->
        <script src="<?php echo base_url('vendor/jquery/jquery.min.js'); ?>"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url('vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo base_url('vendor/metisMenu/metisMenu.min.js'); ?>"></script>
        <!-- DataTables JavaScript -->
        <script src="<?php echo base_url('vendor/datatables/js/jquery.dataTables.min.js'); ?>"></script>
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
		<script type="text/javascript">
		$(document).ready(function() {
				$('#mandal_id').on('change',function(){
				var mandalId = $(this).val();
				if(mandalId){
					$.ajax({
						type:'POST',
						url:'<?php echo base_url();?>index.php/adminLocalization/loadVillages',
						data:'mandal_id='+mandalId,
						success:function(html){
							$('#village_id').html(html);
						}
					}); 
				}
			});
		});
		</script>