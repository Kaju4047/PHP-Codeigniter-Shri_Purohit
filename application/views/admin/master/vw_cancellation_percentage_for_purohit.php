<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

   <!-- Main content -->
   <section class="content">
      <div class="col-md-4 no-pad">
         <h1 class="two-way-hd">Add Cancellation % For Purohit </h1>
         <div class="box box-primary mob-no-height" style="min-height: auto;">
            <div class="box-body mob-no-height">
               <form method="post" id="add_cancellation_per_for_purohit" action="<?php echo base_url(); ?>admin/add-cancellation-percentage-for-purohit">
                  <div class="col-md-12 form-group">
                     <label>Cancellation % For Purohit</label>
                     <div class="input-group">
                       <input type="text" class="form-control" id="cancellation_per_for_purohit" name="cancellation_per_for_purohit" autocomplete="off">
                       <span class="input-group-addon" id="basic-addon2">%</span>
                        <div class="clearfix"></div>
                     </div>
                     <div for="cancellation_per_for_purohit" generated="true" class="error"></div>
                  </div>
                   <?php if(in_array('cancellation_per_purohit_add', $privilige)){?>
                  <div class="col-md-12 form-group">          
                     <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
                         <a href="<?php echo base_url(); ?>admin/cancellation-percentage-for-purohit" ><button type="button" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancel</button></a>
                  </div>
                  <?php }?>
                  <!-- End form-group --> 
               </form>
            </div>
            <!-- End box-body -->
         </div>
      </div>
      <div class="col-md-8 no-pad-right m-mob-top-15 mob-no-pad">
         <h1 class="two-way-hd">Cancellation % For Purohit List</h1>
         <div class="box box-primary mob-no-height">
            <div class="box-body mob-no-height">
               <table id="example" class="table table-bordered table-striped table-hover">
                  <thead>
                     <tr>
                        <th width="12%" class="text-center">Sr.No.</th>
                        <th width="26%">Date & Time</th>
                        <th width="62%">Cancellation % For Purohit</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php if (!empty($cancellationPercentage)) {
                           $page_no= !empty($this->uri->segment(3)) ? $this->uri->segment(3): 1;
                           $i = ($page_no * 10) - 9;
                           foreach ($cancellationPercentage as $key => $value) {
                     ?>
                     <tr>
                        <td class="text-center"><?php echo $i;?></td>
                        <td><?php  echo !empty($value['created_date']) ? date('d-m-Y h:i a ',strtotime($value['created_date'])) : '-';?></td>
                        <td><?php echo !empty($value['cancellation_percentage_purohit'])?ucfirst($value['cancellation_percentage_purohit']):'0'; ?>%</td>
                     </tr>
                     <?php  $i++;
                        }
                     }?>
                  </tbody>
               </table>
               <ul class="pagination pull-right" >
                    <?php if (isset($follow_links) && !empty($follow_links)) { ?>
                   <p><?php echo $follow_links ?></p>
                 <?php } ?>
              </ul>
            </div>
         </div>
         <!-- End col-md-8 -->
      </div>
      <div class="clearfix"></div>
   </section>
   <!-- End .content -->
</div>
<!-- End .content-wrapper -->
<!-- START:: Footer -->
<?php include("application/views/admin/section/vw_footer.php"); ?>
<!-- END:: Footer -->
<script type="text/javascript" src="<?php echo base_url('AdminMedia/validations/js_master/cancellation_per_for_purohit.js'); ?>"></script>
<script>
   $(".masterLi").addClass("active");
   $(".canperpuroLi").addClass("active");
   // $("#example").DataTable();
   $('#example').wrap('<div class="resp_table"></div>');
   $(".select2").select2();
</script>
</body>
</html>