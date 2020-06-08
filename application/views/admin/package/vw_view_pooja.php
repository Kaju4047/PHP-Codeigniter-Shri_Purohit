<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content-header">
      <h1>Pooja Details
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
                  <img src="<?php echo base_url(); ?>AdminMedia/images/default.png" class="poj-up-img">
                </div>
              </div>
              <div class="col-md-10">
                <div class="col-md-4 form-group">
                  <label>Language</label>
                  <h2 class="view-cnt">Marathi</h2>
               </div>
               <div class="col-md-4 form-group">
                  <label>Category</label>
                  <h2 class="view-cnt">Category1</h2>
               </div>
               <div class="col-md-4 form-group">
                  <label>Pooja</label>
                  <h2 class="view-cnt">Pooja1</h2>
               </div>
               <div class="col-md-8 form-group">
                  <label>Short Description</label>
                  <h2 class="view-cnt">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h2>
               </div>
               <div class="col-md-4 form-group">
                  <label>Key Insight</label>
                  <h2 class="view-cnt">Lorem, ipsum, dolor, sit, amet.</h2>
               </div>
               <div class="col-md-12 form-group">
                  <label>Long Description</label>
                  <h2 class="view-cnt">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</h2>
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