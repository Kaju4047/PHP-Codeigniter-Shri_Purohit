<?php include('application/views/front/section/header.php'); ?>  
   <!--  <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/horoscope-blog-banner.jpg);" data-aos="fade">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-12">
             <div class="d-flex">
              <div class="content-box">
                <div class="title-box ml-0">
                  <h3><b>Forgot Password</b></h3>
                  <ul class="flex text-white">
                    <li><a href="index.php">Home /</a> </li>
                     <li><a href="login.php">Login /</a> </li>
                    <li>Forgot Password</li>
                  </ul>
                </div>
              </div>
             </div>
          </div>
        </div>
    </div>  
  </div>
    -->

    <div class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7"  data-aos="fade">

            

            <form action="<?php echo base_url();?>front-forgot-password-action" class="p-5 bg-white box-shadow" method="post" name="forgotpwd" id="forgotpwd">
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
                  <input type="submit"  class="btn btn-primary py-2 px-4 text-white">
                </div>
              </div>

  
            </form>
          </div>
          
        </div>
      </div>
    </div>

    
    
    
<?php include('application/views/front/section/footer.php'); ?>
  </body>
</html>