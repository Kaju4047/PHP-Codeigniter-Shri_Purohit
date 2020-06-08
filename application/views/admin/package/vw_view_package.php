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
         Package Details
         <div class="pull-right">
            <a href="<?php echo base_url(); ?>admin/package-list"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back </button></a>
         </div>
      </h1>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="col-md-12 no-mob-pad no-pad">
         <div class="box box-primary">
            <div class="box-body">
               <div class="col-md-4 form-group">
                  <label>Puja Category</label>
                  <h2 class="view-cnt"><?php echo !empty($packageDetails['category'])?ucfirst($packageDetails['category']):''; ?></h2>
               </div>
               <div class="col-md-4 form-group">
                  <label>Puja</label>
                  <h2 class="view-cnt"><?php echo !empty($packageDetails['pooja_name'])?ucfirst($packageDetails['pooja_name']):''; ?></h2>
               </div>
               <div class="col-md-4 form-group">
                  <label>Package</label>
                  <h2 class="view-cnt"><?php echo !empty($packageDetails['package'])?ucfirst($packageDetails['package']):''; ?></h2>
               </div>
               <div class="col-md-4 form-group">
                  <label>Package Charges</label>
                  <h2 class="view-cnt"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo !empty($packageDetails['package_charges'])?$packageDetails['package_charges']:''; ?></h2>
               </div>
               <div class="col-md-4 form-group">
                  <label>Purohit Dakshina & Puja Material</label>
                  <h2 class="view-cnt"><?php //echo !empty($inclusiveDetails['service_name'])?ucfirst($inclusiveDetails['service_name']):''; ?></h2>
               </div>
               <div class="col-md-4 form-group">
                  <label>Additional Services</label>
                  <h2 class="view-cnt"><?php echo !empty($exclusiveDetails['service_name'])?ucfirst($exclusiveDetails['service_name']):''; ?></h2>
               </div>
               <div class="col-md-12 form-group">
                  <label>Description & Procedure Involved</label>
                  <h2 class="view-cnt"><?php echo !empty($packageDetails['description'])?ucfirst($packageDetails['description']):''; ?></h2>
               </div>
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
   </section>packageDetails
</div>
<!-- End .content-wrapper -->
<!-- START:: Footer -->
<?php include("application/views/admin/section/vw_footer.php"); ?>
<!-- END:: Footer -->
<script>
   $(".packageLi").addClass("active");
</script>
</body>
</html>