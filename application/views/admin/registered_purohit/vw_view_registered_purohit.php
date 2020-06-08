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
         Registered Purohit Details
         <div class="pull-right">
            <a href="<?php echo base_url(); ?>admin/registered-purohit-list"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</button></a>
         </div>
      </h1>
   </section>
   <!-- Main content -->
   <section class="content regpurdet-bx">
      <div class="col-md-12 no-pad">
         <div class="row">
            <div class="col-md-4 no-right-pad">
               <div class="box box-primary margin-bottom" style="min-height: 0px;">
                  <div class="box-body" style="min-height: 0px;padding: 0px;">
                     <div class="col-md-12">
                        <div class="row">
                           <div class="col-md-12 no-pad">
                              <div class="view-hd">
                                 <p>Purohit Details</p>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <!-- <div class="reg-user-img" style="background-image: url('<?php echo base_url(); ?>AdminMedia/images/avatar5.png')">
                              </div> -->
                              <div class="reg-user-img">
                                 <?php $imgdata = !empty($purohitData->upload_profile_image) ? 'upload/android/registartion/purohit_profile/' . $purohitData->upload_profile_image : 'AdminMedia/images/avatar5.png'; ?>
                                 <img src="<?php echo base_url(). $imgdata;?>" class="reg-user-img" width="50%">
                              </div>
                           </div>
                           <div style="padding: 5px;background-color: #f1f5ff">
                              <table class="usertable">
                                 <tbody>
                                    <tr>
                                       <th width="35%">Registered On</th>
                                       <td style="border-top:none;" width="72%"><?= !empty($purohitData->created_date)?date('d-m-Y', strtotime($purohitData->created_date)):""; ?></td>
                                    </tr>

                                    <tr>
                                       <th>Purohit Name</th>
                                       <td><?php echo $purohitData->first_name; echo " ".$purohitData->middle_name; echo " ".$purohitData->last_name; ?></td>
                                    </tr>

                                    <tr>
                                       <th>Mobile No.</th>
                                       <td><?php echo !empty($purohitData->mobile_no)? $purohitData->mobile_no :''?></td>
                                    </tr>

                                    <tr>
                                       <th>Email Id</th>
                                       <td><?php echo !empty($purohitData->email_id)? $purohitData->email_id :''?></td>
                                    </tr>

                                    <tr>
                                       <th style="vertical-align: top !important;">Address</th>
                                       <td><?php echo !empty($purohitData->address)? $purohitData->address :''?></td>
                                    </tr>

                                    <tr>
                                       <th style="vertical-align: top !important;">City</th>
                                       <td><?php echo !empty($purohitData->city_name)? $purohitData->city_name :''?></td>
                                    </tr>

                                    <tr>
                                       <th style="vertical-align: top !important;">Area</th>
                                       <td><?php echo !empty($purohitData->location)? $purohitData->location :''?></td>
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

               <div class="box box-primary margin-bottom" style="min-height: 0px;">
                  <div class="box-body" style="min-height: 0px;padding: 0px;">
                     <div class="col-md-12">
                        <div class="row">
                           <div class="col-md-12 no-pad">
                              <div class="view-hd">
                                 <p>Bank Details</p>
                              </div>
                           </div>
                           <div style="padding: 5px;background-color: #f1f5ff">
                              <table class="usertable">
                                 <tbody>
                                    <tr>
                                       <th width="35%">Bank Name</th>
                                       <td style="border-top:none;" width="72%"><?php echo !empty($purohitData->bank_name)? $purohitData->bank_name :''?></td>
                                    </tr>
                                    <tr>
                                       <th>IFSC Code</th>
                                       <td><?php echo !empty($purohitData->ifsc_code)? $purohitData->ifsc_code :''?></td>
                                    </tr>
                                    <tr>
                                       <th>Branch Name</th>
                                       <td><?php echo !empty($purohitData->branch_name)? $purohitData->branch_name :''?></td>
                                    </tr>
                                    <tr>
                                       <th>Account Holder Name</th>
                                       <td><?php echo !empty($purohitData->account_holder_name)? $purohitData->account_holder_name :''?></td>
                                    </tr>

                                    <tr>
                                       <th style="vertical-align: top !important;">Account Number</th>
                                       <td><?php echo !empty($purohitData->account_number)? $purohitData->account_number :''?></td>
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

                        <div class="col-md-12">
                           <h4>Status <span>(Rating) 
<!--                               <ul class="star-ev str-in">
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                           </ul> -->
                           <ul class="d-flex rating-sec" >
                        <ul>
                          <?php $rating = !empty($this->input->get('rate'))?$this->input->get('rate'):''; ?>
                          <?php if (!empty($rating)) {
                            ?>                            
                          <?php if(!empty($rating) && $rating >="1" && $rating <"2"){  ?> 
                           <li><i class="fa fa-star filled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                           <?php if(!empty($rating) && $rating >"1" && $rating< "2"){  ?> 
                             <li><i class="fa fa-star filled"></i></li>
                             <li><i style="color:#ff9900 !important" class="fa fa-star-half-full"></i></li>                       
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                           <?php if(!empty($rating) && $rating=="2"){  ?> 
                             <li><i class="fa fa-star filled"></i></li>
                             <li><i class="fa fa-star filled"></i></li>         
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                           <?php if(!empty($rating) && $rating>"2" && $rating<"3"){  ?> 
                             <li><i class="fa fa-star filled"></i></li>
                             <li><i class="fa fa-star filled"></i></li>         
                           <li><i style="color:#ff9900 !important" class="fa fa-star-half-full"></i></li> 
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                           <?php if(!empty($rating) && $rating=="3"){  ?>
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>         
                              <li><i class="fa fa-star filled"></i></li> 
                              <li><i class="fa fa-star unfilled"></i></li>
                              <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                          <?php if(!empty($rating) && $rating>"3" && $rating<"4"){ ?> 
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>         
                              <li><i style="color:#ff9900 !important" class="fa fa-star-half-full"></i></li> 
                            <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                           <?php if(!empty($rating) && $rating=="4"){ ?> 
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>         
                              <li><i class="fa fa-star filled"></i></li>
                            <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                           <?php if(!empty($rating) && $rating>"4" && $pooja_total_rating<"5"){ ?> 
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>         
                              <li><i class="fa fa-star filled"></i></li>
                            <li><i style="color:#ff9900 !important" class="fa fa-star-half-full"></i></li> 
                           <?php }?>
                           <?php if(!empty($rating) && $rating=="5" || $rating >"5"){ ?> 
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>         
                              <li><i class="fa fa-star filled"></i></li>
                           <li><i class="fa fa-star filled"></i></li>
                           <?php }?>
                         <?php }else{?>
                                <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                         <?php }?>

                         </ul>
 
                   <!--  <li><p><?=  substr($pooja_total_rating,0,1); ?><?=  substr($pooja_total_rating,1,2); ?>  ( <?php echo !empty($totalcount)? $totalcount:'0';?> Reviews )</p></li> -->
                    <!-- <li><p></p></li> -->
                  </ul>
                         </span></h4>
                        </div>

                        <div class="col-md-4 col-xs-4">
                           <div class="small-box bg-aqua">
                             <div class="inner">
                               <h3>Upcoming Puja</h3>
                               <p class=""><?php echo !empty($upcomingPoojaCount)?$upcomingPoojaCount:'0';
                              ?></p>
                             </div>

                            <a href="<?php echo base_url();?>admin/upcoming-pooja-booking-list?purohit_id=<?php echo $this->uri->segment(3);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                           </div>
                         </div>
                         <div class="col-md-4 col-xs-4">
                           <div class="small-box bg-green">
                             <div class="inner">
                               <h3>Completed Puja</h3>
                               <p class=""><?php echo !empty($completedPoojaCount)?$completedPoojaCount:'0';
                              ?></p>
                             </div>
                            <a href="<?php echo base_url(); ?>admin/completed-pooja-booking-list?purohit_id=<?php echo $this->uri->segment(3);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                           </div>
                         </div>
                         <div class="col-md-4 col-xs-4">
                           <div class="small-box bg-red">
                             <div class="inner">
                               <h3>Cancelled Puja</h3>
                               <p class=""><?php echo !empty($cancelledPoojaCount)?$cancelledPoojaCount:'0';
                              ?></p>
                             </div>
                            <a href="<?php echo base_url(); ?>admin/cancelled-pooja-booking-list?purohit_id=<?php echo $this->uri->segment(3);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                           </div>
                         </div>
                         <a href="<?php echo base_url(); ?>admin/payment-history?purohit_id=<?php echo !empty($purohitData->pk_id)? $purohitData->pk_id :''?>">
                         <div class="col-md-4 col-xs-4">
                           <div class="small-box light-green">
                             <div class="inner">
                               <h3>Total Business</h3>
                               <p class=""><i class="fa fa-inr" aria-hidden="true"></i> <?php echo !empty($bussiness['total_business'])?$bussiness['total_business']:'0'; ?></p>
                             </div>
                             <div class="col-sm-6"><h5 class="totbus-des">Earnings</h5> <h6 class="text-center"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo !empty($bussiness['total_earnig'])?$bussiness['total_earnig']:'0'; ?></h6></div>
                             <!-- <div class="col-sm-6"><h5 class="totbus-des">Incentives</h5> <h6 class="text-center"><i class="fa fa-inr" aria-hidden="true"></i><?php echo !empty($bussiness['total_incetive'])?$bussiness['total_incetive']:'0'; ?></h6></div> -->

                             <div class="col-sm-6"><h5 class="totbus-des">Commision</h5> <h6 class="text-center"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo !empty($bussiness['total_comission'])?$bussiness['total_comission']:'0'; ?></h6></div>
                            <a href="<?php echo base_url();?>admin/payment-history?purohit_id=<?php echo !empty($purohitData->pk_id)? $purohitData->pk_id :''?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                           </div>
                         </div>
                         </a>
                         <a href="<?php echo base_url(); ?>admin/purohit-transaction-history-list?purohit_id=<?php echo !empty($purohitData->pk_id)? $purohitData->pk_id :''?>">
                         <div class="col-md-4 col-xs-4">
                           <div class="small-box bg-yellow">
                             <div class="inner">
                               <h3>Total Paid Amount</h3>
                               <p class=""><i class="fa fa-inr" aria-hidden="true"></i> <?php echo !empty($paid_amount)?$paid_amount:'0'; ?></p>
                             </div>
                            <a href="<?php echo base_url();?>admin/purohit-transaction-history-list?purohit_id=<?php echo !empty($purohitData->pk_id)? $purohitData->pk_id :''?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                           </div>
                         </div>
                         </a>
                         <!-- <a href="<?php echo base_url(); ?>admin/purohit-transaction-history-list"> -->
                          <div class="col-md-4 col-xs-4">
                           <div class="small-box bg-yellow">
                             <div class="inner">
                               <h3>Balance Amount</h3>
                               <p class=""><i class="fa fa-inr" aria-hidden="true"></i> <?php echo !empty($bussiness['total_balance_amt'])?$bussiness['total_balance_amt']:'0'; ?></p>
                             </div>
                            <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                           </div>
                         </div>
                         <!-- </a> -->
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
   $(".regpurohitLi").addClass("active");
 </script>
</body>
</html>