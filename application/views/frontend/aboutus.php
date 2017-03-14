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


 <div class="row pad-t-30">
      <p>As of Census 2011 the town has a population of 27,001 of which 13,252 are males and 13,749 are females. Average Sex Ratio of the town is of 1038 against state average of 993. Population of Children with age of 0-6 is 2864 which is 10.61 % of total population of Payakaraopeta. Child Sex Ratio in Payakaraopeta is around 978 compared to Andhra Pradesh state average of 939. Literacy rate of the town is 76.81 % higher than state average of 67.02%</p>
  </div>   

<div class="devider-double mar-t-b-30"></div>  

  
<div class="row pad-t-b-30 mar-t-30">

<div class="col-md-4">
    <div class="custom-thumbnail round">
       <img src="<?php echo base_url('uploads/images/img14.jpg');?>" class="img-fluid" alt="...">
    </div>      
</div>
    
    
<div class="col-md-8">
      <div class="title"><h2>About MLA</h2></div>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>VANGALAPUDI ANITHA </td>
    <td>&nbsp;</td>
  </tr>
</table>


    </div>
</div>
  
  
<div class="devider-double mar-t-b-30"></div>  
  
<div class="row pad-t-b-30 mar-t-30">

<div class="col-md-8">
      <div class="title"><h2>About Payakaraopeta Constituency</h2></div>
      
      <p>As of Census 2011 the town has a population of 27,001 of which 13,252 are males and 13,749 are females. Average Sex Ratio of the town is of 1038 against state average of 993. Population of Children with age of 0-6 is 2864 which is 10.61 % of total population of Payakaraopeta. Child Sex Ratio in Payakaraopeta is around 978 compared to Andhra Pradesh state average of 939. Literacy rate of the town is 76.81 % higher than state average of 67.02%</p>
      
            <p>It is located at a distance of 2km from Tuni. State runs APS RTC bus services from many cities in the State to this town.</p>
            
            
            
            
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th class="alignleft">Villages</th>
      <th>Administrative Division</th>
      <th>Population</th>
    </tr>
  </thead>
  <tbody>
    <tr class="tr1">
      <td>1</td>
      <td class="alignleft">Aratla Kota</td>
      <td>Payakaraopeta</td>
      <td>3,591</td>
    </tr>
    <tr class="tr1">
      <td>2</td>
      <td class="alignleft">Edatam</td>
      <td>Payakaraopeta</td>
      <td>5,563</td>
    </tr>
    <tr class="tr1">
      <td>3</td>
      <td class="alignleft">Gopalapatnam</td>
      <td>Payakaraopeta</td>
      <td>2,802</td>
    </tr>
    <tr class="tr1">
      <td>4</td>
      <td class="alignleft">Guntapalle</td>
      <td>Payakaraopeta</td>
      <td>2,600</td>
    </tr>
    <tr class="tr1">
      <td>5</td>
      <td class="alignleft">Kandipudi</td>
      <td>Payakaraopeta</td>
      <td>896</td>
    </tr>
    <tr class="tr1">
      <td>6</td>
      <td class="alignleft">Kesavaram</td>
      <td>Payakaraopeta</td>
      <td>4,189</td>
    </tr>
    <tr class="tr1">
      <td>7</td>
      <td class="alignleft">Kumarapuram</td>
      <td>Payakaraopeta</td>
      <td>3,587</td>
    </tr>
    <tr class="tr1">
      <td>8</td>
      <td class="alignleft">Mangavaram</td>
      <td>Payakaraopeta</td>
      <td>4,830</td>
    </tr>
    <tr class="tr1">
      <td>9</td>
      <td class="alignleft">Masahebpeta</td>
      <td>Payakaraopeta</td>
      <td>2,157</td>
    </tr>
    <tr class="tr1">
      <td>10</td>
      <td class="alignleft">Namavaram</td>
      <td>Payakaraopeta</td>
      <td>3,843</td>
    </tr>
    <tr class="tr1">
      <td>11</td>
      <td class="alignleft">Padalavani Laxmipuram</td>
      <td>Payakaraopeta</td>
      <td>3,480</td>
    </tr>
    <tr class="tr1">
      <td>12</td>
      <td class="alignleft">Palteru</td>
      <td>Payakaraopeta</td>
      <td>6,358</td>
    </tr>
    <tr class="tr1">
      <td>13</td>
      <td class="alignleft">Pedaramabhadrapuram</td>
      <td>Payakaraopeta</td>
      <td>4,485</td>
    </tr>
    <tr class="tr1">
      <td>14</td>
      <td class="alignleft">Pentakota</td>
      <td>Payakaraopeta</td>
      <td>4,108</td>
    </tr>
    <tr class="tr1">
      <td>15</td>
      <td class="alignleft">Rajavaram</td>
      <td>Payakaraopeta</td>
      <td>2,555</td>
    </tr>
    <tr class="tr1">
      <td>16</td>
      <td class="alignleft">S.Narasapuram</td>
      <td>Payakaraopeta</td>
      <td>1,585</td>
    </tr>
    <tr class="tr1">
      <td>17</td>
      <td class="alignleft">Satyavaram</td>
      <td>Payakaraopeta</td>
      <td>5,657</td>
    </tr>
    <tr class="tr1">
      <td>18</td>
      <td class="alignleft">Srirampuram</td>
      <td>Payakaraopeta</td>
      <td>3,806</td>
    </tr>
  </tbody>
</table>
            
            
            
            

    </div>
    
    
<div class="col-md-4">
    <div class="custom-thumbnail round">
       <img src="<?php echo base_url('uploads/images/map.jpg');?>" class="img-fluid" alt="...">
    </div>      
</div>

</div>  
    
    
</div>
      
      
      
</div>
</div> 
<?php
$this->load->view('frontend/common/footer');
?>





