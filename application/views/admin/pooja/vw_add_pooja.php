<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<?php
        $fld = 'UA_priviliges';
        $userid = $this->session->userdata['UID'];
         
        $condition = array('UA_pkey' => $userid);
        $privilige = $this->Md_database->getData('static_useradmin', $fld, $condition, '', '');
        $privilige = !empty($privilige[0]['UA_priviliges']) ? explode(',', $privilige[0]['UA_priviliges']) : '';

// (in_array('superAdmin', $privilige) || (in_array('CMS_add', $privilige) ) ) ? '' : redirect(base_url() . 'admin/dashboard'); //redirect if session expire
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content-header">
      <h1>Add Puja 
         <div class="pull-right">
             <a href="<?php echo base_url(); ?>admin/pooja-list"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back </button></a>
         </div>
      </h1>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="col-md-12 no-mob-pad no-pad">
         <div class="box box-primary">
            <form id="add_pooja" action="<?php echo base_url(); ?>admin/add-pooja-action" method='post' enctype="multipart/form-data"> 
            <div class="box-body">
              <input type="hidden" name="txtid" id="txtid" value="<?php echo (!empty($edit['pk_id']) ? $edit['pk_id'] : ''); ?>" class="form-control">
              <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>" class="form-control">
                <input type="hidden" name="fileold" id="fileold" value="<?php echo (!empty($edit['pooja_image']) ? $edit['pooja_image'] : ''); ?>" class="form-control">
                <div class="col-md-8 no-pad">
               <div class="col-md-6 form-group">
                    <label>Language<span style="color: red">*</span></label>
                    <select class="form-control" id="language" name="language" style="color: #555" onchange="getLanguage(this);">
                        <option  value="" selected disabled>Select Language</option>
                        <?php if (!empty($languageDetails)) {
                           foreach ($languageDetails as $key => $value) { ?>
                           <option value="<?= $value['pk_id'];?>"<?php echo ((!empty($edit['fk_language']) && $edit['fk_language'] == $value['pk_id']) ? 'selected' : ''); ?>><?= ucfirst($value['language']);?></option>
                        <?php }}?>                     
                    </select>
               </div> 
               <div class="col-md-6 form-group">
                  <label>Category <span style="color: red">*</span></label>
                  <select class="form-control" id="category" name="category" style="color: #555">
                        <option  value="" selected disabled>Select Category</option>
                        <?php if (!empty($categoryDetails)) {
                           foreach ($categoryDetails as $key => $value) { ?>
                           <option value="<?= $value['pk_id'];?>"<?php echo ((!empty($edit['fk_category']) && $edit['fk_category'] == $value['pk_id']) ? 'selected' : ''); ?>><?= ucfirst($value['category']);?></option>
                        <?php }}?>                     
                    </select>
               </div> 
               <div class="col-md-12 form-group">
                  <label>Puja Name</label>
                  <input type="text" class="form-control" name="pooja_name" id="pooja_name" value="<?php echo (!empty($edit['pooja_name']) ? $edit['pooja_name'] : ''); ?>">
               </div>
               
               <div class="clearfix"></div>
               </div>
               <div class="col-md-4 form-group">
                  <label>Upload Puja Image</label>
                  <input type="file" name="pooja_image" id="pooja_image" class="form-control" onchange="uppoojimg(this);">
              
                  <?php 
                   $imgdata = !empty($edit['pooja_image']) ? 'upload/admin/pooja/' . $edit['pooja_image'] : 'AdminMedia/images/default.png';
                  ?>
                <img id="pojupimg" src="<?php echo base_url($imgdata);  ?>" class="poj-up-img">
               </div>
               <div class="clearfix"></div>
                  <!--<textarea rows="2" class="form-control" id="short_description" name="short_description" style="resize: none;"></textarea>-->
               <div class="col-md-12 form-group">
                  <label>Short Description</label>
                  <textarea class="form-control" id="short_description"  style="resize: none;height: 110px" name="short_description" placeholder=""><?php echo (!empty($edit['short_description']) ? $edit['short_description'] : ''); ?></textarea>
                    <div for="short_description" generated="true" class="error"></div>
               </div>
               <div class="clearfix"></div>
                  <!--<textarea rows="3" class="form-control" id="long_description" name="long_description" style="resize: none;"></textarea>-->
               <div class="col-md-12 form-group">
                  <label>Long Description</label>
                <textarea class="form-control" id="long_description"  style="resize: none;height: 110px" name="long_description" placeholder=""><?php echo (!empty($edit['long_description']) ? $edit['long_description'] : ''); ?></textarea>
                  <div for="long_description" generated="true" class="error"></div>
               </div>
               <div class="clearfix"></div>
                  <!--<textarea rows="3" class="form-control" id="silent_feature" name="silent_feature" style="resize: none;"> </textarea>-->
               <div class="col-md-12 form-group">
                  <label>Salient Feature</label>
                <textarea class="form-control" id="editor"  style="resize: none;height: 110px" name="silent_feature" placeholder=""><?php echo (!empty($edit['silent_feature']) ? $edit['silent_feature'] : ''); ?></textarea>
                 <div for="editor" generated="true" class="error"></div>
               </div>
               <div class="clearfix"></div>
               <div class="col-md-12 mg-top-10 form-group">          
                  <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
                   <a href="<?php echo base_url(); ?>admin/add-pooja"><button type="button" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancel</button></a>
               </div>
            </div>
          </form>
         </div>
       </div>
      <div class="clearfix"></div>
   </section>
</div>
<!-- End .content-wrapper -->
<!-- START:: Footer -->
<?php include("application/views/admin/section/vw_footer.php"); ?>
<!-- END:: Footer -->
<script type="text/javascript" src="<?php echo base_url('AdminMedia/validations/js_pooja/pooja.js'); ?>"></script>
<script>
   $(".poojaLi").addClass("active");
   
    function uppoojimg(input)
    {
        if (input.files && input.files[0]) {
        var reader = new FileReader();
 
        reader.onload = function (e) {
            $('#pojupimg').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script src="<?php echo base_url(); ?>AdminMedia/editor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor', {
        filebrowserUploadUrl: $("#base_url").val() + "admin/cms/Cn_cms/ImageUpload"
    });

    CKEDITOR.replace('editor');
    /*[start:: code to upload local images]*/
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
</script>

<script>
    CKEDITOR.replace('long_description', {
        filebrowserUploadUrl: $("#base_url").val() + "admin/cms/Cn_cms/ImageUpload"
    });

    CKEDITOR.replace('long_description');
    /*[start:: code to upload local images]*/
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
</script>

<script>
    CKEDITOR.replace('short_description', {
        filebrowserUploadUrl: $("#base_url").val() + "admin/cms/Cn_cms/ImageUpload"
    });

    CKEDITOR.replace('short_description');
    /*[start:: code to upload local images]*/
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


    function getLanguage(Id) {
  
      var language = $("#language option:selected").val();
      var base_url = "<?php echo base_url(); ?>";
     // alert(base_url);
     $.ajax({
            type: "POST",
            data: {Id: language},
            url: base_url + "admin/pooja/Cn_pooja/getCategoryByLanguage",
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

</script>
</body>
</html>