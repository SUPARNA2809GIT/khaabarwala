<div class="container-fluid">
    <div class="row">
      <div class="col-md-7 col-sm-12"> DASHBOARD </div>
      <div class="col-md-3 col-sm-12">
        <h5><i class="fa fa-thumbs-up"></i> Welcome <?php echo $this->session->userdata('ADMIN_USERNAME'); ?></h5>
      </div>
      <div class="col-md-2 col-sm-12">
        <h5><i class="fa fa-sign-out"></i> <a href="<?php echo base_url(); ?>login/logout" style="text-decoration:none;">Log out</a></h5>
      </div>
    </div>
  </div>