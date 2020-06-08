<?php include('application/views/front/section/header.php'); ?>
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
        <div class="row">




        <div class="col-lg-3"> <!-- required for floating -->
          <!-- Nav tabs -->
          <ul class="nav nav-tabs tabs-left sideways">
            <li class="active"><a href="<?php echo base_url();?>front-customer-profile" >My Profile</a></li>
            <li><a href="<?php echo base_url();?>front-my-booking">My Bookings</a></li>
            <li><a href="<?php echo base_url();?>front-my-setting">Settings</a></li>
            <li><a href="<?php echo base_url();?>front-customer-logout">Log Out</a></li>
          </ul>
        </div>

        <div class="col-lg-9">
          <!-- Tab panes -->
              <div class="MessageHide">
                              <?php
                              if (!empty($this->session->userdata('msg'))) {
                            echo $this->session->userdata('msg');
                            $this->session->unset_userdata('msg');
                              }
                              ?>
                          </div>
          <div class="tab-content-order">
              <div class="row">
                <div class="col-md-3">
                  <img src="<?php echo base_url(); ?><?php echo !empty($customer_details[0]['customer_photo']) ? 'upload/customer_profile/'.$customer_details[0]['customer_photo'] :  'shri-purohit-website/images/avatar1.png'; ?>" width="100%">
                </div>
                <div class="col-md-9">
                  <div class="profile-content">
                    <h6><b><?php echo !empty($customer_details[0]['customer_name']) ? ucwords($customer_details[0]['customer_name']):'-'?></b> <small><?php echo !empty($customer_details[0]['customer_address']) ? ucwords($customer_details[0]['customer_address']):''?></small></h6>
                    <p><?php echo !empty($customer_details[0]['customer_mobile_no']) ?$customer_details[0]['customer_mobile_no']:''?></p>
                    <p><?php echo !empty($customer_details[0]['customer_email_id']) ? strtolower($customer_details[0]['customer_email_id']):''?></p>
<!--                     <p class="mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p> -->
                    <a href="#" class="hide"><button class="btn btn-success mt-3">Edit Profile</button></a>
                  </div>
                </div>
              </div> <!-- row --> 
            </div>

           
            <div class="tab-content edit_profile_block tab-content-order">
              <div class="edit_profile_button_content">
                
                    <form action="<?php echo base_url();?>front-customer-profile-action" method="post" name="customerfrm" id="customerfrm" enctype="multipart/form-data">
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label for="inputEmail4">Name</label>
                          <input type="text" class="form-control isAlpha" id="name" name="name" value="<?php echo !empty($customer_details[0]['customer_name'])?$customer_details[0]['customer_name']:'' ?>" autocomplete="off">
                        </div> <!-- col-6 --> 

                        <div class="form-group col-md-6"></div>   <!-- col-6 --> 

                        <div class="form-group col-md-6">
                          <label for="inputEmail4">Email</label>
                          <input type="email" class="form-control" id="email" name="email" value="<?php echo !empty($customer_details[0]['customer_email_id'])?$customer_details[0]['customer_email_id']:'' ?>" autocomplete="off" readonly>
                        </div> <!-- col-6 --> 

                        <div class="form-group col-md-6">
                          <label for="inputEmail4">Mobile No.</label>
                          <input type="text" class="form-control isInteger" id="mobileno" name="mobileno" value="<?php echo !empty($customer_details[0]['customer_mobile_no'])?$customer_details[0]['customer_mobile_no']:'' ?>" autocomplete="off">
                        </div> <!-- col-6 --> 

                        <div class="form-group col-md-6">
                          <label for="inputEmail4">Address</label>
                    
                        <input type="text" name="event_location" class="form-control" id="event_location" placeholder="Enter a address" autocomplete="off" onFocus="fillInAddress()" value="<?php echo !empty($customer_details[0]['customer_address'])?$customer_details[0]['customer_address']:'' ?>">
                        </div> <!-- col-6 --> 

                        <div class="col-md-6">
                          <div class="col-md-12 no-pad form-group">
                            <label for="inputEmail4">City</label>
                    
                       <input type="text" class="form-control" name="event_city" id="event_city" autocomplete="off" readonly value="<?php echo !empty($customer_details[0]['customer_city'])?$customer_details[0]['customer_city']:'' ?>">
                          </div>
                        </div>


                          <div class="col-md-6 form-group">
                            <label for="inputEmail4">Pincode</label>
                            <input type="text" class="form-control isInteger" id="pincode" name="pincode"  value="<?php echo !empty($customer_details[0]['customer_pincode'])?$customer_details[0]['customer_pincode']:'' ?>" autocomplete="off" maxlength='6' minlength='6'>
                          </div>
                       

                        <div class="form-group col-md-6">
                          <label for="inputEmail4">Profile Photo</label><br>
                              <input type="file" name="uploadphoto" id="uploadphoto" />
                            <input type="hidden" name="oldimg1" id="oldimg1" value="<?php echo !empty($customer_details[0]['customer_photo'])?$customer_details[0]['customer_photo']:'' ?>">
                      

                        </div> <!-- col-6 --> 
                        <div class="form-group col-md-12">
                         <button class="btn btn-success mt-3" type="submit">Save Detail</button>
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

    
<?php include('application/views/front/section/footer.php'); ?>
    <script type="text/javascript" src="<?php echo base_url(); ?>AdminMedia/validations/front_validations/customer_reg_profile/js_customer_reg_profile.js">    </script>
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



 
       // $('#event_city').prop('readonly',true);
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
        // $('#event_city').prop('readonly',false);
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
                  // $('#event_city').prop('readonly',true);
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
   <script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>

    
 
    </script>


  </body>
</html>