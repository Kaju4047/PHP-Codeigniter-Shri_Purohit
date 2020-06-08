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
         Rejected Pooja Booking Details
         <div class="pull-right">
            <a href="<?php echo base_url(); ?>admin/reject-pooja-booking-list"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</button></a>
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
                                 <?php $imgdata = !empty($rejectedView['customer_photo']) ? 'upload/customer_profile/' . $rejectedView['customer_photo'] : 'AdminMedia/images/avatar5.png'; ?>
                                 <img src="<?php echo base_url(). $imgdata;?>" class="reg-user-img" width="50%">
                              </div>
                           </div>
                           <div style="padding: 5px;background-color: #f1f5ff">
                              <table class="usertable">
                                 <tbody>
                                    <tr>
                                       <th width="30%">Customer Name</th>
                                       <td width="70%"><?php echo !empty($rejectedView['customer_name'])?ucfirst($rejectedView['customer_name']):''; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Mobile No.</th>
                                       <td><?php echo !empty($rejectedView['customer_mobile_no'])?$rejectedView['customer_mobile_no']:''; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Location</th>
                                       <td><?php echo !empty($rejectedView['customer_address'])?$rejectedView['customer_address']:''; ?></td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="clearfix"></div>
         <!--       <div class="box box-primary no-height mg-bot-10">
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
                            <!--   <div class="reg-user-img">
                                 <?php $imgdata = !empty($rejectedView['upload_profile_image']) ? 'upload/android/registartion/purohit_profile/' . $rejectedView['upload_profile_image'] : 'AdminMedia/images/avatar-new.png'; ?>
                                 <img src="<?php echo base_url(). $imgdata;?>" class="reg-user-img" width="50%">
                              </div>
                           </div>
                           <div style="padding: 5px;background-color: #f1f5ff">
                              <table class="usertable">
                                 <tbody>
                                    <tr>
                                       <th width="30%">Purohit Name</th>
                                       <td width="70%"><?php echo !empty($rejectedView['purohit_name'])?ucfirst($rejectedView['purohit_name']):''; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Mobile No.</th>
                                       <td><?php echo !empty($rejectedView['mobile_no'])?$rejectedView['mobile_no']:''; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Location</th>
                                       <td><?php echo !empty($rejectedView['address'])?$rejectedView['address']:''; ?></td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div> -->
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
                                       <td width="70%">Rejected</td>
                                    </tr>
                                   <!--  <tr>
                                       <th>Date & Time</th>
                                       <td><?php echo !empty($rejectedView[0]['updated_date'])?date("d-m-Y", strtotime($rejectedView[0]['updated_date'])):''; ?></td>
                                    </tr> -->
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
                           <div class="col-md-6 lr-pd-5">
                              <h5 class="vw-head">Puja Id</h5>
                              <h6 class="vw-data">SP<?php echo !empty($rejectedView['pooja_order_id'])?$rejectedView['pooja_order_id']:''; ?></h6>
                           </div>
                           <div class="col-md-6 text-right lr-pd-5">
                              <h5 class="vw-head">Puja Scheduled On</h5>
                              <h6 class="vw-data"><?php echo !empty($rejectedView['pooja_date'])?date('d-m-Y', strtotime($rejectedView['pooja_date'])):''; ?> <?php echo !empty($rejectedView['pooja_time'])?date('h:i a', strtotime($rejectedView['pooja_time'])):''; ?></h6>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div class="col-md-9 lr-pd-5">
                        <label>Puja Venue</label>
                        <h2 class="view-cnt"><?php echo !empty($cancelledView['pooja_address'])?$rejectedView['pooja_address']:''; ?></h2>
                     </div>
                     <div class="col-md-3 lr-pd-5 text-right">
                        <label>Puja Ordered Date & Time</label>
                        <h2 class="view-cnt"><?php echo !empty($rejectedView['order_date'])?date('d-m-Y h:i a',strtotime($rejectedView['order_date'])):''; ?></h2>
                     </div>
                     <div class="clearfix"></div>
                     <div class="col-md-12 form-group no-pad">
                         <h4 class="poja-hd cl-brown">Puja Details</h4>
                         <h5 class="puj-det"><?php echo !empty($rejectedView['pooja_name'])?$rejectedView['pooja_name']:''; ?></h5>
                         <h5 class="puj-det"><?php echo !empty($rejectedView['package'])?$rejectedView['package']:''; ?></h5>
                     </div>
                     
                     <div class="col-md-12 form-group no-pad">
                         <h4 class="poja-hd cl-brown">Procedure Involved</h4>
                          <h5 class="pro-in"><?php echo !empty($rejectedView['description'])?$rejectedView['description']:''; ?></h5>
                     </div>
                     
                     <div class="col-md-12 form-group no-pad">
                         <h4 class="poja-hd cl-brown">Purohit Dakshina & Puja Material</h4>
                         <?php 
                         //if (!empty($rejectedView['inclusive_services'])) {
                            // foreach ($rejectedView['inclusive_services'] as $key => $value){?>
                                  <h5 class="pro-in"><?php  //echo !empty($value['inclusive_services'])?$value['inclusive_services']:''; ?></h5>
                             <?//} 
                         //}
                         ?>
                     </div>
                     
                     <div class="col-md-12 form-group no-pad">
                         <h4 class="poja-hd cl-brown">Additional Services (<i class="fa fa-inr" aria-hidden="true"></i> <?php  echo !empty($rejectedView['sum_charges'])?$rejectedView['sum_charges']:'0'; ?>)</h4>
                         <table class="table table-striped table-hover">
                           <thead>
                             <tr>
                              <th>Additional Services</th>
                              <th>Purohit</th>
                              <th>Customer</th>
                             </tr>
                           </thead>
                           <tbody><?php 
                               if (!empty($rejectedView['services_exclusive'])) {
                                foreach ($rejectedView['services_exclusive'] as $key => $value){?>
                             <tr>
                               <td><?php  echo !empty($value['exclusive_services'])?$value['exclusive_services']:''; ?></td>
                               <td class="text-success"><i class="fa fa-inr"></i> 
                                  <?php  echo !empty($value['charges_to_show_purohit'])?$value['charges_to_show_purohit']:''; ?>
                               </td>
                               <td class="text-success"><i class="fa fa-inr"></i> <?php  echo !empty($value['services_charges'])?$value['services_charges']:''; ?></td>
                             </tr>
                                 <?php }}?>

                             <tr>
                               <td class="pro-in tot-bld">Total Package Amount including Tax</td>
                               <td class="text-success"><i class=""></i></td>
                               <td class="text-success">
                                 <span class=" cl-green " ><i class="fa fa-inr" aria-hidden="true"></i> <?php  echo !empty($rejectedView['total_amount'])?$rejectedView['total_amount']:''; ?></span>
                               </td>
                             </tr>
                            <!--  <tr>
                              <td class="pro-in tot-bld">Purohit Charges</td>
                               <td class="text-success">
                               </td>
                               <td class="text-success"><span class="cl-green "><i class="fa fa-inr" aria-hidden="true"></i> <?php  echo !empty($rejectedView['purohit_charges'])?$rejectedView['purohit_charges']:''; ?></span></td>
                                
                             </tr> -->
                           </tbody>
                         </table>
                     
                     <div class="clearfix"></div>                     
                  </div>  
                     <!-- <div class="col-md-12 no-pad">
                        <div class="vs-bx mg-bot-10">
                          <div class="col-md-6">
                            <h5 class="vw-head">Order Id</h5>    
                            <h6 class="vw-data"><?php echo !empty($rejectedView[0]['pooja_order_id'])?$rejectedView[0]['pooja_order_id']:''; ?></h6> 
                          </div>
                          <div class="col-md-6 text-right">
                            <h5 class="vw-head">Pooja Ordered On</h5>    
                            <h6 class="vw-data"><?php echo !empty($rejectedView[0]['order_date'])?date("d-m-Y h:i A", strtotime($rejectedView[0]['order_date'])):''; ?></h6> 
                          </div>                       
                        </div>
                     </div> -->
                     <div class="clearfix"></div>
                     

                    <!--  <div class="col-md-12">
                      <h4 class="poja-hd">Pooja Details</h4>
                      <table class="usertable">
                           <tbody>
                              <tr>
                                 <th width="18%">Name</th>
                                 <td width="82%"><?php echo !empty($rejectedView[0]['pooja_name'])?$rejectedView[0]['pooja_name']:''; ?></td>
                              </tr>
                              <tr>
                                 <th>Description</th>
                                 <td><?php echo !empty($rejectedView[0]['short_description'])?$rejectedView[0]['short_description']:''; ?></td>
                              </tr>
                              <tr>
                                 <th width="18%">Pooja Scheduled On</th>
                                 <td width="82%"><?php echo !empty($rejectedView[0]['pooja_date'])?date("d-m-Y", strtotime($rejectedView[0]['pooja_date'])):''; ?> <?php echo !empty($rejectedView[0]['pooja_time'])?date("h:i:s a", strtotime($rejectedView[0]['pooja_time'])):''; ?></td>
                              </tr>
                              <tr>
                                <th colspan="2">
                                  <h4 class="poja-hd mg-lr-0">Package Details</h4>
                                </th>
                               </tr>
                                <tr>
                                 <th>Inclusive</th>
                                 <td><?php echo !empty($rejectedView[0]['inclusive_services'])?ucfirst($rejectedView[0]['inclusive_services']):'-'; ?></td>
                              </tr>
                               <tr>
                                 <th>Exclusive</th>
                                 <td><?php echo !empty($rejectedView[0]['services_exclusive'])?ucfirst($rejectedView[0]['services_exclusive']):'-'; ?></td>
                              </tr>
                              <tr>
                                 <th>Cost</th>
                                 <td><i class="fa fa-inr" aria-hidden="true"></i><?php echo !empty($rejectedView[0]['total_pkg_price_exclusive'])?ucfirst($rejectedView[0]['total_pkg_price_exclusive']):'-'; ?></td>
                              </tr>
                           </tbody>
                        </table>                       
                     </div> -->
                      <table id="example" class="table table-bordered table-striped table-hover" width="100%">
                  <thead>
                     <tr>
                        <th width="4%">Sr. No.</th>
                        <th width="15%">Purohit Name</th>
                        <th width="15%">Purohit Mobile No.</th>
                        <th width="16%">Rejected Date & Time</th>
                        <th width="8%">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php                     
                     if (!empty($rejectedPoojaPurohit)) {
                           $i = 1;
                      foreach ($rejectedPoojaPurohit as $key => $value){                                            
                     ?>
                     <tr>
                        <td class="text-center"><?= $i;?></td>
                        <td><?php echo !empty($value['purohit_name'])?ucfirst($value['purohit_name']):'-'; ?></td>
                        <td><?php echo !empty($value['mobile_no'])?ucfirst($value['mobile_no']):''; ?></td>
                    
                        <td><?php echo !empty($value['created_date'])?date("d-m-Y", strtotime($value['created_date'])):''; ?></td>
                        <td class="text-center">
                          <a href="<?php echo base_url(); ?>admin/view-registered-purohit/<?php echo (!empty($value['pk_id']) ? $value['pk_id'] : ''); ?>"><button type="button" class="btn btn-primary btn-xs" title="View"><i class="fa fa-eye"></i></button></a>
                        </td>
                     </tr>
                       <?php
                  $i++;
                   }
               } ?>
                  </tbody>
               </table>
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