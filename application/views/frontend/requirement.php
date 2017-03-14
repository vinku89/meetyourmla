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
    <div class="panel-heading"><h2>Requirement</h2></div>
    <div class="panel-body ">
	<?php
                                                $message = $this->session->flashdata('message');
                                                $class = $this->session->flashdata('msg_class');
                                                if (!empty($message) && !empty($class)) {?>
                                                    <div class="alert <?php echo $class; ?>">
                                                        <button class="close" data-close="alert"></button>
                                                        <?php  echo $message;?>
                                                    </div>
                                                <?php }?>
      <form role="form" name="requirementForm" action="<?php echo base_url('home/requirement');?>" method="post">
        <div class="form-group">
          <label for="Name">Name</label>
          <input class="form-control" id="name" placeholder="Name" type="text" name="name" required pattern="[A-Za-Z0-9. ]{1,10}">
        </div>
        <div class="form-group">
          <label for="">Phone Number</label>
          <input class="form-control" id="phone" placeholder="Phone Number" type="text" name="phone" required maxLength="10" pattern="[0-9-]{10}">
        </div>
        <div class="form-group">
          <label for="">Email Id</label>
          <input class="form-control" id="email" placeholder="Email ID" type="email" name="email" required>
        </div>
        
        <div class="form-group">
          <label for="">Adress</label>
          <textarea class="form-control" rows="2" name="address" placeholder="Address" required></textarea>
        </div>
        
        <div class="form-group">
          <label for="">Mandals</label>
        <select class="form-control mandalfilter" name="mandal_id" required>
			<option value="">-Select Mandal-</option>
            <?php foreach($mandals as $key=>$val) :  ?>
			<option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
			<?php endforeach; ?>
          </select>        
        </div>
		<div class="form-group">
          <label for="">Villages</label>
        <select class="form-control villagesdropdown" name="village_id" required>
			<option value="">-Select Village-</option>
            <?php foreach($villages as $key=>$val) :  ?>
				<option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
			<?php endforeach; ?>
          </select>        
        </div>

        <div class="form-group">
          <label for="">Message</label>
          <textarea class="form-control" rows="4" name="message" placeholder="Message" required></textarea>
        </div>
        
        <button type="submit" class="btn btn-default" name="requirementPost" value="Submit">Submit</button>
      </form>
    </div>
  </div>
</div>
      
      
      
</div>
</div> 
<?php
$this->load->view('frontend/common/footer');
?>





