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
            
                <span><h2><?php echo ucwords($villageInfo['village']);?> Village Developments  </h2></span>
                
              
            </div>
            
        
        
    <span class="clearfix"></span>
    
    <div class="panel-body listtd">
       <table class="table">
          
          <tbody>
            <tr class="active">
              <td>Population </td>
              <td><?php echo $villageInfo['population'];?></td>
             </tr>
            
            <tr>
              <td>Houses</td>
              <td><?php echo $villageInfo['houses'];?></td>
            </tr>
            
            <tr class="success">
              <td>Rural Water Supply </td>
              <td><?php echo $villageInfo['water'];?> Liters</td>
            </tr>
            
            <tr>
              <td> Hospital </td>
              <td><?php echo $villageInfo['hospitals'];?></td>
            </tr>
            
            <tr class="info">
              <td>Roads </td>
              <td><?php echo $villageInfo['roads'];?> kms</td>
            </tr>
            
            <tr>
              <td>Govt Buildings</td>
              <td><?php echo $villageInfo['govtbuildings'];?></td>
            </tr>
                
            
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





