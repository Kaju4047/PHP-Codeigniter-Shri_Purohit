<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content-header">
      <h1>Refund Pooja Booking List
         <div class="pull-right">
            <a href="<?php echo base_url(); ?>admin/pending-pooja-booking-list"><button type="button" class="btn btn-default">Pending</button></a>
            <a href="<?php echo base_url(); ?>admin/todays-pooja-booking-list"><button type="button" class="btn btn-default">Todays</button></a>
            <a href="<?php echo base_url(); ?>admin/upcoming-pooja-booking-list"><button type="button" class="btn btn-default">Upcoming</button></a>
            <a href="<?php echo base_url(); ?>admin/completed-pooja-booking-list"><button type="button" class="btn btn-default">Completed</button></a>
            <a href="<?php echo base_url(); ?>admin/refund-pooja-booking-list"><button type="button" class="btn btn-refund">Refund</button></a>
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
             <div class="col-md-2 no-left-pad form-group margin-bottom">
                  <label>City</label>
                  <select class="form-control select2"> 
                      <option value="">Select City</option>
                      <option value="">Pune</option> 
                      <option value="">Mumbai</option>         
                  </select>
                </div>
                <div class="col-md-2 form-group">
                    <label>From Date</label>
                      <div class="input-group date" data-date-format="dd.mm.yyyy" >
                      <input type="text"  id="fromdate" class="form-control" placeholder="dd-mm-yyyy">
                      <div class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </div>
                    </div>
                </div>
                <div class="col-md-2 form-group">
                    <label>To Date </label>
                      <div class="input-group date" data-date-format="dd.mm.yyyy" >
                      <input type="text"  id="todate" class="form-control" placeholder="dd-mm-yyyy">
                      <div class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </div>
                    </div>
                </div>
                <div class="col-md-2 form-group">
                 <!--  <button type="button" class="btn btn-warning filter-btn"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button> -->
                  <button type="submit" class="btn btn-primary filter-btn"><i class="fa fa-filter"></i> Filter</button>
               </div>
            </div>
         </div>
         <div class="clearfix">
         <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                  <div class="col-md-6" style="display: inline-block;float: right;margin-bottom: 10px;">
                      <input type="text" name="search_term" id="search_term" class="form-control" value="" placeholder="Search" style="width: 87%; display: inline-block;margin-left: 43px;">
                       <button type="submit" class="btn btn-primary" title="Search" style="position: absolute;top: 0;right: 0;margin-right: 15px;height: 34px;"><i class="fa fa-search"></i></button>
                  </div>
               </div>
               <table class="table table-bordered table-striped table-hover" width="100%">
                  <thead>
                     <tr>
                        <th width="5%">Sr. No.</th>
                        <th width="8%">Pooja Id</th>
                        <th width="10%">Pooja Name</th>
                        <th width="12%">Date & Time</th>
                        <th width="12%">Customer Name</th>
                        <th width="9%">Mobile No.</th>
                        <th width="13%">Purohit Name</th>
                        <th width="13%">Pooja Scheduled On</th>
                        <th width="10%">Refund Amount</th>
                        <th width="5%">Status</th>
                        <th width="3%">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td class="text-center">1</td>
                        <td>123456</td>
                        <td>Ganesh Pooja</td>
                        <td>2-12-2019 9:43:10</td>
                        <td>Ajay Bhosale</td>
                        <td>9876543210</td>
                        <td>Ganesh Patil</td>
                        <td>2-12-2019 11:00:00</td>
                        <td>500</td>
                        <td><span class="cl-green">New</span></td>
                        <td class="text-center">
                          <a href="<?php echo base_url(); ?>admin/view-refund-pooja-booking"><button type="button" class="btn btn-primary btn-xs" title="View"><i class="fa fa-eye"></i></button></a>
                        </td>
                     </tr>
                      <tr>
                        <td class="text-center">2</td>
                        <td>123457</td>
                        <td>Ganesh Pooja</td>
                        <td>3-12-2019 11:00:00</td>
                        <td>Rahul Jadhav</td>
                        <td>9632587410</td>
                        <td>Ashish Patil</td>
                        <td>2-12-2019 11:30:00</td>
                        <td>200</td>
                        <td><span class="cl-blue">Refunded</span></td>
                        <td class="text-center">
                          <a href="<?php echo base_url(); ?>admin/view-refund-pooja-booking"><button type="button" class="btn btn-primary btn-xs" title="View"><i class="fa fa-eye"></i></button></a>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
        </div>
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
   $(".poojabkLi").addClass("active");
   
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
   
</script>
</body>
</html>