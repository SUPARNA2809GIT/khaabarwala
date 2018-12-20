<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->load->view('layout/header'); ?>
<style>
ul.breadcrumb {
	padding: 10px 16px;
	list-style: none;
	background-color: #eee;
}
ul.breadcrumb li {
	display: inline;
	font-size: 18px;
}
ul.breadcrumb li+li:before {
	padding: 8px;
	color: black;
	content: "/\00a0";
}
ul.breadcrumb li a {
	color: #0275d8;
	text-decoration: none;
}
ul.breadcrumb li a:hover {
	color: #01447e;
	text-decoration: underline;
}
.error{
  color: red;
}
</style>
</head>
<body>
<div class="nav-side-menu">
  <?php $this->load->view('layout/nav-bar'); ?>
</div>
<section id="topBar">
  <?php $this->load->view('layout/head'); ?>
</section>
<section id="mainBody">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb" style="background-color: #006393;font-family: 'Kodchasan', sans-serif;color:#FFFFFF;">
          <li><a href="<?php echo base_url(); ?>home" style="color:#FFFFFF;">Dashboard</a></li>
          <li><a href="<?php echo base_url(); ?>add/restaurant" style="color:#FFFFFF;">RESTAURANT</a></li>
          <li>Add</li>
        </ul>
      </div>
    </div>
  </div>
</section>
<section id="mainBody">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <?php echo $this->session->flashdata('success'); ?>
      </div>
      
      <div class="col-md-12 col-sm-12">
        <h4>&nbsp;</h4>
        <form action="<?php echo base_url(); ?>change_password/save_changes" method="post" enctype="multipart/form-data"> 
        	<div class="row">
            	<div class="col-md-3"><label for=""><h4>Old Password</h4></label></div>
                <div class="col-md-9">
                    <div class="form-group">
                    	<input type="password" name="oldPass" class="form-control" placeholder="" />
                      <?php echo form_error('oldPass', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>

             <div class="row">
              <div class="col-md-3"><label for=""><h4>New Password</h4></label></div>
                <div class="col-md-9">
                    <div class="form-group">
                      <input type="password" name="password" class="form-control" placeholder="" />
                      <?php echo form_error('password', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>

            <div class="row">
              <div class="col-md-3"><label for=""><h4>Re-type New Password</h4></label></div>
                <div class="col-md-9">
                    <div class="form-group">
                      <input type="password" name="cnfpwd" class="form-control" placeholder="" />
                      <?php echo form_error('cnfpwd', '<div class="error">', '</div>'); ?>
                    </div>
                </div>
            </div>
            

            

            

            
            <hr>
            <div class="row">
            	<div class="col-md-3"><h4>&nbsp;</h4></div>
                <div class="col-md-9">
                    <button class="btn btn-success" type="submit">Submit</button>
                </div>
            </div>

        </form>
      </div>
    </div>
  </div>
</section>
</body>
<script>
	$(document).ready(function() {
    $('#example').DataTable();
} );


  var j = jQuery.noConflict();

  function checkValue()
  {
      var radioValue = j("input[name='gst_applied']:checked").val();
      if(radioValue=='y')
      {
         j("#gstAmountDiv").show();
      }
      else
      {
         j("#gstAmountDiv").hide();
      }
  }
</script>
</html>
