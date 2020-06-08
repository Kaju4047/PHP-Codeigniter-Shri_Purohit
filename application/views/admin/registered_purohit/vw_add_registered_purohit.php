<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content-header">
      <h1>
         Add Registered Purohit 
         <div class="pull-right">
            <a href="<?php echo base_url(); ?>admin/registered-purohit-list"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back </button></a>
         </div>
      </h1>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="col-md-12 no-mob-pad no-pad">
         <div class="box box-primary">
            <div class="box-body">
            <form method="post" id="add_registered_purohit" action="<?php echo base_url()?>admin/add-registered-purohit-action" enctype="multipart/form-data">
              <input type="hidden" name="txtid" id="txtid" value="<?php echo (!empty($edit['pk_id']) ? $edit['pk_id'] : ''); ?>" class="form-control">
              <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>" class="form-control">
              <input type="hidden" name="doc_fileold" id="doc_fileold" value="<?php echo (!empty($edit['pk_id']) ? $edit['pk_id'] : ''); ?>" class="form-control">
              <input type="hidden" name="profile_fileold" id="profile_fileold" value="<?php echo (!empty($edit['pk_id']) ? $edit['pk_id'] : ''); ?>" class="form-control">
              <div class="col-md-9">
               <div class="col-md-4 form-group">
                  <label>First Name<span style="color: red">*</span></label>
                  <input type="text" class="form-control" name="first_name" value="<?php echo !empty($edit['first_name'])?$edit['first_name']: ''; ?>" autocomplete="off">
               </div>
               <div class="col-md-4 form-group">
                  <label>Middle Name</label>
                  <input type="text" class="form-control" name="middle_name" value="<?php echo !empty($edit['middle_name'])?$edit['middle_name']:''; ?>" autocomplete="off">
               </div>
               <div class="col-md-4 form-group">
                  <label>Last Name<span style="color: red">*</span></label>
                  <input type="text" class="form-control" name="last_name" value="<?php echo !empty($edit['last_name'])?$edit['last_name']:''; ?>" autocomplete="off">
               </div>
               <div class="col-md-4 form-group">
                  <label>Mobile No.<span style="color: red">*</span></label>
                  <input type="text" class="form-control" name="mobile_no" value="<?php echo !empty($edit['mobile_no'])?$edit['mobile_no']:''; ?>" autocomplete="off">
                  <?= form_error('mobile_no', "<p class='text-danger'>", "</p>"); ?>
               </div>
               <div class="col-md-4 form-group">
                  <label>Alternate Mobile No.</label>
                  <input type="text" class="form-control" name="alter_mobile_no" value="<?php echo !empty($edit['alternate_mobile_no'])?$edit['alternate_mobile_no']:''; ?>" autocomplete="off">
               </div>
               <div class="col-md-4 form-group">
                  <label>Email Id<span style="color: red">*</span></label>
                  <input type="text" class="form-control" name="email_id" value="<?php echo !empty($edit['email_id'])?$edit['email_id']:''; ?>" autocomplete="off">
               </div>
               <div class="col-md-4 form-group">
                  <label>Date of Birth<span style="color: red">*</span></label>
                  <div class="input-group date" data-date-format="dd.mm.yyyy">
                     <input type="text" id="dob" name="dob" class="form-control" placeholder="dd-mm-yyyy" value="<?php echo !empty($edit['user_dob'])?date('d-m-Y', strtotime($edit['user_dob'])):''; ?>" autocomplete="off">
                     <div class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                     </div>
                  </div>
                  <div for="dob" generated="true" class="error"></div>
               </div>
               <div class="col-md-8 form-group">
                  <label>Address<span style="color: red">*</span></label>
                  <textarea rows="2" name="address" class="form-control" style="resize: none;"><?php echo !empty($edit['address'])?$edit['address']:''; ?></textarea>
               </div>
               <div class="clearfix"></div>
               <div class="col-md-4 form-group">
                  <label>State<span style="color: red">*</span></label>
                   <select class="form-control" id="state" name="state" style="color: #555" onchange="getCity(this);">
                        <option value="" selected disabled>Select State</option>
                        <?php if (!empty($stateList)) {
                            // print_r($stateList);
                           foreach ($stateList as $key => $value) { ?>

                           <option value="<?= $value->pk_id;?>"<?php echo ((!empty($edit['fk_state_id']) && $edit['fk_state_id'] == $value->pk_id) ? 'selected' : ''); ?>><?= ucfirst($value->state);?></option>
                        <?php }}?>                     
                    </select>
               </div>
               <div class="col-md-4 form-group">
                  <label>City<span style="color: red">*</span></label>
                  <select class="form-control" id="city" name="city" style="color: #555">
                        <option value="" selected disabled>Select City</option>
                 <?php if (!empty($city)) {
                           foreach ($city as $key => $value) { ?>
                           <option value="<?= $value['pk_id'];?>"<?php echo ((!empty($edit['fk_city_id']) && $edit['fk_city_id'] == $value['pk_id']) ? 'selected' : ''); ?>><?= ucfirst($value['city']);?></option>
                        <?php }}?>                   
                    </select>
               </div>
               <div class="col-md-4 form-group">
                  <label>Area</label>
                  <input type="text" class="form-control" name="area" value="<?php echo !empty($edit['location'])?$edit['location']:''; ?>" autocomplete="off">
               </div>
               <div class="clearfix"></div>
               <div class="col-md-4 form-group">
                  <label>Pathshala / Gurukul Name<span style="color: red">*</span></label>
                  <input type="text" class="form-control" name="gurukul_name" id="gurukul_name" value="<?php echo !empty($edit['pathshala_gurukul_name'])?$edit['pathshala_gurukul_name']:''; ?>" autocomplete="off">
               </div>
               
               <div class="col-md-4 form-group">
                  <label>Experience In Years<span style="color: red">*</span></label>
                  <input type="text" class="form-control" name="experience" value="<?php echo !empty($edit['exp_years'])?$edit['exp_years']:''; ?>" autocomplete="off">
               </div>
                <div class="col-md-4 form-group">
                  <label>Language Known<span style="color: red">*</span></label>
                  <select class="form-control testSelAll2" id="language" name="language[]" multiple="multiple" style="color: #555" onchange="console.log($(this).children(':selected').length)">
                        <!-- <option value="" >Select Language</option> -->
                        <?php if (!empty($languageList)) {
                           foreach ($languageList as $key => $value) { 
                              $selected = (in_array($value->pk_id, $languageDetails)) ? "selected=''" : "";
                        ?>
                           <option value="<?= $value->pk_id;?>"<?php echo $selected; ?>><?= ucfirst($value->language);?></option>
                        <?php }}?>                     
                  </select>
                  <div for="language" generated="true" class="error"></div>
               </div>                                
               <div class="clearfix"></div>

               <div class="col-md-12"> <h4>Bank Details</h4></div>
               
               <div class="row">
               <div class="col-md-4 form-group">
                  <label>Bank Name<span style="color: red">*</span></label>
                  <input type="text" class="form-control" name="bank_name" value="<?php echo !empty($edit['bank_name'])?$edit['bank_name']:''; ?>" autocomplete="off">
               </div>

               <div class="col-md-4 form-group">
                  <label>IFSC Code<span style="color: red">*</span></label>
                  <input type="text" class="form-control" name="ifsc_code" value="<?php echo !empty($edit['ifsc_code'])?$edit['ifsc_code']:''; ?>" autocomplete="off">
               </div>

               <div class="col-md-4 form-group">
                  <label>Branch Name<span style="color: red">*</span></label>
                  <input type="text" class="form-control" name="branch_name" value="<?php echo !empty($edit['branch_name'])?$edit['branch_name']:''; ?>" autocomplete="off">
               </div>

                </div>
                
                <div class="row">
               <div class="col-md-4 form-group">
                  <label>Account Holder Name<span style="color: red">*</span></label>
                  <input type="text" class="form-control" name="holder_name" value="<?php echo !empty($edit['account_holder_name'])?$edit['account_holder_name']:''; ?>" autocomplete="off"> 
               </div>

               <div class="col-md-4 form-group">
                  <label>Account Number<span style="color: red">*</span></label>
                  <input type="text" class="form-control" name="account_number" id="account_number" value="<?php echo !empty($edit['account_number'])?$edit['account_number']:''; ?>" autocomplete="off">
               </div>             
               
               </div>
               
               <div class="clearfix"></div>
               <div class="col-md-12 mg-top-10 form-group">          
                  <button type="submit" id="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
                  <!-- <button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancel</button> -->
                      <a href="<?php echo base_url(); ?>admin/add-registered-purohit" ><button type="button"  class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancel</button></a>
               </div>
             </div>
             <div class="col-md-3">
               <div class="col-md-12 no-pad form-group">
                  <label>Upload Certificate Image</label>
                  <input type="hidden" class="form-control"   name="certificate_image_fileold" value="<?php echo !empty($edit['upload_certificate_image'])?$edit['upload_certificate_image']:''; ?>">
                  
                  <?php $imgdata = !empty($edit['upload_certificate_image']) ? 'uploads/registered_purohit/certificate_image/' . $edit['upload_certificate_image'] : 'AdminMedia/images/default.png'; ?>

                  <input type="file" class="form-control"  onchange="upcertimg(this);" name="certificate_image">
                  <!-- <img id="imgcert" src="<?php echo base_url(). $imgdata;?>" class="poj-up-img"> -->
               </div>
               <div class="col-md-12 no-pad form-group">
                  <label>Upload Profile Image<span style="color: red">*</span></label>
                  <input type="hidden" class="form-control"   name="profile_image_fileold" value="<?php echo !empty($edit['upload_profile_image'])?$edit['upload_profile_image']:''; ?>">
                    <?php $imgdata = !empty($edit['upload_profile_image']) ? 'upload/android/registartion/purohit_profile/' . $edit['upload_profile_image'] : 'AdminMedia/images/default.png'; ?>
                  <input type="file" class="form-control" onchange="upprofimg(this);" name="profile_image">
                  <img id="imgprof" src="<?php echo base_url().$imgdata; ?>" class="poj-up-img">
               </div>
             </div>
            </form> 
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
   </section>
</div>
<!-- End .content-wrapper -->
<!-- START:: Footer -->
<?php include("application/views/admin/section/vw_footer.php"); ?>
<!-- END:: Footer -->
<script type="text/javascript" src="<?php echo base_url('AdminMedia/validations/js_registered_purohit/registered_purohit.js'); ?>"></script>
<script>
   $(".regpurohitLi").addClass("active");


    var date = new Date();
    
  $('#dob').datepicker(
  { 
     format: "dd-mm-yyyy",   
     autoclose:true,     
     //todayHighlight: true
     setDate: "21-12-1996"
  });


   window.testSelAll2 = $('.testSelAll2').SumoSelect({selectAll:true, search:true, placeholder:'Select'});

   function upcertimg(input)
    {
        if (input.files && input.files[0]) {
        var reader = new FileReader();
 
        reader.onload = function (e) {
            $('#imgcert').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
        }
    }

    function upprofimg(input)
    {
        if (input.files && input.files[0]) {
        var reader = new FileReader();
 
        reader.onload = function (e) {
            $('#imgprof').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
        }
    }
    function getCity(Id) {
     // alert($(this.val(Id));
        // $("#city").val('');
        var state = $("#state option:selected").val();
        // alert(state);  
        var base_url = "<?php echo base_url(); ?>";
        $.ajax({
            type: "POST",
            data: {Id: state},
            url: base_url + "admin/registered_purohit/Cn_registered_purohit/getCityById",
            dataType: 'json',
 
            success: function (data){
               // alert(JSON.stringify(data));
                var html='';
                html +=('<option value="">Select</option>');
                if(data!=""){
                $.each( data, function( key, value ){
                    html +=('<option value="'+value.pk_id+'">'+value.city.charAt(0).toUpperCase()+value.city.slice(1)+'</option>');
                });
                }
                $('#city').html(html); 
                $('#city').css('textTransform', 'capitalize');
            }
        });                                      
    }
    
    
    $(function() {
  var regExp = /[a-z]/i;
  $('#account_number').on('keydown keyup', function(e) {
    var value = String.fromCharCode(e.which) || e.key;

    // No letters
    if (regExp.test(value)) {
      e.preventDefault();
      return false;
    }
  });
});
</script>
</body>
</html>