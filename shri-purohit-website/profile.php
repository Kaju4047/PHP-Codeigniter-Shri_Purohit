<?php include('login-header.php')?>   
    

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">




        <div class="col-lg-3"> <!-- required for floating -->
          <!-- Nav tabs -->
          <ul class="nav nav-tabs tabs-left sideways">
            <li class="active"><a href="profile.php" >My Profile</a></li>
            <li><a href="my-bookings.php">My Bookings</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="index.php">Logout</a></li>
          </ul>
        </div>

        <div class="col-lg-9">
          <!-- Tab panes -->
          <div class="tab-content-order">
              <div class="row">
                <div class="col-md-3">
                  <img src="images/profile-img.jpg" width="100%">
                </div>
                <div class="col-md-9">
                  <div class="profile-content">
                    <h6><b>Radhika Shankar Jagtap</b> <small>Vishrantwadi, Pune.</small></h6>
                    <p>radhikasj39@gmail.com</p>
                    <p>+91 7020351472</p>
<!--                     <p class="mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p> -->
                    <a href="#" class="hide"><button class="btn btn-success mt-3">Edit Profile</button></a>
                  </div>
                </div>
              </div> <!-- row --> 
            </div>

           
            <div class="tab-content edit_profile_block tab-content-order">
              <div class="edit_profile_button_content">
                
                    <form>
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label for="inputEmail4">Name</label>
                          <input type="text" class="form-control" id="inputEmail4">
                        </div> <!-- col-6 --> 

                        <div class="form-group col-md-6"></div>   <!-- col-6 --> 

                        <div class="form-group col-md-6">
                          <label for="inputEmail4">Email</label>
                          <input type="email" class="form-control" id="inputEmail4">
                        </div> <!-- col-6 --> 

                        <div class="form-group col-md-6">
                          <label for="inputEmail4">Mobile No.</label>
                          <input type="text" class="form-control" id="inputEmail4">
                        </div> <!-- col-6 --> 

                        <div class="form-group col-md-6">
                          <label for="inputEmail4">Address (Optional)</label>
                          <textarea name="message" class="form-control" rows="5"></textarea>
                        </div> <!-- col-6 --> 

                        <div class="col-md-6">
                          <div class="col-md-12 no-pad form-group">
                            <label for="inputEmail4">City</label>
                            <input type="text" class="form-control" id="inputEmail4">
                          </div>

                          <div class="col-md-12 no-pad form-group">
                            <label for="inputEmail4">Pincode</label>
                            <input type="text" class="form-control" id="inputEmail4">
                          </div>
                        </div> <!-- col-6 --> 

                        <div class="form-group col-md-12">
                          <label for="inputEmail4">Profile Photo</label><br>
                              <input name="Select File" type="file" />

                         <!--  <div class="choose_file">
                              <input name="Select File" type="file" />
                              <span><button class="btn" >Browser</button></span>
                          </div> -->

                        </div> <!-- col-6 --> 
                        <div class="form-group col-md-12">
                         <a href="#"><button class="btn btn-success mt-3">Save Detail</button></a>
                        </div> <!-- col-6 --> 
                        

                      </div>
                    </form>
                 
                <div class="col-6"></div> <!-- col-6 -->
                </div><!-- row --> 
              </div>
            </div>
          </div>
       

     
        </div>
      </div>
    </div>

    
    
    
   <?php include('footer.php')?>
   <script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>
  </body>
</html>