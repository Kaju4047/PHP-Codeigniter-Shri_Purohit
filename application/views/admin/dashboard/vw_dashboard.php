<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- <section class="content-header">
   <h1>Dashboard</h1>
</section> -->


 <?php
                        

                            $fld = 'UA_priviliges';
                            $userid = $this->session->userdata['UID'];
                             
                            $condition = array('UA_pkey' => $userid);
                            $privilige = $this->Md_database->getData('static_useradmin', $fld, $condition, '', '');
                            $privilige = !empty($privilige[0]['UA_priviliges']) ? explode(',', $privilige[0]['UA_priviliges']) : '';?>

<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-md-3 col-xs-6">
            <div class="small-box bg-saddlebrown">
              <div class="inner">
                <h3><?php echo !empty($totalPurohitCount)?$totalPurohitCount:0;?></h3>
                <p class=""> Total Purohit</p>
              </div>
               <a href="<?php echo base_url(); ?>admin/registered-purohit-list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
           <div class="col-md-3 col-xs-6">
            <div class="small-box bg-teal">
              <div class="inner">
                <h3><?php echo !empty($totalCustomerCount)?$totalCustomerCount:0;?></h3>
                <p class=""> Total Customers</p>
              </div>
              <a href="<?php echo base_url(); ?>admin/customers-list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
             </div>
          </div>
           <div class="col-md-3 col-xs-6">
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo !empty($totalPendingCount)?$totalPendingCount:0;?></h3>
                <p class="">Total Pending Request Puja</p>
              </div>
              <a href="<?php echo base_url(); ?>admin/pending-pooja-booking-list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
             
            </div>
          </div>
           <div class="col-md-3 col-xs-6">
            <div class="small-box light-skyblue">
              <div class="inner">
                <h3><?php echo !empty($todayPujaCount)?$todayPujaCount:0;?></h3>
                <p class="">Today Puja</p>
              </div>
              <a href="<?php echo base_url(); ?>admin/todays-pooja-booking-list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>             
            </div>
          </div>
          <div class="clearfix"></div>
           <div class="col-md-3 col-xs-6">
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3><?php echo !empty($totalUpcomingCount)?$totalUpcomingCount:0;?></h3>
                <p class="">Total Upcoming Puja</p>
              </div>
              <a href="<?php echo base_url(); ?>admin/upcoming-pooja-booking-list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            
            </div>
          </div>
           <div class="col-md-3 col-xs-6">
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?php echo !empty($totalCompletedCount)?$totalCompletedCount:0;?></h3>
                <p class="">Total Completed Puja</p>
              </div>
              <a href="<?php echo base_url(); ?>admin/completed-pooja-booking-list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
             
            </div>
          </div>
           <div class="col-md-3 col-xs-6">
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?php echo !empty($totalCancelledCount)?$totalCancelledCount:0;?></h3>
                <p class="">Total Cancelled Puja</p>
              </div>
              <a href="<?php echo base_url(); ?>admin/cancelled-pooja-booking-list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
             
            </div>
          </div>
          <div class="col-md-3 col-xs-6">
            <div class="small-box bg-blue">
              <div class="inner">
                <h3><?php echo !empty($grandTotal)?$grandTotal:'0';?></h3>
                <p class="">Grand Total</p>
              </div>
              <a href="<?php echo base_url(); ?>admin/payment-history" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
      </div>
   
    
        <div class="col-md-12 no-pad">
     
        <table id="example" class="table table-bordered table-striped table-hover dataTable no-footer" role="grid" aria-describedby="example_info">
                  <thead>
                     <tr role="row">
                        <th width="1%">Sr. No.</th>
                        <th width="10%">Puja</th>
                        <th width="10%">Language</th>
                        <th width="10%">Category</th>
                        <?php if (in_array('dashboard_view',$privilige) ){ //redirect if session expire
                              ?>
                        <th width="1%">Action</th>
                        
                      <?php }?>
                    </tr>     
                  </thead>
                  <tbody>
                      <?php
                     
                     if (!empty($pendingPoojaDeatails)) {
                           $page_no= !empty($this->uri->segment(3)) ? $this->uri->segment(3): 1;
                           $i = ($page_no * 10) - 9;
                      foreach ($pendingPoojaDeatails as $key => $value){
                                            
                     ?>
                         <tr>
                        <td class="text-center"><?php echo $i; ?></td>    
                        <td><?php echo !empty($value['pooja_name'])?ucfirst($value['pooja_name']):''; ?></td>
                        <td><?php echo !empty($value['language'])?ucfirst($value['language']):''; ?></td>
                        <td><?php echo !empty($value['category'])?ucfirst($value['category']):''; ?></td>
                         <?php     // print_r($userid);exit();


                              // print_r($privilige);die();
                             if (in_array('dashboard_view',$privilige) ){ //redirect if session expire
                              ?>
                        <td class="text-center">
                          
                          <a href="<?php echo base_url()?>admin/view-pending-pooja-booking/<?php echo (!empty($value['pk_id']) ? $value['pk_id'] : ''); ?>"><button type="button" class="btn btn-primary btn-xs" title="View"><i class="fa fa-eye"></i></button></a>

                        </td>
                        <?php }?>
                        </tr>
                           <?php
                  $i++;
                   }
               } ?>  
                        
                       
                  </tbody>
               </table> 
                   <ul class="pagination pull-right" >
                    <?php if (isset($follow_links) && !empty($follow_links)) { ?>
                   <p><?php echo $follow_links ?></p>
                 <?php } ?>
              </ul>            
            </div>    
     <div class="clearfix"></div>
    
</section>
<!-- End .content -->
</div>  
<!-- End .content-wrapper -->
<!-- START:: Footer -->
<?php include("application/views/admin/section/vw_footer.php"); ?>
<!-- END:: Footer -->
<script type="text/javascript">
   $(".dashboardLi").addClass("active");
   // $("#example").DataTable();
</script>
</body>
</html>