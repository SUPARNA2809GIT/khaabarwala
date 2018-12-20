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
</style>
</head>
<body>
<div class="nav-side-menu">
  <div class="brand" style="background-color:#e0eaef;">
  	<img src="images/logo.png" style="width:80%" />
  	<br />
    <!--<span style="font-size:14px;">Company name should come here</span>-->
  </div>
  <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  <div class="menu-list">
    <ul id="menu-content" class="menu-content collapse out">
      <li class="active"> <a href="#"><i class="fa fa-th-large fa-lg"></i> Dashboard</a> </li>
      <li data-toggle="collapse" data-target="#company" class="collapsed"> <a href="#"><i class="fa fa-bank fa-lg"></i> Account Settings <span class="arrow"></span></a> </li>
      <ul class="sub-menu collapse" id="company">
        <li class="active"><a href="#">Company Settings</a></li>
        <li><a href="#">Tax Settings</a></li>
        <li><a href="#">Change Password</a></li>
      </ul>
      <li  data-toggle="collapse" data-target="#about" class="collapsed"> <a href="#"><i class="fa fa-cog fa-lg"></i> Software Settings <span class="arrow"></span></a> </li>
      <ul class="sub-menu collapse" id="about">
        <li class="active"><a href="#">Create Ledger Account</a></li>
        <li><a href="#">Create Voucher Type</a></li>
      </ul>
      <li  data-toggle="collapse" data-target="#purchase" class="collapsed"> <a href="#"><i class="fa fa-cart-plus fa-lg"></i> Purchase Management<span class="arrow"></span></a> </li>
      <ul class="sub-menu collapse" id="purchase">
        <li class="active"><a href="#">Add Vendor</a></li>
        <li><a href="#">Purchase Order</a></li>
        <li><a href="#">Add Products & Manage Stock</a></li>
        <li><a href="#">Purchase Return</a></li>
        <li><a href="#">Stock Report</a></li>
        <li><a href="#">Purchase Report</a></li>
        <li><a href="#">Petty Cash Book Entry</a></li>
      </ul>
      <li  data-toggle="collapse" data-target="#sales" class="collapsed"> <a href="#"><i class="fa fa-file-text-o fa-lg"></i> Sales Management <span class="arrow"></span></a> </li>
      <ul class="sub-menu collapse" id="sales">
        <li class="active"><a href="#">Make Sale Invoice</a></li>
        <li><a href="#">Sales Return</a></li>
        <li><a href="#">Sales & Invoice Report</a></li>
      </ul>
      
      <li  data-toggle="collapse" data-target="#finance" class="collapsed"> <a href="#"><i class="fa fa-copy fa-lg"></i> Financial Reports <span class="arrow"></span></a> </li>
      <ul class="sub-menu collapse" id="finance">
        <li class="active"><a href="#">Income & Expenditure</a></li>
        <li><a href="#">Ledger-wise Report</a></li>
        <li><a href="#">Petty Cash Book Report</a></li>
      </ul>
      <li class=""> <a href="#"><i class="fa fa-envelope fa-lg"></i> Customer Support</a> </li>
      <li class=""> <a href="#"><i class="fa fa-sign-out fa-lg"></i> Log Out</a> </li>
    </ul>
  </div>
</div>
<section id="topBar">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-7 col-sm-12" style="text-transform:uppercase;"> add edit MODULE </div>
      <div class="col-md-3 col-sm-12">
        <h5><i class="fa fa-thumbs-up"></i> Welcome Admin</h5>
      </div>
      <div class="col-md-2 col-sm-12">
        <h5><i class="fa fa-sign-out"></i> <a href="" style="text-decoration:none;">Log out</a></h5>
      </div>
    </div>
  </div>
</section>
<section id="mainBody">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb" style="background-color: #006393;font-family: 'Kodchasan', sans-serif;color:#FFFFFF;">
          <li><a href="#" style="color:#FFFFFF;">Dashboard</a></li>
          <li><a href="#" style="color:#FFFFFF;">Manage Module</a></li>
          <li>Italy</li>
        </ul>
      </div>
    </div>
  </div>
</section>
<section id="mainBody">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <h4 class="alert alert-warning">Customized Buttons</h4>
        <h4 class="alert alert-success">Customized Buttons</h4>
      </div>
      
      <div class="col-md-12 col-sm-12">
        <h4>&nbsp;</h4>
        <form action="" method="post">
        	<div class="row">
            	<div class="col-md-3"><label for=""><h4>Customized Input Box</h4></label></div>
                <div class="col-md-9">
                    <div class="form-group">
                    	<input type="text" value="" name="" class="form-control" placeholder="Typing area . . ." />
                    </div>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-3"><label for=""><h4>Customized Input Box</h4></label></div>
                <div class="col-md-9">
                    <div class="form-group">
                    	<input type="email" value="" name="" class="form-control" placeholder="Typing area . . ." />
                    </div>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-3"><label for=""><h4>Customized Input Box</h4></label></div>
                <div class="col-md-9">
                    <div class="form-group">
                    	<input type="password" value="" name="" class="form-control" placeholder="Typing area . . ." />
                    </div>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-3"><label for=""><h4>Customized Input Box</h4></label></div>
                <div class="col-md-9">
                    <div class="form-group">
                    	<input type="number" value="" name="" class="form-control" placeholder="Typing area . . ." />
                    </div>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-3"><label for=""><h4>Customized Input Box</h4></label></div>
                <div class="col-md-9">
                    <div class="form-group">
                    	<textarea value="" name="" class="form-control" placeholder="Typing area . . ." rows="4" /></textarea>
                    </div>
                </div>
            </div>
            
            <div class="row">
            	<div class="col-md-3"><label for=""><h4>Customized Input Box</h4></label></div>
                <div class="col-md-9">
                    <div class="form-group">
                        <select class="form-control" id="sel1">
                           <option value="" selected="selected" hidden>Select list (select one):</option>
                           <option>2</option>
                           <option>3</option>
                           <option>4</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row">
            	<div class="col-md-3"><label for=""><h4>Customized Input Box</h4></label></div>
                <div class="col-md-9">
                    <div class="checkbox">
                        <label><input type="checkbox"> Remember me</label>
                    </div>
                </div>
            </div>
            
            <div class="row">
            	<div class="col-md-3"><label for=""><h4>Customized Input Box</h4></label></div>
                <div class="col-md-9">
                    <div class="radio">
                        <label><input type="radio"> Remember me</label>
                        &nbsp;&nbsp;
                        <label><input type="radio"> Remember me</label>
                    </div>
                </div>
            </div>
            
            <div class="row">
            	<div class="col-md-3"><label for="image"><h4>Customized Input Box</h4></label></div>
                <div class="col-md-9">
                    <input type="file" id="image" name="" class="form-control" />
                </div>
            </div>
            
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
</script>
</html>
