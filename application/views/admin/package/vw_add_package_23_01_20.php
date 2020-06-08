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
         Add Package 
         <div class="pull-right">
            <a href="<?php echo base_url(); ?>admin/package-list"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back </button></a>
         </div>
      </h1>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="col-md-12 no-mob-pad no-pad">
         <div class="box box-primary">
            <form id="add_package" action="<?php echo base_url(); ?>admin/add-package-action" method='post'   enctype="multipart/form-data"> 
            <input type="hidden" name="txtid" id="txtid" value="<?php echo (!empty($edit['pk_id']) ? $edit['pk_id'] : ''); ?>" class="form-control">
            <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>" class="form-control">
            <div class="box-body">
               <div class="col-md-3 form-group">
                  <label>Pooja Category<span style="color: red">*</span></label>
                  <select class="form-control" id="category" name="category" style="color: #555">
                        <option  value="" selected disabled>Select Category</option>
                        <?php if (!empty($categoryDetails)) {
                           foreach ($categoryDetails as $key => $value) { ?>
                           <option value="<?= $value['pk_id'];?>"<?php echo ((!empty($edit['fk_category']) && $edit['fk_category'] == $value['pk_id']) ? 'selected' : ''); ?>><?= ucfirst($value['category']);?></option>
                        <?php }}?>                     
                    </select>
               </div>
               <div class="col-md-3 form-group">
                  <label>Pooja <span style="color: red">*</span></label>
                  <select class="form-control" id="pooja" name="pooja" style="color: #555">
                        <option  value="" selected disabled>Select Category</option>
                        <?php if (!empty($poojaDetails)) {
                           foreach ($poojaDetails as $key => $value) { ?>
                           <option value="<?= $value['pk_id'];?>"<?php echo ((!empty($edit['fk_pooja']) && $edit['fk_pooja'] == $value['pk_id']) ? 'selected' : ''); ?>><?= ucfirst($value['pooja_name']);?></option>
                        <?php }}?>                     
                    </select>
               </div>
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
               </div>
               <div class="col-md-6 form-group">
                  <label>Description & Procedure Involved</label>
                  <textarea rows="2" class="form-control" style="resize: none;" id="description" name="description"><?php echo (!empty($edit['description']) ? $edit['description'] : ''); ?></textarea>
               </div>

               <div class="col-md-3 form-group">
                  <label>Inclusive Services</label>                  
                  <select name="inclusive_services[]" id="inclusive_services" multiple="multiple" onchange="console.log($(this).children(':selected').length)" class="testSelAll2 form-control sumoselect" style="color: #555;">

                  <?php
                  if (!empty($serviceDetails)) {
                     foreach ($serviceDetails as $key => $value) {
                     $selected = (in_array($value['pk_id'], $inclusiveDetails)) ? "selected=''" : "";
                     ?>
                     <option value="<?php echo!empty($value['pk_id']) ? $value['pk_id'] : ''; ?>" id="type_option" <?php echo $selected; ?>><?php echo!empty($value['service_name']) ? ucfirst($value['service_name']) : ''; ?></option>
                     <?php
                     }
                  }
                  ?>
                  </select>
               </div>

               <div class="col-md-3 form-group">
                  <label>Exclusive Services</label>
                  <select name="exclusive_services[]" id="exclusive_services" multiple="multiple" onchange="console.log($(this).children(':selected').length)" class="testSelAll2 form-control sumoselect" style="color: #555;">

                  <?php
                  if (!empty($serviceDetails)) {
                     foreach ($serviceDetails as $key => $value) {
                     $selected = (in_array($value['pk_id'], $exclusiveDetails)) ? "selected=''" : "";
                     ?>
                     <option value="<?php echo!empty($value['pk_id']) ? $value['pk_id'] : ''; ?>"<?php echo $selected; ?>><?php echo!empty($value['service_name']) ? ucfirst($value['service_name']) : ''; ?></option>
                     <?php
                     }
                  }
                  ?>
                  </select>
               </div>

               <div class="clearfix"></div>
               <div class="col-md-12 mg-top-10 form-group">          
                  <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
                  <button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancel</button>
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
<script type="text/javascript" src="<?php echo base_url('AdminMedia/validations/js_package/package.js'); ?>"></script>
<script>
   $(".packageLi").addClass("active");
   window.testSelAll2 = $('.testSelAll2').SumoSelect({selectAll:true, search:true, placeholder:'Select'});
</script>
</body>
</html>