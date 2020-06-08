<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content-header">
      <h1>Todays Pooja Booking List
         <div class="pull-right">
            <a href="<?php echo base_url(); ?>admin/pending-pooja-booking-list"><button type="button" class="btn btn-default">Pending</button></a>
            <a href="<?php echo base_url(); ?>admin/todays-pooja-booking-list"><button type="button" class="btn btn-info">Todays</button></a>
            <a href="<?php echo base_url(); ?>admin/upcoming-pooja-booking-list"><button type="button" class="btn btn-default">Upcoming</button></a>
            <a href="<?php echo base_url(); ?>admin/completed-pooja-booking-list"><button type="button" class="btn btn-default">Completed</button></a>
            <a href="<?php echo base_url(); ?>admin/refund-pooja-booking-list"><button type="button" class="btn btn-default">Refund</button></a>
            <a href="<?php echo base_url(); ?>admin/reject-pooja-booking-list"><button type="button" class="btn btn-default">Rejected</button></a>
            <a href="<?php echo base_url(); ?>admin/cancelled-pooja-booking-list"><button type="button" class="btn btn-default">Cancelled</button></a>
         </div>
      </h1>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="col-md-12 no-mob-pad no-pad">
          <div class="box box-primary no-height margin-bottom">
            <div class="box-body no-height">
              <form id="filter"  method='get'  enctype="multipart/form-data">
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
                 <!-- <div class="col-md-2 form-group">
                    <label>From Date</label>
                      <div class="input-group date" data-date-format="dd.mm.yyyy" id="fromdate">
                      <input type="text"  class="form-control" placeholder="dd-mm-yyyy">
                      <div class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </div>
                    </div>
                </div>
                <div class="col-md-2 form-group">
                    <label>To Date </label>
                      <div class="input-group date" data-date-format="dd.mm.yyyy" id="todate">
                      <input type="text"  class="form-control" placeholder="dd-mm-yyyy">
                      <div class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </div>
                    </div>
                </div> -->
                <div class="col-md-2 form-group">
                    <label>From Date</label>
                      <div class="input-group date" data-date-format="dd.mm.yyyy" >
                      <input type="text"  id="fromdate" class="form-control" placeholder="dd-mm-yyyy" value="<?php echo !empty($filter_fromdate) ? date('d-m-Y',strtotime($filter_fromdate)) : '';?>" name="filter_fromdate" autocomplete="off">
                      <div class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </div>
                    </div>
                </div>
                <div class="col-md-2 form-group">
                    <label>To Date </label>
                      <div class="input-group date" data-date-format="dd.mm.yyyy" >
                      <input type="text"  id="todate" class="form-control" placeholder="dd-mm-yyyy" name="filter_todate" value="<?php echo !empty($filter_todate) ? date('d-m-Y',strtotime($filter_todate)) : '';?>" autocomplete="off">
                      <div class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </div>
                    </div>
                </div>
                <!-- <div class="col-md-2 form-group">
                  <button type="button" class="btn btn-warning filter-btn"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>

               </div> -->
               <div class="col-md-2 form-group">
                 <!--  <button type="button" class="btn btn-warning filter-btn"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button> -->
                  <button type="submit" class="btn btn-primary filter-btn" onclick="javascript: form.action='<?php echo base_url('admin/todays-pooja-booking-list');?>';"><i class="fa fa-filter"></i> Filter</button>
               </div>
               </form>
            </div>
         </div>
         <div class="box box-primary">
            <div class="box-body">
                 <div class="row">
                  <div class="col-md-6" style="display: inline-block;float: right;margin-bottom: 10px;">
                     <form name="frmSearch" id="frmSearch" method="GET" autocomplete="off">
                        
                        <input type="text" name="search_term" id="search_term" class="form-control" value="<?php echo!empty($this->input->get('search_term')) ? $this->input->get('search_term') : ''; ?>" placeholder="Search" style="width: 87%; display: inline-block;margin-left: 43px;">
                       
                        <button type="submit" class="btn btn-primary" title="Search" onclick="javascript: form.action='<?php echo base_url('admin/todays-pooja-booking-list');?>';" style="position: absolute;top: 0;right: 0;margin-right: 15px;height: 34px;"><i class="fa fa-search"></i></button>
                     </form>
                  </div>
               </div>
               <table id="example" class="table table-bordered table-striped table-hover" width="100%">
                  <thead>
                    <tr>
                        <th width="4%">Sr. No.</th>
                        <th width="5%">Pooja Id</th>
                        <th width="11%">Pooja Name</th>
                        <th width="11%">Pooja Ordered Date & Time</th>
                        <th width="16%">Customer Name</th>
                        <th width="10%">Mobile No.</th>
                        <th width="13%">Purohit Name</th>
                        <th width="8%">Pooja City</th>
                        <th width="10%">Pooja Scheduled On</th>
                        <th width="8%">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                    <?php
                     
                     if (!empty($todaysPoojaDeatails)) {
                           $page_no= !empty($this->uri->segment(3)) ? $this->uri->segment(3): 1;
                           $i = ($page_no * 10) - 9;
                      foreach ($todaysPoojaDeatails as $key => $value){
                                            
                     ?>
                     <tr>
                        <td class="text-center"><?= $i;?></td>
                        <td><?php echo !empty($value['pooja_id'])?ucfirst($value['pooja_id']):''; ?></td>
                        <td><?php echo !empty($value['pooja_id'])?ucfirst($value['pooja_id']):''; ?></td>
                        <td><?php echo !empty($value['created_date'])?date("d-m-Y", strtotime($value['created_date'])):''; ?></td>
                        <td><?php echo !empty($value['customer_name'])?ucfirst($value['customer_name']):''; ?></td>
                    
                        <td><?php echo !empty($value['customer_mobile_no'])?ucfirst($value['customer_mobile_no']):''; ?></td>
                        <td><?php echo !empty($value['purohit_name'])?ucfirst($value['purohit_name']):'-'; ?></td>
                        <td><?php echo !empty($value['pooja_city'])?ucfirst($value['pooja_city']):''; ?></td>
                        <td><?php echo !empty($value['pooja_date'])?date("d-m-Y", strtotime($value['pooja_date'])):''; ?></td>
                        <td class="text-center">
                          <a href="<?php echo base_url(); ?>admin/view-todays-pooja-booking/<?php echo !empty($value['pk_id'])?ucfirst($value['pk_id']):''; ?>"><button type="button" class="btn btn-primary btn-xs" title="View"><i class="fa fa-eye"></i></button></a>
                           <a href="<?php echo base_url(); ?>admin/delete-todays-pooja-booking-list/<?php echo (!empty($value['pk_id']) ? $value['pk_id'] : ''); ?>" onClick="return confirm('Are you sure you want to delete record?')"><button type="button" class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash"></i></button></a> 
                        </td>
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
   $(".poojabkLi").addClass("active");
   // $("#example").DataTable();
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
     var nowDate = new Date();

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

    var minDate = $('#fromdate').val();
        $('#todate').datepicker('setStartDate', minDate);

    var maxDate = $('#todate').val();
        $('#fromdate').datepicker('setEndDate', maxDate);
</script>
</body>
</html>