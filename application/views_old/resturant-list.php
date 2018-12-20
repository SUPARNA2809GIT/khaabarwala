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
          <li><a href="<?php echo base_url(); ?>home" style="color:#FFFFFF;">Dashboard</a></li>
          <li><a href="<?php echo base_url(); ?>add/restaurant" style="color:#FFFFFF;">RESTAURANT</a></li>
        </ul>
      </div>
    </div>
  </div>
</section>
<section id="mainBody">
  <div class="container-fluid">
    <div class="row">

      <div class="col-md-12 col-sm-12">

        <a href="<?php echo base_url(); ?>add/addRestaurant" class="btn btn-info">ADD RESTAURANT</a>

        <br>
        <br>

       <?php echo $this->session->flashdata('success'); ?>
      </div>
      
      <div class="col-md-12 col-sm-12">
        <h4>&nbsp;</h4>
        <table id="example" class="table table-striped table-bordered" style="width:100%;">
          <thead>
            <tr>
              <th style="background-color: #70d3f7;">#</th>
              <th style="background-color: #70d3f7;">Name</th>
              <th style="background-color: #70d3f7;">Address</th>
              <th style="background-color: #70d3f7;">Icon</th>
              <th style="background-color: #70d3f7;">GST</th>
              <th style="background-color: #70d3f7;">GST Applied</th>
              <th style="background-color: #70d3f7;">Published</th>
              <th style="background-color: #70d3f7;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($result)){ foreach ($result as $key => $value) { 


              if($value->published==1) { $temp='primary'; } else { $temp='danger'; }

              if($value->is_gst_applied=='y') { $temp1='primary'; } else { $temp1='danger'; }


              ?>
              
                <tr>
                  <td><?php echo $key+1; ?></td>
                  <td><?php echo $value->res_name; ?></td>
                  <td><?php echo $value->res_address; ?></td>


                  <?php if($value->res_icon!=''){?> 
                         <td><img src="<?php echo base_url(); ?>assets/images/<?php echo $value->res_icon; ?>" height="64" width="64"></td>

                    <?php } else {?> 
                          
                          <td><img src="<?php echo base_url(); ?>assets/images/images.png ?>" height="64" width="70"></td>

                    <?php } ?>


                  


                  <td><?php echo $value->gst_amount; ?></td>

                  
                  <td><a href="<?php echo base_url() ?>add/resGST/<?php echo $value->res_id; ?>" class="btn btn-<?php echo $temp1; ?> btn-xs"><?php if($value->is_gst_applied=='y') echo 'Yes'; else echo 'No' ?></a></td>

                  
                <td><a href="<?php echo base_url() ?>add/resPublished/<?php echo $value->res_id; ?>" class="btn btn-<?php echo $temp; ?> btn-xs"><?php if($value->published==1) echo 'Yes'; else echo 'No' ?></a></td>

                 
                  <td>
                  <a href="<?php echo base_url(); ?>edit/restaurant/<?php echo $value->res_id; ?>"><i class="fa fa-edit"></i></a>
                  <a onclick="return confirm('Are you sure to delete?')" href="<?php echo base_url(); ?>delete/resDelete/<?php echo $value->res_id; ?>"><i class="fa fa-trash"></i></a>
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
