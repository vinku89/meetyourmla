


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


<?php
$this->load->view('frontend/common/header');
?>

<div class="container-fluid">
<div class="row">
  
 <div class="col-md-3"> 
<div class="panel panel-default round ">
  <div class="panel-heading">
    <h3>Quick Links</h3>
  </div>
  <div class="panel-body list-arrows">
    
    
<ul class="">
<li class="active"><i class="fa fa-arrow-circle-right"></i><a href="index.html">Home</a></li>
<li><i class="fa fa-arrow-circle-right"></i><a href="about.html">About</a></li>
<li><i class="fa fa-arrow-circle-right"></i><a data-toggle="modal" data-target="#myModa4" href="#">Development</a></li>
<li><i class="fa fa-arrow-circle-right"></i><a data-toggle="modal" data-target="#myModa2" href="">Invest / Requirement </a></li>
<li><i class="fa fa-arrow-circle-right"></i><a href="meetpeople.html">Meet People</a></li>
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
    <option value="<?php echo $val['id']; ?>"><?php echo $val['mandal_name']; ?></option>
    <?php endforeach; ?>
    </select>
</div>

 
<div class="col-md-3 village_box">  
	<h5> Village</h5>       
    <select id="villages_dropdown" class="selectpicker" multiple data-live-search="true" data-actions-box="true">
    <?php foreach($villages as $key=>$val) :  ?>
		<option value="<?php echo $val['id']; ?>"><?php echo $val['village_name']; ?></option>
    <?php endforeach; ?>
    </select>
</div>


<div class="col-md-3"> 
<h5> Designation</h5>          
    <select id="designations_dropdown" class="selectpicker" multiple data-live-search="true" data-actions-box="true">
    <?php foreach($designations as $key=>$val) :  ?>
		<option value="<?php echo $val['id']; ?>"><?php echo $val['designation']; ?></option>
    <?php endforeach; ?>
    </select>
</div>
    
<div class="col-md-3 mar-t-35"> 
<a type="button" class="btn btn-warning" href="contact-results.html">Submit</a>
</div>


<span class="clearfix"></span>

<div class="panel-body listtd">
   <table class="table">
      <thead>
        <tr>
          <th width="18%">Names</th>
          <th width="18%">Villages</th>
          <th width="16%">Mandal</th>
          <th width="14%">Designation</th>
          <th width="15%">Phone Number</th>
          <th width="19%" class="pad-l-20">
          <input name="" type="checkbox" value="" class="mar-r-10">
          <a data-toggle="modal" data-target="#myModa3" href="#" class="sms">Select all to SMS</a></th>
        </tr>
      </thead>
      <tbody>
        <tr class="active">
          <td>Devarapu Anand Kumar</td>
          <td>Mangavaram</td>
          <td>S.Rayavaram</td>
          <td>Sarpanch</td>
          <td>+91 8333957999</td>
          <td>
            <span class="pad-l-10">
              <input name="" type="checkbox" value=""> 
              <a href="#" class="btn btn-success mar-l-10" data-toggle="modal" data-target="#myModa3">
              SEND SMS<i class="fa fa-mobile pad-l-10" aria-hidden="true"></i></a>
             </span>
            </td>
         </tr>
        
        <tr>
          <td>Danathuluri Sudhakar</td>
          <td> Dosalapadu</td>
          <td>S.Rayavaram</td>
          <td>MPTC</td>
          <td>+91 9949492177</td>
          <td>
            <span class="pad-l-10">
              <input name="" type="checkbox" value=""> 
              <a href="#" class="btn btn-success mar-l-10" data-toggle="modal" data-target="#myModa3">
              SEND SMS<i class="fa fa-mobile pad-l-10" aria-hidden="true"></i></a>
             </span>
            </td>
        </tr>
        <tr class="success">
          <td>Patri Sarojini</td>
          <td>Dosalapadu</td>
          <td>S.Rayavaram</td>
          <td>ZPTC</td>
          <td>+91 7382371554</td>
          <td>
            <span class="pad-l-10">
              <input name="" type="checkbox" value=""> 
              <a href="#" class="btn btn-success mar-l-10" data-toggle="modal" data-target="#myModa3">
              SEND SMS<i class="fa fa-mobile pad-l-10" aria-hidden="true"></i></a>
             </span>
            </td>
        </tr>
        <tr>
          <td>Chenchalapu Sanyasiamma</td>
          <td>Mangavaram</td>
          <td>Kotauratla</td>
          <td>Sarpanch</td>
          <td>+91 9293421354</td>
          <td>
            <span class="pad-l-10">
              <input name="" type="checkbox" value=""> 
              <a href="#" class="btn btn-success mar-l-10" data-toggle="modal" data-target="#myModa3">
              SEND SMS<i class="fa fa-mobile pad-l-10" aria-hidden="true"></i></a>
             </span>
            </td>
        </tr>
        <tr class="info">
          <td>Arugula Ramudu</td>
          <td>Mangavaram</td>
          <td>Kotauratla</td>
          <td>MPTC</td>
          <td>+91 9160877375</td>
          <td>
            <span class="pad-l-10">
              <input name="" type="checkbox" value=""> 
              <a href="#" class="btn btn-success mar-l-10" data-toggle="modal" data-target="#myModa3">
              SEND SMS<i class="fa fa-mobile pad-l-10" aria-hidden="true"></i></a>
             </span>
            </td>
        </tr>
        <tr>
          <td>Kodukula Satyavathi</td>
          <td>Dosalapadu</td>
          <td>S.Rayavaram</td>
          <td>Sarpanch</td>
          <td>+91 9912555332</td>
          <td>
            <span class="pad-l-10">
              <input name="" type="checkbox" value=""> 
              <a href="#" class="btn btn-success mar-l-10" data-toggle="modal" data-target="#myModa3">
              SEND SMS<i class="fa fa-mobile pad-l-10" aria-hidden="true"></i></a>
             </span>
            </td>
        </tr>
        <tr class="warning">
          <td>Chodupalli Srinivasa Rao</td>
          <td>Dosalapadu</td>
          <td>Kotauratla</td>
          <td>ZPTC</td>
          <td>+91 9491433543</td>
          <td>
            <span class="pad-l-10">
              <input name="" type="checkbox" value=""> 
              <a href="#" class="btn btn-success mar-l-10" data-toggle="modal" data-target="#myModa3">
              SEND SMS<i class="fa fa-mobile pad-l-10" aria-hidden="true"></i></a>
             </span>
            </td>
        </tr>
        <tr>
          <td>Addala Lakshmi</td>
          <td> Dosalapadu</td>
          <td>S.Rayavaram</td>
          <td>Sarpanch</td>
          <td>+91 9492158440</td>
          <td>
            <span class="pad-l-10">
              <input name="" type="checkbox" value=""> 
              <a href="#" class="btn btn-success mar-l-10" data-toggle="modal" data-target="#myModa3">
              SEND SMS<i class="fa fa-mobile pad-l-10" aria-hidden="true"></i></a>
             </span>
            </td>
        </tr>
        <tr class="danger">
          <td>Gompala Veera Badrudu</td>
          <td>Mangavaram</td>
          <td>Kotauratla</td>
          <td>MPTC</td>
          <td>+91 9293421354</td>
          <td>
            <span class="pad-l-10">
              <input name="" type="checkbox" value=""> 
              <a href="#" class="btn btn-success mar-l-10" data-toggle="modal" data-target="#myModa3">
              SEND SMS<i class="fa fa-mobile pad-l-10" aria-hidden="true"></i></a>
             </span>
            </td>
        </tr>
                
      </tbody>
    </table>
        </div>
        

<span class="clearfix"></span>
</div>
</div>   
    
<span class="clearfix"></span>

<div class="panel-body listtd">
   
        </div>
        
      </div>
</div>
      
      
      
</div>
</div> 


<?php
$this->load->view('frontend/common/footer');
?>




