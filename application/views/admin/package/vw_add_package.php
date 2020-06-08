<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<style>
    .btn-add-more{
        margin-top:25px;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="height: auto;">
   <section class="content-header">
      <h1>
         Add Package 
         <div class="pull-right">
            <a href="<?php echo base_url(); ?>admin/package-list"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back </button></a>
         </div>
      </h1>
   </section>
   <!-- Main content -->
   <section class="content" >
      <div class="col-md-12 no-mob-pad no-pad">
         <div class="box box-primary">
            <form id="add_package" class="add_package" action="<?php echo base_url(); ?>admin/add-package-action" method='post'   enctype="multipart/form-data"> 
            <input type="hidden" name="txtid" id="txtid" value="<?php echo (!empty($edit['pk_id']) ? $edit['pk_id'] : ''); ?>" class="form-control">
            <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>" class="form-control">
            <input type="hidden" name="dropdown" id="dropdown" value="1" class="form-control">
            <div class="box-body">
                
                <div class="col-md-3 form-group">
                  <label>Language<span style="color: red">*</span></label>
                  <!-- <select class="form-control" id="category" name="category" style="color: #555">
                        <option  value="" selected disabled>Select Language</option>
                        <option>Hindi</option>
                        <option>Marathi</option>
                        <option>Gujarathi</option>
                    </select> -->
                    <select class="form-control" id="language" name="language" style="color: #555" onchange="getCategory(this);">
                        <option  value="" selected disabled>Select Language</option>
                        <?php if (!empty($languageDetails)) {
                           foreach ($languageDetails as $key => $value) { ?>
                           <option value="<?= $value['pk_id'];?>"<?php echo ((!empty($edit['fk_language']) && $edit['fk_language'] == $value['pk_id']) ? 'selected' : ''); ?>><?= ucfirst($value['language']);?></option>
                        <?php }}?>                     
                    </select>
               </div>
               <div class="clearfix"></div>
               <div class="col-md-3 form-group">
                  <label>Puja Category<span style="color: red">*</span></label>
                  <select class="form-control" id="category" name="category" style="color: #555" onchange="getPooja();">
                        <option  value="" selected disabled>Select Category</option>
                        <?php if (!empty($categoryDetails)) {
                           foreach ($categoryDetails as $key => $value) { ?>
                           <option value="<?= $value['pk_id'];?>"<?php echo ((!empty($edit['fk_category']) && $edit['fk_category'] == $value['pk_id']) ? 'selected' : ''); ?>><?= ucfirst($value['category']);?></option>
                        <?php }}?>                     
                    </select>
               </div>
               <div class="col-md-3 form-group">
                  <label>Puja <span style="color: red">*</span></label>
                  <select class="form-control" id="pooja" name="pooja" style="color: #555">
                        <option  value="" selected disabled>Select Category</option>
                        <?php if (!empty($poojaDetails)) {
                           foreach ($poojaDetails as $key => $value) { ?>
                           <option value="<?= $value['pk_id'];?>"<?php echo ((!empty($edit['fk_pooja']) && $edit['fk_pooja'] == $value['pk_id']) ? 'selected' : ''); ?>><?= ucfirst($value['pooja_name']);?></option>
                        <?php }}?>                     
                    </select>
               </div>
               <div class="clearfix"></div>
               <div class="col-md-3 form-group">
                  <label>Package</label>
                  <input type="text" class="form-control" name="package" id="package" value="<?php echo (!empty($edit['package']) ? $edit['package'] : ''); ?>" autocomplete="off">
               </div>
               <div class="col-md-3 form-group">
                  <label>Package Charges</label>
                  <div class="input-group">
                     <input type="text" class="form-control" name="package_charges" id="package_charges" value="<?php echo (!empty($edit['package_charges']) ? $edit['package_charges'] : ''); ?>" autocomplete="off">
                     <span class="input-group-addon" id="basic-addon2"><i class="fa fa-inr" aria-hidden="true"></i></span>
                  </div>
                    <div for="package_charges" generated="true" class="error"></div>
               </div>
               <div class="col-md-3 form-group">
                  <label>Purohit Percentage</label>
                  <div class="input-group">
                     <input type="text" class="form-control" name="purohit_percentage" id="purohit_percentage" value="<?php echo (!empty($edit['purohit_percentage']) ? $edit['purohit_percentage'] : ''); ?>" autocomplete="off">
                     <span class="input-group-addon" id="basic-addon2"><i class="fa fa-percent" aria-hidden="true"></i></span>
                  </div>
               <div for="purohit_percentage" generated="true" class="error"></div>
               </div>
               <div class="clearfix"></div>


                <div class="col-md-3 form-group">
                  <label>Purohit Dakshina & Puja Material</label>
                  <!--<input type="text" class="form-control" value="Purohit Dakshina & Puja Material" name="inclusive_services">-->
                  <!--<select name="inclusive_services[]" id="inclusive_services" multiple="multiple" onchange="console.log($(this).children(':selected').length)" class="testSelAll2 form-control sumoselect" style="color: #555;">-->

                  <?php
                //   if (!empty($serviceDetails)) {
                //      foreach ($serviceDetails as $key => $value) {
                //      $selected = (in_array($value['pk_id'], $inclusiveDetails)) ? "selected=''" : "";
                //      ?>
                      <option value="<?php //echo!empty($value['pk_id']) ? $value['pk_id'] : ''; ?>" id="type_option" <?php //echo $selected; ?>><?php //echo!empty($value['service_name']) ? ucfirst($value['service_name']) : ''; ?></option>
                      <?php
                //      }
                //   }
                  ?>
                  <!--</select>-->
                   <div for="inclusive_services" generated="true" class="error"></div>
               </div>
               
               <div class="clearfix"></div>
               <!-- <div class="wrapper"> -->
               <div class="col-md-3 form-group ">
                  <label>Additional Services</label>
                  <!-- <select id="services_0" name="services_0"  class="form-control services" style="color: #555;"> -->
                      <select class="form-control services" id="services_0" name="services_0" style="color: #555;">

                     <option value="">Select Service</option>
                  <?php
                  if (!empty($serviceDetails)) {
                     foreach ($serviceDetails as $key => $value) {
                     ?>
                     <option value="<?php echo!empty($value['pk_id']) ? $value['pk_id'] : ''; ?>"<?php echo ((!empty($more_service_list[0]['service_name']) && $more_service_list[0]['service_name'] == $value['service_name']) ? 'selected' : ''); ?>><?php echo!empty($value['service_name']) ? ucfirst($value['service_name']) : ''; ?></option>
                     <?php
                     }
                  }
                  ?>
                  </select>
               </div>
              
               <input type="hidden" name="adm_services" id="adm_services" value="<?php echo !empty($more_service_list)?count($more_service_list):'1' ?>">
               
               <div class="col-md-3 form-group ">
                  <label>Services Charges</label>                  
                  <div class="input-group">
                     <input type="text" class="form-control package_charges" name="package_charges_0" id="package_charges_0" value="<?php echo !empty($more_service_list[0]['services_charges'])?$more_service_list[0]['services_charges']:''; ?>" autocomplete="off">
                     <span class="input-group-addon" id="basic-addon2"><i class="fa fa-inr" aria-hidden="true"></i></span>
                  </div>
                  <div for="package_charges_0" generated="true" class="error"></div>
               </div>
             <!--   <?php echo !empty($more_service_list[0]['charges_to_show_purohit'])?$more_service_list[0]['charges_to_show_purohit']:'0'; ?> -->
               <div class="col-md-3 form-group ">
                  <label>Charges to show to purohit</label>                  
                  <div class="input-group">
                     <input type="text" class="form-control charges_to_show_purohit" name="charges_to_show_purohit_0" id="charges_to_show_purohit_0" value="<?php echo !empty($more_service_list[0]['charges_to_show_purohit'])?$more_service_list[0]['charges_to_show_purohit']:''; ?>" autocomplete="off">
                     <span class="input-group-addon" id="basic-addon2"><i class="fa fa-inr" aria-hidden="true"></i></span>
                  </div>
                      <div for="charges_to_show_purohit_0" generated="true" class="error"></div>
                      <div class="error_0" style="color:red"></div>
               </div>
             <!-- </div> -->
               <div class="col-md-3 form-group">
                   <label></label>
                  <button type="button" class="btn btn-success btn-sm btn-add-more add-more" id="add-more"><i class="fa fa-plus-circle" ></i> Add More</button>

               </div>               
               <!-- start :: add more vehicle edit -->
              <?php if(!empty($more_service_list)){
                  // echo "<pre>";
                  // print_r($more_service_list);
                            // print_r($more_service_list);
                            // die();
                foreach ($more_service_list as $key => $value){
                if($key > 0){                
                ?>
                <div>
                  <!-- <div class="vehicle-comp"> -->
                  <div class="row"></div>
                    <div class="row" style="padding: 6px 12px;">
                      <div class="col-md-3 form-group">
                        <label>Additional Services<span class="text-danger">*</span></label>
                        <select class="form-control services" id="services_<?php echo $key;?>" name="services_<?php echo $key;?>">
                        <option value="">Select Service</option>                 
                          <?php
                          if (!empty($serviceDetails)) {
                             foreach ($serviceDetails as $key => $val) {
                                              ?>
                             <option value="<?php echo!empty($val['pk_id']) ? $val['pk_id'] : ''; ?>"<?php echo ((!empty($val['pk_id']) && $val['pk_id'] == $value['fk_services']) ? 'selected' : ''); ?>><?php echo!empty($val['service_name']) ? ucfirst($val['service_name']) : ''; ?></option>
                             <?php
                             }
                          }
                          // die();
                          ?>
                        </select>
                      </div>
                      <div class="col-md-3 form-group">
                        <label>Services Charges</label>
                        <div class="input-group ">
                          <input type="text" class="form-control package_charges" value="<?php echo !empty($value["services_charges"])?$value["services_charges"]:'0'; ?>" autocomplete="off">
                          <span class="input-group-addon" id="basic-addon2"><i class="fa fa-inr" aria-hidden="true"></i></span>
                        </div>   
                      </div>
                       <div class="col-md-3 form-group ">
                          <label>Charges to Show to Purohit</label>                  
                          <div class="input-group">
                             <input type="text" class="form-control charges_to_show_purohit" value="<?php echo !empty($value["charges_to_show_purohit"])?$value["charges_to_show_purohit"]:'0'; ?>" autocomplete="off">
                             <span class="input-group-addon" id="basic-addon2"><i class="fa fa-inr" aria-hidden="true"></i></span>
                          </div>
                       </div>
                      
                       <div class="col-md-1">
                            <button type="button" style="padding-right: 15px; padding-left: 15px;" class="btn btn-danger btn-sm  pull-right remove_service btn-add-more" >Delete</button>
                       </div>
                    </div>
                     
            <?php } } } ?>
              <!--end :: add more vehicle edit -->
            <div class="clearfix"></div>    
                
              <div id="addmore_div"></div>

               <div class="clearfix"></div>
               <div class="col-md-12 form-group">
                  <label>Description & Procedure Involved</label>
                  
                  <textarea class="form-control" id="editor" style="resize: none;height: 110px" name="description" placeholder=""><?php echo (!empty($edit['description']) ? $edit['description'] : ''); ?></textarea>
                                <div for="editor" generated="true" class="error"></div>
               </div>

               <div class="clearfix"></div>
               <div class="col-md-12 mg-top-10 form-group">          
                  <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
                   <a href="<?php echo base_url(); ?>admin/add-package"><button type="button" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancel</button></a>
               </div>
            </div>
         </form>
         </div>
      </div>
   </section>
    <div class="clearfix"></div>
</div>
<!-- End .content-wrapper -->
<!-- START:: Footer -->
<?php include("application/views/admin/section/vw_footer.php"); ?>
<!-- END:: Footer -->
<script type="text/javascript" src="<?php echo base_url('AdminMedia/validations/js_package/package.js'); ?>"></script>
<script>
   $(".packageLi").addClass("active");
   window.testSelAll2 = $('.testSelAll2').SumoSelect({selectAll:true, search:true, placeholder:'Select services'});
</script>
<script src="<?php echo base_url(); ?>AdminMedia/editor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor', {
        filebrowserUploadUrl: $("#base_url").val() + "admin/cms/Cn_cms/ImageUpload"
    });

    CKEDITOR.replace('editor');
    // /*[start:: code to upload local images]*/
    var config = {
        '.chosen-select': {},
        '.chosen-select-deselect': {allow_single_deselect: true},
        '.chosen-select-no-single': {disable_search_threshold: 10},
        '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
        '.chosen-select-width': {width: "95%"}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
    /*[end:: code to upload local images]*/


     function getCategory(Id){
         // alert(Id);
      var language = $("#language option:selected").val();
      var base_url = "<?php echo base_url(); ?>";
     // alert(base_url);
      $.ajax({
            type: "POST",
            data: {Id: language},
            url: base_url + "admin/package/Cn_package/getCategoryByLanguage",
            dataType: 'json',
 
            success: function (data){
               // alert(JSON.stringify(data));
                var html='';
                html +=('<option value="">Select</option>');
                if(data!=""){
                $.each( data, function( key, value ){
                    html +=('<option value="'+value.pk_id+'">'+value.category.charAt(0).toUpperCase()+value.category.slice(1)+'</option>');
                });
                }
                $('#category').html(html); 
                $('#category').css('textTransform', 'capitalize');
            }
        });                                            
    }

    function getPooja() {
         // alert(Id);
        var category = $("#category option:selected").val();
        var language = $("#language option:selected").val();
        var base_url = "<?php echo base_url(); ?>";
        $.ajax({
            type: "POST",
            data: {language: language,category : category},
            url: base_url + "admin/package/Cn_package/getPoojaByCategory",
            dataType: 'json',
 
            success: function (data){
               // alert(JSON.stringify(data));
                var html='';
                html +=('<option value="">Select</option>');
                if(data!=""){
                $.each( data, function( key, value ){
                    html +=('<option value="'+value.pk_id+'">'+value.pooja_name.charAt(0).toUpperCase()+value.pooja_name.slice(1)+'</option>');
                });
                }
                $('#pooja').html(html); 
                $('#pooja').css('textTransform', 'capitalize');
            }
        });                                            
    }



</script>


</body>
</html>