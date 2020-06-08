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
         Upcoming Pooja Booking Details
         <div class="pull-right">
            <a href="<?php echo base_url(); ?>admin/upcoming-pooja-booking-list"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</button></a>
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
                                 <?php $imgdata = !empty($upcomingView['customer_photo']) ? 'upload/customer_profile/' . $upcomingView['customer_photo'] : 'AdminMedia/images/avatar5.png'; ?>
                                 <img src="<?php echo base_url(). $imgdata;?>" class="reg-user-img" width="50%">
                              </div>
                           </div>
                           <div style="padding: 5px;background-color: #f1f5ff">
                              <table class="usertable">
                                 <tbody>
                                    <tr>
                                       <th width="30%">Customer Name</th>
                                       <td width="70%"><?php echo !empty($upcomingView['customer_name'])?ucfirst($upcomingView['customer_name']):''; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Mobile No.</th>
                                       <td><?php echo !empty($upcomingView['customer_mobile_no'])?$upcomingView['customer_mobile_no']:''; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Location</th>
                                       <td><?php echo !empty($upcomingView['customer_address'])?$upcomingView['customer_address']:''; ?></td>
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
                              <!-- <div class="reg-user-img" style="background-image: url('<?php echo base_url(); ?>AdminMedia/images/avatar-new.png')">
                              </div> -->
                               <div class="reg-user-img">
                                 <?php $imgdata = !empty($upcomingView['upload_profile_image']) ? 'upload/android/registartion/purohit_profile/' . $upcomingView['upload_profile_image'] : 'AdminMedia/images/avatar-new.png'; ?>
                                 <img src="<?php echo base_url(). $imgdata;?>" class="reg-user-img" width="50%">
                              </div>

                         </div>
                           <div style="padding: 5px;background-color: #f1f5ff">
                              <table class="usertable">
                                 <tbody>
                                    <tr>
                                       <th width="30%">Purohit Name</th>
                                       <td width="70%"><?php echo !empty($upcomingView['purohit_name'])?ucfirst($upcomingView['purohit_name']):''; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Mobile No.</th>
                                       <td><?php echo !empty($upcomingView['mobile_no'])?$upcomingView['mobile_no']:''; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Location</th>
                                       <td><?php echo !empty($upcomingView['address'])?$upcomingView['address']:''; ?></td>
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
                                       <td width="70%">Upcoming</td>
                                    </tr>
                                    <tr>
                                       <th>Date & Time</th>
                                       <td><?php echo !empty($upcomingView['pooja_date'])?date("d-m-Y", strtotime($upcomingView['pooja_date'])):''; ?></td>
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
                           <div class="col-md-6 lr-pd-5">
                              <h5 class="vw-head">Puja Id</h5>
                              <h6 class="vw-data">SP<?php echo !empty($upcomingView['pooja_order_id'])?$upcomingView['pooja_order_id']:''; ?></h6>
                           </div>
                           <div class="col-md-6 text-right lr-pd-5">
                              <h5 class="vw-head">Puja Scheduled On</h5>
                              <h6 class="vw-data"><?php echo !empty($upcomingView['pooja_date'])?date('d-m-Y', strtotime($upcomingView['pooja_date'])):''; ?> <?php echo !empty($upcomingView['pooja_time'])?date('h:i a', strtotime($upcomingView['pooja_time'])):''; ?></h6>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div class="col-md-9 lr-pd-5">
                        <label>Puja Venue</label>
                        <h2 class="view-cnt"><?php echo !empty($upcomingView['pooja_address'])?$upcomingView['pooja_address']:''; ?></h2>
                     </div>
                     <div class="col-md-3 lr-pd-5 text-right">
                        <label>Puja Ordered Date & Time</label>
                        <h2 class="view-cnt"><?php echo !empty($upcomingView['order_date'])?date('d-m-Y h:i a',strtotime($upcomingView['order_date'])):''; ?></h2>
                     </div>
                     <div class="clearfix"></div>
                     <div class="col-md-12 form-group no-pad">
                         <h4 class="poja-hd cl-brown">Puja Details</h4>
                         <h5 class="puj-det"><?php echo !empty($upcomingView['pooja_name'])?$upcomingView['pooja_name']:''; ?></h5>
                         <h5 class="puj-det"><?php echo !empty($upcomingView['package'])?$upcomingView['package']:''; ?></h5>
                     </div>
                     
                     <div class="col-md-12 form-group no-pad">
                         <h4 class="poja-hd cl-brown">Procedure Involved</h4>
                          <h5 class="pro-in"><?php echo !empty($upcomingView['description'])?$upcomingView['description']:''; ?></h5>
                         <!-- <h5 class="pro-in">Ganpati Puja</h5>
                         <h5 class="pro-in">Punyah Vachanam, Maha Sankalpam</h5>description
                         <h5 class="pro-in">Kalasha Puja</h5>
                         <h5 class="pro-in">Annaprasanam Puja</h5>
                         <h5 class="pro-in">Prasad Distribution</h5> -->
                     </div>
                     
                     <div class="col-md-12 form-group no-pad">
                         <h4 class="poja-hd cl-brown">Purohit Dakshina & Puja Material</h4>
                         <?php 
                         // echo "<pre>";
                         // print_r($pendingView);
                         // die();
                         //if (!empty($upcomingView['inclusive_services'])) {
                            // foreach ($upcomingView['inclusive_services'] as $key => $value){?>
                                  <h5 class="pro-in"><?php  //echo !empty($value['inclusive_services'])?$value['inclusive_services']:''; ?></h5>
                             <?//} 
                         //}
                         ?>
                        <!--  <h5 class="pro-in">All Puja Materials</h5>
                         <h5 class="pro-in">kalasha Puja</h5>
                         <h5 class="pro-in">Flowers & Fruits</h5>
                         <h5 class="pro-in">Havan</h5> -->
                     </div>
                     
                     <div class="col-md-12 form-group no-pad">
                         <h4 class="poja-hd cl-brown">Additional Services (<i class="fa fa-inr" aria-hidden="true"></i> <?php  echo !empty($upcomingView['sum_charges'])?$upcomingView['sum_charges']:'0'; ?>)</h4>


                         <table class="table table-striped table-hover">
                           <thead>
                             <tr>
                              <th>Additional Services</th>
                               <th>Purohit </th>
                               <th> Customer </th>
                             </tr>
                           </thead>
                           <tbody><?php 
                               if (!empty($upcomingView['services_exclusive'])) {
                                foreach ($upcomingView['services_exclusive'] as $key => $value){?>
                             <tr>
                               <td><?php  echo !empty($value['exclusive_services'])?$value['exclusive_services']:''; ?></td>
                               <td class="text-success"><i class="fa fa-inr"></i> 
                                 1000
                               </td>
                               <td class="text-success"><i class="fa fa-inr"></i> <?php  echo !empty($value['charges_to_show_purohit'])?$value['charges_to_show_purohit']:''; ?></td>
                             </tr>
                                 <?php }}?>

                             <tr>
                               <td class="pro-in tot-bld">Total Package Amount including Tax</td>
                               <td class="text-success"><i class=""></i></td>
                               <td class="text-success">
                                 <span class=" cl-green " ><i class="fa fa-inr" aria-hidden="true"></i> <?php  echo !empty($upcomingView['total_amount'])?$upcomingView['total_amount']:''; ?></span>
                               </td>
                             </tr>
                             <tr>
                              <td class="pro-in tot-bld">Purohit Amount</td>
                               <td class="text-success">
                               </td>
                               <td class="text-success"><span class="cl-green "><i class="fa fa-inr" aria-hidden="true"></i> <?php  echo !empty($upcomingView['purohit_charges'])?$upcomingView['purohit_charges']:''; ?></span></td>
                                
                             </tr>
                           </tbody>
                         </table>
                     </div>                     
                     <div class="clearfix"></div>                     
                  </div>             
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