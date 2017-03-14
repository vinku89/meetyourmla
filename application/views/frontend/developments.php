<?php
$this->load->view('frontend/common/header');
?>
<div class="logo-row">
<div class="container">
    <div class="header-v1">
    <div class="col-md-3">
      <div class="site-name">
        <a href="#">Meet your MLA</a>
      </div>
    </div>
    <div class="col-md-9">
      
                        <div class="socicons pull-right pad-t-15">
                            <ul>
                              <li><a href="#"><i class="fa fa-facebook fa-lg"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter fa-lg"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin fa-lg"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype fa-lg"></i></a></li>
                            </ul>   
                         </div>      
    </div>
      </div>

</div>
</div>




<div class="banner">
    <img src="<?php echo base_url(); ?>assets/img/banner.jpg" alt="">
</div>



    
    

<div class="container-fluid">
<div class="row">
  
 <div class="col-md-3"> 
<div class="panel panel-default round ">
  <div class="panel-heading">
    <h3>Quick Links</h3>
  </div>
  <div class="panel-body list-arrows">
    
    
<ul class="">
<li class="active"><i class="fa fa-arrow-circle-right"></i><a href="<?php echo base_url('home/index');?>">Home</a></li>
<li><i class="fa fa-arrow-circle-right"></i><a href="<?php echo base_url('home/about');?>">About</a></li>
<li><i class="fa fa-arrow-circle-right"></i><a data-toggle="modal" data-target="#myModa4" href="#">Development</a></li>
<li><i class="fa fa-arrow-circle-right"></i><a data-toggle="modal" data-target="#myModa2" href="">Invest / Requirement </a></li>
<li><i class="fa fa-arrow-circle-right"></i><a href="meetpeople.html">Meet People</a></li>
</ul>
    
    
  </div>
  </div>
  <div class="panel panel-default round mar-t-20">
    <div class="panel-heading">
      <h3>Departments </h3>
    </div>
    <div class="panel-body list-arrows list-arrows list-bg">
      <ul class="">
		<?php if(isset($departments) && count($departments)>0){
			$sno = 0;
			foreach($departments as $department){?>
			<li><i class="fa fa-arrow-circle-right"></i><a href="<?php echo base_url('home/developments/'.$department['id']);?>"><?php echo ucwords($department['name']);?></a></li>
		<?php }
		}?>
      </ul>
    </div>
  </div>
 </div>
 
  
<div class="col-md-9">  
<div class="panel panel-default">
        <div class="panel-heading">
        
            <span><h2> Payakaraopeta Constituency </h2></span>
            
          
        </div>
        
 <div class="filtersrow">
<div class="sub-heading">
 

<div class="col-md-3 madals_box"> 
	<h5> Mandal</h5>        
    <select id="madals_dropdown" class="selectpicker" multiple data-live-search="true" data-actions-box="true">
    <?php foreach($mandals as $key=>$val) :  ?>
    <option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
    <?php endforeach; ?>
    </select>
</div>

 
<div class="col-md-3 village_box">  
	<h5> Village</h5>       
    <select id="villages_dropdown" class="selectpicker " multiple data-live-search="true" data-actions-box="true">
    <?php foreach($villages as $key=>$val) :  ?>
		<option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
    <?php endforeach; ?>
    </select>
</div>
<div class="col-md-3 mar-t-35"> 
<button type="button" class="btn btn-warning filterdevelopment">Submit</button>
</div>
<span class="clearfix"></span>
</div>
</div>   
    
<span class="clearfix"></span>

<div class="panel-body listtd">
   <table class="table">
      <thead>
        <tr>
          <th width="6%">S.NO</th>
          <th width="16%">Department</th>
          <th width="13%">Villages</th>
          <th width="13%">Mandal</th>
          <th width="16%">Name Of Work</th>
          <th width="8%">Cost</th>
          <th width="13%">Contractor </th>
          <th width="15%">Location </th>
        </tr>
      </thead>
      <tbody id="developments">
			
		<?php if(isset($developments) && count($developments)>0){
			$sno = 1;
			foreach($developments as $development){?>
        <tr class="active">
		  <td><?php echo $sno++;?></td>
          <td><?php echo ucwords($development['department']);?></td>
          <td><?php echo ucwords($development['village']);?></td>
          <td><?php echo ucwords($development['mandal']);?></td>
          <td><?php echo ucwords($development['work']);?></td>
          <td><?php echo $development['cost'];?></td>
		  <td><?php echo ucwords($development['contrator']);?></td>
          <td><a href="https://www.google.co.in/maps/place/Payakaraopeta,+Andhra+Pradesh/@17.3652775,82.5519588,15z/data=!3m1!4b1!4m5!3m4!1s0x3a39c78b276e15c9:0xde8ee6490c3efa7f!8m2!3d17.3617463!4d82.5591603" target="_blank">Location Area</a></td>
         </tr>
        <?php }
		}else{?>
			<tr class="active"><td colspan='8'>No Records Found</td></tr>
		<?php }?>
		
      </tbody>
    </table>
        </div>
        
      </div>
</div>
      
      
      
</div>
</div> 
<?php
$this->load->view('frontend/common/footer');
?>





