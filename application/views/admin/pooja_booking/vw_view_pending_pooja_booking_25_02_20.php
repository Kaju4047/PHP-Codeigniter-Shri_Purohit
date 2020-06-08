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
                                 <?php $imgdata = !empty($pendingView[0]['customer_photo']) ? 'upload/customer_profile/' . $pendingView[0]['customer_photo'] : 'AdminMedia/images/avatar5.png'; ?>
                                 <img src="<?php echo base_url(). $imgdata;?>" class="reg-user-img" width="50%">
                              </div>          
                           </div>
                           <div style="padding: 5px;background-color: #f1f5ff">
                              <table class="usertable">
                                 <tbody>
                                    <tr>
                                       <th width="30%">Customer Name</th>
                                       <td width="70%"><?php echo !empty($pendingView[0]['customer_name'])?ucfirst($pendingView[0]['customer_name']):''; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Mobile No.</th>
                                       <td><?php echo !empty($pendingView[0]['customer_mobile_no'])?$pendingView[0]['customer_mobile_no']:''; ?></td>
                                    </tr>
                                    <tr>
                                       <th>Location</th>
                                       <td><?php echo !empty($pendingView[0]['customer_address'])?$pendingView[0]['customer_address']:''; ?></td>
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
                                 <input type="hidden" name="pooja_order_id" id="pooja_order_id" value="<?php echo !empty($pendingView[0]['pooja_order_id'])?$pendingView[0]['pooja_order_id']:''; ?>">
                                 <label>Assigned Purohit</label>
                                <!--  <select class="form-control">
                                    <option>Select Purohit</option>
                                    <option>Ganesh Patil</option>
                                    <option>Raghav Patil</option>
                                 </select> -->
                                  <select class="form-control select2" name="assign_purohit" id="assign_purohit"> 
                                     <option value="">Select Purohit</option>
                                     <?php 
                                       if (!empty($purohitList)) {
                                           foreach ($purohitList as $key => $value) { ?>
                                             <option value="<?php  echo !empty($value['pk_id'])?$value['pk_id']:''?>"<?php echo( (!empty($pendingView[0]['fk_purohit']) && $pendingView[0]['fk_purohit']==$value['pk_id'])?'selected' : '')?>> <?php  echo !empty($value['purohit_name'])?$value['purohit_name']:''?></option>
                                          <? }
                                       } 
                                     ?>
                                 </select>
                              </div>
                              <div class="col-md-12 form-group">
                                 <label>Remark</label>
                                 <textarea rows="3" class="form-control" id="remark" name="remark" style="resize: none;"></textarea>
                              </div>
                              <div class="clearfix"></div>
                              <div class="col-md-12 form-group">          
                                 <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
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
                          <div class="col-md-6">
                            <h5 class="vw-head">Order Id</h5>    
                            <h6 class="vw-data"><?php echo !empty($pendingView[0]['pooja_order_id'])?$pendingView[0]['pooja_order_id']:''; ?></h6> 
                          </div>
                          <div class="col-md-6 text-right">
                            <h5 class="vw-head">Pooja Ordered On</h5>    
                            <h6 class="vw-data"><?php echo !empty($pendingView[0]['order_date'])?date("d-m-Y h:i A", strtotime($pendingView[0]['order_date'])):''; ?></h6> 
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
                                 <td width="82%"><?php echo !empty($pendingView[0]['pooja_name'])?ucfirst($pendingView[0]['pooja_name']):''; ?></td>
                              </tr>
                              <tr>
                                 <th>Description</th>
                                 <td><?php echo !empty($pendingView[0]['short_description'])?ucfirst($pendingView[0]['short_description']):''; ?></td>
                              </tr>
                              <tr>
                                 <th width="18%">Pooja Scheduled On</th>
                                 <td width="82%"><?php echo !empty($pendingView[0]['pooja_date'])?date("d-m-Y", strtotime($pendingView[0]['pooja_date'])):''; ?> <?php echo !empty($pendingView[0]['pooja_time'])?date("h:i:s a", strtotime($pendingView[0]['pooja_time'])):''; ?></td>
                              </tr>
                              <tr>
                                <th colspan="2">
                                  <h4 class="poja-hd mg-lr-0">Package Details</h4>
                                </th>
                               </tr>
                                <tr>
                                 <th>Inclusive</th>
                                 <td><?php echo !empty($pendingView[0]['inclusive_services'])?ucfirst($pendingView[0]['inclusive_services']):''; ?></td>
                              </tr>
                               <tr>
                                 <th>Exclusive</th>
                                 <td><?php echo !empty($pendingView[0]['services_exclusive'])?ucfirst($pendingView[0]['services_exclusive']):'-'; ?></td>
                              </tr>
                              <tr>
                                 <th>Cost</th>
                                 <td><i class="fa fa-inr" aria-hidden="true"></i><?php echo !empty($pendingView[0]['total_pkg_price_exclusive'])?ucfirst($pendingView[0]['total_pkg_price_exclusive']):'-'; ?></td>
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
<script type="text/javascript" src="<?php echo base_url('AdminMedia/validations/js_assign_purohit/assign_purohit.js'); ?>"></script>
<script>
   $(".poojabkLi").addClass("active");
</script>
</body>
</html>