<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content-header">
      <h1>Puja Details
         <div class="pull-right">
             <a href="<?php echo base_url(); ?>admin/pooja-list"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back </button></a>
         </div>
      </h1>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="col-md-12 no-mob-pad no-pad">
         <div class="box box-primary">
            <div class="box-body">
              <div class="col-md-2">
                <div class="col-sm-12 no-pad">
                  <?php $imgdata = !empty($poojaDetails['pooja_image'])? 'upload/admin/pooja/'.$poojaDetails['pooja_image']: 'AdminMedia/images/default.png' ?>
                  <img src="<?php echo base_url( $imgdata);?>" class="poj-up-img">
                </div>
              </div>
              <div class="col-md-10">
                <div class="col-md-4 form-group">
                  <label>Language</label>
                  <h2 class="view-cnt"><?php echo !empty($poojaDetails['language'])?ucfirst($poojaDetails['language']):''; ?></h2>
               </div>
               <div class="col-md-4 form-group">
                  <label>Category</label>
                  <h2 class="view-cnt"><?php echo !empty($poojaDetails['category'])?ucfirst($poojaDetails['category']):''; ?></h2>
               </div>
               <div class="col-md-4 form-group">
                  <label>Puja</label>
                  <h2 class="view-cnt"><?php echo !empty($poojaDetails['pooja_name'])?ucfirst($poojaDetails['pooja_name']):''; ?></h2>
               </div>
               <div class="col-md-8 form-group">
                  <label>Short Description</label>
                  <h2 class="view-cnt"><?php echo !empty($poojaDetails['short_description'])?ucfirst($poojaDetails['short_description']):''; ?></h2>
               </div>
               <div class="col-md-4 form-group">
                  <label>Salient Feature</label>
                  <h2 class="view-cnt"><?php echo !empty($poojaDetails['silent_feature'])?ucfirst($poojaDetails['silent_feature']):''; ?></h2>
               </div>
               <div class="col-md-12 form-group">
                  <label>Long Description</label>
                  <h2 class="view-cnt"><?php echo !empty($poojaDetails['long_description'])?ucfirst($poojaDetails['long_description']):''; ?></h2>
               </div>
              </div>
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
<script>
   $(".poojaLi").addClass("active");
</script>
</body>
</html>