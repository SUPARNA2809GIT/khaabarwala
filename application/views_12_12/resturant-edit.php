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

        <form action="<?php echo base_url(); ?>edit/restaurant/<?php echo $row->res_id; ?>" method="post" enctype="multipart/form-data">

          <div class="row">

              <div class="col-md-3"><label for=""><h4>Restaurant Name</h4></label></div>

                <div class="col-md-9">

                    <div class="form-group">

                      <input type="text" name="res_name" class="form-control" placeholder="" value="<?php echo $row->res_name; ?>" />

                      <?php echo form_error('res_name', '<div class="error">', '</div>'); ?>

                    </div>

                </div>

            </div>

            <div class="row">

              <div class="col-md-3"><label for=""><h4>Address</h4></label></div><div class="col-md-9">

                    <div class="form-group"><textarea name="res_address" class="form-control" placeholder="" rows="4" /><?php echo $row->res_address; ?></textarea>

                      <?php echo form_error('res_address', '<div class="error">', '</div>'); ?>



                    </div>

                </div>

            </div>



            <div class="row">

              <div class="col-md-3"><label for=""><h4>GST Applied?</h4></label></div>

                <div class="col-md-9">

                    <div class="radio">

                        <label><input type="radio" name="gst_applied" value="y" <?php if($row->is_gst_applied=='y') echo "checked='checked'"; ?> onclick="checkValue()">Yes</label>

                        &nbsp;&nbsp;

                        <label><input type="radio" name="gst_applied" value="n" <?php if($row->is_gst_applied=='n') echo "checked='checked'"; ?> onclick="checkValue()">No</label>

                    </div>

                </div>

            </div>

            

            <?php if($row->is_gst_applied=='y'){ $display=''; } else { $display='none'; } ?>



            <div class="row"  id="gstAmountDiv" style="display: <?php echo $display; ?>;">

              <div class="col-md-3"><label for=""><h4>GST Amount</h4></label></div>

                <div class="col-md-9">

                    <div class="form-group">

                        <select class="form-control" id="sel1" name="gst_amount">

                           <option value="" selected="selected" hidden>Select list:</option>

                           <option value="0" <?php if($row->gst_amount==0) echo "selected='selected'"; ?>>0</option>

                           <option value="5" <?php if($row->gst_amount==5) echo "selected='selected'"; ?>>5</option>

                           <option value="12" <?php if($row->gst_amount==12) echo "selected='selected'"; ?>>12</option>

                           <option value="18" <?php if($row->gst_amount==18) echo "selected='selected'"; ?>>18</option>

                           <option value="24" <?php if($row->gst_amount==24) echo "selected='selected'"; ?>>24</option>

                           <option value="28" <?php if($row->gst_amount==28) echo "selected='selected'"; ?>>28</option>

                        </select>

                    </div>

                </div>

            </div>



            





            <div class="row">

              <div class="col-md-3"><label for=""><h4>Restaurant Icon</h4></label></div>

                <div class="col-md-9">



                  <div class="row">

                    <div class="col-md-2"><img src="<?php echo base_url(); ?>assets/images/store1.png" height="64" width="64">

                      <br>

                      <input type="radio" name="res_icon" value="store1.png" <?php if($row->res_icon=='store1.png') echo "checked='checked'"; ?> >



                    </div>





                    <div class="col-md-2"><img src="<?php echo base_url(); ?>assets/images/store2.png" height="64" width="64">

                      <br>

                      <input type="radio" name="res_icon" value="store2.png" <?php if($row->res_icon=='store2.png') echo "checked='checked'"; ?>>

                    </div>

                    <div class="col-md-2"><img src="<?php echo base_url(); ?>assets/images/store3.png" height="64" width="64">

                      <br>

                      <input type="radio" name="res_icon" value="store3.png" <?php if($row->res_icon=='store3.png') echo "checked='checked'"; ?>>

                    </div>

                    <div class="col-md-2"><img src="<?php echo base_url(); ?>assets/images/store4.png" height="64" width="64">

                      <br>

                      <input type="radio" name="res_icon" value="store4.png" <?php if($row->res_icon=='store4.png') echo "checked='checked'"; ?>>

                    </div>

                    <div class="col-md-2"><img src="<?php echo base_url(); ?>assets/images/store5.png" height="64" width="64">

                      <br>

                      <input type="radio" name="res_icon" value="store5.png" <?php if($row->res_icon=='store5.png') echo "checked='checked'"; ?>>

                    </div>

                  </div>



                   

                </div>

            </div>



            <hr>

            <div class="row">

              <div class="col-md-3"><h4>&nbsp;</h4></div>

                <div class="col-md-9">

                    <button class="btn btn-success" type="submit">Update</button>

                </div>

            </div>



        </form>

      </div>

    </div>

  </div>

</section>

</body>

<script>



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

