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
         Cancelled Pooja Booking Details
         <div class="pull-right">
            <a href="<?php echo base_url(); ?>admin/cancelled-pooja-booking-list"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</button></a>
         </div>
      </h1>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="col-md-12 no-pad">
         <div class="row">
            <div class="col-md-4 no-right-pad">
               <div class="box box-primary no-height mg-bot-10">
                  <div class="box-body no-height no-pad">
                     <div class="col-md-12">
                        <div class="row">
                           <div class="col-md-12 no-pad">
                              <div class="view-hd">
                                 <p>Customer Details</p>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <!-- <div class="reg-user-img" style="background-image: url('<?php echo base_url(); ?>AdminMedia/images/avatar5.png')">
                              </div> -->
                               <div class="reg-user-img">
                                 <?php $imgdata = !empty($cancelledView[0]['customer_photo']) ? 'upload/customer_profile/' . $cancelledView[0]['customer_photo'] : 'AdminMedia/images/avatar5.png'; ?>
                                 <img src="<?php echo base_url(). $imgdata;?>" class="reg-user-img" width="50%">
                              </div>
                           </div>
                           <div style="padding: 5px;background-color: #f1f5ff">
                              <table class="usertable">
                                 <tbody>
                                    <tr>
                                       <th width="30%">Customer Name</th>
                                       <td width="70%"><?php echo !empty($cancelledView[0]['purohit_name'])?ucfirst($cancelledView[0]['purohit_name']):''; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Mobile No.</th>
                                       <td><?php echo !empty($cancelledView[0]['mobile_no'])?$cancelledView[0]['mobile_no']:''; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Location</th>
                                       <td><?php echo !empty($cancelledView[0]['address'])?$cancelledView[0]['address']:''; ?></td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="clearfix"></div>
               <div class="box box-primary no-height mg-bot-10">
                  <div class="box-body no-height no-pad">
                     <div class="col-md-12">
                        <div class="row">
                           <div class="col-md-12 no-pad">
                              <div class="view-hd">
                                 <p>Purohit Details</p>
                              </div>
                           </div>
                           <div class="col-md-12">
                             <!--  <div class="reg-user-img" style="background-image: url('<?php echo base_url(); ?>AdminMedia/images/avatar-new.png')">
                              </div> -->
                               <div class="reg-user-img">
                                 <?php $imgdata = !empty($cancelledView[0]['upload_profile_image']) ? 'upload/android/registartion/purohit_profile/' . $cancelledView[0]['upload_profile_image'] : 'AdminMedia/images/avatar-new.png'; ?>
                                 <img src="<?php echo base_url(). $imgdata;?>" class="reg-user-img" width="50%">
                              </div>
                           </div>
                           <div style="padding: 5px;background-color: #f1f5ff">
                              <table class="usertable">
                                 <tbody>
                                    <tr>
                                       <th width="30%">Purohit Name</th>
                                       <td width="70%"><?php echo !empty($cancelledView[0]['purohit_name'])?ucfirst($cancelledView[0]['purohit_name']):''; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Mobile No.</th>
                                       <td><?php echo !empty($cancelledView[0]['mobile_no'])?$cancelledView[0]['mobile_no']:''; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Location</th>
                                       <td><?php echo !empty($cancelledView[0]['address'])?$cancelledView[0]['address']:''; ?></td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="clearfix"></div>
               <div class="box box-primary no-height">
                  <div class="box-body no-height no-pad">
                     <div class="col-md-12">
                        <div class="row">
                           <div style="padding: 5px;background-color: #f1f5ff">
                              <table class="usertable">
                                 <tbody>
                                    <tr>
                                       <th width="30%">Status</th>
                                       <td width="70%">Cancelled</td>
                                    </tr>
                                    <tr>
                                       <th>Date & Time</th>
                                       <td><?php echo !empty($cancelledView[0]['cancelled_date_time'])?date("d-m-Y h:i a", strtotime($cancelledView[0]['cancelled_date_time'])):''; ?></td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                  </div>
               </div>
            </div>
            <div class="col-md-8">
               <div class="box box-primary" style="min-height: 0px;">
                  <div class="box-body">
                     <div class="col-md-12 no-pad">
                        <div class="vs-bx mg-bot-10">
                          <div class="col-md-6">
                            <h5 class="vw-head">Order Id</h5>    
                            <h6 class="vw-data"><?php echo !empty($cancelledView[0]['pooja_order_id'])?$cancelledView[0]['pooja_order_id']:''; ?></h6> 
                          </div>
                          <div class="col-md-6 text-right">
                            <h5 class="vw-head">Pooja Ordered On</h5>    
                            <h6 class="vw-data"><?php echo !empty($cancelledView[0]['order_date'])?date("d-m-Y h:i A", strtotime($cancelledView[0]['order_date'])):''; ?></h6> 
                          </div>                       
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     

                     <div class="col-md-12">
                      <h4 class="poja-hd">Pooja Details</h4>
                      <table class="usertable">
                           <tbody>
                              <tr>
                                 <th width="18%">Name</th>
                                 <td width="82%"><?php echo !empty($cancelledView[0]['pooja_name'])?$cancelledView[0]['pooja_name']:''; ?></td>
                              </tr>
                              <tr>
                                 <th>Description</th>
                                 <td><?php echo !empty($cancelledView[0]['short_description'])?$cancelledView[0]['short_description']:''; ?></td>
                              </tr>
                              <tr>
                                 <th width="18%">Pooja Scheduled On</th>
                                 <td width="82%"><?php echo !empty($cancelledView[0]['pooja_date'])?date("d-m-Y", strtotime($cancelledView[0]['pooja_date'])):''; ?> <?php echo !empty($cancelledView[0]['pooja_time'])?date("h:i:s a", strtotime($cancelledView[0]['pooja_time'])):''; ?></td>
                              </tr>
                              <tr>
                                <th colspan="2">
                                  <h4 class="poja-hd mg-lr-0">Package Details</h4>
                                </th>
                               </tr>
                                <tr>
                                 <th>Inclusive</th>
                                 <td><?php echo !empty($cancelledView[0]['inclusive_services'])?ucfirst($cancelledView[0]['inclusive_services']):'-'; ?></td>
                              </tr>
                               <tr>
                                 <th>Exclusive</th>
                                 <td><?php echo !empty($cancelledView[0]['services_exclusive'])?ucfirst($cancelledView[0]['services_exclusive']):'-'; ?></td>
                              </tr>
                              <tr>
                                 <th>Cost</th>
                                 <td><i class="fa fa-inr" aria-hidden="true"></i><?php echo !empty($cancelledView[0]['total_pkg_price_exclusive'])?ucfirst($cancelledView[0]['total_pkg_price_exclusive']):'-'; ?></td>
                              </tr>
                           </tbody>
                        </table>
                        
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
   $(".poojabkLi").addClass("active");
</script>
</body>
</html>