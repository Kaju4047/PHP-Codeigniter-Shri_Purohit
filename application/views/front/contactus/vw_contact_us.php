<?php include('application/views/front/section/header.php'); ?> 

<style>
    
    .error{
        color: red;
    }
</style>

     <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo base_url('shri-purohit-website/images/horoscope-blog-banner.jpg'); ?>);" data-aos="fade">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-12">
             <div class="d-flex">
              <div class="content-box">
                <div class="title-box ml-0">
                  <h3><b>Contact Us</b></h3>
                  <ul class="flex text-white">
                    <li><a href="<?php echo base_url();?>index">Home /</a> </li>
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

   <div class="MessageHide" id="success-alert">
                            <?php
                            if (!empty($this->session->userdata('msg'))) {
                                echo $this->session->userdata('msg');
                                $this->session->unset_userdata('msg');
                            }
                            ?>
                        </div>
            

            <!--<form action="<?php echo base_url();?>front-contact-send-email" class="p-5 bg-white" name="contact_us" id="contact_us" method="post">-->
             <?= form_open('front-contact-send-email', ['class' => 'p-5 bg-white', 'name' => 'contact_us', 'id' => 'contact_us', 'autocomplete' => 'off']); ?>

              <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="fname">First Name</label>
                  <input type="text" id="fname" class="form-control isAlpha" name="fname" placeholder="Enter First Name">
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="lname">Last Name</label>
                  <input type="text" id="lname" class="form-control isAlpha" name="lname" placeholder="Enter Last Name">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" id="email" class="form-control" name ="email" placeholder="Enter Email">
                </div>
              </div>

                  <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="mob">Mobile Number</label> 
                  <input type="text" id="mob" class="form-control isInteger" name ="mob" placeholder="Enter Mobile Number">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="subject">Subject</label> 
                  <input type="subject" id="subject" class="form-control" name="subject" placeholder="Enter Subject">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Message</label> 
                  <textarea name="message" id="message" name="message" cols="30" rows="3" class="form-control" placeholder="Enter Message here..."></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Send Message" class="btn btn-primary py-2 px-4 text-white">
                </div>
              </div>

            <?= form_close(); ?>
            <!--</form>-->
          </div>
          <div class="col-md-5"  data-aos="fade" data-aos-delay="100">
            
            <div class="p-4 mb-3 bg-white con-det">
        <p class="mb-0 font-weight-bold">Address</p>
              <p class="mb-4"><?php echo !empty($orgdata[0]['om_CmpAddress'])? ucfirst($orgdata[0]['om_CmpAddress']):''?></p>

              <p class="mb-0 font-weight-bold">Phone</p>
              <p class="mb-2"><a href="tel:8106336242">+91 81063 36242 </a></p>
              <p class="mb-2"><a href="tel:8106336243">+91 81063 36243 </a> </p>
              <p class="mb-4"><a href="tel:7893453059">+91 78934 53059</a></p>

              <p class="mb-0 font-weight-bold">Email Address</p>
    
              <p class="mb-0"><?= !empty($orgdata[0]['om_CmpEmail']) ? '<a style="color: #131111;" href="mailto:' . strtolower($orgdata[0]['om_CmpEmail']) . '">' . strtolower($orgdata[0]['om_CmpEmail']) . '</a>' : '-' ?></p>

            </div>
          </div>
        </div>
      </div>
    </div>

<?php include('application/views/front/section/footer.php'); ?>
    <script type="text/javascript">
        $(".contactLi").addClass("active");


$(document).ready(function () {
 
window.setTimeout(function() {
    $(".MessageHide").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 5000);
 
});
    </script>
    
    
    <script>
    
    
    $.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
});
        
        
        $("#contact_us").validate({

        rules: {
            fname: {
                required: true,
                alpha: true
                },  
            lname: {
                required: true,
                alpha: true
            },
            email:{
                required: true,
                email: true
            },
            mob: {
                required: true,
                minlength: 10,
                maxlength: 10,
                number: true,
            },
            subject :{
                required: true
            },
            message:{
                required: true
            }
        },
        
        messages: {
            fname: {
                required: "Enter First Name",
                alpha: "Enter only alphabets"
                },  
            lname: {
                required: "Enter Last Name",
                alpha: "Enter only alphabets"
            },
            email:{
                required: "Enter Email",
                email: "Enter valid email"
            },
            mob: {
                required: "Enter Mobile no",
                minlength: "Mobile no should be 10 digits",
                maxlength: "Mobile no should be 10 digits",
                number: "Enter mobile no in digits",
            },
            subject :{
                required: "Enter Subject"
            },
            message:{
                required: "Enter Message"
            }
        },
        submitHandler: function (form) { 
            form.submit(); 
        }
    });
        
    </script>
  </body>
</html>