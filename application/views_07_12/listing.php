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
      <div class="col-md-7 col-sm-12"> MANAGE MODULE </div>
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
        <a class="btn btn-info">ADD MODULE</a>
      </div>
      
      <div class="col-md-12 col-sm-12">
        <h4>&nbsp;</h4>
        <table id="example" class="table table-striped table-bordered" style="width:100%;">
          <thead>
            <tr>
              <th style="background-color: #70d3f7;">Name</th>
              <th style="background-color: #70d3f7;">Position</th>
              <th style="background-color: #70d3f7;">Office</th>
              <th style="background-color: #70d3f7;">Age</th>
              <th style="background-color: #70d3f7;">Start date</th>
              <th style="background-color: #70d3f7;">Salary</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Tiger Nixon</td>
              <td>System Architect</td>
              <td>Edinburgh</td>
              <td>61</td>
              <td>2011/04/25</td>
              <td>$320,800</td>
            </tr>
            <tr>
              <td>Garrett Winters</td>
              <td>Accountant</td>
              <td>Tokyo</td>
              <td>63</td>
              <td>2011/07/25</td>
              <td>$170,750</td>
            </tr>
            <tr>
              <td>Ashton Cox</td>
              <td>Junior Technical Author</td>
              <td>San Francisco</td>
              <td>66</td>
              <td>2009/01/12</td>
              <td>$86,000</td>
            </tr>
            <tr>
              <td>Cedric Kelly</td>
              <td>Senior Javascript Developer</td>
              <td>Edinburgh</td>
              <td>22</td>
              <td>2012/03/29</td>
              <td>$433,060</td>
            </tr>
            <tr>
              <td>Airi Satou</td>
              <td>Accountant</td>
              <td>Tokyo</td>
              <td>33</td>
              <td>2008/11/28</td>
              <td>$162,700</td>
            </tr>
            <tr>
              <td>Brielle Williamson</td>
              <td>Integration Specialist</td>
              <td>New York</td>
              <td>61</td>
              <td>2012/12/02</td>
              <td>$372,000</td>
            </tr>
            <tr>
              <td>Herrod Chandler</td>
              <td>Sales Assistant</td>
              <td>San Francisco</td>
              <td>59</td>
              <td>2012/08/06</td>
              <td>$137,500</td>
            </tr>
            <tr>
              <td>Rhona Davidson</td>
              <td>Integration Specialist</td>
              <td>Tokyo</td>
              <td>55</td>
              <td>2010/10/14</td>
              <td>$327,900</td>
            </tr>
            <tr>
              <td>Colleen Hurst</td>
              <td>Javascript Developer</td>
              <td>San Francisco</td>
              <td>39</td>
              <td>2009/09/15</td>
              <td>$205,500</td>
            </tr>
            <tr>
              <td>Sonya Frost</td>
              <td>Software Engineer</td>
              <td>Edinburgh</td>
              <td>23</td>
              <td>2008/12/13</td>
              <td>$103,600</td>
            </tr>
            <tr>
              <td>Jena Gaines</td>
              <td>Office Manager</td>
              <td>London</td>
              <td>30</td>
              <td>2008/12/19</td>
              <td>$90,560</td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <th>Name</th>
              <th>Position</th>
              <th>Office</th>
              <th>Age</th>
              <th>Start date</th>
              <th>Salary</th>
            </tr>
          </tfoot>
        </table>
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
