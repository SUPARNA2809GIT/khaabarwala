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
/* Preloader */

#preloader {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #fff;
  /* change if the mask should have another color then white */
  z-index: 99;/* makes sure it stays on top */
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
  margin: -100px 0 0 -100px;/* is width and height divided by two */
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
          <li><a href="<?php echo base_url(); ?>view/customers" style="color:#FFFFFF;">ORDERS</a></li>
        </ul>
      </div>
    </div>
  </div>
</section>
<section id="mainBody">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-sm-12"> <br>
        <br>
        <form method="get" action="" >
          <div class="row" >
            <div class="col-md-6">
              <label>From Date</label>
              <div class="form-group">
                <input type="date" name="from_date" class="form-control" placeholder="From Date" value="<?php if(!empty($from_date)) echo $from_date; ?>" />
              </div>
            </div>
            <div class="col-md-6">
              <label>To Date</label>
              <div class="form-group">
                <input type="date" name="to_date" class="form-control" placeholder="To Date" value="<?php if(!empty($to_date)) echo $to_date; ?>" />
              </div>
            </div>
          </div>
          <div class="row" >
            <div class="col-md-4">
              <label>Restaurant</label>
              <div class="form-group">
                <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="res_id" onchange="return cuisine(this.value)" style="background-color: #fff; important;">
                  <option value="" selected="" hidden="">--Select--</option>
                  <?php if(!empty($restaurants)){
                      foreach ($restaurants as $value) { ?>
                  <option value="<?php echo $value->res_id; ?>" <?php if(!empty($res_id) && $value->res_id==$res_id) echo "selected='selected'"; ?>><?php echo $value->res_name; ?></option>
                  <?php  } } ?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <label>Menu</label>
              <div class="form-group" id="ciusineId">
                <input list="browsers" name="menu_name" name="menu_name" class="form-control" autocomplete="off" value="<?php if($menu_name!='') echo $menu_name; ?>">
                <datalist id="browsers">
                  <?php if(!empty($menus)){
                      foreach ($menus as $val) { ?>
                  <option value="<?php echo $val->menu_name; ?>" >
                  <?php  } } ?>
                </datalist>
              </div>
            </div>
            <div class="col-md-4">
              <label>Customers</label>
              <div class="form-group">
                <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="user_id" onchange="return cuisine(this.value)">
                  <option value="" selected="" hidden="">--Select--</option>
                  <?php if(!empty($customers)){
                      foreach ($customers as $cus) { ?>
                  <option value="<?php echo $cus->user_id; ?>" <?php if(!empty($user_id) && $cus->user_id==$user_id) echo "selected='selected'"; ?>><?php echo $cus->name; ?></option>
                  <?php  } } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <input class="btn btn-success" type="submit" name="search" value="Search">
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-12 col-sm-12">
        <br>
        <br>
        <br>
        <br>
        <!-- <input type="button" id="btnExport" value=" Export Table data into Excel " class="btn btn-primary" /> -->
        <a href="javascript:void(0);" onclick="fnExcelReport();" class="btn btn-primary">Excel Export</a>
        <h4>&nbsp;</h4>
        <div id="dvData">
        <table id="example" class="table table-striped table-bordered" style="width:100%;">
          <thead>
            <tr>
              <th style="background-color: #70d3f7;">#</th>
              <th style="background-color: #70d3f7;">Order Id</th>
              <th style="background-color: #70d3f7;">Customer</th>
              <th style="background-color: #70d3f7;">Restaurant</th>
              <th style="background-color: #70d3f7;">Order And Menu Details</th>
              <th style="background-color: #70d3f7;">Order Amount</th>
              <th style="background-color: #70d3f7;">Gst Amount</th>
              <th style="background-color: #70d3f7;">Total</th>
              <th style="background-color: #70d3f7;">Order Date</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($orders)){ foreach ($orders as $key => $value) {

              $orderMenus = $this->db->query("SELECT * FROM tb_order_menu WHERE order_id=".$value->order_id)->result();

              $users = $this->db->query("SELECT * FROM tb_user WHERE user_id=".$value->user_id)->row();


              $restaurant = $this->db->query("SELECT * FROM tb_restaurant WHERE res_id=".$orderMenus[0]->res_id)->row();


             ?>
            <tr>
              <td><?php echo $key+1; ?></td>
              <td><?php echo $value->order_gen_id; ?></td>
              <td><?php echo $users->name; ?></td>
              <td><?php echo $restaurant->res_name; ?></td>
              <td><?php if(!empty($orderMenus)){ foreach ($orderMenus as $ordM) {

                    $menu = $this->db->query("SELECT * FROM tb_menu WHERE menu_id=".$ordM->menu_id)->row();


                   ?>
                <strong>Menu</strong>: <?php echo $menu->menu_name; ?> <br>
                <strong>Quantity</strong>: <?php echo $ordM->quantity; ?> <br>
                <strong>Price</strong>: <?php echo $ordM->price; ?> <br>
                <br>
                <?php } } ?></td>
              <td><?php echo $value->order_amount; ?></td>
              <td><?php echo $value->gst_amount; ?></td>
              <td><?php echo $value->sub_total; ?></td>
              <td><?php echo date('Y/m/d',strtotime($value->order_date)); ?></td>
            </tr>
            <?php } } ?>
          </tbody>
        </table>
      </div>
      </div>
    </div>
  </div>
</section>
<iframe id="txtArea1" style="display:none"></iframe>
</body>

<script>

  $(document).ready(function(){

      // $('#example').DataTable();

      $('#example').DataTable( {
          buttons: [
              'copy', 'excel', 'pdf'
          ]
      } );

  });

  function cuisine(resId)
  {

    $.ajax({url:"<?php echo base_url(); ?>add/getMenu", //the page containing php script
            type: "post", //request type,
            dataType: 'html',
            data: {res_id: resId},
            success:function(result){

                console.log(result);
                $("#ciusineId").html(result);
             
            }
          });
  }
</script>

<script type="text/javascript">
function fnExcelReport()
{
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('example'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    { 
    tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
    //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) // If Internet Explorer
    {
    txtArea1.document.open("txt/html","replace");
    txtArea1.document.write(tab_text);
    txtArea1.document.close();
    txtArea1.focus(); 
    sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    } 
    else //other browser not tested on IE 11
    sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text)); 

    return (sa);
}
</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
</html>
