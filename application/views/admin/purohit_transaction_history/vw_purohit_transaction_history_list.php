<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content-header">
      <h1>Purohit Transaction History
         <?php
                $fld = 'UA_priviliges';
                $userid = $this->session->userdata['UID'];
                 
                $condition = array('UA_pkey' => $userid);
                $privilige = $this->Md_database->getData('static_useradmin', $fld, $condition, '', '');
                $privilige = !empty($privilige[0]['UA_priviliges']) ? explode(',', $privilige[0]['UA_priviliges']) : '';

              // (in_array('superAdmin', $privilige) || (in_array('CMS_add', $privilige) ) ) ? '' : redirect(base_url() . 'admin/dashboard'); //redirect if session expire
        ?>
         <?php if(in_array('purohit_transaction_add', $privilige)){ ?>
         <div class="pull-right">
            <a href="<?php echo base_url(); ?>admin/add-purohit-transaction-history"><button type="button" class="btn btn-success"><i class="fa fa-plus-circle"></i> New Transaction</button></a>
         </div>
       <?php }?>
      </h1>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="col-md-12 no-mob-pad no-pad">
         <div class="box box-primary">
            <div class="box-body">
              <div class="row">
                  <div class="col-md-6" style="display: inline-block;float: right;margin-bottom: 10px;">
                     <form name="frmSearch" id="frmSearch" action="<?php echo base_url(); ?>admin/city" method="GET" autocomplete="off">
                        
                        <input type="text" name="search_term" id="search_term" class="form-control" value="<?php echo!empty($this->input->get('search_term')) ? $this->input->get('search_term') : ''; ?>" placeholder="Search" style="width: 87%; display: inline-block;margin-left: 43px;">
                       
                        <button type="submit" class="btn btn-primary" title="Search" onclick="javascript: form.action='<?php echo base_url('admin/purohit-transaction-history-list');?>';" style="position: absolute;top: 0;right: 0;margin-right: 15px;height: 34px;"><i class="fa fa-search"></i></button>
                     </form>
                  </div>
               </div>
               <table id="example" class="table table-bordered table-striped table-hover" width="100%">
                  <thead>
                     <tr>
                        <th width="7%">Sr. No.</th>
                        <th width="11%">Created Date</th>
                        <th width="18">Purohit Details</th>
                        <th width="13%">Transaction Type</th>
                        <!-- <th width="8%">Amount</th> -->
                        <th width="8%">Amount</th>
                        <th width="11%">Transaction Id</th>
                        <th width="8%">Balance</th>
                    <!--     <th width="8%">Amount</th> -->
                        <th width="13%">Date & Time</th>
                        <th width="19%">Remark</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php if(!empty($transactionDetails)){
                         $page_no= !empty($this->uri->segment(3)) ? $this->uri->segment(3): 1;
                        $i = ($page_no * 10) - 9;
                     foreach ($transactionDetails as $key => $value) {?>
                        <tr>
                           <td class="text-center"><?php echo $i;?></td>
                           <td><?php echo !empty($value['created_date'])?date('d-m-Y',strtotime($value['created_date'])):''?></td>
                           <td><?php echo !empty($value['purohit_name'])?$value['purohit_name']:''?> ,<?php echo  !empty($value['mobile_no'])?$value['mobile_no']:''?>, <?php echo !empty($value['email_id'])?$value['email_id']:''?>, <?php echo !empty($value['address'])?$value['address']:''?></td>
                           <td>
                              <?php if($value['transaction_type']=='1') {?>
                             <span class="cl-red">Debited</span> 
                           <?php }else if($value['transaction_type']=='2') {?>
                              <span class="cl-green">Transferred</span>
                             <?php }else if($value['transaction_type']=='3' || $value['transaction_type']=='4') {?>
                              <span class="cl-orange">Credited</span>
                             <?php } ?>
                           </td>
                           <td>
                             <span class=""><?php echo !empty($value['amount'])?$value['amount']:'0'?></span> 
                        
                           </td>
                           <td><?php echo !empty($value['transaction_id'])?$value['transaction_id']:'-'?></td>
                     
                           <td><?php echo !empty($value['balance'])?ucfirst($value['balance']):'0'?></td>
                           <td>   <?php if($value['transaction_type']=='1' ||$value['transaction_type']=='3' ||$value['transaction_type']=='4') {?>
                                 <?php echo !empty($value['created_date'])?date('d-m-Y h:i A',strtotime($value['created_date'])):''?>
                           <?php }else{?>
                              <?php echo !empty($value['transaction_date'])?date('d-m-Y', strtotime($value['transaction_date'])):''?>
                               <?php echo !empty($value['transaction_time'])?$value['transaction_time']:''?>
                             <?php } ?>
       
                           <td><?php echo !empty($value['remark'])?ucfirst($value['remark']):''?></td>
                       </tr>
                     <?php  $i++;
                        }
                     }?>
                  </tbody>
               </table>
               <ul class="pagination pull-right" >
                    <?php if (isset($follow_links) && !empty($follow_links)) { ?>
                   <p><?php echo $follow_links ?></p>
                 <?php } ?>
              </ul>
            </div>
            <!-- End box-body -->
         </div>
         <!-- End box -->
      </div>
      <div class="clearfix"></div>
   </section>
   <!-- End .content -->
</div>
<!-- End .content-wrapper -->
<!-- START:: Footer -->
<?php include("application/views/admin/section/vw_footer.php"); ?>
<!-- END:: Footer -->
<script>
   $(".purtranhisLi").addClass("active");
   // $("#example").DataTable();
</script>
</body>
</html>