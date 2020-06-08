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
         <h1 class="two-way-hd">Add Tax </h1>
         <div class="box box-primary mob-no-height" style="min-height: auto;">
            <div class="box-body mob-no-height">
               <form method="post" action="<?php echo base_url()?>admin/add-tax" id="add_tax">
                  <div class="col-md-12 form-group">
                     <label>State tax in %</label>
                     <div class="input-group">
                       <input type="text" class="form-control" id="state_tax" name="state_tax" autocomplete="off">
                       <span class="input-group-addon" id="basic-addon2">%</span>
                        <div class="clearfix"></div>
                     </div>
                      <div for="state_tax" generated="true" class="error"></div>
                  </div> 
                    <div class="clearfix"></div>
                   <div class="col-md-12 form-group">
                     <label>Central tax in %</label>
                     <div class="input-group">
                       <input type="text" class="form-control" id="central_tax" name="central_tax" autocomplete="off">
                       <span class="input-group-addon" id="basic-addon2">%</span>
                        <div class="clearfix"></div>
                     </div>
                      <div for="central_tax" generated="true" class="error"></div>
                  </div>
                  <div class="clearfix"></div>
                   <?php  if(in_array('tax_add', $privilige)){?>
                  <div class="col-md-12 form-group">          
                     <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
                       <a href="<?php echo base_url(); ?>admin/tax" ><button type="button" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancel</button></a>
                  </div>
                  <?php }?>
                  <!-- End form-group --> 
               </form>
            </div>
            <!-- End box-body -->
         </div>
      </div>
      <div class="col-md-8 no-pad-right m-mob-top-15 mob-no-pad">
         <h1 class="two-way-hd">Tax List 
            <div class="pull-right">
              <?php  if(in_array('tax_AI', $privilige)){?>
               <span class="mstr-sts">Tax <div class="pull-right">
                    <?php
                    $status = ""; 
                    if ($tax[0]['status'] == "1") {
                        $status = "2";
                        $class = "fa fa-toggle-on tgle-on";
                        $title = "Active";
                    } else if ($tax[0]['status'] == "2"){
                        $status = "1";
                        $class = "fa fa-toggle-on fa-rotate-180 tgle-off";
                        $title = "Inactive";
                    }
                    ?>
                    <a onClick="return confirm('Are you sure you want to change status of this record ?')"  href="<?php echo base_url(); ?>admin/tax-status/<?php echo (!empty($status) ? $status : ''); ?>"> <i class="<?php echo $class; ?>" aria-hidden="true" title="<?php echo $title; ?>"></i></a>

            </div></span>
             <?php }?>
            </div>
         </h1>
         <div class="box box-primary mob-no-height">
            <div class="box-body mob-no-height">
               <table id="example" class="table table-bordered table-striped table-hover">
                  <thead>
                     <tr>
                        <th width="12%" class="text-center">Sr. No.</th>
                        <th width="26%">Date & Time</th>
                        <th width="30%">State tax (%)</th>
                        <th width="30%">Central tax (%)</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php if (!empty($tax)) {
                           $page_no= !empty($this->uri->segment(3)) ? $this->uri->segment(3): 1;
                           $i = ($page_no * 10) - 9;
                           foreach ($tax as $key => $value) {
                     ?>
                     <tr>
                        <td class="text-center"><?php echo $i;?></td>
                        <td><?php echo !empty($value['created_date'])?date("d-m-Y h:i:a", strtotime($value['created_date'])):''; ?></td>
                        <td><?php echo !empty($value['state_tax'])?ucfirst($value['state_tax']):'0'; ?>%</td>
                        <td><?php echo !empty($value['central_tax'])?ucfirst($value['central_tax']):'0'; ?>%</td>
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
<script type="text/javascript" src="<?php echo base_url('AdminMedia/validations/js_master/tax.js'); ?>"></script>
<script>
   $(".masterLi").addClass("active");
   $(".taxLi").addClass("active");
   // $("#example").DataTable();
   $('#example').wrap('<div class="resp_table"></div>');
   $(".select2").select2();
</script>
</body>
</html>