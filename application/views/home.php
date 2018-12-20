<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->load->view('layout/header'); ?>
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

      <a href="<?php echo base_url(); ?>view/customers">
        <div class="col-md-4 col-sm-12">
          <div class="alert alert-danger">
            <p class="text-center numbertxt"><i class="fa fa-users"></i></p>
            <p class="text-center headtext">Number of Customers</p>
            <p class="text-center numbertxt"><?php echo $totalCus; ?></p>
          </div>
        </div>
     </a>

      <a href="<?php echo base_url(); ?>add/restaurant">
        <div class="col-md-4 col-sm-12">
          <div class="alert alert-success">
            <p class="text-center numbertxt"><i class="fa fa-archive"></i></p>
            <p class="text-center headtext">Number of Resturant</p>
            <p class="text-center numbertxt"><?php echo $totalRes; ?></p>
          </div>
        </div>
     </a>


      <a href="<?php echo base_url(); ?>add/menu">
        <div class="col-md-4 col-sm-12">
          <div class="alert alert-warning">
            <p class="text-center numbertxt"><i class="fa fa-file-text"></i></p>
            <p class="text-center headtext">Number of Menu</p>
            <p class="text-center numbertxt"><?php echo $totalMenu; ?></p>
          </div>
        </div>
       </a>


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
