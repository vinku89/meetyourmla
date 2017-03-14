<div class="footer mar-t-60">
<div class="container">
	<div class="footer-lnks">
		<a href="<?php echo base_url('home/about');?>">Visit constituency</a> 
        <a href="<?php echo base_url('home/developments');?>">Development</a>     
        <a href="<?php echo base_url('home/investment');?>">Invest</a> 
        <a href="<?php echo base_url('home/requirement');?>">Requirement</a>    
        <a href="#">Meet People</a>     
	</div>
    <div class="copy">© <?php echo date('Y');?> meetyourmla.com</div>
</div>
</div>

<div id="myModa2" class="modal fade login" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Invest / Requirement </h4>
      </div>
      
      <div class="modal-body">
<div class="col-md-6 text-center">
      <div class="icon-bg round-full mar-b-15 icon-large"> <i class="fa fa-handshake-o" aria-hidden="true"></i> </div>
      <div class="desc">
        <h2>INVEST</h2>
        <p></p>
        <a href="<?php echo base_url('home/investment');?>" class="btn btn-success">INVEST</a> </div>
    </div>



<div class="col-md-6 text-center">
      <div class="icon-bg round-full mar-b-15 icon-large"> <i class="fa fa-bell" aria-hidden="true"></i> </div>
      <div class="desc">
        <h2>Requirement</h2>
        <p></p>
        <a href="<?php echo base_url('home/requirement');?>" class="btn btn-success">Requirement</a> </div>
    </div>

<span class="clearfix"></span>
        
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>

  </div>
</div>

<div id="myModa3" class="modal fade login" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">SMS</h4>
      </div>
      <div class="modal-body">
        
        <form role="form">
        <div class="form-group">
          <textarea class="form-control" rows="3"></textarea>
        </div>
        
        <a href="contact.html" type="submit" class="btn btn-success">Send</a>
      </form>
        
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>

  </div>
</div>



<div id="myModa4" class="modal fade login" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Developments </h4>
      </div>
      
      <div class="modal-body">
<div class="col-md-6 text-center">
      <div class="icon-bg round-full mar-b-15 icon-large"> <i class="fa fa-university" aria-hidden="true"></i> </div>
      <div class="desc">
        <p></p>
        <a data-toggle="modal" href="#selvillage" class="btn btn-success">Village</a> </div>
    </div>



<div class="col-md-6 text-center">
      <div class="icon-bg round-full mar-b-15 icon-large"> <i class="fa fa-sitemap" aria-hidden="true"></i> </div>
      <div class="desc">
        <p></p>
        <a href="<?php echo base_url('home/developments');?>" class="btn btn-success">Department</a> </div>
    </div>

<span class="clearfix"></span>
        
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>

  </div>
</div>

<div id="selvillage" class="modal fade login" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Village</h4>
      </div>
      
      <div class="modal-body">
      
<div class="col-md-6 text-center col-md-offset-3 pad-20">
      <div class="icon-bg round-full mar-b-15 icon-large"> <i class="fa fa-university" aria-hidden="true"></i> </div>
      <div class="desc">
        
        <select id="selvillage" class="form-control" name="forma" onChange="location = this.value;">
              <?php if(isset($villages) && count($villages)>0){
				foreach($villages as $village){?>
					<option value="<?php echo base_url('home/villages/'.$village['id']);?>"><?php echo ucwords($village['name']);?></option>
				<?php }
			   }?>
          </select>        
        
        </div>
    </div>





<span class="clearfix"></span>
        
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>

  </div>
</div>



<!-- Bootstrap core JavaScript -->

<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/selectmenu.js"></script>

<script src="<?php echo base_url(); ?>assets/js/bootstrap-select.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.chained.js"></script>
<!-- Modal popup -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap-modalmanager.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-modal.js"></script>

<!-- Filters Script -->
<script type="text/javascript">
$(document).ready(function() {
	$('#madals_dropdown').change(function(){
		var mandal_ids = $('#madals_dropdown').val();
		if(mandal_ids.length >0)
		{
			$.ajax({
					url: '<?php echo base_url();?>index.php/Home/getVillages',
					cache: false,
					type: "post",
					beforeSend: function(){$('#villages_dropdown').empty();},
					data: { result : JSON.stringify(mandal_ids) },
					success: function(res){
						if(res != '') {
							var data = JSON.parse(res);
							options = "";
							list = "";
							for(var i =0;i < data.length;i++)
							{
								var item = data[i];	
								if($("#villages_dropdown option[value='"+item.id+"']").length == 0){							
									$('#villages_dropdown').append('<option value="' + item['id'] + '">' + item['name'] +'</option>');
								}
							}
							$('#villages_dropdown').append(options);						
							$('#villages_dropdown').selectpicker('refresh');
						}
					}
			});
		}
	});
});

/* load contacts based on the filter starts*/
$(document).ready(function() {
	$('.filter').click(function(){
		var mandal_ids = $('#madals_dropdown').val();
		var village_ids = $('#villages_dropdown').val();
		var designation_ids = $('#designations_dropdown').val();
		if(mandal_ids.length >0)
		{
			$.ajax({
					url: '<?php echo base_url();?>index.php/Home/getContacts',
					cache: false,
					type: "post",
					//beforeSend: function(){$('#villages_dropdown').empty();},
					data: { mandals : JSON.stringify(mandal_ids), villages : JSON.stringify(village_ids), designations : JSON.stringify(designation_ids) },
					success: function(res){
						options = "";
						var list = "";
						if(res != '') {
							var data = JSON.parse(res);
							for(var i =0;i < data.length;i++)
							{
								var item = data[i];	
								list += '<tr><td>'+item.name+'</td>';
								list += '<td>'+item.village+'</td>';
								list += '<td>'+item.mandal+'</td>';
								list += '<td>'+item.designation+'</td>';
								list += '<td>'+item.phone+'</td>';
								list += '<td><span class="pad-l-10"><input name="" type="checkbox" value="">';
								list += '<a href="#" class="btn btn-success mar-l-10" data-toggle="modal" data-target="#myModa3">SEND SMS<i class="fa fa-mobile pad-l-10" aria-hidden="true"></i></a></span>'
								list += '</td>';
								list += '</tr>';
							}
							
						}else{
							list += '<tr><td colspan="6">No Records Found</td></tr>';
						}
						$('#contacts').html(list);
							
					}
			});
		}
	});
});
/* load contacts based on the filter starts*/

/* load developments based on the filter starts*/
$(document).ready(function() {
	$('.filterdevelopment').click(function(){
		var mandal_ids = $('#madals_dropdown').val();
		var village_ids = $('#villages_dropdown').val();
		if(mandal_ids.length >0)
		{
			$.ajax({
					url: '<?php echo base_url();?>index.php/Home/getDevelopmentsByAjaxFilter',
					cache: false,
					type: "post",
					//beforeSend: function(){$('#villages_dropdown').empty();},
					data: { mandals : JSON.stringify(mandal_ids), villages : JSON.stringify(village_ids)},
					success: function(res){
						options = "";
						var list = "";
						if(res != '') {
							var data = JSON.parse(res);
							var sno = 1;
							for(var i =0;i < data.length;i++)
							{
								sno = sno++;
								var item = data[i];	
								list += '<tr><td>'+sno+'</td>';
								list += '<td>'+item.department+'</td>';
								list += '<td>'+item.village+'</td>';
								list += '<td>'+item.mandal+'</td>';
								list += '<td>'+item.work+'</td>';
								list += '<td>'+item.cost+'</td>';
								list += '<td>'+item.contrator+'</td>';
								list += '<td><a href="https://www.google.co.in/maps/place/Payakaraopeta,+Andhra+Pradesh/@17.3652775,82.5519588,15z/data=!3m1!4b1!4m5!3m4!1s0x3a39c78b276e15c9:0xde8ee6490c3efa7f!8m2!3d17.3617463!4d82.5591603" target="_blank">Location Area</a></td>';
								list += '</tr>';
							}
							
						}else{
							list += '<tr><td colspan="6">No Records Found</td></tr>';
						}
						$('#developments').html(list);
							
					}
			});
		}
	});
});
/* load developments based on the filter ends*/

/* load villages based on the mandal selection starts */
$(document).ready(function() {
$('.mandalfilter').change(function(){
		var mandal_id = $(this).val();
		if(mandal_id.length>0)
		{
			$.ajax({
					url: '<?php echo base_url();?>index.php/Home/getVillages',
					cache: false,
					type: "post",
					beforeSend: function(){$('.villagesdropdown').empty();},
					data: { result : JSON.stringify(mandal_id) },
					success: function(res){
						if(res != '') {
							var data = JSON.parse(res);
							options = "";
							list = "";
							$('.villagesdropdown').append('<option value="">-Select Village-</option>');
							for(var i =0;i < data.length;i++)
							{
								var item = data[i];	
								if($(".villagesdropdown option[value='"+item.id+"']").length == 0){							
									$('.villagesdropdown').append('<option value="' + item['id'] + '">' + item['name'] +'</option>');
								}
							}
							$('.villagesdropdown').append(options);						
							//$('#villages_dropdown').selectpicker('refresh');
						}
					}
			});
		}
	});
});
/* load villages based on the mandal selection ends */	
</script>
</body>
</html>
