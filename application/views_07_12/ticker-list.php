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
          <li><a href="<?php echo base_url() ?>home" style="color:#FFFFFF;">Dashboard</a></li>
          <li><a href="<?php echo base_url() ?>add/ticker" style="color:#FFFFFF;">Ticker</a></li>
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
        <form action="<?php echo base_url(); ?>add/ticker" method="post">
          <div class="row">
            <div class="col-md-3"><label for="image"><h4>Ticker:</h4><br>
              </label></div>
              <div class="col-md-9">
                <input type="text" name="ticker" class="form-control"/>
                <?php echo form_error('ticker', '<div class="error">', '</div>'); ?>
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
      
      <div class="col-md-12 col-sm-12">
        <h4>&nbsp;</h4>
        <table id="example" class="table table-striped table-bordered" style="width:100%;">
          <thead>
            <tr>
              <th style="background-color: #70d3f7;">#</th>
              <th style="background-color: #70d3f7;">Ticker</th>
              <th style="background-color: #70d3f7;">Published</th>
              <th style="background-color: #70d3f7;">Action</th>
            </tr>
          </thead>
          <tbody>
            
            <?php if(!empty($result)) { foreach ($result as $key => $value) { ?>

              <tr>
                <td><?php echo $key+1; ?></td>
                <td><?php echo $value->ticker; ?></td>
                <?php if($value->published=='1') { $temp='primary'; } else { $temp='danger'; } ?>
                <td>
                  <a href="<?php echo base_url() ?>add/tickerPublished/<?php echo $value->ticker_id; ?>" class="btn btn-<?php echo $temp; ?> btn-xs"><?php if($value->published==1) echo 'Yes'; else echo 'No' ?></a>
                </td>
                <td>
                  <a onclick="return confirm('Are you sure to delete?')" href="<?php echo base_url(); ?>delete/ticker/<?php echo $value->ticker_id ?>"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
              
          <?php } } ?>
            
          </tbody>
          
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
