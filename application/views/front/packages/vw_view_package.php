
<?php include('application/views/front/section/header.php');


 ?>  
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
<body>
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url('<?php echo base_url('shri-purohit-website/images/horoscope-blog-banner.jpg'); ?>');" data-aos="fade">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-12">
             <div class="d-flex">
              <div class="content-box">
               <div class="image-box">
              <?php $imgdata = !empty($package_list[0]['pooja_image'])? 'upload/admin/pooja/'.$package_list[0]['pooja_image']: 'AdminMedia/images/default.png' ?>
                 <img src="<?php echo base_url($imgdata);?>">
               </div>
                <div class="title-box">
                  <h3><b><?php echo !empty($package_list[0]['pooja_name'])? ucwords($package_list[0]['pooja_name']):'';?></b></h3>
                   <ul class="d-flex-only rating-sec" >
                        <ul>
                          <?php if (!empty($pooja_total_rating)) {?>
                       
                  
                          <?php if(!empty($pooja_total_rating) && $pooja_total_rating >="1" && $pooja_total_rating <"2"){  ?> 
                           <li><i class="fa fa-star filled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                           <?php if(!empty($pooja_total_rating) && $pooja_total_rating >"1" && $pooja_total_rating< "2"){  ?> 
                             <li><i class="fa fa-star filled"></i></li>
                             <li><i style="color:#ff9900 !important" class="fa fa-star-half-full"></i></li>                       
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                           <?php if(!empty($pooja_total_rating) && $pooja_total_rating=="2"){  ?> 
                             <li><i class="fa fa-star filled"></i></li>
                             <li><i class="fa fa-star filled"></i></li>         
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                           <?php if(!empty($pooja_total_rating) && $pooja_total_rating>"2" && $pooja_total_rating<"3"){  ?> 
                             <li><i class="fa fa-star filled"></i></li>
                             <li><i class="fa fa-star filled"></i></li>         
                           <li><i style="color:#ff9900 !important" class="fa fa-star-half-full"></i></li> 
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                           <?php if(!empty($pooja_total_rating) && $pooja_total_rating=="3"){  ?>
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>         
                              <li><i class="fa fa-star filled"></i></li> 
                              <li><i class="fa fa-star unfilled"></i></li>
                              <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                          <?php if(!empty($pooja_total_rating) && $pooja_total_rating>"3" && $pooja_total_rating<"4"){ ?> 
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>         
                              <li><i style="color:#ff9900 !important" class="fa fa-star-half-full"></i></li> 
                            <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                           <?php if(!empty($pooja_total_rating) && $pooja_total_rating=="4"){ ?> 
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>         
                              <li><i class="fa fa-star filled"></i></li>
                            <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                           <?php if(!empty($pooja_total_rating) && $pooja_total_rating>"4" && $pooja_total_rating<"5"){ ?> 
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>         
                              <li><i class="fa fa-star filled"></i></li>
                            <li><i style="color:#ff9900 !important" class="fa fa-star-half-full"></i></li> 
                           <?php }?>
                           <?php if(!empty($pooja_total_rating) && $pooja_total_rating=="5" || $pooja_total_rating >"5"){ ?> 
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>         
                              <li><i class="fa fa-star filled"></i></li>
                           <li><i class="fa fa-star filled"></i></li>
                           <?php }?>
                         <?php }else{?>
                                <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                         <?php }?>

                         </ul>
 
                    <li><p><?=  substr($pooja_total_rating,0,1); ?><?=  substr($pooja_total_rating,1,2); ?>  ( <?php echo !empty($totalcount)? $totalcount:'0';?> Reviews )</p></li>
                    <li><p></p></li>
                  </ul>
                </div>
              </div>
              
                <div class="button-box">
                  
                  <!--   <a href="<?php echo base_url();?>front-services-view/<?php echo !empty($package_list[0]['fk_pooja'])? $package_list[0]['fk_pooja']:'';?>" class=""><button class="btn btn-success"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</button></a> -->
                     <a href="<?php echo $this->input->get('redirect2'); ?>" class=""><button class="btn btn-success"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</button></a>
                    
          
                </div>
             </div>
          </div>
        </div>
    </div>  
  </div>  

    <div class="site-section pos-re">
      <div class="container">
 <!-- <form action="" method="post" name="razorpay-form" id="razorpay-form"> -->

    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url();?>">
    <input type="hidden" name="package_id_name" id="package_id">
    <input type="hidden" name="pooja_id_name" id="pooja_id">
    <input type="hidden" name="tax_post" id="tax_post"> 
    <input type="hidden" name="package_sum" id="package_sum">
    <input type="hidden" name="customer_id" id="customer_id" value="<?php echo !empty($this->session->userdata('CTMRPKID'))?$this->session->userdata('CTMRPKID'):'' ?>">
    <input type="hidden" name="customer_name" id="customer_name" value="<?php echo !empty($this->session->userdata('CTMRNAME'))?$this->session->userdata('CTMRNAME'):'' ?>">
    <input type="hidden" name="customer_email_id" id="customer_email_id" value="<?php echo !empty($this->session->userdata('CTMREMAIL'))?$this->session->userdata('CTMREMAIL'):'' ?>">
    <input type="hidden" name="customer_mob" id="customer_mob" value="<?php echo !empty($this->session->userdata('CTMRMOBILE'))?$this->session->userdata('CTMRMOBILE'):'' ?>">



 
        <div class="row">
           
          <div class="col-lg-8">
               
            <div class="mb-3"><h6><b>Select Your Package</b></h6></div>
            
            
            <div class="hs_about_right_cont_wrapper mt-0">
               
              <?php  $a='a';
                if (!empty($package_list)) {
               foreach ($package_list as $key => $value) {
// print_r($_SESSION['CTMRPKID']);die();
                ?>
          
               
                <div class="package-details mb-3">
                  <div class="row">
                    
                    <div class="col-md-12">
                      <div class="border-bottm"><h6><b>Package: (<?php echo !empty($value['package'])? ucwords($value['package']):'';?>)</b></h6></div>
                    </div>
                    
                    <div class="col-md-6">
                      <div class="one-sec">
                        
                      <h6><b>Procedure involved :</b></h6>
                    <?php echo !empty($value['description'])?$value['description']:'';?>
                      </div>
                    </div>
                    
                    
                      <div class="col-md-3">
                      <div class="one-sec">
                        <h6><b>Purohit Dakshina & Puja Material</b></h6>
                      <ul class="service-list">
                     <?php    //if (!empty($value['inclusive'])) {
                    //foreach ($value['inclusive'] as $key => $row) {?>
                        <!-- <li><i class="fa fa-check text-success" aria-hidden="true"></i> <?php //echo !empty($row['service_name'])? ucwords($row['service_name']):'';?></li> -->
                <?php //}}?>
                      </ul>
                      </div>
                    </div>
                    
                    
                    
                      <div class="col-md-3">
                      <div class="two-sec excls">
                       
                        <h6><b>Additional Services</b></h6>
                      <ul class="service-list">
                           <?php  $sum_exclusive_charge=0; 
                            if (!empty($value['exclusive'])) {
                        foreach ($value['exclusive'] as $key => $row) {

                      $sum_exclusive_charge=$sum_exclusive_charge+$row['services_charges'];
                
                    
                

                          ?>
                        <li> <input  type="checkbox" name="exservices[]" id="<?php echo $a.'_'.$row['fk_services']?>" class="<?php echo $a ?>" data-service="<?php echo !empty($row['services_charges'])? $row['services_charges']:'';?>" value="<?php echo !empty($row['fk_services'])? $row['fk_services']:'';?>"> <?php echo !empty($row['service_name'])? ucwords($row['service_name']):'';?> (<?php echo !empty($row['services_charges'])? 'Rs.'.$row['services_charges']:'';?>)</li>
                       
                          <?php }}?>
                      </ul>
                      
                     
                       <div class="mt-3">
                        <input type="hidden" name="package_charge" id="<?php echo $a ?>" value="<?php echo !empty($value['package_charges'])? $value['package_charges']:'';?>">
                    
                   
                

                           <h6><b id="<?php echo $a ?>_amt"><?php echo !empty($value['package_charges'])? 'Rs.'.$value['package_charges']:'';?></b></h6>

                               
                             
                          <div class=" btn btn-basic btncolor" id="btncolor_<?php echo $a ?>"  data-toggle="modal" data-target="#logregreqModal">
                          <input type="radio"  data-price="<?php echo $value['package_charges'];?>" name="selectbtn" id="<?php echo $a ?>_radio" 
                            data-package_id='<?php echo !empty($value['pk_id'])? $value['pk_id']:'';?>' data-pooja_id='<?php echo !empty($value['fk_pooja'])? $value['fk_pooja']:'';?>'  data-pkgname='<?php echo !empty($value['package'])? ucwords($value['package']):'';?>'  data-language='<?php echo !empty($value['language'])? $value['language']:'';?>' data-puja-name='<?php echo !empty($value['pooja_name'])? ucwords($value['pooja_name']):'';?>'
                            data-tax='<?php echo !empty($value['tax'])? $value['tax']:'';?>'
                                class="<?php echo $a ?>" >
                          <span id="selected_<?php echo $a ?>" class="selected">Select</span>
                                
                         </div>
                         
                       </div>
                      </div>
                    </div>
                 
                </div>
                </div>
                
            <?php $a++; }}?>
              
            
            
        <div for="selectbtn" generated="true" class="error"></div>
        <p id="package_error" class="error"></p>
            <div class="hs_about_right_cont_wrapper mt-0">
                <div class="package-details mb-3">
                  <div class="mb-3 ttl-color"><h6><b> Date & Time Requirements</b></h6></div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <input type="radio" name="" checked=""> <span>Select date for Puja</span>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <div class="input-group date" data-date-format="dd.mm.yyyy" id="fromdate">
                           <input type="text"  name="poojadate" id="poojadate" class="form-control test" placeholder="dd-mm-yyyy" autocomplete="off" readonly >
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                        </div>
                        <div for="poojadate" generated="true" class="error poojadateerror"></div>
                        <p id="date_error" class="error"></p>
                      </div>
                    </div>
                   </div>

                    <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <span>Time preference</span>
                      </div>
                    </div>
                    <div class="col-md-4 sm-contro">
                      <div class="form-group">  
                        <div class="input-group time">
                            <input type="text" class="form-control" id="timepicker" name="poojatime">
                            <span class="input-group-addon">
                            <span class="fa fa-clock-o"></span>
                            </span>
                        </div>
                        <div for="poojatime" generated="true" class="error"></div>
                        <p id="time_error" class="error"></p>
                      </div>
                    </div>
                    <div class="col-md-4 form-group sm-contro">
                     
                    </div>
                       <div class="col-md-3">
                      <div class="form-group">
                        <span>Detail Address</span>
                      </div>
                    </div>
                    <div class="col-md-9 form-group sm-contro textarea">
                      <?php if (empty($customer_pooja_address_details)) {?>
                      <textarea class="form-control" rows="5" name="address" id="address" placeholder="Flat no.wing, society or house number" ></textarea>
                       <?php }else{?>
                         <textarea class="form-control" rows="5" name="address" id="address" placeholder="Plate no.wing, society or house number"><?php echo !empty($customer_pooja_address_details[0]['pooja_address'])?$customer_pooja_address_details[0]['pooja_address']:'' ?></textarea>
                        <?php }?>
                        <p id="address_error" class="error"></p>
                    </div>
                    
                    <div class="col-md-3">
                      <div class="form-group">
                        <span>Location</span>
                      </div>
                    </div>
                    <div class="col-md-9 form-group sm-contro">
                      <?php if (empty($customer_pooja_address_details)) {?>
                   
                      <input type="text" name="event_location" class="form-control" id="event_location"  placeholder="Enter a area"  value="<?php echo !empty($customer_address_details[0]['customer_address'])?$customer_address_details[0]['customer_address']:'' ?>">

                    <input type="hidden" class="form-control" name="event_city" id="event_city" autocomplete="off" value="<?php echo !empty($customer_address_details[0]['customer_city'])?$customer_address_details[0]['customer_city']:'' ?>">
                  <?php }else{?>
                  <input type="text" name="event_location" class="form-control" id="event_location"  placeholder="Enter a area"  value="<?php echo !empty($customer_pooja_address_details[0]['pooja_area'])?$customer_pooja_address_details[0]['pooja_area']:'' ?>">

                    <input type="hidden" class="form-control" name="event_city" id="event_city" autocomplete="off" value="<?php echo !empty($customer_pooja_address_details[0]['pooja_city'])?$customer_pooja_address_details[0]['pooja_city']:'' ?>">
                    

                  <?php }?>
                  <p id="area_error" class="error"></p>
                    </div>

                   
                 
                   </div>


                </div>
                

                  </div>
              

                  </div>
                </div>
                <div class="col-md-4">
                    <div class="left-container">
                   <div class="mb-3"><h6><b>Order Summary</b></h6></div>
                   <div class="package-details mb-3">
                  <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                          <table class="table summary-table">
                            <tr>
                              <th width="35%">City</th><td><span id="poojacity_set">-</span></td>
                            </tr>
                         <!--       <tr>
                              <th>Puja Location</th><td><span id="poojalocation_set">-</span></td>
                            </tr>   -->
                             <tr>
                              <th width="35%">Priest Preference</th><td><span id="languageset">-</span></td>
                            </tr>
                             <tr>
                              <th>Puja Name</th><td><span id="pooja_nameset">-</span></td>
                            </tr> 
                             <tr>
                              <th width="35%">Package Name</th><td><span id="pkgnameset">-</span></td>
                            </tr>
                           
                             
                          </table>
                             <hr>  
                        </div>
                        <div class="mt-1">
                          <form>
                          <div class="row">
                            <div class="col-md-12">
                              <div>
                                <label><b>Total Amount</b>  <span id="pkgcharge">-</span></label>
                              </div>
                            </div>
                            <?php if (!empty($package_list[0]['tax'])) {?>
                           
                            <div class="col-md-12">
                              <div class="form-group">
                                <label><b>Tax Included Amount</b> <span id="taxset">-</span></label>
                              </div>
                            </div> 
                          <?php }?>
                           
                        <!--     <div class="col-md-12">
                              <p>Advance Amount : <b><span id="advamount">-</span></b></p>
                              <p>* Remaining Amount <b><span id="remainingamt">-</span></b> Pay To Purohit</p>
                              
                            </div> -->
                          </div>
                          </form>
                        </div>
                        <?php if (!empty($this->session->userdata('CTMRPKID'))) {?>
                       
                         <button class=" btn btn-success buy_now" id="submit-pay" type="submit"> Make Payment <i class="fa fa-chevron-right"> </i></button>
                           <?php }?>
                    
                        </div>
                      </div>
                     </div>
                  </div>
                </div>
                </div>

                  <!-- </form> -->
              </div>
            </div>
          </div>
      <?php if (empty($this->session->userdata('CTMRPKID'))) {
        $current_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        ?>
          <!-- Modal -->
      <div class="modal fade" id="logregreqModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Login / Registration Required</h4>
            </div>
            <div class="modal-body">
              <p>Please login with your registered email id & password to continue the payment process. In case of new User, please register first and then make payment.</p>
            <div class="col-md-12 col-sm-12 no-pad">
                <a href="<?php echo base_url();?>front-customer-login?pkg=<?php echo $current_link ?>"><button type="button" class="btn btn-success btn-logn">Login</button></a>
                <a href="<?php echo base_url();?>front-customer-register?pkg=<?php echo $current_link ?>"><button type="button" class="btn btn-primary btn-rgstr">Register</button></a>
            </div>
            </div>
           </div>
        </div>
    </div>
    <!-- Modal End -->
  <?php }?>
</body>
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
                $("#poojacity_set").html(val.long_name);
         
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
 <script type="text/javascript" src="<?php echo base_url(); ?>AdminMedia/validations/front_validations/package/js_package.js"></script>
 <script type="text/javascript">
   $('.nav-tabs-responsive').on('click', 'li', function() {
      $('li.active').removeClass('active');
      $(this).addClass('active');
});
 </script>
 <script type="text/javascript">
        $(".serviceLi").addClass("active");
    </script>

    <script type="text/javascript">

 
      var nowDate = new Date();
        // alert(nowDate);

  var next_date = new Date(nowDate.setDate(nowDate.getDate() + 3));
      // alert(next_date);
       $('#fromdate').datepicker(
      { 
        format: "dd-mm-yyyy",   
        autoclose:true,     
        todayHighlight: true,
        startDate: next_date,
        // maxDate: "+5",
        // minDate: -0
      });
      
       $("#timepicker").timepicker({
           format: "LT",
           icons: {
             up: "fa fa-chevron-up",
             down: "fa fa-chevron-down"
           }
       });
       
       



    </script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<!-- <script src="https://checkout.razorpay.com/v1/checkout.js"></script> -->
</body>
</html>