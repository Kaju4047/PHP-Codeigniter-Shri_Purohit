<?php include('login-header.php')?> 
    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
        <div class="col-lg-3"> <!-- required for floating -->
          <!-- Nav tabs -->
          <ul class="nav nav-tabs tabs-left sideways">
            <li><a href="profile.php" >My Profile</a></li>
            <li class="active"><a href="my-bookings.php">My Bookings</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="index.php">Logout</a></li>
          </ul>
        </div>
       <div class="col-lg-9">
            <!-- Tab panes -->
            <div class="tab-content-order">
             <div class="col-md-12 no-pad">
                   <div class="package-details mb-2">

                    <div class="cont-box">
                        <div class="order-cont">
                          <h5 class="w-10">Order Id :</h5>
                          <span class="view-cnt">SP123456</span>
                        </div>
                        <div class="order-cont">
                            <span class="view-cnt">Confirmed</span>
                        </div>
                      </div>
                       <div class="order-cont">
                          <h5 class="w-10"><i class="fa fa-calendar"></i></h5>
                          <span class="view-cnt">12 Jan, 2020</span>
                      </div>
                      </div>
                      <div class="package-details mb-2">

                    <div class="cont-box">
                        <div class="order-cont">
                          <h5 class="w-10">Puja Name:</h5>
                          <span class="view-cnt">Durga Puja</span>
                        </div>                        
                        <div class="order-cont">
                            <h5 class="w-10"><i class="fa fa-calendar"></i></h5>
                            <span class="view-cnt">12 Jan, 2020</span>

                            <h5 class="w-10 ml-2"><i class="fa fa-clock-o"></i></h5>
                            <span class="view-cnt">12:45 PM</span>
                            <button id="flip" class="ml-2 btn btn-sm btn-success" title="Change Date"><i class="fa fa-pencil"></i></button>
                        </div>
                      </div>
                       <div class="order-cont">
                          <h5 ><i class="fa fa-map-marker"></i></h5>
                          <span class="view-cnt">Nashik</span>
                      </div>
                      </div>
                      <div id="panel">
                      <div class="package-details mb-2" >
                        <div class="mb-3 ttl-color"><h6><b> Date & Time Requirements</b></h6></div>
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <input type="radio" name="" checked=""> <span>Select date for pooja</span>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <div class="input-group date" data-date-format="dd.mm.yyyy">
                                 <input type="text" id="fromdate" class="form-control" placeholder="dd-mm-yyyy">
                                 <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                 </div>
                              </div>
                            </div>
                          </div>
                         </div>
                         <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <span>Time preference</span>
                            </div>
                          </div>
                          <div class="col-md-4 form-group sm-contro">
                            <input type="text" class="form-control" name="">
                          </div>
                          <div class="col-md-5">
                            <div class="form-group">
                              <span>(Optional)</span>
                            </div>
                          </div>
                         
                          <div class="col-md-3">
                            <div class="form-group">
                              <span>Location</span>
                            </div>
                          </div>
                          <div class="col-md-9  sm-contro ">
                            <div class="form-group textarea">
                              <textarea class="form-control" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                              <button class="btn btn-success">Submit New Date</button>
                            </div>
                          </div>
                         </div>
                       </div>
                     </div>
                    <div class="package-details mb-2">
                      <div class="purohit-box">
                      <div class="row">
                        <div class="col-sm-8 col-12">
                          <div class="order-cont">
                          <img src="images/unnamed.jpg">
                           <div>
                             <h5>Vinod Kulkarni</h5>
                              <span>(+91 90705 43218)</span><br>
                              <small class="view-cnt">Vishrantwadi, Pune</small>
                           </div>
                          </div>
                        </div>
                        <div class="col-sm-4 col-12">
                          <!-- </div>
                      <div class="col-md-4 col-4"> -->
                      <div class="order-cont float-right order-bttn">
                         <button class="btn btn-order" onclick="openForm()"><i class="fa fa-comment"></i> Chat</button>
                      </div>
                      <!-- </div>
                    </div> -->
                        </div>
                      </div>
                    </div>
                  </div>




                      <div class="package-details mb-3">
                  <div class="row">
                    
                    <div class="col-md-6">
                      <div class="one-sec">
                        
                      <h6><b>Package Details :</b> Durga Puja</h6>

                      <ul class="service-list">
                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i> Ganapathi Pooja</li>
                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i> Punyaha Vachanam, Maha Sankalpam</li>
                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i> Kalasha Pooja</li>
                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i> Annaprasanam Pooja</li>
                        <li><i class="fa fa-chevron-right" aria-hidden="true"></i> Prasad Distribution</li>
                      </ul>
                      </div>
                    </div>
                       <div class="col-md-3 col-sm-6">
                      <div class="one-sec">
                        <h6><b>Inclusions</b></h6>
                      <ul class="service-list">
                        <li><i class="fa fa-check text-success" aria-hidden="true"></i> Dakshina</li>
                        <li><i class="fa fa-check text-success" aria-hidden="true"></i> All Pooja Materials</li>
                        <li><i class="fa fa-check text-success" aria-hidden="true"></i> Kalasha Pooja</li>
                        <li><i class="fa fa-check text-success" aria-hidden="true"></i> Flowers & Fruits</li>
                        <li><i class="fa fa-check text-success" aria-hidden="true"></i> Havan</li>
                      </ul>
                      </div>
                    </div>
                      <div class="col-md-3 col-sm-6">
                      <div class="two-sec">
                        <h6><b>Exclusions</b></h6>
                        <ul class="service-list">
                          <li> <input type="checkbox" checked=""> All Pooja Materials</li>
                          <li> <input type="checkbox" checked=""> All Pooja Materials</li>
                          <li> <input type="checkbox" checked=""> All Pooja Materials</li>
                        </ul>
                      </div>
                    </div>
                   </div>
                  </div>

                       
                        
                              <div class="package-details mb-3">
                              <div class="flex">
                                <p>Total : </p> <h5 class="ml-1 mb-0"><b> Rs 4,600.00</b></h5>
                             </div>
                             <hr>
                            <div class="col-md-12 no-pad">
                              <p>Advance Amount : <b>Rs 1,400.00</b></p>
                               <p>Purohit Amount <b>Rs 3,200.00</b> Pay To Purohit</p>
                              
                             
                            </div>
                          </div>

                          <div class="package-details mb-3">
                                
                              <div class="">
                                <h6><b>Add A Review</b></h6>
                                <form>
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="">
                                        <label>Your Review<span class="text-danger">*</span></label>
                                      </div>
                                      <div class="form-group">
                                       <div class="rating">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                      </div>
                                      </div>
                                      <div class="form-group">
                                        <textarea class="form-control"></textarea>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <button class="btn btn-success ">Submit</button>
                                    </div>
                                  </div>
                                </form>
                                </div>
                          </div>
                         
                        </div>
                         <div class="text-right">
                          <a href="#"><button class=" btn btn-success">  Cancel</button></a>
                           <!-- <a href="#"><button class=" btn btn-success"> <i class="fa fa-download"></i> Download Invoive</button></a> -->
                         </div>
                         <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                            
            </div>

            

          </div>
          
          </div>
       

     
        </div>
      </div>
    </div>

    
   <?php include('footer.php')?>
   
   <script> 
    $(document).ready(function(){
      $(".order-cont #flip").click(function(){
        $("#panel").slideToggle("slow");
      });
    });
    </script>
    <script type="text/javascript">
       $('#fromdate').datepicker(
      { 
        format: "dd-mm-yyyy",   
        autoclose:true,     
        todayHighlight: true  
      });
    </script>
  </body>
</html>