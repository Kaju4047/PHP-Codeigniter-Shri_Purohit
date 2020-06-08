
<aside class="main-sidebar">
   <section class="sidebar">
      <ul class="sidebar-menu">
         <li class="header">MAIN NAVIGATION</li>

            <?php
                    $fld = 'UA_priviliges';
                    $userid = $this->session->userdata['UID'];
                     
                    $condition = array('UA_pkey' => $userid);
                    $privilige = $this->Md_database->getData('static_useradmin', $fld, $condition, '', '');
                    $privilige = !empty($privilige[0]['UA_priviliges']) ? explode(',', $privilige[0]['UA_priviliges']) : '';

                  // (in_array('superAdmin', $privilige) || (in_array('CMS_add', $privilige) ) ) ? '' : redirect(base_url() . 'admin/dashboard'); //redirect if session expire
            ?>


         <li class="dashboardLi">
            <a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
         </li>
        <?php  if(in_array('state_add', $privilige) || in_array('state_AI', $privilige)||in_array('state_delete', $privilige)||in_array('city_AI', $privilige)||in_array('city_add', $privilige)||in_array('city_delete', $privilige)||in_array('language_add', $privilige)||in_array('language_AI', $privilige)||in_array('language_delete', $privilige)||in_array('citywiselang_add', $privilige)||in_array('citywiselang_AI', $privilige)||in_array('citywiselang_delete', $privilige)||in_array('category_add', $privilige)||in_array('category_AI', $privilige)||in_array('category_delete', $privilige)||in_array('cancellation_charges_add', $privilige)||in_array('cancellation_charges_AI', $privilige)||in_array('tax_add', $privilige)||in_array('tax_AI', $privilige)||in_array('additional_service_add', $privilige)||in_array('additional_service_AI', $privilige)||in_array('additional_service_delete', $privilige)||in_array('cancellation_per_purohit_add', $privilige)||in_array('fine_for_purohit_add', $privilige)||in_array('fine_for_purohit_AI', $privilige)||in_array('fine_for_purohit_delete', $privilige)){?>
         <li class="masterLi" id="adminMasterLi">
            <a href="">
            <i class="fa fa-table"></i><span>Master</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-down pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <?php  if(in_array('state_add', $privilige) || in_array('state_AI', $privilige)||in_array('state_delete', $privilige)){?>
                <li class="stateLi"><a href="<?php echo base_url(); ?>admin/state"><i class="fa fa-list"></i><span>State</span></a></li>
                 <?php }
              if(in_array('city_add', $privilige) || in_array('city_AI', $privilige)||in_array('city_delete', $privilige)){?>
               <li class="cityLi"><a href="<?php echo base_url(); ?>admin/city"><i class="fa fa-list"></i><span>City</span></a></li>
                <?php }
              if(in_array('language_add', $privilige) || in_array('language_AI', $privilige)||in_array('language_delete', $privilige)){?>
               <li class="langLi"><a href="<?php echo base_url(); ?>admin/language"><i class="fa fa-list"></i><span>Language</span></a></li>
                <?php }
              if(in_array('citywiselang_add', $privilige) || in_array('citywiselang_AI', $privilige)||in_array('citywiselang_delete', $privilige)){?>
               <li class="langcityLi"><a href="<?php echo base_url(); ?>admin/citywise-language"><i class="fa fa-list"></i><span>City Wise Language</span></a></li>
                <?php }
              if(in_array('category_add', $privilige) || in_array('category_AI', $privilige)||in_array('category_delete', $privilige)){?>
               <li class="catLi"><a href="<?php echo base_url(); ?>admin/category"><i class="fa fa-list"></i><span>Category</span></a></li>
               <!--  <?php }
              if(in_array('city_add', $privilige) || in_array('city_AI', $privilige)||in_array('city_delete', $privilige)){?>
               <li class="advpayLi"><a href="<?php echo base_url(); ?>admin/advance-payment"><i class="fa fa-list"></i><span>Advance Payment</span></a></li>
                <?php }
              if(in_array('city_add', $privilige) || in_array('city_AI', $privilige)||in_array('city_delete', $privilige)){?>
               <li class="incLi"><a href="<?php echo base_url(); ?>admin/incentives"><i class="fa fa-list"></i><span>Incentives</span></a></li> -->
                <?php }
              if(in_array('cancellation_charges_add', $privilige) || in_array('cancellation_charges_AI', $privilige)){?>
               <li class="canchargLi"><a href="<?php echo base_url(); ?>admin/cancellation-charges"><i class="fa fa-list"></i><span>Cancellation Charges</span></a></li>
                <?php }
              if(in_array('tax_add', $privilige) || in_array('tax_AI', $privilige)){?>
               <li class="taxLi"><a href="<?php echo base_url(); ?>admin/tax"><i class="fa fa-list"></i><span>Tax</span></a></li>
                <?php }
              if(in_array('additional_service_add', $privilige) || in_array('additional_service_AI', $privilige)||in_array('additional_service_delete', $privilige)){?>
               <li class="adserLi"><a href="<?php echo base_url(); ?>admin/additional-services"><i class="fa fa-list"></i><span>Additional Services</span></a></li>
                <?php }
              if(in_array('cancellation_per_purohit_add', $privilige) || in_array('cancellation_per_purohit_AI', $privilige)||in_array('cancellation_per_purohit_delete', $privilige)){?>
               <li class="canperpuroLi"><a href="<?php echo base_url(); ?>admin/cancellation-percentage-for-purohit"><i class="fa fa-list"></i><span>Cancellation % For Purohit</span></a></li>
                <?php }
              if(in_array('fine_for_purohit_add', $privilige) || in_array('fine_for_purohit_AI', $privilige)||in_array('fine_for_purohit_delete', $privilige)){?>
               <li class="fineforpuroLi"><a href="<?php echo base_url(); ?>admin/fine-for-purohit"><i class="fa fa-list"></i><span>Fine For Purohit</span></a></li>
                <?php }?>
            </ul>
         </li>
         <?php }?>
         <?php if(in_array('CMS_add', $privilige)){?>
            <li class="cmsLi">
               <a href="<?php echo base_url(); ?>admin/cms"><i class="fa fa-pie-chart"></i><span>CMS</span></a>
            </li>
         <?php }
          if(in_array('puja_add', $privilige) || in_array('puja_view', $privilige)||in_array('puja_AI', $privilige)||in_array('puja_delete', $privilige)){?>
            <li class="poojaLi">
               <a href="<?php echo base_url(); ?>admin/pooja-list"><i class="fa fa-dashboard"></i><span>Puja</span></a>
            </li>
         <?php }
         if(in_array('pacakage_add', $privilige) || in_array('pacakage_view', $privilige)||in_array('pacakage_AI', $privilige)||in_array('pacakage_delete', $privilige)){?>
            <li class="packageLi">
               <a href="<?php echo base_url(); ?>admin/package-list"><i class="fa fa-cubes"></i><span>Package</span></a>
            </li>
         <?php }
         if(in_array('registered_purohit_add', $privilige) || in_array('registered_purohit_view', $privilige)||in_array('registered_purohit_AI', $privilige)||in_array('registered_purohit_delete', $privilige)){?>
            <li class="regpurohitLi">
               <a href="<?php echo base_url(); ?>admin/registered-purohit-list"><i class="fa fa-user-circle-o"></i><span>Registered Purohit</span></a>
            </li>
         <?php }
           if(in_array('customers_delete', $privilige) || in_array('customers_view', $privilige) || in_array('registered_purohit_AI', $privilige) ){ ?>
            <li class="customerLi">
               <a href="<?php echo base_url(); ?>admin/customers-list"><i class="fa fa-users"></i><span>Customers</span></a>
            </li>
         <?php }
         if(in_array('customers_delete', $privilige) || in_array('customers_view', $privilige) || in_array('registered_purohit_AI', $privilige) ){ ?>
            <li class="customerreviewLi">
               <a href="<?= base_url('admin/customer-reviews'); ?>"><i class="fa fa-users"></i><span>Customer Reviews</span></a>
            </li>
         <?php }
          if(in_array('pooja_booking_view', $privilige) || in_array('pooja_booking_AI', $privilige)){?>
            <li class="poojabkLi">
               <a href="<?php echo base_url(); ?>admin/pending-pooja-booking-list"><i class="fa fa-book"></i><span>
               Puja Booking</span></a>
            </li>
         <?php }
          if(in_array('CMS_add', $privilige)){?>
            <li class="payhisLi">
               <a href="<?php echo base_url(); ?>admin/payment-history"><i class="fa fa-credit-card"></i><span>Payment History</span></a>
            </li>
         <?php }
          if(in_array('enquiry_view', $privilige) || in_array('enquiry_delete', $privilige)){?>
            <li class="enqsupLi">
               <a href="<?php echo base_url(); ?>admin/enquiry-support-requests"><i class="fa fa-question-circle"></i><span>Enquiry / Support Requests</span></a>
            </li>
         <?php }
          if(in_array('purohit_transaction_add', $privilige)){?>    
            <li class="purtranhisLi">
               <a href="<?php echo base_url(); ?>admin/purohit-transaction-history-list"><i class="fa fa-exchange"></i><span>Purohit Transaction History</span></a>
            </li>
         <?php } ?>
            <li class="reptLi" id="adminreptLi">
            <a href="">
            <i class="fa fa-bar-chart"></i><span>Reports</span></a>
          <!--   <span class="pull-right-container">
            <i class="fa fa-angle-down pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li class="bookreLi"><a href="<?php echo base_url(); ?>admin/pooja-booking-report"><i class="fa fa-list"></i><span>Pooja Booking Report</span></a></li>
               <li class="custorepLi"><a href="<?php echo base_url(); ?>admin/customers-report"><i class="fa fa-list"></i><span>Customers Report</span></a></li>
               <li class="enquirepLi"><a href="<?php echo base_url(); ?>admin/enquiry-report"><i class="fa fa-list"></i><span>Enquiry Report</span></a></li>
               <li class="payhistrepLi"><a href="<?php echo base_url(); ?>admin/payment-history-report"><i class="fa fa-list"></i><span>Payment History Report</span></a></li>
               <li class="transhistLi"><a href="<?php echo base_url(); ?>admin/transaction-history-report"><i class="fa fa-list"></i><span>Transaction History Report</span></a></li>
            </ul> -->
         </li>

      </ul>
      <!-- End sidebar-menu -->
   </section>
   <!-- End sidebar -->
</aside>
<!-- End main-sidebar -->