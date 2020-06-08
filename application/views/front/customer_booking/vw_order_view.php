<?php include('application/views/front/section/header.php'); ?>  
<!-- <body onload="loadMap()"> -->
<style type="text/css">
  .error {
    color: red;
    margin-bottom: 0px;
    /* padding-bottom: 2px; */
    text-align: left;
    /* text-align: right; */
    padding-top: 2px;
}
</style>
    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
        <div class="col-lg-3"> <!-- required for floating -->
          <!-- Nav tabs -->
          <ul class="nav nav-tabs tabs-left sideways">
            <li><a href="<?php echo base_url();?>front-customer-profile" >My Profile</a></li>
            <li class="active"><a href="<?php echo base_url();?>front-my-booking">My Bookings</a></li>
            <li><a href="<?php echo base_url();?>front-my-setting">Settings</a></li>
            <li><a href="<?php echo base_url();?>front-customer-logout">Log Out</a></li>
          </ul>

        <div>
          <div class="mt-4">
            <h6><b>Track Purohit</b></h6>
          </div>
           <input type="hidden" name="latitude" id="latitude" value="<?php echo !empty($pooja_order_view[0]['purohit_latitude'])?$pooja_order_view[0]['purohit_latitude']:''?>">
            <input type="hidden" name="longitude" id="longitude" value="<?php echo !empty($pooja_order_view[0]['purohit_longitude'])?$pooja_order_view[0]['purohit_longitude']:''?>">
          <div class=" border-bx" id="mapdiv">

           <!--  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3782.0995820613953!2d73.87718441450612!3d18.569548687380433!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2c7283e33be27%3A0x92e5786212fca783!2sMplussoft%20Technologies!5e0!3m2!1sen!2sin!4v1583235438644!5m2!1sen!2sin" width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen=""></iframe> -->
           <!-- <div id="map" style="width:600px; height:400px"> -->
           
         
            <?php 

           
                $pujadate=date('Y-m-d');
                $current_time=date('g:i A');

                $date_of_puja=!empty($pooja_order_view[0]['pooja_date'])? date('Y-m-d', strtotime($pooja_order_view[0]['pooja_date'])):'';
                $time_of_puja=!empty($pooja_order_view[0]['pooja_time'])?$pooja_order_view[0]['pooja_time']:'';
                
                $puja_time_before2hr=date('g:i A', strtotime($time_of_puja . " -2 hours"));
                // print_r($puja_time_before2hr);die();
            // print_r($pooja_order_view[0]['pooja_time']);die(); 
            if (!empty($pooja_order_view[0]['pooja_time']) && $puja_time_before2hr < $current_time && $pooja_order_view[0]['pooja_date']==$pujadate && !empty($pooja_order_view[0]['fk_purohit']) && $pooja_order_view[0]['pooja_status']!=4 &&  $pooja_order_view[0]['pooja_status']!=2) {
            
              ?>
             
              <div id="map_canvas" style="width:100%; height:500px"></div>
            <?php }else{?>
            <img id="" src="<?php echo base_url();?>AdminMedia/images/map.png" style="width:100%; height:500px"></img>
            <?php }?>
        <!-- </div> -->
          </div>
        </div>
        </div>
       <div class="col-lg-9">
            <!-- Tab panes -->
                 <div class="MessageHide">
                              <?php
                              if (!empty($this->session->userdata('msg'))) {
                            echo $this->session->userdata('msg');
                            $this->session->unset_userdata('msg');
                              }
                              ?>
                          </div>
            <div class="tab-content-order">
             <div class="col-md-12 no-pad">
                   <div class="package-details mb-2">
                       
                    <div class="cont-box">
                        <div class="order-cont">
                          <h5 class="w-10">Puja ID :</h5>
                          <span class="view-cnt"><?php echo !empty(!empty($pooja_order_view[0]['order_id']))? 'SP'.$pooja_order_view[0]['order_id']:'';?></span>

                        </div>
                        <div class="order-cont">

                          <?php 
               if($pooja_order_view[0]['fk_purohit']=='' && $pooja_order_view[0]['cancelled_by_purohit']=='' && $pooja_order_view[0]['pooja_status']!='3' && $pooja_order_view[0]['pooja_status']!='4' && $pooja_order_view[0]['pooja_status']!='2')
                    { $setText="Pending";} 
             
                elseif(!empty($pooja_order_view[0]['fk_purohit']) && !empty($pooja_order_view[0]['pooja_status'] && $pooja_order_view[0]['pooja_status']!='3' && $pooja_order_view[0]['pooja_status']!='4' && $pooja_order_view[0]['pooja_status']!='2' ))
                    { $setText="Confirmed";}
                elseif($pooja_order_view[0]['pooja_status']=='2')
                    { $setText="Completed";}
                  elseif(!empty($pooja_order_view[0]['cancelled_by_purohit']) && $pooja_order_view[0]['pooja_status']!='4')
                    { $setText="Cancelled by purohit searching new purohit";}
                elseif($pooja_order_view[0]['pooja_status']=='3' || $pooja_order_view[0]['pooja_status']=='4')
                    { $setText="Cancelled";}

                          ?>
                            <span class="view-cnt"><?php echo !empty($setText)? $setText:''; ?></span>
                        </div>
                      </div>
                       <div class="order-cont">
                          <h5 class="w-10"><i class="fa fa-calendar"></i></h5>
                          <span class="view-cnt"><?= !empty($pooja_order_view[0]['created_date']) ? date('d M Y', strtotime($pooja_order_view[0]['created_date'])) : ""; ?></span>
                      </div>
                      </div>
                      <div class="package-details mb-2">

                    <div class="cont-box">
                        <div class="order-cont">
                          <h5 class="w-10">Puja Name:</h5>
                          <span class="view-cnt"><?php echo !empty($pooja_order_view[0]['pooja_name'])? ucwords($pooja_order_view[0]['pooja_name']):'';?></span>
                        </div>                        
                        <div class="order-cont">
                            <h5 class="w-10"><i class="fa fa-calendar"></i></h5>
                            <span class="view-cnt"><?= !empty($pooja_order_view[0]['pooja_date']) ? date('d M, Y', strtotime($pooja_order_view[0]['pooja_date'])) : ""; ?></span>

                            <h5 class="w-10 ml-2"><i class="fa fa-clock-o"></i></h5>
                            <span class="view-cnt"><?php echo !empty($pooja_order_view[0]['pooja_time'])? $pooja_order_view[0]['pooja_time']:'';?></span>
                            <button id="flip" class="ml-2 btn btn-sm btn-success editbtn" title="Change Date"><i class="fa fa-pencil"></i></button>
                        </div>
                      </div>
                       <div class="order-cont">
                          <h5 ><i class="fa fa-map-marker"></i></h5>
                          <span class="view-cnt"><?php echo !empty($pooja_order_view[0]['pooja_area'])? ucwords($pooja_order_view[0]['pooja_area']):'';?></span>
                      </div>
                      </div>
                      <div id="panel">
                        <form action="<?php echo base_url();?>front-pooja-update-action" id="updatepooja" name="updatepooja" method="post">
                          <input type="hidden" name="pooja_order_id" id="pooja_order_id" value="<?php echo !empty($pooja_order_view[0]['order_id'])? $pooja_order_view[0]['order_id']:'';?>">
                      <div class="package-details mb-2" >
                        <div class="mb-3 ttl-color"><h6><b> Date & Time Requirements</b></h6></div>
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <input type="radio" name="" checked=""> <span>Select date for Puja</span>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <div class="input-group date" data-date-format="dd.mm.yyyy">
                                 <input type="text" id="fromdate" name="poojadate" class="form-control" placeholder="dd-mm-yyyy" value="<?= !empty($pooja_order_view[0]['pooja_date']) ? date('d-m-Y', strtotime($pooja_order_view[0]['pooja_date'])) : ""; ?>" readonly autocomplete="off">
                                 <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                 </div>
                              </div>
                            </div>
                          </div>
                         </div>
                         <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <span>Time preference</span>
                            </div>
                          </div>
                          <div class="col-md-4 form-group sm-contro">
                                <div class="input-group time">
                                  <?php 
                $date_of_puja=!empty($pooja_order_view[0]["pooja_date"])?$pooja_order_view[0]["pooja_date"]:'';
                $time_of_puja=!empty($pooja_order_view[0]["pooja_time"])?$pooja_order_view[0]["pooja_time"]:'';

                $puja_data_before24=date('Y-m-d', strtotime($date_of_puja . " -24 hours"));
                $puja_time_before24=date('H:i A', strtotime($time_of_puja . " -24 hours"));
                $puja_time_disable=$puja_data_before24.' '.$puja_time_before24;
                $current_time = date('Y-m-d H:i A');
                ?>
                                         
                                  <?php if ($current_time >=$puja_time_disable) {?>
                                  <input type="text" class="form-control" name="poojatime" id="" value="<?php echo !empty($pooja_order_view[0]['pooja_time'])? $pooja_order_view[0]['pooja_time']:'';?>" readonly>
                                    <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                    </span>
                                 <?php }else{?>
                                  <input type="text" class="form-control" name="poojatime" id="timepicker" value="<?php echo !empty($pooja_order_view[0]['pooja_time'])? $pooja_order_view[0]['pooja_time']:'';?>">
                                    <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                    </span>
                                 <?php }?>
                                </div>
                   
                          </div>
                          <div class="col-md-5">
                            <div class="form-group">
                              <span>(Optional)</span>
                            </div>
                          </div>
                         
                          <div class="col-md-3">
                            <div class="form-group">
                              <span>Address</span>
                            </div>
                          </div>
                          <div class="col-md-9  sm-contro ">
                            <div class="form-group textarea">
                              <textarea class="form-control" name="address" rows="5" readonly><?php echo !empty($pooja_order_view[0]['pooja_address'])? ucwords($pooja_order_view[0]['pooja_address']):'';?></textarea>
                            </div>
                            </div>
                               <div class="col-md-3">
                              <div class="form-group">
                                <span>Area</span>
                              </div>
                            </div>
                              <div class="col-md-9  sm-contro">
                              <div class="form-group">
                                  <input type="text" name="area" class="form-control" id="area" id="area" placeholder="Enter a area" readonly value="<?php echo !empty($pooja_order_view[0]['pooja_area'])? ucwords($pooja_order_view[0]['pooja_area']):'';?>">
                              </div>
                            
                            
                            
                              <button class="btn btn-success editsubmitbtn" type="submit">Submit</button>
                            </div>
                       
                         </div>
                       </div>
                       </form>
                     </div>
                     <?php if (!empty($pooja_order_view[0]['fk_purohit']) ) {?>
                    
                    <div class="package-details mb-2">
                      <div class="purohit-box">
                      <div class="row">
                        <div class="col-sm-8 col-12">
                          <div class="order-cont">
                            <?php   $profile_pic= !empty($pooja_order_view[0]['assign_upload_profile_Image']) ? base_url().'upload/android/registartion/purohit_profile/'.$pooja_order_view[0]['assign_upload_profile_Image']:base_url().'AdminMedia/images/photo.png';?>
                          <img src="<?php echo $profile_pic ?>">
                           <div>
                             <h5><?php echo !empty($pooja_order_view[0]['assign_purohit_name'])? ucwords($pooja_order_view[0]['assign_purohit_name']):'';?></h5>
                              <span>(<?php echo !empty($pooja_order_view[0]['assign_mobile_no'])? $pooja_order_view[0]['assign_mobile_no']:'';?>)</span><br>
                              <small class="view-cnt"><?php echo !empty($pooja_order_view[0]['assign_address'])? ucwords($pooja_order_view[0]['assign_address']):'';?>, <?php echo !empty($pooja_order_view[0]['assign_city_name'])? ucwords($pooja_order_view[0]['assign_city_name']):'';?></small>
                           </div>
                          </div>
                        </div>
                        <div class="col-sm-4 col-12">
                          <!-- </div>
                      <div class="col-md-4 col-4"> -->
                      <div class="order-cont float-right order-bttn">
                         <button class="btn btn-order assign_chtbtn"   
                         data-purohit-name="<?= !empty($pooja_order_view[0]['assign_purohit_name']) ? $pooja_order_view[0]['assign_purohit_name'] : "-" ?>" 
                         data-from-id="<?= !empty($pooja_order_view[0]['fk_user_id']) ? $pooja_order_view[0]['fk_user_id'] : "-" ?>" 
                         data-to-id="<?= !empty($pooja_order_view[0]['fk_purohit']) ? $pooja_order_view[0]['fk_purohit'] : "-" ?>" 
                         data-order-id="<?= !empty($pooja_order_view[0]['order_id']) ? $pooja_order_view[0]['order_id'] : "-" ?>"
                          data-pooja-status="<?= !empty($pooja_order_view[0]['pooja_status']) ? $pooja_order_view[0]['pooja_status'] : "-" ?>"
                         data-pooja-reject-status="<?= !empty($pooja_order_view[0]['reject_status']) ? $pooja_order_view[0]['reject_status'] : "" ?>"
                         data-pooja-reject-by="<?= !empty($pooja_order_view[0]['request_rejected_by']) ? $pooja_order_view[0]['request_rejected_by'] : "" ?>"
                         ><i class="fa fa-comment"></i> Chat</button>
                      </div>
                      <!-- </div>
                    </div> -->
                        </div>
                      </div>
                    </div>

                  </div>
                <?php }?>

<!--   <?php if (!empty($pooja_order_view[0]['fk_purohit'])) {?>
               <div class="package-details mb-2">
                      <div class="purohit-box">
                      <div class="row">
                        <div class="col-sm-8 col-12">
                          <div class="order-cont">
                            <?php   $profile_pic= !empty($pooja_order_view[0]['upload_profile_Image']) ? base_url().'upload/android/registartion/purohit_profile/'.$pooja_order_view[0]['upload_profile_Image']:base_url().'AdminMedia/images/photo.png';?>
                          <img src="<?php echo $profile_pic ?>">
                           <div>
                             <h5><?php echo !empty($pooja_order_view[0]['first_name'])? ucwords($pooja_order_view[0]['first_name']):'';?> <?php echo !empty($pooja_order_view[0]['middle_name'])? ucwords($pooja_order_view[0]['middle_name']):'';?> <?php echo !empty($pooja_order_view[0]['last_name'])? ucwords($pooja_order_view[0]['last_name']):'';?></h5>
                              <span>(<?php echo !empty($pooja_order_view[0]['mobile_no'])? $pooja_order_view[0]['mobile_no']:'';?>)</span><br>
                              <small class="view-cnt"><?php echo !empty($pooja_order_view[0]['address'])? ucwords($pooja_order_view[0]['address']):'';?>, <?php echo !empty($pooja_order_view[0]['city_name'])? ucwords($pooja_order_view[0]['city_name']):'';?></small>
                           </div>
                          </div>
                        </div>
                        <div class="col-sm-4 col-12">
                    
                      <div class="order-cont float-right order-bttn">
                         <button class="btn btn-order chtbtn assign_chtbtn" 
                         data-purohit-name="<?php echo !empty($pooja_order_view[0]['first_name'])? ucwords($pooja_order_view[0]['first_name']):'';?> <?php echo !empty($pooja_order_view[0]['middle_name'])? ucwords($pooja_order_view[0]['middle_name']):'';?> <?php echo !empty($pooja_order_view[0]['last_name'])? ucwords($pooja_order_view[0]['last_name']):'';?>" data-from-id="<?= !empty($pooja_order_view[0]['fk_user_id']) ? $pooja_order_view[0]['fk_user_id'] : "-" ?>" 
                         data-to-id="<?= !empty($pooja_order_view[0]['fk_purohit']) ? $pooja_order_view[0]['fk_purohit'] : "-" ?>" 
                         data-order-id="<?= !empty($pooja_order_view[0]['order_id']) ? $pooja_order_view[0]['order_id'] : "-" ?>"
                         data-pooja-status="<?= !empty($pooja_order_view[0]['pooja_status']) ? $pooja_order_view[0]['pooja_status'] : "-" ?>"
                         data-pooja-reject-status="<?= !empty($pooja_order_view[0]['reject_status']) ? $pooja_order_view[0]['reject_status'] : "" ?>"
                         data-pooja-reject-by="<?= !empty($pooja_order_view[0]['request_rejected_by']) ? $pooja_order_view[0]['request_rejected_by'] : "" ?>"
                        ><i class="fa fa-comment"></i> Chat</button>
                      </div>
          
                        </div>
                      </div>
                    </div>
                    
                  </div>
                <?php }?> -->

                      <div class="package-details mb-3">
                  <div class="row">
                    
                    <div class="col-md-6">
                      <div class="one-sec">
                        
                      <h6><b>Package Details : </b><?php echo !empty($pooja_order_view[0]['pooja_name'])? ucwords($pooja_order_view[0]['pooja_name']):'';?></h6>

                    <?php echo !empty($pooja_order_view[0]['description'])? ucwords($pooja_order_view[0]['description']):'';?>
                      </div>
                    </div>
                       <div class="col-md-3 col-sm-6">
                      <div class="one-sec">
                        <h6><b>Purohit Dakshina & Puja Material</b></h6>
                      <ul class="service-list">
                           <?php    //if (!empty($pooja_order_view[0]['inclusive'])) {
                    //foreach ($pooja_order_view[0]['inclusive'] as $key => $row) {?>
                        <!-- <li><i class="fa fa-check text-success" aria-hidden="true"></i> <?php //echo !empty($row['service_name'])? ucwords($row['service_name']):'';?></li> -->
                <?php //}}?>
                      </ul>
                      </div>
                    </div>
                      <div class="col-md-3 col-sm-6">
                      <div class="two-sec">
                        <h6><b>Additional Services</b></h6>
                        <ul class="service-list">
                             <?php    if (!empty($pooja_order_view[0]['exclusive'])) {
                    foreach ($pooja_order_view[0]['exclusive'] as $key => $row) {?>
                          <li> <i class="fa fa-check text-success" aria-hidden="true"></i> <?php echo !empty($row['servicename'])? ucwords($row['servicename']):'';?> (<?php echo !empty($row['services_charges'])? 'Rs.'.$row['services_charges']:'';?>)</li>
                        
                           <?php }}else{
                            ?>
                            - <?php }?>
                        </ul>
                      </div>
                    </div>
                   </div>
                  </div>

                       
                        
                              <div class="package-details mb-3">
                              <div class="flex">
                                <p>Total : </p> <h5 class="ml-1 mb-0"><b> <?php echo !empty($pooja_order_view[0]['total_pkg_price_exclusive'])? 'Rs.'.$pooja_order_view[0]['total_pkg_price_exclusive']:'';?></b></h5>
                             </div>
                             <?php    if (!empty($pooja_order_view[0]['cancellation_charges'])) {?>
                                <div class="flex">
                                <p>Cancellation Charge  : </p> <h5 class="ml-1 mb-0"><b> <?php echo !empty($pooja_order_view[0]['cancellation_charges'])? 'Rs.'.$pooja_order_view[0]['cancellation_charges']:'';?></b></h5>
                             </div>
                           <?php }?>
                             <hr>
                        <!--     <div class="col-md-12 no-pad">
                              <p>Advance : <b><?php echo !empty($pooja_order_view[0]['advance_amount'])? 'Rs.'.$pooja_order_view[0]['advance_amount']:'';?></b></p>
                               <p>Remaining Amount <b><?php echo !empty($pooja_order_view[0]['remaining_amount'])? 'Rs.'.$pooja_order_view[0]['remaining_amount']:'';?></b> Pay To Purohit</p>
                              
                             
                            </div> -->
                          </div>
                           <input type="hidden" name="poojastatus" id="poojastatus" value="<?= !empty($pooja_order_view[0]['pooja_status']) ? $pooja_order_view[0]['pooja_status'] : "-" ?>">
                    <?php if(empty($customer_rating_data)){  ?>  
                          <div class="package-details mb-3">
                                
                              <div class="">
                                <h6><b>Add A Review</b></h6>
                                <form action="<?php echo base_url();?>rating-action" method="POST" name="ratingFrm" id="ratingFrm">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="">
                                        <label>Your Review<span class="text-danger"></span></label>
                                      </div>
                                      <input type="hidden" name="pooja_order_id" value="<?= !empty($pooja_order_view[0]['order_id']) ? $pooja_order_view[0]['order_id'] : "-" ?>">
                                      <input type="hidden" name="poojastatus" id="poojastatus" value="<?= !empty($pooja_order_view[0]['pooja_status']) ? $pooja_order_view[0]['pooja_status'] : "-" ?>">
                                      <input type="hidden" name="puja_id" id="puja_id" value="<?= !empty($pooja_order_view[0]['puja_id']) ? $pooja_order_view[0]['puja_id'] : "-" ?>">
                                      <input type="hidden" name="puja_completed_by" id="puja_completed_by" value="<?= !empty($pooja_order_view[0]['puja_completed_by']) ? $pooja_order_view[0]['puja_completed_by'] : "-" ?>">
                                      <div class="form-group">
                                       <fieldset class="rating">
                                     <input type="radio" id="star5" name="rating" class="rating_val" value="5" /><label class = "full" for="star5" ></label>
                                      <input type="radio" id="star4" name="rating" class="rating_val" value="4" /><label class = "full" for="star4" ></label>
                                      <input type="radio" id="star3" name="rating" class="rating_val" value="3" /><label class = "full" for="star3" ></label>
                                      <input type="radio" id="star2" name="rating" class="rating_val" value="2" /><label class = "full" for="star2" ></label>
                                      <input type="radio" id="star1" name="rating" class="rating_val" value="1" /><label class = "full" for="star1" ></label>
                                      </fieldset>
                                      </div>
                                      <div class="clearfix"></div>
                                      <div for="rating" generated="true" class="error"></div>
                                      <div class="form-group">
                                        <textarea class="form-control" name="txtcomment"></textarea>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <button class="btn btn-success submit" id="btnclass" type="submit">Submit</button>
                                    </div>
                                  </div>
                                </form>
                                </div>
                          </div>
                        <?php }?>
                       <?php if(!empty($customer_rating_data)){  ?>  
                             <div class="package-details mb-3 rating-sec">
                                
                           
                                <h6><b>Puja Completed Successfully !</b></h6>
                               
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="dis-flex">
                                   
                                                             
                         <ul>
                 
                          <?php if(!empty($customer_rating_data) && $customer_rating_data[0]['rating']=="1"){  ?> 
                           <li><i class="fa fa-star filled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                     
                           <?php if(!empty($customer_rating_data) && $customer_rating_data[0]['rating']=="2"){  ?> 
                             <li><i class="fa fa-star filled"></i></li>
                             <li><i class="fa fa-star filled"></i></li>         
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                      
                           <?php if(!empty($customer_rating_data) && $customer_rating_data[0]['rating']=="3"){  ?>
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>         
                              <li><i class="fa fa-star filled"></i></li> 
                              <li><i class="fa fa-star unfilled"></i></li>
                              <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                        
                           <?php if(!empty($customer_rating_data) && $customer_rating_data[0]['rating']=="4"){ ?> 
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>         
                              <li><i class="fa fa-star filled"></i></li>
                            <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                  
                           <?php if(!empty($customer_rating_data) && $customer_rating_data[0]['rating']=="5"){ ?> 
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>         
                              <li><i class="fa fa-star filled"></i></li>
                           <li><i class="fa fa-star filled"></i></li>
                           <?php }?>

                         </ul>

                         <span class="mb-0">Rating &nbsp; <b><?php if(!empty($customer_rating_data)){ 
                          echo $customer_rating_data[0]['rating']; }?>/5</b></span>
                        </div>
                    
                      <p><?php echo !empty($customer_rating_data[0]['comment']) ? ucfirst($customer_rating_data[0]['comment']):'';?></p>
                                 
                               </div>     
                                </div>
                         
                         
                        </div>
                      <?php }?>
                        <?php if(empty($customer_refund_data)){ ?> 
                         <div class="text-right">
                        
                          <button type="button" class=" btn btn-success cancelcls" data-toggle="modal" data-target="#cancelpujaModal" 
                          data-pooja-name="<?= !empty($pooja_order_view[0]['pooja_name']) ? $pooja_order_view[0]['pooja_name'] : "-" ?>"
                          data-pooja-date="<?= !empty($pooja_order_view[0]['pooja_date']) ? date('d M, Y', strtotime($pooja_order_view[0]['pooja_date'])) : ""; ?>"
                          data-pooja-time="<?= !empty($pooja_order_view[0]['pooja_time']) ? $pooja_order_view[0]['pooja_time'] : ""; ?>"
                          data-pooja-order-id="<?= !empty($pooja_order_view[0]['order_id']) ? $pooja_order_view[0]['order_id'] : ""; ?>"
                          data-pkg-total="<?= !empty($pooja_order_view[0]['total_pkg_price_exclusive']) ? $pooja_order_view[0]['total_pkg_price_exclusive'] : ""; ?>"
                              > Cancel</button>
                           
                          <button type="button" class="btn btn-success refundcls" id="refundbtn">Refund</button>
                         </div>

                         <form action="<?php echo base_url();?>customer-refund-request" method="post" id="refundFrm">
                          <input type="hidden" name="pooja_order_id" id="pooja_order_id" value="<?= !empty($pooja_order_view[0]['order_id']) ? $pooja_order_view[0]['order_id'] : ""; ?>">
                           <div id="bankinfo-div">
                          <input type="hidden" name="fk_customer_id" id="fk_customer_id" value="<?= !empty($pooja_order_view[0]['fk_user_id']) ? $pooja_order_view[0]['fk_user_id'] : ""; ?>">
                           <div id="bankinfo-div">
                     <div class="col-md-4 form-group fl-lft">
                        <label>Bank Name<span style="color: red">*</span></label>
                        <input type="text" class="form-control isAlpha" name="bank_name">
                     </div>
                     <div class="col-md-4 form-group fl-lft">
                        <label>Account Holder Name<span style="color: red">*</span></label>
                        <input type="text" class="form-control isAlpha" name="holdername">
                     </div>
                     <div class="col-md-4 form-group fl-lft">
                        <label>Account No.<span style="color: red">*</span></label>
                        <input type="text" class="form-control isInteger" name="account_number">
                     </div>
                     <div class="clearfix"></div>
                     <div class="col-md-4 form-group fl-lft">
                        <label>IFSC Code<span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="ifsc_code">
                     </div>
                     <div class="col-md-4 form-group fl-lft">
                        <label>Branch Name<span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="banch_name">
                     </div>
                     <div class="clearfix"></div>
                     <div class="col-md-12 col-sm-12 form-group fl-lft">
                        <button type="submit" class=" btn btn-success">Submit</button>
                     </div>
                  </div>
                  </form>
                <?php }else{?>
                  <div id="">
                     <div class="col-md-4 form-group fl-lft order-cont">
                      <h5 class="w-10">Bank Name:</h5>
                        <span class="view-cnt"><?php echo !empty($customer_refund_data[0]['bank_name'])? ucwords($customer_refund_data[0]['bank_name']):'-';?></span>
                        
                     </div>
                     <div class="col-md-4 form-group fl-lft order-cont">
                        <h5 class="w-10">Account Holder Name:</h5><span class="view-cnt" ><?php echo !empty($customer_refund_data[0]['acc_holder_name'])? ucwords($customer_refund_data[0]['acc_holder_name']):'-';?></span>
                       
                     </div>
                     <div class="col-md-4 form-group fl-lft order-cont">
                        <h5 class="w-10">Account No.</h5><span class="view-cnt"><?php echo !empty($customer_refund_data[0]['account_number'])? $customer_refund_data[0]['account_number']:'-';?></span>
                     
                     </div>
                     <div class="clearfix"></div>
                     <div class="col-md-4 form-group fl-lft order-cont">
                        <h5 class="w-10">IFSC Code:</h5><span class="view-cnt"><?php echo !empty($customer_refund_data[0]['ifsc_code'])? $customer_refund_data[0]['ifsc_code']:'-';?></span>
                        
                     </div>
                     <div class="col-md-4 form-group fl-lft order-cont">
                        <h5 class="w-10">Branch Name:</h5><span class="view-cnt"><?php echo !empty($customer_refund_data[0]['branch_name'])? ucwords($customer_refund_data[0]['branch_name']):'-';?></span>
                        
                     </div>
                      <div class="col-md-4 form-group fl-lft order-cont">
                        <h5 class="w-10">Refund Status:</h5><span class="view-cnt"><?php echo !empty($customer_refund_data[0]['refund_status'])? ucwords($customer_refund_data[0]['refund_status']):'-';?></span>
                        
                     </div>
                  
                  </div>
                <?php }?>
                         <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                            
            </div>

            

          </div>
          
          </div>
       

     
        </div>
      </div>
    </div>

   <div> 
              
               
              <div class="chat-popup" id="assign_myForm">
                <div class="modal-header">
                  <div style="flex:1">
                    <h6 class="modal-title purohit_name_cls"></h6>
                  </div>
                  <div style="flex:1">
                    
                    <button type="button" class="close" onclick="closeForm()">                      
                      <span aria-hidden="true">×</span>
                    </button>
                    <button  type="button" class="close" id="miniview">
                      <span aria-hidden="true">-</span>
                    </button>
                   <div class="left right_c left_icons">                   
                   </div>
                  </div>
                </div>
                <div class="chatboxout">
                     
                    <div class="chatboxin" id="msg_list">
                    </div>
                    <div class="chat-container">
                     <form method="post" id="chat_box">
                        <input type="hidden" name="from_id_set" id="from_id_set">
                         <input type="hidden" name="to_id_set" id="to_id_set">
                         <input type="hidden" name="order_id_set" id="order_id_set">
                        <div class="form-group chat-box">

                          <input type="text" name="txtmsg" class="form-control" id="txtmsg" autocomplete="off">
                          <button class="btn btn-success btn-sm" id="btnsend" type="submit">Send</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
               
              </div>
<!-- Modal -->
<div class="modal fade" id="cancelpujaModal" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Confirmation Required</h4>
         </div>
         <div class="modal-body">
            <p>Do you really want to cancel <span id="poojanmset"></span> scheduled on <span id="poojadate"></span> at <span id="poojatime"></span> ?</p>
            <div class="col-md-12 col-sm-12 no-pad">
              <form method="post" id="cancelFrm" action="<?php echo base_url();?>customer-cancel-pooja">
              <input type="hidden" name="puja_order_id" id="puja_order_id">
              <input type="hidden" name="puja_pkg_ammount" id="puja_pkg_ammount">
               <button type="submit" class="btn btn-ys">Yes</button>
            
               <a href="<?php echo base_url();?>front-order-view/<?php echo $this->uri->segment('2') ?>"><button type="button" class="btn btn-no">No</button></a>
                </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Modal End -->

  <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">  
  <input type="hidden" name="purohit_id" id="purohit_id" value="<?= !empty($pooja_order_view[0]['fk_purohit']) ?$pooja_order_view[0]['fk_purohit'] : ""; ?>">  
  <input type="hidden" name="cancelled_status" id="cancelled_status" value="<?= !empty($pooja_order_view[0]['pooja_status']) ?$pooja_order_view[0]['pooja_status'] : ""; ?>">  
  <input type="hidden" name="order_id" id="order_id" value="<?= !empty($pooja_order_view[0]['order_id']) ?$pooja_order_view[0]['order_id'] : ""; ?>">  
<?php include('application/views/front/section/footer.php'); ?>  
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url('AdminMedia/validations/front_validations/chat/chat.js') ?>"></script>

   <script> 

    // google.maps.event.addDomListener(window, 'load', function () 
  // {
    // var input_txt1 = document.getElementById('area');
    // var places1 = new google.maps.places.Autocomplete(input_txt1);
  // });
    $(document).ready(function(){
      $(".order-cont #flip").click(function(){
        $("#panel").slideToggle("slow");
      });
    });
    </script>
    <script type="text/javascript">
      var nowDate = new Date();
       // $('#fromdate').datepicker(
      // { 
        // format: "dd-mm-yyyy",   
        // autoclose:true,     
        // todayHighlight: true ,
        // startDate: nowDate
      // });

      $("#timepicker").timepicker({
           format: "LT",
           icons: {
             up: "fa fa-chevron-up",
             down: "fa fa-chevron-down"
           }
       });

       $("#bankinfo-div").hide();
   
   $("#refundbtn").click(function()
   {
       $("#bankinfo-div").show();
   });

</script>



    <script>


var  purohit_id = $('#purohit_id').val()  
var  puja_status = $('#cancelled_status').val()  
var  order_id = $('#order_id').val()  
  setInterval(function() {
    sendRequest();
  }, 10000);

  sendRequest();
  function sendRequest(){
      $.ajax({
        url:$("#base_url").val() + "get-purohit-lat-long",
        data: {purohit_id: purohit_id,puja_status:puja_status,order_id:order_id},
        dataType: "json",
        success: 
          function(result){
            // alert(JSON.stringify(result));
            // alert(result[0].pooja_status);
    //       if (cancelled_status!=4 || cancelled_status!=2) {
    //        if(result[0].purohit_latitude){ // if true (1)
    //         setTimeout(function(){// wait for 5 secs(2)
    //        location.reload(); // then reload the page.(3)
    //     }, 10000); 
    //   }
    // }

        // if (result[0].pooja_status==2) { 
        //    location.reload(); // then reload the page.(3)

        // }
   
          loadMap(result[0].purohit_latitude,result[0].purohit_longitude);
           
        },
    
    });
  };

 

            var map;
            var geocoder;

            function loadMap(latitude = $('#latitude').val(),longitude = $('#longitude').val()) {
                // Using the lat and lng of purohit.
                var latlng = new google.maps.LatLng(latitude,longitude);
                var feature = {
                    zoom: 15,
                    center: latlng,

                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById("map_canvas"), feature);
                geocoder = new google.maps.Geocoder();
                var marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    title: "Test for Location"
                });
            }


</script>

  
  </body>
</html>