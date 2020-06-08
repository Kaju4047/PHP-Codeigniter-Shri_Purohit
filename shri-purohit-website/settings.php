<?php include('login-header.php')?>   
    

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">




        <div class="col-lg-3"> <!-- required for floating -->
          <!-- Nav tabs -->
          <ul class="nav nav-tabs tabs-left sideways">
            <li><a href="profile.php" >My Profile</a></li>
            <li><a href="my-bookings.php">My Bookings</a></li>
            <li class="active"><a href="settings.php">Settings</a></li>
            <li><a href="index.php">Logout</a></li>
          </ul>
        </div>

        <div class="col-lg-9">

          <div class="tab-content-order">
              <div class="row">
                <div class="col-md-2 col-6">
                  <img src="images/profile-img.jpg" width="100%" class="mb-3">
                </div>
                <div class="col-md-10">
                  <div class="profile-content">
                    <h6><b>Radhika Shankar Jagtap</b> <small>Vishrantwadi, Pune.</small></h6>
                    <p>radhikasj39@gmail.com</p>
                    <p>+91 7020351472</p>
                  </div>
                </div>
              </div> <!-- row --> 
            </div>
          <!-- Tab panes -->
          <div class="tab-content-order">

          <div class="col-md-6 no-pad"  data-aos="fade">

            <div class="form-group">
              <h6><b>Change Password</b></h6>
            </div>

            <form action="profile.php">
             
              <div class="row form-group">                
                <div class="col-md-12">                 
                  <input type="password" id="subject" class="form-control" placeholder="Old Password">
                </div>
              </div>

              <div class="row form-group">                
                <div class="col-md-12">                 
                  <input type="password" id="subject" class="form-control" placeholder="New Password">
                </div>
              </div>

              <div class="row form-group">                
                <div class="col-md-12">                 
                  <input type="password" id="subject" class="form-control" placeholder="Confirm Password">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Submit" class="btn btn-primary py-2 px-4 text-white">
                </div>
              </div>

  
            </form>
          </div>
          
        
          </div>
        </div>

     
        </div>
      </div>
    </div>

    
    
    
   <?php include('footer.php')?>
  </body>
</html>