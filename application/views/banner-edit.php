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
          <li><a href="<?php echo base_url() ?>add/banner" style="color:#FFFFFF;">Banner</a></li>
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
        <form action="<?php echo base_url(); ?>edit/banner/<?php echo $row->banner_id;  ?>" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-3"><label for="image"><h4>Select Photo (one or multiple):</h4><br>
                <span style="color: red;">Size should be 828px*400px</span></label></div>
                <div class="col-md-9">
                  <img src="<?php echo base_url(); ?>uploads/<?php echo $row->image_name; ?>" width="150" height="70" />
                  <br>
                  <br>
                  <input type="file" name="userfile" class="form-control"/>
                </div>
            </div>
            <div class="row">
              <div class="col-md-3"><h4>&nbsp;</h4></div>
                <div class="col-md-9">
                  <br>
                    <button class="btn btn-success" type="submit">Edit</button>
                </div>
            </div>
        </form>
      </div>
      <!-- <div class="col-md-12 col-sm-12">
        <h4>&nbsp;</h4>
        <table id="example" class="table table-striped table-bordered" style="width:100%;">
          <thead>
            <tr>
              <th style="background-color: #70d3f7;">#</th>
              <th style="background-color: #70d3f7;">Iamge</th>
              <th style="background-color: #70d3f7;">Published</th>
              <th style="background-color: #70d3f7;">Action</th>
            </tr>
          </thead>
          <tbody>
            
            <?php if(!empty($result)) { foreach ($result as $key => $value) { ?>

              <tr>
                <td><?php echo $key+1; ?></td>
                <td><img src="<?php echo base_url(); ?>uploads/<?php echo $value->image_name; ?>" width="150" height="70" /></td>

                <?php if($value->published) { $temp='primary'; } else { $temp='danger'; } ?>
                <td><a href="<?php echo base_url() ?>add/bannerPublished/<?php echo $value->banner_id; ?>" class="btn btn-<?php echo $temp; ?> btn-xs"><?php if($value->published) echo 'Yes'; else echo 'No' ?></a></td>


                <td>
                  <a href="<?php echo base_url(); ?>edit/banner/<?php echo $value->banner_id; ?>"><i class="fa fa-edit"></i></a>
                  <a href=""><i class="fa fa-trash"></i></a>
                </td>
                
              </tr>
              
          <?php } } ?>
            
            
            
          </tbody>
          
        </table>
      </div> -->
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
