<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<?php $this->load->view('layout/header'); ?>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />

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

          <li><a href="<?php echo base_url(); ?>add/menu" style="color:#FFFFFF;">Menu</a></li>

          <li>Edit</li>

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

        <form action="<?php echo base_url(); ?>edit/menu/<?php echo $row->menu_id; ?>" method="post" enctype="multipart/form-data">

          <div class="row" >

              <div class="col-md-3"><label for=""><h4>Returant</h4></label></div>

                <div class="col-md-9">

                    <div class="form-group">

                       <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="res_id" onchange="return cuisine(this.value)">

                          <option value="">--Select--</option>

                          <?php if(!empty($restaurants)){

                            foreach ($restaurants as $value) { ?>

                               <option value="<?php echo $value->res_id; ?>" <?php if($row->res_id==$value->res_id) echo "selected='selected'"; ?>><?php echo $value->res_name; ?></option>

                          <?php  } } ?>

                        </select>

                        <?php echo form_error('res_id', '<div class="error">', '</div>'); ?>

                    </div>

                </div>

            </div>

            <?php

             $cuisineRec = $this->db->query("SELECT * FROM  tb_cuisine WHERE cuisine_id=".$row->cuisine_id)->row();

             ?>
            <div class="row" >
              <div class="col-md-3">
                <label for="">
                <h4>Cuisine</h4>
                </label>
              </div>
              <div class="col-md-9">
                <div class="form-group" id="ciusineId">
                  <input list="browsers" name="cuisine_name" name="cuisine_name" class="form-control" autocomplete="off" value="<?php echo $cuisineRec->cuisine_name; ?>">
                  <datalist id="browsers">
                    <?php if(!empty($cuisine)){
                        foreach ($cuisine as $val) { ?>
                          <option value="<?php echo $val->cuisine_name; ?>" selected>
                        <?php  } } ?>
                  </datalist>
                  <?php echo form_error('cuisine_id', '<div class="error">', '</div>'); ?> </div>
              </div>
            </div>



          <div class="row">

              <div class="col-md-3"><label for=""><h4>Menu Name</h4></label></div>

                <div class="col-md-9">

                    <div class="form-group">

                      <input type="text" name="menu_name" class="form-control" placeholder="" value="<?php echo $row->menu_name; ?>" />

                      <?php echo form_error('menu_name', '<div class="error">', '</div>'); ?>

                    </div>

                </div>

            </div>

            <div class="row">

              <div class="col-md-3"><label for=""><h4>Menu Price</h4></label></div>

                <div class="col-md-9">

                    <div class="form-group">

                      <input type="text" name="menu_price" class="form-control" placeholder="" value="<?php echo $row->menu_price; ?>" />

                      <?php echo form_error('menu_price', '<div class="error">', '</div>'); ?>

                    </div>

                </div>

            </div>



            <div class="row">

              <div class="col-md-3"><label for=""><h4>Restaurant Icon</h4></label></div>

                <div class="col-md-9">

                  <div class="row">

                    <div class="col-md-2"><img src="<?php echo base_url(); ?>assets/images/vegetarian-food-symbol.png" height="34" width="34">

                      <br>

                      <input type="radio" name="menu_icon" value="vegetarian-food-symbol.png" <?php if($row->menu_icon=='vegetarian-food-symbol.png') echo "checked='checked'"; ?>>

                    </div>

                    <div class="col-md-2"><img src="<?php echo base_url(); ?>assets/images/non-vegetarian-food-symbol.png" height="34" width="34">

                      <br>

                      <input type="radio" name="menu_icon" value="non-vegetarian-food-symbol.png" <?php if($row->menu_icon=='non-vegetarian-food-symbol.png') echo "checked='checked'"; ?> >

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

  function cuisine(resId)
  {
    $.ajax({url:"<?php echo base_url(); ?>add/getCuisine", //the page containing php script
            type: "post", //request type,
            dataType: 'html',
            data: {res_id: resId},
            success:function(result){
                $("#ciusineId").html(result);
            }
          });
  }

</script>



<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

</html>

