<?php include('header.php')?>   
   <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/horoscope-blog-banner.jpg);" data-aos="fade">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-12">
             <div class="d-flex">
              <div class="content-box">
               <div class="image-box">
                 <img src="images/puja.jpg">
               </div>
                <div class="title-box">
                  <h3><b>Book A Pandit For Pooja</b></h3>
                  <ul class="d-flex">
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><p>5.0  ( 20 Reviews )</p></li>
                    <li><p></p></li>
                  </ul>
                </div>
              </div>
              
                <div class="button-box">
                  
                    <a href="#" class=""><button class="btn btn-success"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</button></a>
          
                </div>
             </div>
          </div>
        </div>
    </div>  
  </div>   

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="mb-3"><h6><b> Your Requirements</b></h6></div>
            <div class="hs_about_right_cont_wrapper mt-0">
                
               
               
                <div class="package-details mb-3" style="min-height: 270px;">
                  <div class="mb-3"><h6><b> Date & Time Requirements</b></h6></div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <input type="radio" name="" checked=""> <span>Select date for pooja</span>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <div class="input-group date" data-date-format="dd.mm.yyyy">
                           <input type="text" id="fromdate" class="form-control" placeholder="Date">
                           <div class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                           </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <button class="btn btn-success">Check Availability</button>
                         <button class="btn btn-success d-none"><i class="fa fa-check"></i> Available</button>
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
                      <div class="form-group">
                        <input type="text" name="" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-5">
                    </div>
                   </div>

                   <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="radio" name=""> <span>I Need Harivara To fix my Date and Time</span>
                      </div>
                    </div>
                   </div>

                </div>
                

                  </div>
                </div>
                <div class="col-md-4">
                   <div class="mb-3"><h6><b>Payment Summary</b></h6></div>
                   <div class="package-details mb-3">
                  <div class="row">
                    <div class="col-md-12">
                        <!-- <div class="table-responsive">
                          <table class="table summary-table">
                            <tr>
                              <th width="35%">City</th><td width="65%">Mumbai</td>
                            </tr>
                             <tr>
                              <th>Priest Preference</th><td>Hindi</td>
                            </tr>
                             <tr>
                              <th>Pooja Location</th><td> Temple Near My location</td>
                            </tr>
                             <tr>
                              <th>Pooja Name</th><td>Annaprashan Puja</td>
                            </tr>
                             <tr>
                              <th>Package Name</th><td>Standard: (1 Panditji + All Puja Samagries)</td>
                            </tr>
                             <tr>
                              <th>Flowers & Fruits</th><td>Included</td>
                            </tr>
                            <tr>
                              <th>Havan</th><td>Havan</td>
                            </tr>
                          </table>
                             <hr>  
                        </div> -->
                        <div class="mt-1">
                          <form>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <input type="radio" name="payment" checked=""><label><b class="ml-2">Pay Advance</b> 1,400.00</label>
                              </div>
                              <div class="form-group">
                                <input type="radio" name="payment"><label class="ml-2"><b>Pay Full Amount</b></label>
                              </div>
                                 <hr>  
                            </div>

                           
                            <div class="col-md-12">
                              <p>Advance : <b>Rs 1,400.00</b></p>
                              <p>Remaining : <b>Rs 1,400.00</b></p>
                              <hr>
                              <p>Total : <b>Rs 4,600.00</b></p>
                            </div>
                          </div>
                          </form>
                        </div>
                        </div>
                      </div>
                     </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>

 
   
    
 <?php include('footer.php')?>
 
 <script type="text/javascript">
   $('.nav-tabs-responsive').on('click', 'li', function() {
      $('li.active').removeClass('active');
      $(this).addClass('active');
});
 </script>
</body>
</html>