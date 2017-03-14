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

<div class="container">
<div class="row">

	<div class="title"><h1>Welcome to
    Payakaraopeta Constituency</h1></div>
    
    <div class="row mar-t-50">
  <div class="left-col col-md-4">
    <div class="thumbnail"> <img alt="..." class="img-responsive" src="<?php echo base_url('uploads/images/img1.jpg');?>">
      <div class="caption">
        <h4>About</h4>
        <p>PAYAKARAOPETA(Assembly constituency) is one of the Assembly constituencies of Andhra Pradesh in India.[1]VANGALAPUDI ANITHA is the present MLA of the constituency representing Telugu Desam Party. It is located at a distance of 2km from Tuni. </p>
        <a role="button" class="btn btn-default mar-t-10" href="<?php echo base_url('home/about');?>">visit constituency</a> </div>
    </div>
  </div>
  
  <div class="right-col col-md-8">
  
    <div class="row">
      <div class="col-md-6"> <img alt="..." class="img-responsive" src="<?php echo base_url('uploads/images/img2.jpg');?>"> 
      <a role="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Contact</a> </div>
      <div class="col-md-6"> <img alt="..." class="img-responsive" src="<?php echo base_url('uploads/images/img3.jpg');?>"> 
      <a role="button" class="btn btn-default" data-toggle="modal" href="#myModa4">Development</a> </div>
    </div>
    
    <div class="row mar-t-30">
      <div class="col-md-6"> <img alt="..." class="img-responsive" src="<?php echo base_url('uploads/images/img4.jpg');?>"> 
      <a role="button" class="btn btn-default" data-toggle="modal" data-target="#myModa2">Invest / Requirement </a> </div>
      <div class="col-md-6"> <img alt="..." class="img-responsive" src="<?php echo base_url('uploads/images/img5.jpg');?>"> 
      <a role="button" class="btn btn-default" href="meetpeople.html">Meet People</a> </div>
    </div>
    
  </div>
</div>

    
    
</div>
</div>
<?php
$this->load->view('frontend/common/footer');
?>