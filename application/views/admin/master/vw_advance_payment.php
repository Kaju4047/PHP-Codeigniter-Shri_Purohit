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
         <h1 class="two-way-hd">Add Advance Payment </h1>
         <div class="box box-primary mob-no-height" style="min-height: auto;">
            <div class="box-body mob-no-height">
               <form method="post" action="<?php echo base_url()?>admin/add-advanced-payment" id="advance_payment">
                  <div class="col-md-12 form-group">
                     <label>Advance Payment in %</label>
                     <div class="input-group">
                       <input type="text" class="form-control" id="advanced_payment" name="advanced_payment" autocomplete="off">
                       <span class="input-group-addon" id="basic-addon2">%</span>
                           <div class="clearfix"></div>
                     </div>
                    <div for="advanced_payment" generated="true" class="error"></div>
                  </div>
                  <div class="clearfix"></div>
                  
                  <div class="col-md-12 form-group">          
                     <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
                       <a href="<?php echo base_url(); ?>admin/advance-payment" ><button type="button" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancel</button></a>
                  </div>
                  <!-- End form-group --> 
               </form>
            </div>
            <!-- End box-body -->
         </div>
      </div>
      <div class="col-md-8 no-pad-right m-mob-top-15 mob-no-pad">
         <h1 class="two-way-hd">Advance Payment List 
            <div class="pull-right">
               <!-- <span class="mstr-sts">Advance Payment Service <i class="fa fa-toggle-on tgle-on " aria-hidden="true" title="Active"></i></span> -->
               <span class="mstr-sts">Advance Payment Service 
                    <?php
                    $status = ""; 
                    if ($advancedPayment[0]['status'] == "1") {
                        $status = "2";
                        $class = "fa fa-toggle-on tgle-on";
                        $title = "Active";
                    } else if ($advancedPayment[0]['status'] == "2"){
                        $status = "1";
                        $class = "fa fa-toggle-on fa-rotate-180 tgle-off";
                        $title = "Inactive";
                    }
                    ?>
                    <a onClick="return confirm('Are you sure you want to change status of this record ?')"  href="<?php echo base_url(); ?>admin/advance-payment-status/<?php echo (!empty($status) ? $status : ''); ?>"> <i class="<?php echo $class; ?>" aria-hidden="true" title="<?php echo $title; ?>"></i></a>
               </span>
            </div>
         </h1>
         <div class="box box-primary mob-no-height">
            <div class="box-body mob-no-height">
               <table id="example" class="table table-bordered table-striped table-hover">
                  <thead>
                     <tr>
                        <th width="12%" class="text-center">Sr. No.</th>
                        <th width="26%">Date & Time</th>
                        <th width="62%">Advance Payment (%)</th>
                     </tr>
                  </thead>
                  <tbody>
                  <?php if (!empty($advancedPayment)) {
                        $page_no= !empty($this->uri->segment(3)) ? $this->uri->segment(3): 1;
                        $i = ($page_no * 10) - 9;
                        foreach ($advancedPayment as $key => $value){
                  ?>
                     <tr>
                        <td class="text-center"><?php echo $i;?></td>
                        <td><?php echo !empty($value['created_date'])?date("d-m-Y h:i:a", strtotime($value['created_date'])):''; ?></td>
                        <td><?php echo !empty($value['advanced_payment'])?ucfirst($value['advanced_payment']):''; ?>%</td>
                     </tr>                
                     <?php $i++;
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
<script type="text/javascript" src="<?php echo base_url('AdminMedia/validations/js_master/advanced_payment.js'); ?>"></script>
<script>
   $(".masterLi").addClass("active");
   $(".advpayLi").addClass("active");
   // $("#example").DataTable();
   $('#example').wrap('<div class="resp_table"></div>');
   $(".select2").select2();
</script>
</body>
</html>