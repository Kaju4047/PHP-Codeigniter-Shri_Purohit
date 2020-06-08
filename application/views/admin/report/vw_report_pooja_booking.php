<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content-header">
      <h1> Pooja Booking Report
           <?php 
           $cust_id = !empty($this->input->get('cust_id')) ? $this->input->get('cust_id') : '';
           $purohit_id = !empty($this->input->get('purohit_id')) ? $this->input->get('purohit_id') : '';
           ?>
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
                <div class="col-md-2 form-group">
                    <label>Status </label>
                      <select class="form-control">
                          <option>Select Status</option>
                          <option>Pending</option>
                          <option>Todays</option>
                          <option>Upcoming</option>
                          <option>Completed</option>
                          <option>Refund</option>
                          <option>Rejected</option>
                          <option>Cancelled</option>
                      </select>
                </div>
                <div class="col-md-2 form-group">
                  <!-- <button type="button" class="btn btn-warning filter-btn"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button> -->
                  <button type="submit" class="btn btn-primary filter-btn" onclick="javascript: form.action='<?php echo base_url('admin/completed-pooja-booking-list');?>';"><i class="fa fa-filter"></i> Filter</button>
               </div>
               </form>
            </div>
         </div>
         <div class="clearfix">
         <div class="box box-primary">
            <div class="box-body">
               <table id="example" class="table table-bordered table-striped table-hover" width="100%">
                  <thead>
                     <tr>
                       <th width="6%">Sr. No.</th>
                        <th width="8%">Puja Id</th>
                        <th width="11%">Puja Name</th>
                        <th width="11%">Puja Ordered Date & Time</th>
                        <th width="10%">Customer Name</th>
                        <th width="8%">Mobile No.</th>
                        <th width="10%">Purohit Name</th>
                        <th width="8%">Puja City</th>
                        <th width="10%">Puja Scheduled On</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td class="text-center">1</td>
                        <td>SP173</td>
                        <td>Samvatsarikam – First Year ceremony – Non Brahmins</td>
                        <td>05-03-2020</td>
                        <td>Ashvini</td>
                        <td>9146602601</td>
                        <td>-</td>
                        <td>Pune</td>
                        <td>17-03-2020</td>
                     </tr>
                     
                  </tbody>
               </table>
              <!--  <ul class="pagination pull-right" >-->
              <!--      <?php if (isset($follow_links) && !empty($follow_links)) { ?>-->
              <!--     <p><?php echo $follow_links ?></p>-->
              <!--   <?php } ?>-->
              <!--</ul>-->
            </div>
            <!-- End box-body -->
         </div>
         <!-- End box -->
      </div>
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
   $(".reptLi").addClass("active");
   $(".bookreLi").addClass("active");
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
        
        $(document).ready(function() {
            $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [{
                   extend: 'excelHtml5',
                    text: 'Export To Excel',
                }]
            } );
        } );
</script>
</body>
</html>