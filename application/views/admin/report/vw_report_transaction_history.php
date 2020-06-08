<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content-header">
      <h1>Transaction History Report  </h1>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="col-md-12 no-mob-pad no-pad">
          
          <div class="box box-primary no-height margin-bottom">
            <div class="box-body no-height ">
              <div>
                 <!-- <form name="frmSearchByType" id="frmSearchByType" action="<?php //echo base_url('admin/enquiry-support-requests-byType');?>" method="post" autocomplete="off"> -->
                  <form name="frmSearchByType" id="frmSearchByType" action="<?php echo base_url('admin/enquiry-support-requests');?>" method="get" autocomplete="off">
                  
                   <div class="col-md-2 form-group no-pad-left">
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
                  <button type="submit" class="btn btn-primary filter-btn"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
               </div>
             </form>
             </div>
             </div>
             </div>
          
         <div class="box box-primary">
            <div class="box-body">
               <table id="example" class="table table-bordered table-striped table-hover" width="100%">
                  <thead>
                     <tr>
                        <th width="7%">Sr. No.</th>
                        <th width="11%">Created Date</th>
                        <th width="18">Purohit Details</th>
                        <th width="13%">Transaction Type</th>
                        <th width="8%">Amount</th>
                        <th width="11%">Transaction Id</th>
                        <th width="13%">Date & Time</th>
                        <th width="19%">Remark</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                       <td class="text-center">1</td>
                       <td>28-02-2020</td>
                       <td>Rupali Pawar Pawar ,9630905274, rupalipawar421@gmail.com, sjbxvd</td>
                       <td>
                            <span class="cl-green">Credited</span>
                        </td>

                       <td>
                         <span class="">10</span> 
                    
                       </td>
                       <td>Tp12345678</td>
                       <td>28-02-2020   5:43 PM </td>
                       <td></td>
                   </tr>
                  </tbody>
               </table>
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
   $(".reptLi").addClass("active");
   $(".transhistLi").addClass("active");
   // $("#example").DataTable();
</script>
<script type="text/javascript">
   $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Export To Excel'
              
            },
            {
                extend: 'pdfHtml5',
                text: 'Export To PDF'
            }
        ]
    } );
} );

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