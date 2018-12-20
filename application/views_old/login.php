<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->load->view('layout/header'); ?>
</head>
<body style="background: repeating-radial-gradient(closest-side at 25px 35px, #00b300 15%, #eee 40%);
background-size:60px 60px;">
<div class="container-fluid">  
  <div class="row" style="margin-top:150px;">
    <div class="col-md-4 col-sm-12"> &nbsp;&nbsp; </div>
    	<div class="col-md-4 col-sm-12">
        	<div class="panel panel-success" style="font-family: 'Kodchasan', sans-serif;">
              <div class="panel-heading" style="background-color:#ff9a3596;">
              	<img src="<?php echo base_url(); ?>assets/images/logo.png" style="width:25%" />
              </div>
              <div class="panel-body">
            		<form action="<?php echo base_url(); ?>login/admin_login" method="post">
                    <div class="form-group">
                      <label for="email">Username :</label>
                      <input type="text" name="username" class="form-control" id="username">
                    </div>
                    <div class="form-group">
                      <label for="pwd">Password :</label>
                      <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <button type="submit" class="btn btn-success">LOGIN</button>
                  </form>
              </div>
              <div class="panel-footer" style="background-color:#ff9a3596;color:#140877; font-weight:bold;">Designed & developed by <a href="" target="_blank" style="text-decoration:none;color:#140877; font-weight:bold;">Projukti</a></div>
            </div>
        </div>
    <div class="col-md-4 col-sm-12"> &nbsp;&nbsp; </div>
  </div>
</div>
</body>
</html>
