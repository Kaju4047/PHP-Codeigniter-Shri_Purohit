<?php include('header.php')?>   
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
   

    <div class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7"  data-aos="fade">

            

            <form action="profile.php" class="p-5 bg-white box-shadow">
             
              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" id="email" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="subject">Password</label> 
                  <input type="password" id="subject" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-12">
                  <div class="flex-box">
                    <p>No account yet? <a href="register.php">Register Here</a></p>
                    <p>Forgot Password? <a href="forgot-password.php">Click Here</a></p>
                  </div>
                </div>
              </div>

            
              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Sign In" class="btn btn-primary py-2 px-4 text-white">
                </div>
              </div>

  
            </form>
          </div>
          
        </div>
      </div>
    </div>

    
    
    
   <?php include('footer.php')?>
   <script type="text/javascript">
        $(".loginLi").addClass("active");
    </script>
  </body>
</html>