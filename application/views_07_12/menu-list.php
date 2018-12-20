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

          <li><a href="<?php echo base_url(); ?>add/menu" style="color:#FFFFFF;">MENU</a></li>

        </ul>

      </div>

    </div>

  </div>

</section>

<section id="mainBody">

  <div class="container-fluid">

    <div class="row">



      <div class="col-md-12 col-sm-12">



        <a href="<?php echo base_url(); ?>add/menuAdd" class="btn btn-info">ADD MENU</a>



        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp;UPLOAD MENU</button>



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

              <th style="background-color: #70d3f7;">Restaurant Name</th>

              <th style="background-color: #70d3f7;">Cuisine</th>

              <th style="background-color: #70d3f7;">Menu</th>

              <th style="background-color: #70d3f7;">Price</th>

              <th style="background-color: #70d3f7;">Icon</th>

              <th style="background-color: #70d3f7;">Published</th>

              <th style="background-color: #70d3f7;">Action</th>

            </tr>

          </thead>

          <tbody>

            <?php if(!empty($result)){ foreach ($result as $key => $value) { 



               if($value->published==1) { $temp='primary'; } else { $temp='danger'; }



              ?>

              

                <tr>

                  <td><?php echo $key+1; ?></td>

                  <td><?php echo $value->res_name; ?></td>

                  <td><?php echo $value->cuisine_name; ?></td>

                  <td style="width: 15%;"><?php echo $value->menu_name; ?></td>

                  <td><?php echo $value->menu_price; ?></td>

                  <td>



                    

<img src="<?php echo base_url(); ?>assets/images/non-vegetarian-food-symbol.png" height="34" width="34">

<input type="radio" name="image_symbol_<?php echo $key; ?>" value="non-vegetarian-food-symbol.png"<?php if($value->menu_icon=='non-vegetarian-food-symbol.png') echo "checked='checked'"; ?> onClick="ChangeMenuStatus(<?php echo $value->menu_id; ?>,'non-vegetarian-food-symbol.png')">

<img src="<?php echo base_url(); ?>assets/images/vegetarian-food-symbol.png" height="34" width="34">

<input type="radio" name="image_symbol_<?php echo $key; ?>" value="vegetarian-food-symbol.png" <?php if($value->menu_icon=='vegetarian-food-symbol.png') echo "checked='checked'"; ?> onClick="ChangeMenuStatus(<?php echo $value->menu_id; ?>,'vegetarian-food-symbol.png')">

                    

                  </td>

                 

                 <td><a href="<?php echo base_url() ?>add/menuPublished/<?php echo $value->menu_id; ?>" class="btn btn-<?php echo $temp; ?> btn-xs"><?php if($value->published==1) echo 'Yes'; else echo 'No' ?></a></td>



                 

                  <td>

                  <a href="<?php echo base_url(); ?>edit/menu/<?php echo $value->menu_id; ?>"><i class="fa fa-edit"></i></a>

                  <a onclick="return confirm('Are you sure to delete?')" href="<?php echo base_url(); ?>delete/resDelete/<?php echo $value->menu_id; ?>"><i class="fa fa-trash"></i></a>

                </td>

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


  function ChangeMenuStatus(menuId,imageSymbol)
  {
      
       
       $.ajax({url:"<?php echo base_url(); ?>add/menuIcon", //the page containing php script
            type: "post", //request type,
            data: {menuId: menuId, imageSymbol: imageSymbol},
            success:function(result){

                alert("Success!!");
             
            }
          });
  }

</script>

</html>

