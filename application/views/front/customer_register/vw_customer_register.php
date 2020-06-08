<?php include('application/views/front/section/header.php'); ?>
    <!-- <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/horoscope-blog-banner.jpg);" data-aos="fade">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-12">
             <div class="d-flex">
              <div class="content-box">
                <div class="title-box ml-0">
                  <h3><b>Register Here</b></h3>
                  <ul class="flex text-white">
                    <li><a href="index.php">Home /</a> </li>
                    <li>Register</li>
                  </ul>
                </div>
              </div>
             </div>
          </div>
        </div>
    </div>  
  </div> -->
<style type="text/css">
  .error {
    color: red;
    margin-bottom: 0px;
    /* padding-bottom: 2px; */
    text-align: left;
    /* text-align: right; */
    padding-top: 2px;
}
</style>
    <div class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7"  data-aos="fade">

               <div class="MessageHide">
                              <?php
                              if (!empty($this->session->userdata('msg'))) {
                            echo $this->session->userdata('msg');
                            $this->session->unset_userdata('msg');
                              }
                              ?>
                          </div>

            <form action="<?php  echo base_url();?>customer-reg-action" class="p-5 bg-white box-shadow" method="post" name="customerfrm" id="customerfrm">
              <input type="hidden" name="login_redirect" value="<?php echo $this->input->get('pkg') ?>">

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="name">Name</label> 
                  <input type="text" id="name" class="form-control isAlpha" name="name" autocomplete="off">
                </div>
              </div>
              
              <div class="row form-group">
                
                <div class="col-md-6 col-12">
                  <label class="text-black" for="mobileno">Mobile No.</label> 
                  <input type="text" id="mobileno" class="form-control isInteger" name="mobileno" autocomplete="off">
                </div>
             
             
                
                <div class="col-md-6 col-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" id="email" class="form-control" name="email" autocomplete="off">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="password">Password</label> 
                  <input type="password" id="password" class="form-control" name="password" autocomplete="off">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="cnfirm_password">Re-type Password</label> 
                  <input type="password" id="cnfirm_password" class="form-control" name="cnfirm_password" autocomplete="off">
                </div>
              </div>
                 <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="subject">Address (Optional)</label> 
                    <input type="text" name="event_location" class="form-control" id="event_location" placeholder="" autocomplete="off" onFocus="fillInAddress()">
                </div>
              </div>
                <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="subject">City</label> 
                  <input type="text" class="form-control" name="event_city" id="event_city" autocomplete="off"></input>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-12">
                  <p>Have an account? <a href="<?php echo base_url();?>front-customer-login">Log In</a></p>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" class="btn btn-primary py-2 px-4 text-white submit " value="Sign In">
                </div>
              </div>

  
            </form>
          </div>
          
        </div>
      </div>
    </div>
  <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">   
<?php include('application/views/front/section/footer.php'); ?>
<script type="text/javascript">
  /*Start:: empty loaction when type manually */
       $("#event_location").change(function(){
          var cityval=$('#event_city').val(); 
           if (cityval=='') {
    $('#event_location').val('');
       }

    });
        /*End:: empty loaction when type manually */
     /*[START ::google address::]*/
       var placeSearch, autocomplete;
      var componentForm = {
        
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
        country: 'long_name',
        
      };
     google.maps.event.addDomListener(window, 'load', function () { 
        autocomplete = new google.maps.places.Autocomplete(
            (document.getElementById('event_location')),
            {types: ['geocode']});
        autocomplete.addListener('place_changed', fillInAddress);

      });
     

    $('body').on('focusout','input[name="event_location"]',function(){
      if (!is_selected) {
        $('#event_city').val('');
      }
     })

     var is_selected = false;


      function fillInAddress() {
        var is_selected = true;
        var place = autocomplete.getPlace();
       
         if(place!="")
        {

          var basic_addr="";
          if(place.address_components!=""){
            // alert(JSON.stringify(place.address_components));
            $.each( place.address_components, function( i, val ){
              
              if(val.types[0]=='country')
              {
                if(val.long_name!=''){
                $("#country").val(val.long_name);
                }
              }
              if(val.types[0]=='administrative_area_level_1')
              {

                if(val.long_name!=''){
                $("#state").val(val.long_name);
                }
              }
              if(val.types[0]=='locality')
              {
                if(val.long_name!=''){
                $("#event_city").val(val.long_name);
                }
              }
              
            });
          }
          
          
        }

       // alert(JSON.stringify(place));
        
        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          //alert(addressType);
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
           //alert(val);
            document.getElementById(addressType).value = val;
          }
        }
      }
      /*[END ::google address::]*/
</script>
 <script type="text/javascript" src="<?php echo base_url(); ?>AdminMedia/validations/front_validations/customer_reg_profile/js_customer_reg_profile.js"></script>
   <script type="text/javascript">
        $(".registerLi").addClass("active");
    </script>
  </body>
</html>