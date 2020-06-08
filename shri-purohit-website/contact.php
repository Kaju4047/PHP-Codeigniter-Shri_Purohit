<?php include('header.php')?>   
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/horoscope-blog-banner.jpg);" data-aos="fade">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-12">
             <div class="d-flex">
              <div class="content-box">
                <div class="title-box ml-0">
                  <h3><b>Contact Us</b></h3>
                  <ul class="flex text-white">
                    <li><a href="index.php">Home /</a> </li>
                    <li>Contact Us</li>
                  </ul>
                </div>
              </div>
             </div>
          </div>
        </div>
    </div>  
  </div>
    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-7 mb-3"  data-aos="fade">

            

            <form action="#" class="p-5 bg-white con-form">
             

              <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="fname">First Name</label>
                  <input type="text" id="fname" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="lname">Last Name</label>
                  <input type="text" id="lname" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" id="email" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="subject">Subject</label> 
                  <input type="subject" id="subject" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Message</label> 
                  <textarea name="message" id="message" cols="30" rows="6" class="form-control" placeholder="Write your notes or questions here..."></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Send Message" class="btn btn-primary py-2 px-4 text-white">
                </div>
              </div>

  
            </form>
          </div>
          <div class="col-md-5"  data-aos="fade" data-aos-delay="100">
            
            <div class="p-4 mb-3 bg-white con-det">
              <p class="mb-0 font-weight-bold">Address</p>
              <p class="mb-4">M/S Shripurohit Online Solutions <br> Door No: 6-7-71/A, Bhuktapur, Adilabad <br> Telangana, Pin: 504001. </p>

              <p class="mb-0 font-weight-bold">Phone</p>
              <p class="mb-2"><a href="tel:8106336242">+91 81063 36242 </a></p>
              <p class="mb-2"><a href="tel:8106336243">+91 81063 36243 </a> </p>
              <p class="mb-4"><a href="tel:7893453059">+91 78934 53059</a></p>


              <p class="mb-0 font-weight-bold">Email Address</p>
              <p class="mb-0"><a href="mailto:shripurohit7@gmail.com">shripurohit7@gmail.com</a></p>

            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include('footer.php')?>
    <script type="text/javascript">
        $(".contactLi").addClass("active");
    </script>
  </body>
</html>