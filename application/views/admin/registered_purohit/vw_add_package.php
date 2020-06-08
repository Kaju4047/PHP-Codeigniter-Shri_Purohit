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
            <div class="box-body">
               <div class="col-md-3 form-group">
                  <label>Pooja Category</label>
                  <select class="form-control">
                     <option>Select Pooja Category</option>
                     <option>PoojaCategory1</option>
                     <option>PoojaCategory2</option>
                     <option>PoojaCategory3</option>
                  </select>
               </div>
               <div class="col-md-3 form-group">
                  <label>Pooja</label>
                  <select class="form-control">
                     <option>Select Pooja</option>
                     <option>Pooja1</option>
                     <option>Pooja2</option>
                     <option>Pooja3</option>
                  </select>
               </div>
               <div class="col-md-3 form-group">
                  <label>Package</label>
                  <input type="text" class="form-control">
               </div>
               <div class="col-md-3 form-group">
                  <label>Package Charges</label>
                  <div class="input-group">
                     <input type="text" class="form-control">
                     <span class="input-group-addon" id="basic-addon2"><i class="fa fa-inr" aria-hidden="true"></i></span>
                  </div>
               </div>
               <div class="col-md-6 form-group">
                  <label>Description & Procedure Involved</label>
                  <textarea rows="2" class="form-control" style="resize: none;"></textarea>
               </div>

               <div class="col-md-3 form-group">
                  <label>Inclusive Services</label>
                  <select class="testSelAll2 form-control" multiple="multiple">
                     <option>Prasad</option>
                     <option>Flowers</option>
                  </select>
                </div>

                <div class="col-md-3 form-group">
                  <label>Exclusive Services</label>
                  <select class="testSelAll2 form-control" multiple="multiple">
                     <option>Dakshina</option>
                     <option>Pandit for Full  Day</option>
                  </select>
                </div>

               <div class="clearfix"></div>
               <div class="col-md-12 mg-top-10 form-group">          
                  <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
                  <button type="button" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancel</button>
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
   $(".packageLi").addClass("active");
   window.testSelAll2 = $('.testSelAll2').SumoSelect({selectAll:true, search:true, placeholder:'Select'});
</script>
</body>
</html>