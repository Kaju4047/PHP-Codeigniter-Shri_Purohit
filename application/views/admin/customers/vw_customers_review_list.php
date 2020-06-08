<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content-header">
      <h1>Customer Review List</h1>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="col-md-12 no-mob-pad no-pad">
         <!-- <div class="box box-primary no-height margin-bottom">
            <div class="box-body no-height">
               
            </div>
         </div>-->
         <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                  <div class="col-md-4" style="display: inline-block;float: right;margin-bottom: 10px;">
               <form name="frmSearch" id="frmSearch" action="" method="GET" autocomplete="off">
                        
                        <input type="text" name="search_term" id="search_term" class="form-control" value="" placeholder="Search" style="width: 87%; display: inline-block;margin-left: 43px;">
                       
                        <button type="submit" class="btn btn-primary" title="Search" onclick="javascript: form.action='';" style="position: absolute;top: 0;right: 0;margin-right: 15px;height: 34px;"><i class="fa fa-search"></i></button>
                     </form>
                  </div>
               </div>
               <table id="example11" class="table table-bordered table-striped table-hover" width="100%">
                  <thead>
                     <tr>
                        <th width="8%" class="text-center">Sr. No.</th>
                        <th width="10%">Customer Name</th>
                        <th width="20%">Review</th>
                        <th width="3%">Status</th>
                        <th width="6%" class="text-center">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                      <?php 
                            if(!empty($review_list)) {
                                $sr = 1;
                                foreach($review_list as $key => $value) {
                        ?>
                     <tr>
                        <td class="text-center"><?= $sr++; ?></td>
                        <td><?= !empty($value->customer_name)?$value->customer_name:""; ?></td>
                        <td><?= !empty($value->comment)?$value->comment:""; ?></td>
                         
                        <td class="text-center">
                                <?php
                                $status = ""; 
                                if ($value->status == 1){
                                    $status = 2;
                                    $class = "fa fa-toggle-on tgle-on";
                                    $title = "Active";
                                } else if ($value->status == 2) {
                                    $status = 1;
                                    $class = "fa fa-toggle-on fa-rotate-180 tgle-off";
                                    $title = "Inactive";
                                }
                                ?>
                                <a onClick="return confirm('Are you sure you want to change status of this record ?')"  href="<?= base_url('admin/status-customer-reviews/').$value->pk_id.'/'.$status; ?>"> <i class="<?php echo $class; ?>" aria-hidden="true" title="<?php echo $title; ?>"></i></a>
                        </td>
                          
                        <td class="text-center">
                            
                          <a href="<?= base_url('admin/delete-customer-reviews/').$value->pk_id; ?>" onClick="return confirm('Are you sure you want to delete record?')"><button type="button" class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash"></i></button></a>
                   
                        </td>
                   
                     </tr>
                        <?php } } else { ?>
                        <p>No Data.</p>
                        <?php } ?>
                  </tbody>
               </table>
                <ul class="pagination pull-right" >
                    
                   <p></p>
                 
              </ul>
            </div>
            <!-- End box-body -->
         </div>
         <!-- End box -->
      </div>
      <div class="clearfix"></div>
   </section>
   <!-- End .content -->
</div>
<!-- End .content-wrapper -->
<!-- START:: Footer -->
<?php include("application/views/admin/section/vw_footer.php"); ?>
<!-- END:: Footer -->



<script>

$('.customerreviewLi').addClass('active');

</script>
</body>
</html>