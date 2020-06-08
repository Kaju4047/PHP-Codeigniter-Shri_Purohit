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
         Pending Pooja Booking Details
         <div class="pull-right">
            <a href="<?php echo base_url(); ?>admin/pending-pooja-booking-list"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</button></a>
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
                                 <?php $imgdata = !empty($pendingView['customer_photo']) ? 'upload/customer_profile/' . $pendingView['customer_photo'] : 'AdminMedia/images/avatar5.png'; ?>
                                 <img src="<?php echo base_url(). $imgdata;?>" class="reg-user-img" width="50%">
                              </div>          
                           </div>
                           <div style="padding: 5px;background-color: #f1f5ff">
                              <table class="usertable">
                                 <tbody>
                                    <tr>
                                       <th width="30%">Customer Name</th>
                                       <td width="70%"><?php echo !empty($pendingView['customer_name'])?ucfirst($pendingView['customer_name']):''; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Mobile No.</th>
                                       <td><?php echo !empty($pendingView['customer_mobile_no'])?$pendingView['customer_mobile_no']:''; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Location</th>
                                       <td><?php echo !empty($pendingView['customer_address'])?$pendingView['customer_address']:''; ?></td>
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
                           <form method="post" id="assign_purohit_form" name="assign_purohit_form"action="<?php echo base_url()?>admin/admin-assign-purohit">
                           <div style="padding: 5px;background-color: #f1f5ff">
                              <div class="col-md-12 form-group">
                                 <input type="hidden" name="pooja_order_id" id="pooja_order_id" value="<?php echo !empty($pendingView['pooja_order_id'])? $pendingView['pooja_order_id'] :''?>">
                                 <label>Assigned Purohit</label>
                                  <select class="form-control select2" name="assign_purohit" id="assign_purohit"> 
                                     <option value="">Select Purohit</option>
                                     <?php 
                                       if (!empty($purohitList)) {
                                           foreach ($purohitList as $key => $value) { ?>
                                             <option value="<?php  echo !empty($value['pk_id'])?$value['pk_id']:''?>"<?php echo( (!empty($pendingView['fk_purohit']) && $pendingView['fk_purohit']==$value['pk_id'])?'selected' : '')?>> <?php  echo !empty($value['purohit_name'])?$value['purohit_name']:''?></option>
                                          <? }
                                       } 
                                     ?>
                                 </select>
                              </div>
                              <div class="col-md-12 form-group">
                                 <label>Remark</label>
                                 <textarea rows="3" class="form-control" id="remark" name="remark" style="resize: none;" value="<?php echo !empty($pendingView['admin_assign_purohit_remark']) ? $pendingView['admin_assign_purohit_remark']:'';?>"><?php echo !empty($pendingView['admin_assign_purohit_remark']) ? $pendingView['admin_assign_purohit_remark']:'';?> </textarea>
                              </div>
                              <div class="clearfix"></div>
                              <div class="col-md-12 form-group">          
                                 <button type="submit" 
                                 
                                 <?php if($pendingView['pooja_date'] < date('Y-m-d')){?>onClick="return confirm('Pooja Date is expired. Do you want to Cancelled Pooja?')" attr= "<?php echo $pendingView['pooja_order_id'] ?>" <?} ?> class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
                                 <button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancel</button>
                              </div>
                           </div>
                           </form>
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
                                       <td width="70%">Pending</td>
                                    </tr>
                                    <!-- <tr>
                                       <th>Date & Time</th>
                                       <td>2-12-2019, 11:12:32</td>
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
                              <h6 class="vw-data">SP<?php echo !empty($pendingView['pooja_order_id'])?$pendingView['pooja_order_id']:''; ?></h6>
                           </div>
                           <div class="col-md-6 text-right lr-pd-5">
                              <h5 class="vw-head">Puja Scheduled On</h5>
                              <h6 class="vw-data"><?php echo !empty($pendingView['pooja_date'])?date('d-m-Y', strtotime($pendingView['pooja_date'])):''; ?> <?php echo !empty($pendingView['pooja_time'])?date('h:i a', strtotime($pendingView['pooja_time'])):''; ?></h6>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div class="col-md-9 lr-pd-5">
                        <label>Puja Venue</label>
                        <h2 class="view-cnt"><?php echo !empty($pendingView['pooja_address'])?$pendingView['pooja_address']:''; ?></h2>
                     </div>
                     <div class="col-md-3 lr-pd-5 text-right">
                        <label>Puja Ordered Date & Time</label>
                        <h2 class="view-cnt"><?php echo !empty($pendingView['order_date'])?date('d-m-Y h:i a',strtotime($pendingView['order_date'])):''; ?></h2>
                     </div>
                     <div class="clearfix"></div>
                     <div class="col-md-12 form-group no-pad">
                         <h4 class="poja-hd cl-brown">Puja Details</h4>
                         <h5 class="puj-det"><?php echo !empty($pendingView['pooja_name'])?$pendingView['pooja_name']:''; ?></h5>
                         <h5 class="puj-det"><?php echo !empty($pendingView['package'])?$pendingView['package']:''; ?></h5>
                     </div>
                     
                     <div class="col-md-12 form-group no-pad">
                         <h4 class="poja-hd cl-brown">Procedure Involved</h4>
                          <h5 class="pro-in"><?php echo !empty($pendingView['description'])?$pendingView['description']:''; ?></h5>
                     </div>
                     
                     <div class="col-md-12 form-group no-pad">
                         <h4 class="poja-hd cl-brown">Purohit Dakshina & Puja Material</h4>
                         <?php 
                         //if (!empty($pendingView['inclusive_services'])) {
                           //  foreach ($pendingView['inclusive_services'] as $key => $value){?>
                                  <h5 class="pro-in"><?php  //echo !empty($value['inclusive_services'])?$value['inclusive_services']:''; ?></h5>
                             <?//} 
                         //}
                         ?>
                         
                     </div>
                     
                     <div class="col-md-12 form-group no-pad">
                         <h4 class="poja-hd cl-brown">Additional Services (<i class="fa fa-inr" aria-hidden="true"></i> <?php  echo !empty($pendingView['sum_charges'])?$pendingView['sum_charges']:'0'; ?>)</h4>


                         <table class="table table-striped table-hover">
                           <thead>
                             <tr>
                              <th>Additional Services</th>
                               <th>Purohit </th>
                               <th> Customer </th>
                             </tr>
                           </thead>
                           <tbody><?php 
                               if (!empty($pendingView['services_exclusive'])) {
                                foreach ($pendingView['services_exclusive'] as $key => $value){?>
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
                                 <span class=" cl-green " ><i class="fa fa-inr" aria-hidden="true"></i> <?php  echo !empty($pendingView['total_amount'])?$pendingView['total_amount']:''; ?></span>
                               </td>
                             </tr>
                          <!--    <tr>
                              <td class="pro-in tot-bld">Purohit Charges</td>
                               <td class="text-success">
                               </td>
                               <td class="text-success"><span class="cl-green "><i class="fa fa-inr" aria-hidden="true"></i> <?php  echo !empty($pendingView['purohit_charges'])?$pendingView['purohit_charges']:''; ?></span></td>
                                
                             </tr> -->
                           </tbody>
                         </table>
                     
                     <div class="clearfix"></div>                     
                  </div>             
            </div>
         </div>
         </div>
         <!-- End box -->
      </div>
    </div>
      <!-- End col-md-4 -->
      <div class="clearfix"></div>
   </section>
</div>
<!-- End .content-wrapper --> 
<!-- START:: Footer -->
<?php include("application/views/admin/section/vw_footer.php");?>
<!-- END:: Footer -->
<script type="text/javascript" src="<?php echo base_url('AdminMedia/validations/js_assign_purohit/assign_purohit.js'); ?>"></script>
<script>
   $(".poojabkLi").addClass("active");








</script>
</body>
</html>