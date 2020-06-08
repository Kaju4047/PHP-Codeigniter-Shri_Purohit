<?php include('application/views/front/section/header.php'); ?>
   <style type="text/css">
  .error {
    color: red;
    margin-bottom: 0px;
    /* padding-bottom: 2px; */
    text-align: left;
    /* text-align: right; */
    padding-top: 2px;
}
</style>    

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">




        <div class="col-lg-3"> <!-- required for floating -->
          <!-- Nav tabs -->
          <ul class="nav nav-tabs tabs-left sideways">
            <li><a href="<?php echo base_url();?>front-customer-profile" >My Profile</a></li>
            <li><a href="<?php echo base_url();?>front-my-booking">My Bookings</a></li>
            <li class="active"><a href="<?php echo base_url();?>front-my-setting">Settings</a></li>
            <li><a href="<?php echo base_url();?>front-customer-logout">Log Out</a></li>
          </ul>
        </div>

        <div class="col-lg-9">

          <div class="tab-content-order">
              <div class="row">
                <div class="col-md-3">
                  <img src="<?php echo base_url(); ?><?php echo !empty($customer_details[0]['customer_photo']) ? 'upload/customer_profile/'.$customer_details[0]['customer_photo'] :  'shri-purohit-website/images/avatar1.png'; ?>" width="100%">
                </div>
                <div class="col-md-9">
                  <div class="profile-content">
                    <h6><b><?php echo !empty($customer_details[0]['customer_name']) ? ucwords($customer_details[0]['customer_name']):'-'?></b> <small><?php echo !empty($customer_details[0]['customer_address']) ? ucwords($customer_details[0]['customer_address']):''?></small></h6>
                    <p><?php echo !empty($customer_details[0]['customer_mobile_no']) ?$customer_details[0]['customer_mobile_no']:''?></p>
                    <p><?php echo !empty($customer_details[0]['customer_email_id']) ? strtolower($customer_details[0]['customer_email_id']):''?></p>

                  </div>
                </div>
              </div> <!-- row --> 
            </div>
          <!-- Tab panes -->
          <div class="tab-content-order">

          <div class="col-md-6 no-pad"  data-aos="fade">
   <div class="MessageHide">
                              <?php
                              if (!empty($this->session->userdata('msg'))) {
                            echo $this->session->userdata('msg');
                            $this->session->unset_userdata('msg');
                              }
                              ?>
                          </div>
            <div class="form-group">
              <h6><b>Change Password</b></h6>
            </div>

            <form action="<?php echo base_url();?>front-my-setting-action" method="post" name="frmSetting" id="frmSetting">
             
              <div class="row form-group">                
                <div class="col-md-12">                 
                  <input type="password" id="txtOldPass" name="txtOldPass" class="form-control" placeholder="Old Password">
                </div>
              </div>

              <div class="row form-group">                
                <div class="col-md-12">                 
                  <input type="password" id="txtNewPass" name="txtNewPass" class="form-control" placeholder="New Password">
                </div>
              </div>

              <div class="row form-group">                
                <div class="col-md-12">                 
                  <input type="password" id="txtNewConfrmPass" name="txtNewConfrmPass" class="form-control" placeholder="Confirm Password">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit"  class="btn btn-primary py-2 px-4 text-white submit">
                </div>
              </div>

  
            </form>
          </div>
          
        
          </div>
        </div>

     
        </div>
      </div>
    </div>

    
    <input type="hidden" name="txtOldPass1" id="txtOldPass1" value="<?php echo $this->session->userdata('CTMRPWD') ?>">
    
  <?php include('application/views/front/section/footer.php'); ?>
  <script type="text/javascript" src="<?php echo base_url(); ?>AdminMedia/validations/js_setting/js_setting.js"></script>
  </body>
</html>