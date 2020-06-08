<?php include('application/views/front/section/header.php');

 ?>
<body onbeforeunload='reset_options()'>
 <style type="text/css">
  .error {
    color: red;
    margin-bottom: 0px;
    /* padding-bottom: 2px; */
    text-align: left;
    /* text-align: right; */
    padding-top: 2px;
}

  .table > tbody > tr > td{
  border:none;
  }
   .all-inputs{color: #333 !important;}
   td{
    vertical-align: top !important;
  }
  .btnAdd, .delete-branch{
    margin-top: 30px !important; 
  }
</style>   
    <div class="site-blocks-cover overlay" style="background-image: url(<?php echo base_url('shri-purohit-website/images/header/slide.jpg'); ?>);" data-aos="fade" >
      <div class="container">
        <div class="call-box">
          <section class="top-bar">            
            <div class="cll-num">
              <p>Call Us</p>
              <a href="tel:+918106336242"><span><img src="<?php echo base_url();?>shri-purohit-website/images/white-phone-icon-png-5.png"> +91 81063 36242</span></a>
              <a href="tel:+918106336243"><span><img src="<?php echo base_url();?>shri-purohit-website/images/white-phone-icon-png-5.png"> +91 81063 36243</span></a>
              <a href="tel:+917893453059"><span><img src="<?php echo base_url();?>shri-purohit-website/images/white-phone-icon-png-5.png"> +91 78934 53059</span></a>
            </div>
          </section>
        </div>
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-12">
            
            
            <div class="row justify-content-center">
              <div class="col-md-12 text-center">
                <div class="your-class">
                  <div>
                    <h1 data-aos="fade-up" data-aos-delay="100">SHRIPUROHIT</h1>
                    <p class="" data-aos="fade-up"> OFFERS BEST OF CLASS PUROHITS AND PUJA SERVICES</p>
                  </div>
                  <!-- <div>
                    <p data-aos="fade-up" data-aos-delay="100"> Best in Class Pooja Services as per Vedic Standards with Quality</p>
                <h1 class="" data-aos="fade-up"> Pooja Materials Delivered at your Door-Step </h1>
                  </div> -->
                </div>
              </div>
            </div>

                 <div class="row align-items-center">
                  <div class="col-md-12 align-items-center">
            <div class="form-search-wrap" data-aos="fade-up" data-aos-delay="200">
              <form method="get" action="<?php echo base_url();?>front-services" id="filterFrm" name="filterFrm">
                    <div class="row">
                      <div class="col-lg-5 col-sm-12 mb-xl-0 col-xl-5">
                        <div class="select-wrap">
                      <!--  <span class="icon"><span class="icon-keyboard_arrow_down"></span></span> -->
                      <select class="form-control rounded all-inputs" name="cityid" id="cityid">
                        <option value="">Perform Puja In</option>
                   <?php
                  if (!empty($citylist)) {
                  foreach ($citylist as $val) {    
                  if (!empty($val['cityarray'])) {?>
                  <optgroup label="<?php echo ucfirst($val['state']); ?>">
                  <?php
                  foreach ($val['cityarray'] as $optcitylist) {?>
                  <option value="<?php echo $optcitylist['pk_id']; ?>"><?php echo ucfirst($optcitylist['city']); ?></option>
                    <?php }?>

                   </optgroup>
                  <?php }  }}?>
                      </select>
                    </div>
                  </div>
                  
                  <div class="col-lg-4 col-sm-12 mb-xl-0 col-xl-4">
                    <div class="select-wrap">
                     <!--  <span class="icon"><span class="icon-keyboard_arrow_down"></span></span> -->
                      <select class="form-control rounded all-inputs" name="language" id="language">
                        <option value="">Language</option>
                 
                      
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-12 col-xl-3 ml-auto text-right">
                    <input type="submit" class="btn btn-primary btn-block rounded" value="Search All Services">
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

    <div class="hs_title_main_wrapper">
        <div class="container">
                <div class="service-slider">
                    <div class="hs_title_box_main_wrapper">
                        <div class="hs_title_img_wrapper">
                            <img src="<?php echo base_url();?>shri-purohit-website/images/puja.jpg" alt="totle_img">
                        </div>
                        <div class="hs_title_img_cont_wrapper">
                            <h2><a href="#">Puja</a></h2>
                            <p>Puja is a prayer and ritual performed to offer devotional worship to one or more deities, to spiritually celebrate an event.</p>
                        </div>
                    </div>
               
            
                    <div class="hs_title_box_main_wrapper">
                        <div class="hs_title_img_wrapper">
                            <img src="<?php echo base_url();?>shri-purohit-website/images/Homam.jpg" alt="totle_img">
                        </div>
                        <div class="hs_title_img_cont_wrapper">
                            <h2><a href="#">Havan</a></h2>
                            <p>Havan is seen to be the prime part of any major Puja and is a ritual involving making offering is made into fire. </p>
                        </div>
                    </div>
                
            
                    <div class="hs_title_box_main_wrapper">
                        <div class="hs_title_img_wrapper">
                            <img src="<?php echo base_url();?>shri-purohit-website/images/fast-puja.jpg" alt="totle_img">
                        </div>
                        <div class="hs_title_img_cont_wrapper">
                            <h2><a href="#">Festive Puja</a></h2>
                            <p>Festive Puja is performed to offer devotional worship to one or more deities during different festivals like Ganesh Chaturthi, Diwali, Dussera, Navaratri Puja etc.</p>
                        </div>
                    </div>
               
            
                    <div class="hs_title_box_main_wrapper">
                        <div class="hs_title_img_wrapper">
                            <img src="<?php echo base_url();?>shri-purohit-website/images/kalash-img.png" alt="totle_img">
                        </div>
                        <div class="hs_title_img_cont_wrapper">
                            <h2><a href="#">Vastushanti</a></h2>
                            <p>Vastu Shanti is performed to prevent harmful influences of the planets, remove negative energy and create a peaceful environment in the new premises.</p>
                        </div>
                    </div>
                </div>
           
            </div>
        </div>
    </div>
    

    <!-- hs about ind wrapper Start -->
    <div class="hs_about_indx_main_wrapper">
        <div class="container">
            <div class="row">
                <!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">-->
                <!--    <div class="hs_about_heading_main_wrapper">-->
                <!--        <div class="hs_about_heading_wrapper">-->
                <!--            <h2>One stop solution for <span>all pooja and ceremonies</span></h2>-->
                <!--            <h4><span></span></h4>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div> -->
             <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="hs_about_left_img_wrapper">
                        <img src="<?php echo base_url()?>images/book-a-pandit-ji.png" alt="about_img" />
                    </div>
                </div> 
                <div class="col-lg-7 col-md-7">
                    <div class="hs_about_right_cont_wrapper">
                       <?php echo !empty($home_about_us[0]['cms_text'])? $home_about_us[0]['cms_text']:'';?>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- 
            <div class="hs_about_indx_main_wrapper bg-img overlay">
                    <div class="container">

            <div class="wrapper">
                <div class="counter col_third text-center">
                  <img src="images/pooja-icon.png">
                  <h2 class="timer count-title count-number" data-to="200000" data-speed="5000"></h2>
                   <p class="count-text ">Puja Performed</p>
                </div>

                <div class="counter col_third text-center">
                  <img src="images/vedic-icon.png">
                  <h2 class="timer count-title count-number" data-to="170000" data-speed="5000"></h2>
                  <p class="count-text ">Vedic Priests</p>
                </div>

                <div class="counter col_third end text-center">
                  <img src="images/fire-icon.png">
                  <h2 class="timer count-title count-number" data-to="11900" data-speed="5000"></h2>
                  <p class="count-text ">Types Of Pooja</p>
                </div>
            </div>
            </div>
            </div> -->
            
    <!-- hs about ind wrapper End -->
<div class="clearfix"></div>
     <!-- hs service wrapper Start -->
    <!-- <div class="hs_service_main_wrapper bg-light">
        <div class="container">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="hs_about_heading_main_wrapper">
                          <div class="hs_about_heading_wrapper text-center">
                              <h2>Our<span> Services</span></h2>
                              <h4><span></span></h4>
                          </div>
                      </div>
                  </div> 
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 portfolio-wrapper III_column" data-groups='["all", "business"]'>
                        <div class="hs_service_main_box_wrapper">
                           <div>
                               <img src="images/manglik.png" width="100%">
                           </div>
                            <div class="hs_service_icon_cont_wrapper">
                                <h2>Manglik Dosha</h2>
                                <p>Proin gravida nibh vel velit auctor aliquet. Aenean .</p>
                                <h5><a href="#">Read More <i class="fa fa-long-arrow-right"></i></a></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 portfolio-wrapper III_column" data-groups='["all","website"]'>
                        <div class="hs_service_main_box_wrapper">
                            <div>
                               <img src="images/kundali-dosh.jpg" width="100%">
                           </div>
                            <div class="hs_service_icon_cont_wrapper">
                                <h2>Kundli Dosha</h2>
                                <p>Proin gravida nibh vel velit auctor aliquet. Aenean .</p>
                                <h5><a href="#">Read More <i class="fa fa-long-arrow-right"></i></a></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 portfolio-wrapper III_column" data-groups='["all", "business"]'>
                        <div class="hs_service_main_box_wrapper">
                           <div>
                               <img src="images/muhurtha.jpg" width="100%">
                           </div>
                            <div class="hs_service_icon_cont_wrapper">
                                <h2>Fix Your Muhurtha</h2>
                                <p>Proin gravida nibh vel velit auctor aliquet. Aenean .</p>
                                <h5><a href="#">Read More <i class="fa fa-long-arrow-right"></i></a></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 portfolio-wrapper III_column" data-groups='["all","website"]'>
                        <div class="hs_service_main_box_wrapper">
                            <div>
                               <img src="images/Upanayana.jpg" width="100%">
                           </div>
                            <div class="hs_service_icon_cont_wrapper">
                                <h2>Upanayana</h2>
                                <p>Proin gravida nibh vel velit auctor aliquet. Aenean .</p>
                                <h5><a href="#">Read More <i class="fa fa-long-arrow-right"></i></a></h5>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
           
        </div> -->
  
<!-- hs testi slider wrapper Start -->
<?php if(!empty($customer_rating)) { ?>
    <div class="hs_testi_slider_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="hs_about_heading_main_wrapper">
                        <div class="hs_about_heading_wrapper text-center">
                            <h2>What clients <span> are saying</span></h2>
                            <h4><span></span></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="hs_testi_slider_wrapper">
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="row">
                                    <?php
                                        $i = 1;
                                        foreach($customer_rating as $key => $value) { 
                                            if($i%2 != 0) {
                                    ?>
                                    
                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                        <div class="hs_testi_cont_main_wrapper">
                                            <div class="hs_testi_cont_inner_wrapper">
                                                <div class="hs_testi_quote_wrapper">
                                                    <i class="fa fa-quote-left"></i>
                                                </div>
                                                <div class="hs_testi_quote_cont_wrapper">
                                                    <p><?= !empty($value->comment)?$value->comment:""; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hs_testi_client_main_wrapper">
                                            <div class="hs_testi_client_cont_sec">
                                                <h2><?= !empty($value->customer_name)?$value->customer_name:""; ?></h2>
                                               
                                            </div>
                                            <div class="hs_testi_client_cont_img_sec">
                                                <!--<img src="<?php echo base_url();?>shri-purohit-website/images/content/testi_client_img1.jpg" alt="testi_img" />-->
                                                <img src="<?= base_url(!empty($value->customer_photo)?'upload/customer_profile/'.$value->customer_photo:"shri-purohit-website/images/content/testi_client_img1.jpg"); ?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <?php } else { ?>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-2 hidden-xs">
                                        <div class="hs_testi_cont_main_wrapper hs_testi_cont_main_right_wrapper">
                                            <div class="hs_testi_cont_inner_wrapper">
                                                <div class="hs_testi_quote_wrapper">
                                                    <i class="fa fa-quote-left"></i>
                                                </div>
                                                <div class="hs_testi_quote_cont_wrapper">
                                                    <p><?= !empty($value->comment)?$value->comment:""; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hs_testi_client_main_wrapper hs_testi_client_main_right_wrapper">
                                            <div class="hs_testi_client_cont_img_sec">
                                                <img src="<?= base_url(!empty($value->customer_photo)?'upload/customer_profile/'.$value->customer_photo:"shri-purohit-website/images/content/testi_client_img1.jpg"); ?>" alt="testi_img" />
                                            </div>
                                            <div class="hs_testi_client_cont_sec">
                                                <h2><?= !empty($value->customer_name)?$value->customer_name:""; ?></h2>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <?php } $i++; } ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- hs testi slider wrapper End -->

<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url();?>">
<?php include('application/views/front/section/footer.php'); ?>
    <script type="text/javascript" src="<?php echo base_url(); ?>AdminMedia/validations/front_validations/filter/js_filter.js"></script>
<script type="text/javascript">
    $(".homeLi").addClass("active");

// alert(id);
/*Start::get language city wise*/
     $('#cityid').on('change', function ()
    {


        var city_id = $(this).val();
// 
       if (city_id != '') {
        $('#language').html(''); 
      

            var base_url = $("#base_url").val();
            $.ajax({
                type: "post",
                data: {city_id: city_id},
                url: base_url + "get-language",
                dataType: 'json',
                success: function (data)
                {
                 //alert(JSON.stringify(data));
               
                    if (data != "") {
                     
                        var html='';
                        if(data!=""){
                          html +=('<option value="">Select</option>');
                        $.each( data, function( key, value ){
                              html +=('<option value="'+value.pk_id+'">'+value.language.charAt(0).toUpperCase()+value.language.slice(1)+'</option>');
                          });
                        }
                        $('#language').html(html); 
                     } else {
                      $('#language').html('<option value="">Select</option>'); 
                        
                    }

                }

            });
            
        } 
     });
/*End::get language city wise*/

</script>
<script>
function reset_options() {
    document.getElementById('cityid').options.length = 0;
    document.getElementById('language').options.length = 0;
    return true;
}

</script>
</body>
</html>