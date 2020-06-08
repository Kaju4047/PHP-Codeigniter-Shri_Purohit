<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<style>
    .mr-0{
        margin:3px 5px;
        font-weight:600;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content-header">
      <h1>Payment History</h1>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="col-md-12 no-mob-pad no-pad">
         <div class="box box-primary no-height">
            <div class="box-body no-height margin-bottom">
                <form id="filter_customer" method='get'  enctype="multipart/form-data">
               <div class="col-md-2 no-left-pad form-group margin-bottom">
                  <label>City</label>
                  <select class="form-control select2" name="filter_city"> 
                      <option value="">Select City</option>
                      <?php 
                        if (!empty($cityDetails)) {
                            foreach ($cityDetails as $key => $value) { ?>
                              <option value="<?php  echo !empty($value['pooja_city'])?$value['pooja_city']:''?>"<?php echo( (!empty($filter_city) && $filter_city==$value['pooja_city'])?'selected' : '')?>> <?php  echo !empty($value['pooja_city'])?$value['pooja_city']:''?></option>
                           <? }
                        } 
                      ?>
                  </select>
                </div>
                
                <div class="col-md-2 form-group">
                    <label>From Date</label>
                      <div class="input-group date" data-date-format="dd.mm.yyyy" id="fromdate">
                      <input type="text"  class="form-control" placeholder="dd-mm-yyyy" id="fromdatefilter" name="fromdatefilter" value="<?php echo !empty($fromdatefilter) ? date('d-m-Y',strtotime($fromdatefilter)) : '';?>" autocomplete='off'>
                      <div class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </div>
                    </div>
                </div>
                <div class="col-md-2 form-group">
                    <label>To Date </label>
                      <div class="input-group date" data-date-format="dd.mm.yyyy" id="todate">
                      <input type="text"  class="form-control" placeholder="dd-mm-yyyy" id="todatefilter" name="todatefilter" value="<?php echo !empty($todatefilter) ? date('d-m-Y',strtotime($todatefilter)) : '';?>" autocomplete="off">
                      <div class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </div>
                    </div>
                </div>
                <div class="col-md-2 form-group">
                  <!-- <button type="button" class="btn btn-warning filter-btn"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button> -->
                  <input type="hidden" name="search_term" value="<?php echo!empty($this->input->get('search_term')) ? $this->input->get('search_term') : ''; ?>">
                   <button type="submit" class="btn btn-primary filter-btn"  onclick="javascript: form.action='<?php echo base_url('admin/payment-history');?>';"><i class="fa fa-filter"></i>  Filter</button>
               </div>
               <div class="col-md-2 form-group">
                  <?php if(!empty($payment_historyList)){?>
                   <button type="submit" class="btn btn-primary filter-btn" onclick="javascript: form.action='<?php echo base_url('admin/payment-history-export-to-excel');?>';">Export to Excel</button>
                 <?php }?>
                </div>
             </form>
            </div>
         </div>
         <div class="box box-primary">
            <div class="box-body">
                 <div class="row">
                  <div class="col-md-6" style="display: inline-block;float: right;margin-bottom: 10px;">
                     <form name="frmSearch" id="frmSearch" action="<?php echo base_url(); ?>admin/payment-history" method="GET" autocomplete="off">
                        
                        <input type="text" name="search_term" id="search_term" class="form-control" value="<?php echo!empty($this->input->get('search_term')) ? $this->input->get('search_term') : ''; ?>" placeholder="Search" style="width: 87%; display: inline-block;margin-left: 43px;">
                       
                        <button type="submit" class="btn btn-primary" title="Search" onclick="javascript: form.action='<?php echo base_url('admin/payment-history');?>';" style="position: absolute;top: 0;right: 0;margin-right: 15px;height: 34px;"><i class="fa fa-search"></i></button>
                     </form>
                  </div>
               </div>
               <table id="example" class="table table-bordered table-striped table-hover" width="150%">
                  <thead>
                     <tr>
                        <th width="5%" class="text-center">Sr. No.</th>
                        <th width="6%">Puja Id</th>
                        <th width="7%">Puja Date & Time</th>
                        <th width="11%">Customer Name</th>
                        <th width="7%">Customer Mobile No.</th>
                        <th width="11%">Purohit Name</th>
                        <th width="10%">Puja Name</th>
                        <th width="11%">Puja Completed On</th>
                        <th width="11%">Purohit Amount (Rs.)</th>
                        <th width="10%">Total Amount (Rs.)</th>
                     </tr>
                  </thead>
                  <tbody>
                    <?php 
                     if (!empty($payment_historyList)){
                           $page_no= !empty($this->uri->segment(3)) ? $this->uri->segment(3): 1;
                           $i = ($page_no * 10) - 9;
                           foreach ($payment_historyList as $key => $value){
                     ?>
                     <tr>
                        <td class="text-center"><?php echo $i;?></td>
                        <td>SP<?php echo !empty($value['pooja_id'])?ucfirst($value['pooja_id']):''; ?></td>
                        <td><?php echo !empty($value['pooja_date'])?date("d-m-Y", strtotime($value['pooja_date'])):''; ?></td>
                        <td><?php echo !empty($value['customer_name'])?ucfirst($value['customer_name']):''; ?></td>
                        <td><?php echo !empty($value['customer_mobile_no'])?ucfirst($value['customer_mobile_no']):''; ?></td>
                        <td><?php echo !empty($value['purohit_name'])?ucfirst($value['purohit_name']):''; ?></td>
                        <td><?php echo !empty($value['pooja_name'])?ucfirst($value['pooja_name']):''; ?></td>
                        <td><?php echo !empty($value['completed_date_time'])?date("d-m-Y", strtotime($value['completed_date_time'])):''; ?></td>
                        <td><?php echo !empty($value['purohit_amount'])?ucfirst($value['purohit_amount']):''; ?></td>
                        <td><?php echo !empty($value['total_pkg_price_exclusive'])?ucfirst($value['total_pkg_price_exclusive']):''; ?></td>
                     </tr>                    
                      <?php 
                     $i++; }
                     }
                     ?>
                     <tr>


                        <td colspan="9" class="text-right bg-warning"><h4 class="mr-0">Grand Total</h4></td>
                        <td class="bg-warning"><h4 class="mr-0"><?php echo !empty($grand_total)?ucfirst($grand_total):''; ?></h4></td>
                     </tr>
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
   $(".payhisLi").addClass("active");
     $(".select2").select2();

        $('#fromdatefilter').datepicker(
    { 
        format: "dd-mm-yyyy",   
        autoclose:true,     
        todayHighlight: true  
    });

    $('#todatefilter').datepicker(
    { 
        format: "dd-mm-yyyy",   
        autoclose:true,     
        todayHighlight: true  
    });
    var nowDate = new Date(); // alert(nowDate);

    $('#fromdatefilter').datepicker({
        format: "dd-mm-yyyy",
        autoclose: true,
        todayHighlight: true,
        startDate: nowDate
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#todatefilter').datepicker('setStartDate', minDate);
    });


      $('#todatefilter').datepicker({
          format: "dd-mm-yyyy",
          autoclose: true,
          startDate: nowDate}).on('changeDate', function (selected) {
          var maxDate = new Date(selected.date.valueOf());
          $('#fromdatefilter').datepicker('setEndDate', maxDate);
      });
</script>
</body>
</html>