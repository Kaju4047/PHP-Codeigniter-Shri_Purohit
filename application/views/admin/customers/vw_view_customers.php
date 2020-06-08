<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content-header">
      <h1 style="margin:0px">
         Customer Details
         <div class="pull-right">
            <a href="<?php echo base_url(); ?>admin/customers-list"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</button></a>
         </div>
      </h1>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="col-md-12 no-pad">
         <div class="row">
            <div class="col-md-4 no-right-pad">
               <div class="box box-primary margin-bottom" style="min-height: 0px;">
                  <div class="box-body" style="min-height: 0px;padding: 0px;">
                     <div class="col-md-12">
                        <div class="row">
                           <div class="col-md-12 no-pad">
                              <div class="view-hd">
                                 <p>Customer Details</p>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <?php
                                if($customer_result->customer_photo==null)
                                {
                                  ?>
                                  <div class="reg-user-img" style="background-image: url('<?php echo base_url(); ?>AdminMedia/images/avatar5.png')">
                              </div>
                                <?php 
                              }
                              else
                              {?>
                                <div class="reg-user-img" style="background-image: url('<?php echo base_url(); ?>upload/customer_profile/<?= $customer_result->customer_photo; ?>')">
                                  </div>
                              <?php 
                            }
                              ?>
                           </div>
                           <div style="padding: 5px;background-color: #f1f5ff">
                              <table class="usertable">
                                 <tbody>
                                     <tr>
                                       <th width="28%">Registered On</th>
                                       <td style="border-top:none;" width="72%"><?php echo date('Y-m-d',strtotime($customer_result->created_date));?></td>
                                    </tr>
                                    <tr>
                                       <th>Name</th>
                                       <td><?php echo $customer_result->customer_name; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Mobile No.</th>
                                       <td><?php echo $customer_result->customer_mobile_no; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Email Id</th>
                                       <td><?php echo $customer_result->customer_email_id; ?></td>
                                    </tr>
                                    <tr>
                                       <th>City</th>
                                       <td><?php echo $customer_result->customer_city; ?></td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  <!-- End box-body -->
               </div>
            </div>
            <div class="col-md-8">
               
               <div class="box box-primary" style="min-height: 0px;">
                  <div class="box-body">
                     <div class="col-md-12 no-pad">

                        <div class="col-md-4 col-xs-4">
                           <div class="small-box bg-aqua">
                             <div class="inner">
                               <h3>Upcoming Puja</h3>
                               <p class=""></p><?php echo !empty($upcomingPoojaCount)?$upcomingPoojaCount:0; ?></p>
                             </div>
                            <a href="<?php echo base_url();?>admin/upcoming-pooja-booking-list?cust_id=<?php echo $this->uri->segment(3);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                           </div>
                         </div>
                         <div class="col-md-4 col-xs-4">
                           <div class="small-box bg-green">
                             <div class="inner">
                               <h3>Completed Puja</h3>
                               <p class=""><?php echo !empty($completedPoojaCount)?$completedPoojaCount:0; ?></p>
                             </div>
                            <a href="<?php echo base_url();?>admin/completed-pooja-booking-list?cust_id=<?php echo $this->uri->segment(3);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                           </div>
                         </div>
                         <div class="col-md-4 col-xs-4">
                           <div class="small-box bg-red">
                             <div class="inner">
                               <h3>Cancelled Puja</h3>
                               <p class=""><?php echo !empty($cancelledPoojaCount)?$cancelledPoojaCount:0; ?></p>
                             </div>
                            <a href="<?php echo base_url();?>admin/cancelled-pooja-booking-list?cust_id=<?php echo $this->uri->segment(3);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                           </div>
                         </div>
                         
                     </div>
                  </div>
                  <!-- End box-body -->
               </div>
            </div>
         </div>
         <!-- End box -->
      </div>
      <!-- End col-md-4 -->
      <div class="clearfix"></div>
   </section>
</div>
<!-- End .content-wrapper --> 
<!-- START:: Footer -->
<?php include("application/views/admin/section/vw_footer.php"); ?>
<!-- END:: Footer -->
<script>
   $(".customerLi").addClass("active");
 </script>
</body>
</html>