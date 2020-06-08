<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content-header">
      <h1>Payment History Report</h1>
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
                   <button type="submit" class="btn btn-primary filter-btn"  onclick="javascript: form.action='<?php echo base_url('admin/payment-history');?>';"><i class="fa fa-filter"></i>  Filter</button>
               </div>
             </form>
            </div>
         </div>
         <div class="box box-primary">
            <div class="box-body">
                <div class="table-responsive">
               <table id="example" class="table table-bordered table-striped table-hover" width="150%">
                  <thead>
                     <tr>
                        <th width="5%">Sr. No.</th>
                        <th width="6%">Puja Id</th>
                        <th width="7%">Puja Date & Time</th>
                        <th width="11%">Customer Name</th>
                        <th width="7%">Customer Mobile No.</th>
                        <th width="11%">Purohit Name</th>
                        <th width="10%">Puja Name</th>
                        <th width="11%">Puja Completed On</th>
                        <th width="10%">Total Amount (Rs.)</th>
                        <th width="11%">Purohit Amount (Rs.)</th>
                     </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>SP174</td>
                        <td>20-03-2020</td>
                        <td>Ashvini</td>
                        <td>9146602601</td>
                        <td></td>
                        <td>Samvatsarikam – First Year ceremony – Non Brahmins</td>
                        <td></td>
                        <td>1155</td>
                        <td>57.75</td>
                     </tr>
                  </tbody>
               </table>
               </div>
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
   $(".payhistrepLi").addClass("active");
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
<script type="text/javascript">
   $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Export To Excel'
              }
            // },
            // {
            //     extend: 'pdfHtml5',
            //     text: 'Export To PDF'
            // }
        ]
    } );
} );
</script>
</body>
</html>