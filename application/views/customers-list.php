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



/* Preloader */

#preloader {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #fff;
  /* change if the mask should have another color then white */
  z-index: 99;
  /* makes sure it stays on top */
}

#status {
  width: 200px;
  height: 200px;
  position: absolute;
  left: 50%;
  /* centers the loading animation horizontally one the screen */
  top: 50%;
  /* centers the loading animation vertically one the screen */
  background-image: url(https://raw.githubusercontent.com/niklausgerber/PreLoadMe/master/img/status.gif);
  /* path to your loading animation */
  background-repeat: no-repeat;
  background-position: center;
  margin: -100px 0 0 -100px;
  /* is width and height divided by two */
}

</style>

</head>

<body>

  <div id="preloader" style="display: none;">
    <div id="status">&nbsp;</div>
  </div>

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

          <li><a href="<?php echo base_url(); ?>view/customers" style="color:#FFFFFF;">CUSTOMERS</a></li>

        </ul>

      </div>

    </div>

  </div>

</section>

<section id="mainBody">

  <div class="container-fluid">

    <div class="row">



      <div class="col-md-12 col-sm-12">



      


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
              <th style="background-color: #70d3f7;">Email</th>
              <th style="background-color: #70d3f7;">Password</th>
              <th style="background-color: #70d3f7;">Address</th>
              <th style="background-color: #70d3f7;">Pin</th>
              <th style="background-color: #70d3f7;">Land Mark</th>
              <th style="background-color: #70d3f7;">Orders No(s).</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($customers))
            { 

              foreach ($customers as $key => $value) {

              $orders = $this->db->query("SELECT * FROM tb_order WHERE user_id=".$value->user_id)->result();
             ?>

                <tr>
                  <td><?php echo $key+1; ?></td>
                  <td><?php echo $value->name; ?></td>
                  <td><?php echo $value->email; ?></td>
                  <td><?php echo $value->password; ?></td>
                  <td><?php echo $value->address; ?></td>
                  <td><?php echo $value->pin; ?></td>
                  <td><?php echo $value->landmark; ?></td>
                  <td><?php //if(!empty($orders)){ foreach ($orders as $ord) {
                    //echo $ord->order_gen_id;
                  //} } ?></td>
              </tr>

            <?php } } ?>

        
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- Modal -->

<div class="modal fade" id="myModal" role="dialog">

 <div class="modal-dialog ">

 

   <!-- Modal content-->

   <div class="modal-content">

     <div class="modal-header">

      <h4 class="modal-title" style="color: red;">Upload CSV File</h4>

       <button type="button" class="close" data-dismiss="modal">&times;</button>

       

     </div>

     <div class="modal-body">

<p><form method="post" action="<?php echo base_url(); ?>add/import" enctype="multipart/form-data" id="upload_excel" name="upload_excel">

        <!-- <input type="file" name="importfile" id="importfile" required="required"> -->

        <input type="file" class="form-control" name="file" id="file"  align="center"/>

        <label for="example_file" generated="true" class="error" style="color: red; display: none;"></label>

        <br>

        <button type="submit" id="submit" name="import" class="btn btn-primary">Import</button>

        <!-- <input type="submit" name="submit" value="Upload" class="btn btn-primary"> -->

    </form></p>

     </div>

     <div class="modal-footer">

       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

     </div>

   </div>

   

 </div>

</div>

</body>

<script>

	$(document).ready(function(){

      $('#example').DataTable();

  });


</script>

</html>

