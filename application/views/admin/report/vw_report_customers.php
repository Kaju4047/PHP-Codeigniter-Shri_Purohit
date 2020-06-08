<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content-header">
      <h1>Customers Report</h1>
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
                  <!-- <button type="button" class="btn btn-warning filter-btn"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button> -->
                   <button type="submit" class="btn btn-primary filter-btn"  onclick="javascript: form.action='<?php echo base_url('admin/customers-list');?>';"><i class="fa fa-filter"></i>  Filter</button>
               </div>
             </form>
            </div>
         </div>
         <div class="box box-primary">
            <div class="box-body">
               <table id="example" class="table table-bordered table-striped table-hover" width="100%">
                  <thead>
                     <tr>
                        <th width="8%">Sr. No.</th>
                        <th width="12%">Registered On</th>
                        <th width="18%">Customer Name</th>
                        <th width="10%">Mobile No.</th>
                        <th width="23%">Email Id</th>
                        <th width="20%">City</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td class="text-center">1</td>
                        <td>04-03-2020</td>
                        <td>Rahul A Dasi</td>
                        <td>7507657595</td>
                        <td>dasiraul7@gmail.com</td>
                        <td></td>
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
  $(".reptLi").addClass("active");
  $(".custorepLi").addClass("active");
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
<script>
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
</script>
</body>
</html>