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
         Refund Pooja Booking Details
         <div class="pull-right">
            <a href="<?php echo base_url(); ?>admin/refund-pooja-booking-list"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</button></a>
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
                              <div class="reg-user-img">
                                 <?php $imgdata = !empty($refundView['customer_photo']) ? 'upload/customer_profile/' . $refundView['customer_photo'] : 'AdminMedia/images/avatar5.png'; ?>
                                 <img src="<?php echo base_url(). $imgdata;?>" class="reg-user-img" width="50%">
                              </div>
                           </div>
                           <div style="padding: 5px;background-color: #f1f5ff">
                              <table class="usertable">
                                 <tbody>
                                    <tr>
                                       <th width="30%">Customer Name</th>
                                       <td width="70%"><?php echo !empty($refundView['customer_name'])?ucfirst($refundView['customer_name']):'-'; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Mobile No.</th>
                                       <td><?php echo !empty($refundView['customer_mobile_no'])?$refundView['customer_mobile_no']:'-'; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Location</th>
                                       <td><?php echo !empty($refundView['customer_address'])?$refundView['customer_address']:'-'; ?></td>
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
                              <div class="reg-user-img">
                                 <?php $imgdata = !empty($refundView['upload_profile_image']) ? 'upload/android/registartion/purohit_profile/' . $refundView['upload_profile_image'] : 'AdminMedia/images/avatar-new.png'; ?>
                                 <img src="<?php echo base_url(). $imgdata;?>" class="reg-user-img" width="50%">
                              </div>
                           </div>
                           <div style="padding: 5px;background-color: #f1f5ff">
                              <table class="usertable">
                                 <tbody>
                                    <tr>
                                       <th width="30%">Purohit Name</th>
                                       <td width="70%"><?php echo !empty($refundView['purohit_name'])?ucfirst($refundView['purohit_name']):'-'; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Mobile No.</th>
                                       <td><?php echo !empty($refundView['mobile_no'])?$refundView['mobile_no']:'-'; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Location</th>
                                       <td><?php echo !empty($refundView['address'])?$refundView['address']:'-'; ?></td>
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
                                       <td width="70%"><?php if (!empty($refundView['refund_status']) && $refundView['refund_status'] == 'Not Refund') {
                                           echo "New";
                                        }elseif(!empty($refundView['refund_status']) && $refundView['refund_status'] == 'Refund'){
                                          echo "Refunded";
                                        }
                                     ?></td>
                                    </tr>
                                    <tr>
                                       <th>Date & Time</th>
                                       <td><?php echo !empty($refundView['refund_date'])?date("d-m-Y", strtotime($refundView['refund_date'])):''; ?> <?= !empty($refundView['refund_time'])?date('h:i a', strtotime($refundView['refund_time'])):""; ?></td>
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
                              <h6 class="vw-data">SP<?php echo !empty($refundView['pooja_order_id'])?$refundView['pooja_order_id']:''; ?></h6>
                           </div>
                           <div class="col-md-6 text-right lr-pd-5">
                              <h5 class="vw-head">Puja Scheduled On</h5>
                              <h6 class="vw-data"><?php echo !empty($refundView['pooja_date'])?date('d-m-Y', strtotime($refundView['pooja_date'])):''; ?> <?php echo !empty($refundView['pooja_time'])?date('h:i a', strtotime($refundView['pooja_time'])):''; ?></h6>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div class="col-md-9 lr-pd-5">
                        <label>Puja Venue</label>
                        <h2 class="view-cnt"><?php echo !empty($refundView['pooja_address'])?$refundView['pooja_address']:''; ?></h2>
                     </div>
                     <div class="col-md-3 lr-pd-5 text-right">
                        <label>Puja Date & Time</label>
                        <h2 class="view-cnt"><?php echo !empty($refundView['order_date'])?date('d-m-Y h:i a',strtotime($refundView['order_date'])):''; ?></h2>
                     </div>
                     <div class="clearfix"></div>
                     <div class="col-md-12 form-group no-pad">
                         <h4 class="poja-hd cl-brown">Puja Details</h4>
                         <h5 class="puj-det"><?php echo !empty($refundView['pooja_name'])?$refundView['pooja_name']:''; ?></h5>
                         <h5 class="puj-det"><?php echo !empty($refundView['package'])?$refundView['package']:''; ?></h5>
                     </div>
                     
                     <div class="col-md-12 form-group no-pad">
                         <h4 class="poja-hd cl-brown">Procedure Involved</h4>
                         <h5 class="pro-in"><?php echo !empty($refundView['description'])?$refundView['description']:''; ?></h5>
                     </div>
                     
                      <div class="col-md-12 form-group no-pad">
                         <h4 class="poja-hd cl-brown">Purohit Dakshina & Puja Material</h4>
                         <?php 
                         //if (!empty($refundView['inclusive_services'])) {
                           //  foreach ($refundView['inclusive_services'] as $key => $value){?>
                                  <h5 class="pro-in"><?php  //echo !empty($value['inclusive_services'])?$value['inclusive_services']:''; ?></h5>
                             <?//} 
                         //}
                         ?>
                     </div>
                     
                    <!--  <div class="col-md-12 form-group no-pad">
                         <h4 class="poja-hd cl-brown">Exclusion (<i class="fa fa-inr" aria-hidden="true"></i> 700)</h4>
                         <h5 class="pro-in">All Puja Materials <span class="pull-right cl-green"><i class="fa fa-inr" aria-hidden="true"></i> 200</span></h5>
                         <h5 class="pro-in">Flowers & Fruits <span class="pull-right cl-green"><i class="fa fa-inr" aria-hidden="true"></i> 500</span></h5>
                         <h5 class="pro-in">Purohit Charges <span class="pull-right cl-green"><i class="fa fa-inr" aria-hidden="true"></i> 4000</span></h5>
                         <h5 class="pro-in tot-bld">Total Package Amount <span class="pull-right cl-green"><i class="fa fa-inr" aria-hidden="true"></i> 4700</span></h5>
                     </div> -->

                     <div class="col-md-12 form-group no-pad">
                         <h4 class="poja-hd cl-brown">Additional Services (<i class="fa fa-inr" aria-hidden="true"></i> <?php  echo !empty($refundView['sum_charges'])?$refundView['sum_charges']:'0'; ?>)</h4>


                         <!-- <table class="table table-striped table-hover">
                           <thead>
                             <tr>
                              <th>Exclusion</th>
                               <th>Purohit </th>
                               <th> Customer </th>
                             </tr>
                           </thead>
                           <tbody><?php 
                               if (!empty($refundView['services_exclusive'])) {
                                foreach ($refundView['services_exclusive'] as $key => $value){?>
                             <tr>
                               <td><?php  echo !empty($value['exclusive_services'])?$value['exclusive_services']:''; ?></td>
                               <td class="text-success"><i class="fa fa-inr"></i> 
                                 <?php  echo !empty($value['charges_to_show_purohit'])?$value['charges_to_show_purohit']:''; ?>
                               </td>
                               <td class="text-success"><i class="fa fa-inr"></i><?php  echo !empty($value['purohit_charges'])?$value['purohit_charges']:''; ?></td>
                             </tr>
                                 <?php }}?>

                             <tr>
                               <td class="pro-in tot-bld">Total Package Amount</td>
                               <td class="text-success"><i class=""></i></td>
                               <td class="text-success">
                                 <span class=" cl-green " ><i class="fa fa-inr" aria-hidden="true"></i> <?php  echo !empty($refundView['total_amount'])?$refundView['total_amount']:''; ?></span>
                               </td>
                             </tr>
                             <tr>
                              <td class="pro-in tot-bld">Purohit Charges</td>
                               <td class="text-success">
                               </td>
                               <td class="text-success"><span class="cl-green "><i class="fa fa-inr" aria-hidden="true"></i> <?php  echo !empty($refundView['purohit_charges'])?$refundView['purohit_charges']:''; ?></span></td>
                                
                             </tr>
                           </tbody>
                         </table> -->
                           <table class="table table-striped table-hover">
                           <thead>
                             <tr>
                              <th>Additional Services</th>
                               <th>Purohit </th>
                               <th> Customer </th>
                             </tr>
                           </thead>
                           <tbody><?php 
                               if (!empty($refundView['services_exclusive'])) {
                                foreach ($refundView['services_exclusive'] as $key => $value){?>
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
                                 <span class=" cl-green " ><i class="fa fa-inr" aria-hidden="true"></i> <?php  echo !empty($refundView['total_amount'])?$refundView['total_amount']:''; ?></span>
                               </td>
                             </tr>
                           <!--   customer_charges
                             <?php $refundView['purohit_charges']?> -->
                              <?php if (!empty($refundView['cancellation_charges'])) {?>
                  
                               <tr>
                                <td class="pro-in tot-bld">Customer Charges</td>
                                 <td class="text-success">
                                 </td>
                                 <td class="text-success"><span class="cl-green "><i class="fa fa-inr" aria-hidden="true"></i> <?php  echo !empty($refundView['cancellation_charges'])?$refundView['cancellation_charges']:''; ?></span></td>
                                  
                               </tr>
                             <?}elseif($refundView['cancellation_charges']!=0) {?>
                                <tr>
                                <td class="pro-in tot-bld">Customer Charges</td>
                                 <td class="text-success">
                                 </td>
                                 <td class="text-success"><span class="cl-green "><i class="fa fa-inr" aria-hidden="true"></i> <?php  echo !empty($refundView['purohi_cancellation_charges'])?$refundView['purohi_cancellation_charges']:''; ?></span></td>
                                  
                               </tr>
                            
                            <?php }
                             ?>
                           </tbody>
                         </table>

                     </div>
                     
                     <div class="clearfix"></div>
                     <h4 class="poja-hd">Refund Details</h4>
                     <table class="usertable form-group">
                        <tbody>
                           <tr>
                              <th width="22%">Refund Amount</th>
                              <td width="78%"><i class="fa fa-inr" aria-hidden="true"></i> <?php  echo !empty($refundView['customer_charges'])?$refundView['customer_charges']:$refundView['customer_charges']; ?></td>
                           </tr>
                           <tr>
                              <th>Bank Name</th>
                              <td><?php  echo !empty($refundView['bank_name'])?$refundView['bank_name']:''; ?></td>
                           </tr>
                           <tr>
                              <th>Branch Name</th>
                              <td><?php  echo !empty($refundView['branch_name'])?$refundView['branch_name']:''; ?></td>
                           </tr>
                           <tr>
                              <th>IFSC Code</th>
                              <td><?php  echo !empty($refundView['ifsc_code'])?$refundView['ifsc_code']:''; ?></td>
                           </tr>
                           <tr>
                              <th>Account Holder Name</th>
                              <td><?php  echo !empty($refundView['acc_holder_name'])?$refundView['acc_holder_name']:''; ?></td>
                           </tr>
                           <tr>
                              <th>Account No.</th>
                              <td><?php  echo !empty($refundView['account_number'])?$refundView['account_number']:''; ?></td>
                           </tr>
                        </tbody>
                     </table>
                      <?php if( !empty($refundView) && $refundView['refund_status']!= 'Refund') { ?>

                     <div class="col-md-4 lr-pd-5 form-group">
                        <label>Request Status</label>
                        <?php if( !empty($refundView) && $refundView['refund_status']== 'Refund') { ?>

                          <?php ;} ?>
                        <select class="form-control" id="selreq">
                           <option value="nosts">Select Status</option>
                           <option value="newsts">New</option>
                           <option value="refsts"<?php if( !empty($refundView) && $refundView['refund_status']== 'Refund') { echo "selected" ;} ?>>Refunded</option>
                        </select>
                     </div>
                          <?php ;} ?>
                     <div class="clearfix"></div>
                     <div class="col-md-12 lr-pd-5 form-group" id="refunded-div">
                       <!-- <form method="post" id="add_refund" action="<?php echo base_url()?>admin/<?php  echo !empty($refundView['pk_id'])?$refundView['pk_id']:''; ?>"> -->
                       <form method="post" id="add_refund" action="<?php echo base_url()?>admin/add-refund/<?php  echo !empty($refundView['pk_id'])?$refundView['pk_id']:''; ?>">
                        <div class="col-md-4 form-group no-left-pad">
                           <label>Transaction Id</label>
                           <input type="text" name="transaction_id" id="transaction_id" class="form-control" autocomplete="off">
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-4 form-group no-left-pad">
                           <label>Date </label>
                           <div class="input-group date" data-date-format="dd.mm.yyyy" >
                              <input type="text"  id="date" name="date" class="form-control" placeholder="dd-mm-yyyy">
                              <div class="input-group-addon">
                                 <span class="glyphicon glyphicon-calendar"></span>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4 form-group no-left-pad">
                           <label>Time</label>
                           <div class="input-group time" >
                              <input type="text" class="form-control" id="time" name="time" />
                              <span class="input-group-addon">
                              <span class="glyphicon glyphicon-time"></span>
                              </span>
                           </div>
                        </div>
                        <div class="col-md-8 form-group no-left-pad">
                           <label>Remark</label>
                           <textarea class="form-control" id="remark" name="remark" rows="3" style="resize:none;"></textarea>
                        </div>
                        <div class="col-md-12 form-group no-pad">
                           <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
                        </div>
                      </form>
                     </div>
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
<script type="text/javascript" src="<?php echo base_url('AdminMedia/validations/js_refund/refund.js'); ?>"></script>
<script>
   $(".poojabkLi").addClass("active");
   
   $(document).ready(function()
   {    
      $("#refunded-div").hide();
       
      $("#selreq").change(function()
      {
          if($(this).val() == "newsts")
          {
              $("#refunded-div").hide();
          }
          if($(this).val() == "refsts")
          {
              $("#refunded-div").show();
          }
          if($(this).val() == "nosts")
          {
              $("#refunded-div").hide();
          } 
       });
   });
   
   $('#time').datetimepicker({
    format: 'LT'
   });
   
   $('#date').datepicker(
      { 
        format: "dd-mm-yyyy",   
        autoclose:true,     
        todayHighlight: true,
        startDate: new Date()
      });
</script>
</body>
</html>