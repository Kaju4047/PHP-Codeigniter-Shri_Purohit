<div class="clearfix"></div>
 <div class="msg_div1">
            <?php
             // print_r('tese '.$this->session->flashdata("success1"));die();
            $msg = '';
            $error_class = 'alert-success';
            $hint_text = 'Success';
            if ($this->input->get('successmsg') != "") {
                $msg = $this->input->get('successmsg');
                $error_class = 'alert-success';
                $hint_text = 'Success';
            }else if ($this->input->get('failed') != "" || (validation_errors() != "")) {
                $msg = ($this->input->get('failed') ? $this->input->get('failed') : validation_errors());
                $error_class = 'alert-danger';
                $hint_text = 'Error';
            } 
            ?>
            <div class="err-msg-reg suc-fal-msg" style=" <?php echo (!empty($msg) ? 'display:block;' : 'display:none;'); ?>">
                <div class="alert <?php echo $error_class; ?>" >
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>
                    <strong><?php echo $hint_text; ?> !</strong> <?php echo $msg; ?>
                </div>
            </div>
            <?php  
         
            ?>

        </div> 
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-6">
                <h2 class="footer-heading mb-2">About Us</h2>
                <?php    
          $footer_aboutus = $this->Md_database->getData('static_cms','cms_text',array('cms_pkey'=>'8'),'','');
          $orgdata = $this->Md_database->getData('static_organizationmaster', '*');

          ?>
          <?php echo !empty($footer_aboutus[0]['cms_text'])? $footer_aboutus[0]['cms_text']:'';?>
                <div class="social-links">
                <a href="<?php echo !empty($orgdata[0]['om_CmpFBLink'])? $orgdata[0]['om_CmpFBLink']:'';?>" class="pl-0 pr-0" target="_blank"><span class="icon-facebook"></span></a>
               <a href="<?php echo !empty($orgdata[0]['om_CmpTwitterLink'])? $orgdata[0]['om_CmpTwitterLink']:'';?>" class="pl-2 pr-0" target="_blank"><span class="icon-twitter"></span></a>
                <a href="<?php echo !empty($orgdata[0]['om_insta_link'])? $orgdata[0]['om_insta_link']:'';?>" class="pl-2 pr-0" target="_blank"><span class="icon-instagram"></span></a>
               <a href="<?php echo !empty($orgdata[0]['om_CmpLinkedInLink'])? $orgdata[0]['om_CmpLinkedInLink']:'';?>" class="pl-2 pr-0" target="_blank"><span class="icon-linkedin"></span></a>
                <a href="<?php echo !empty($orgdata[0]['om_youtube_link'])? $orgdata[0]['om_youtube_link']:'';?>" class="pl-2 pr-0" target="_blank"><span class="icon-youtube"></span></a>
              </div>
              </div>
              
              <div class="col-md-3 col-6">
                <h2 class="footer-heading mb-2">Quick Links</h2>
                <ul class="list-unstyled">
                    <li><a href="<?php echo base_url();?>index">Home</a></li>
                  <li><a href="<?php echo base_url();?>front-about-us">About Us</a></li>
                  <li><a href="<?php echo base_url();?>front-services">Services</a></li>
                  <li><a href="<?php echo base_url();?>front-contact-us">Contact Us</a></li>
                </ul>
              </div>

              <div class="col-md-3 col-6">
                <h2 class="footer-heading mb-2">Policy Info</h2>
                <ul class="list-unstyled">
                    <li><a href="<?php echo base_url();?>front-how-we-work" >How We Work</a></li>
                  <li><a href="<?php echo base_url();?>front-privacy-policy" >Privacy Policy</a></li>
                  <li><a href="<?php echo base_url();?>front-terms-of-use" >Terms Of Use</a></li>
                  <li><a href="<?php echo base_url();?>front-faq" >FAQ</a></li>
                  <li><a href="<?php echo base_url();?>front-refund-policy" >Cancellation & Refund Policy</a></li>
                  <li><a href="<?php echo base_url();?>front-how-we-work-details" >How We Work Details</a></li>
                </ul>
              </div>              
            </div>
          </div>

          <div class="col-md-3">
            <h2 class="footer-heading mb-2">Payment Partners</h2>
            <img src="<?php echo base_url();?>shri-purohit-website/images/payment.png" width="100%">
            </div>
        </div>
        </div>       
    </footer>
    <footer class="pt-4 site-footer-balck">
     
        <div class="row text-center">
          <div class="col-md-12">
            <p> Copyright &copy;<script>document.write(new Date().getFullYear());</script> Shri Purohit App. All rights reserved. Design By- <a href="https://mplussoft.com" target="_blank" >Mplussoft</a>          
            </p>          
          </div>
        </div>
    </footer>
  </div>


<!--    <div> 
              
              <div class="chat-popup" id="myForm">
                <div class="modal-header">
                  <div style="flex:1">
                    <h6 class="modal-title">Ashwini Patil</h6>
                  </div>
                  <div style="flex:1">
                    
                    <button type="button" class="close" onclick="closeForm()">                      
                      <span aria-hidden="true">×</span>
                    </button>
                    <button  type="button" class="close" id="miniview">
                      <span aria-hidden="true">-</span>
                    </button>
                   <div class="left right_c left_icons">                   
                   </div>
                  </div>
                </div>
                <div class="chatboxout">
                    <div class="chatboxin">
                      <div class="chat-container">
                        <div class="chat-sender img-chat"><img src="<?php echo base_url();?>shri-purohit-website/images/avatar1.png"></div>
                        <div class="chat-sender msg"><strong>Ashwini Patil</strong>
                          <div class="chatmsg">Reset my Windows Password</div>
                          <div class="text-right mt-1"><small>12 Dec, 2019 12:09 PM</small></div>
                        </div>
                      </div>
                      <div class="chat-container">
                        <div class="chat-respond msg">
                          <div class="flippd">
                            <strong>Radhika Jagtap</strong>
                            <div class="chatmsg"> Hey Ashley! Done. Check your email for the password link and reset your password. Can I be of assistance to you for anything else?
                            </div>
                            <div class="text-right mt-1"><small>12 Dec, 2019 12:09 PM</small></div>
                          </div>
                        </div>
                        <div class="chat-respond img-respo"><img src="<?php echo base_url();?>shri-purohit-website/images/avatar2.png"></div>
                      </div>

                      <div class="chat-container">
                        <div class="chat-sender img-chat"><img src="<?php echo base_url();?>shri-purohit-website/images/avatar1.png"></div>
                        <div class="chat-sender msg"><strong>Ashwini Patil</strong>
                          <div class="chatmsg"> My iphone is not able to connect to the office VPN after the IOS upgrade.</div>
                          <div class="text-right mt-1"><small>12 Dec, 2019 12:09 PM</small></div>
                        </div>
                      </div>


                      <div class="chat-container">
                        <div class="chat-respond msg">
                          <div class="flippd">
                            <strong>Radhika Jagtap</strong>
                            <div class="chatmsg"> HiOS no more supports PPTP VPN. Here’s a step by step guide to connect your iPhone to the office VPN
                              <br> Connect iOS to the Office VPN iOS no more supports PPTP VPN. Use the following steps to connect to the office VPN:…
                            </div>
                            <div class="text-right mt-1"><small>12 Dec, 2019 12:09 PM</small></div>
                          </div>
                        </div>
                        <div class="chat-respond img-respo"><img src="<?php echo base_url();?>shri-purohit-website/images/avatar2.png"></div>
                      </div>
                      
                    </div>
                    <div class="chat-container">
                      <form>
                        <div class="form-group chat-box">
                          <input type="text" name="" class="form-control">
                          <a href=""><img src="<?php echo base_url();?>shri-purohit-website/images/paper-airplane-icon.png"></a>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div> -->


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD19o3ef65KJnJ9qCKaph5XuR-hSW6sfXM&libraries=places"></script>
  <script src="<?php echo base_url();?>shri-purohit-website/js/jquery-3.3.1.min.js"></script>
  <script src="<?php echo base_url();?>shri-purohit-website/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="<?php echo base_url();?>shri-purohit-website/js/jquery-ui.js"></script>
  <script src="<?php echo base_url();?>shri-purohit-website/js/popper.min.js"></script>
  <script src="<?php echo base_url();?>shri-purohit-website/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>shri-purohit-website/js/owl.carousel.min.js"></script>
  <script src="<?php echo base_url();?>shri-purohit-website/js/jquery.stellar.min.js"></script>
  <script src="<?php echo base_url();?>shri-purohit-website/js/jquery.countdown.min.js"></script>
  <script src="<?php echo base_url();?>shri-purohit-website/js/jquery.magnific-popup.min.js"></script>
  <!-- <script src="<?php echo base_url();?>shri-purohit-website/js/bootstrap-datepicker.min.js"></script> -->
  <script src="<?php echo base_url();?>shri-purohit-website/js/aos.js"></script>
  <script src="<?php echo base_url();?>shri-purohit-website/js/slick.js"></script>
  <script src="<?php echo base_url();?>shri-purohit-website/js/rangeslider.min.js"></script>
  <script src="<?php echo base_url();?>shri-purohit-website/js/main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script src="<?php echo base_url();?>shri-purohit-website/js/time-picker.js"></script>  
  <!-- <script src="<?php echo base_url();?>shri-purohit-website/js/checkout.js"></script>   -->

<!--[start::jQuery Validation files]-->
<script type="text/javascript" src="<?php echo base_url(); ?>AdminMedia/validations/JqueryValidation/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>AdminMedia/validations/JqueryValidation/js_common_validations.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>AdminMedia/validations/JqueryValidation/notificationMsg.js"></script>

<!--[end::jQuery Validation files]-->
  <script type="text/javascript">      
      $(document).ready(function(){
        $("#miniview").click(function(){
          $(".chatboxout").slideToggle("slow");
        });
      });


//       if (history.pushState) {
//     var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname ;
//     window.history.pushState({path:newurl},'',newurl);
// }
  </script>
<!--   <script type="text/javascript">
     function openForm() {
        document.getElementById("myForm").style.display = "block";
      }

      function closeForm() {
        document.getElementById("myForm").style.display = "none";
      }
   </script> -->
 

  
    