<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content-header">
      <h1>Customers List</h1>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="col-md-12 no-mob-pad no-pad">
          <div class="box box-primary no-height margin-bottom">
            <div class="box-body no-height">
               <form id="filter_customer" method='get'  enctype="multipart/form-data">
                <div class="col-md-2 no-left-pad form-group margin-bottom">
                  <label>City</label>
                  <select class="form-control select2" name="city" id="city"> 
                      <option value="">Select City</option>
                      <?php 
                        if (!empty($cityList)) {
                            foreach ($cityList as $key => $value) { ?>
                              <option value="<?php  echo !empty($value['customer_city'])?$value['customer_city']:''?>"<?php echo( (!empty($city) && $city==$value['customer_city'])?'selected' : '')?>> <?php  echo !empty($value['customer_city'])?$value['customer_city']:''?></option>
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
                <input type="hidden" name="search_term" value="<?php echo!empty($this->input->get('search_term')) ? $this->input->get('search_term') : ''; ?>">
                <div class="col-md-2 form-group">
                  <!-- <button type="button" class="btn btn-warning filter-btn"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button> -->
                   <button type="submit" class="btn btn-primary filter-btn"  onclick="javascript: form.action='<?php echo base_url('admin/customers-list');?>';"><i class="fa fa-filter"></i>  Filter</button>
               </div>
               <div class="col-md-2 form-group">
                    <?php if(!empty($registeredCust)){?>
                     <button type="submit" class="btn btn-primary filter-btn" onclick="javascript: form.action='<?php echo base_url('admin/export-to-excel-customer');?>';">Export to Excel</button>
                   <?php }?>
                  </div>
             </form>
            </div>
         </div>
         <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                  <div class="col-md-4" style="display: inline-block;float: right;margin-bottom: 10px;">
               <form name="frmSearch" id="frmSearch" action="<?php echo base_url(); ?>admin/customers-list" method="GET" autocomplete="off">
                        
                        <input type="text" name="search_term" id="search_term" class="form-control" value="<?php echo!empty($this->input->get('search_term')) ? $this->input->get('search_term') : ''; ?>" placeholder="Search" style="width: 87%; display: inline-block;margin-left: 43px;">
                       
                        <button type="submit" class="btn btn-primary" title="Search" onclick="javascript: form.action='<?php echo base_url('admin/customers-list');?>';" style="position: absolute;top: 0;right: 0;margin-right: 15px;height: 34px;"><i class="fa fa-search"></i></button>
                     </form>
                  </div>
               </div>
               <table id="example11" class="table table-bordered table-striped table-hover" width="100%">
                  <thead>
                     <tr>
                        <th width="8%" class="text-center">Sr. No.</th>
                        <th width="12%">Registered On</th>
                        <th width="18%">Customer Name</th>
                        <th width="10%">Mobile No.</th>
                        <th width="23%">Email Id</th>
                        <th width="20%">City</th>
                         <?php if(in_array('customers_AI', $privilige)){ ?>
                        <th width="3%">Status</th>
                        <?php }if(in_array('customers_view', $privilige) || in_array('customers_delete', $privilige) ){ ?>
                        <th width="6%" class="text-center">Action</th>
                      <?php }?>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     
                     if (!empty($registeredCust)) {
                           $page_no= !empty($this->uri->segment(3)) ? $this->uri->segment(3): 1;
                           $i = ($page_no * 10) - 9;
                     foreach ($registeredCust as $get_values) {
                                            
                     ?>
                     <tr>
                        <td class="text-center"><?= $i; ?></td>
                        <td><?php echo !empty($get_values['created_date'])?date("d-m-Y", strtotime($get_values['created_date'])):''; ?></td>
                        <td><?php echo !empty($get_values['customer_name'])?$get_values['customer_name']:''; ?></td>
                        <td><?php echo !empty($get_values['customer_mobile_no'])?$get_values['customer_mobile_no']:''; ?></td>
                        <td><?php echo !empty($get_values['customer_email_id'])?$get_values['customer_email_id']:''; ?></td>
                        <td><?php echo !empty($get_values['customer_city'])?$get_values['customer_city']:'-'; ?></td>
                         <?php if(in_array('customers_AI', $privilige)){ ?>
                        <td class="text-center">
                                <?php
                                $status = ""; 
                                if ($get_values['status'] == "1"){
                                    $status = "2";
                                    $class = "fa fa-toggle-on tgle-on";
                                    $title = "Active";
                                } else if ($get_values['status'] == "2") {
                                    $status = "1";
                                    $class = "fa fa-toggle-on fa-rotate-180 tgle-off";
                                    $title = "Inactive";
                                }
                                ?>
                                <a onClick="return confirm('Are you sure you want to change status of this record ?')"  href="<?php echo base_url(); ?>admin/registered-customer-status-change/<?php echo (!empty($get_values['pk_id']) ? $get_values['pk_id'] : ''); ?>/<?php echo (!empty($status) ? $status : ''); ?>"> <i class="<?php echo $class; ?>" aria-hidden="true" title="<?php echo $title; ?>"></i></a>
                        </td>
                          <?php }?>
                         <?php if( in_array('customers_delete', $privilige) || in_array('customers_view', $privilige) ){ ?>
                        <td class="text-center">
                          <?php if(in_array('customers_view', $privilige)){ ?>
                          <a href="<?php echo base_url('admin/view-customers/'.$get_values['pk_id']); ?>"><button type="button" class="btn btn-primary btn-xs" title="View"><i class="fa fa-eye"></i></button></a>
                            <?php }if(in_array('customers_delete', $privilige)){ ?>
                          <a href="<?php echo base_url(); ?>admin/delete-registered-customer/<?php echo (!empty($get_values['pk_id']) ? $get_values['pk_id'] : ''); ?>" onClick="return confirm('Are you sure you want to delete record?')"><button type="button" class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash"></i></button></a>
                           <?php } ?> 
                        </td>
                        <?php } ?> 
                     </tr>
                  <?php
                  $i++;
                   }
               } ?>
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
  $(".customerLi").addClass("active");
//   $("#example").DataTable();
   $('#example').wrap('<div class="resp_table"></div>');
      $(".select2").select2();

        $('#fromdate').datepicker(
    { 
        format: "dd-mm-yyyy",   
        autoclose:true,     
        todayHighlight: true  
    });

    $('#todate').datepicker(
    { 
        format: "dd-mm-yyyy",   
        autoclose:true,     
        todayHighlight: true  
    });
    var nowDate = new Date(); // alert(nowDate);

    $('#fromdate').datepicker({
        format: "dd-mm-yyyy",
        autoclose: true,
        todayHighlight: true,
        startDate: nowDate
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#todate').datepicker('setStartDate', minDate);
    });


      $('#todate').datepicker({
          format: "dd-mm-yyyy",
          autoclose: true,
          startDate: nowDate}).on('changeDate', function (selected) {
          var maxDate = new Date(selected.date.valueOf());
          $('#fromdate').datepicker('setEndDate', maxDate);
      });
</script>
</body>
</html>