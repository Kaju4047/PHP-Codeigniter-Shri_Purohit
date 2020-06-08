<?php include('application/views/front/section/header.php'); ?>
    <!-- <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/horoscope-blog-banner.jpg);" data-aos="fade">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-12">
             <div class="d-flex">
              <div class="content-box">
                <div class="title-box ml-0">
                  <h3><b>Login Here</b></h3>
                  <ul class="flex text-white">
                    <li><a href="index.php">Home /</a> </li>
                    <li>Login</li>
                  </ul>
                </div>
              </div>
             </div>
          </div>
        </div>
    </div>  
  </div> -->
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
        <div class="row justify-content-center">
          <div class="col-md-7"  data-aos="fade">
    <form action="<?php echo base_url();?>front-customer-login-action" class="p-5 bg-white box-shadow" method="post" name="loginfrm" id="loginfrm">
      <input type="hidden" name="login_redirect" value="<?php echo $this->input->get('pkg') ?>">
               <div class="MessageHide">
                              <?php
                              if (!empty($this->session->userdata('msg'))) {
                            echo $this->session->userdata('msg');
                            $this->session->unset_userdata('msg');

                              }
                              ?>
                          </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" id="email" class="form-control" name="email" autocomplete="off">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="password">Password</label> 
                  <input type="password" id="password" class="form-control" name="password" >
                </div>
              </div>

              <div class="row form-group">
                <div class="col-12">
                  <div class="flex-box-flex">
                    <p>No account yet? <a href="<?php echo base_url();?>front-customer-register">Register Here</a></p>
                    <p>Forgot Password? <a href="<?php echo base_url();?>front-forgot-password">Click Here</a></p>
                  </div>
                </div>
              </div>

            
              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit"  value="Log In" class="btn btn-primary py-2 px-4 text-white save">
                </div>
              </div>

  
            </form>
          </div>
          
        </div>
      </div>
    </div>

    
    
  <?php include('application/views/front/section/footer.php'); ?>
   <script type="text/javascript" src="<?php echo base_url(); ?>AdminMedia/validations/front_validations/customer_reg_profile/js_customer_login.js"></script>
   <script type="text/javascript">
        $(".loginLi").addClass("active");
    </script>
  </body>
</html>