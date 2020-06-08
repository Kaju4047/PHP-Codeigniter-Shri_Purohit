<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content-header">
      <h1>Enquiry Report</h1>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="col-md-12 no-mob-pad no-pad">
         <div class="box box-primary no-height margin-bottom">
            <div class="box-body no-height ">
              <div>
                <?php
                if(empty($hidden))
                {
                  echo '<input type="hidden" name="set_select" id="set_select" value="all">';
                }
                else
                {
                  echo $hidden;
                }
                ?>
                 <!-- <form name="frmSearchByType" id="frmSearchByType" action="<?php //echo base_url('admin/enquiry-support-requests-byType');?>" method="post" autocomplete="off"> -->
                  <form name="frmSearchByType" id="frmSearchByType" action="<?php echo base_url('admin/enquiry-support-requests');?>" method="get" autocomplete="off">
                  <div class="col-md-2 no-left-pad form-group margin-bottom">
                      <label>Search By</label>
                      <select class="form-control" name="serach_by_type" id="serach_by_type"> 
                          <option value="all" >All</option>
                          <option value="Purohit">Purohit</option>
                          <option value="User">User</option>
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
                  <button type="submit" class="btn btn-primary filter-btn"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
               </div>
             </form>
             </div>
             </div>
             </div>
             <div class="box box-primary">
            <div class="box-body">
               <div class="clearfix"></div>
               <table id="example" class="table table-bordered table-striped table-hover" width="100%">
                  <thead>
                     <tr>
                        <th width="8%">Sr. No.</th>
                        <th width="9%">Enquiry Id</th>
                        <th width="13%">Date & Time</th>
                        <th width="9%">User Type</th>
                        <th width="18%">User Name</th>
                        <th width="10%">Mobile No.</th>
                        <th width="22%">Subject</th>
                      </tr>
                  </thead>
                  <tbody id="tbody">
                    <tr>
                        <td class="text-center">1</td>
                        <td>26</td>
                        <td>2020-03-05 14:29:16</td>
                        <td>Purohit</td>
                        <td>Sujata Purohit</td>                        
                        <td>9960090811</td>
                        <td>Test 3</td>
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

<!-- Modal -->
   <div class="modal fade" id="viewenqsupModal" role="dialog">
      <div class="modal-dialog">
         <!-- Payment Modal start-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
               <div class="col-md-7 col-sm-7 no-left-pad">
                  <h3 class="modal-ins-cont-hd">Enquiry Date</h3>
                  <h4 class="modal-ins-cont-subhd e_date"></h4>
              </div>
              <div class="col-md-5 col-sm-5">
                  <h3 class="modal-ins-cont-hd pull-right">Enquiry Id : <span id="enquiryID"></span></h3>
              </div>
            </div>
            <div class="modal-body">
              <table class="usertable">
                 <tbody id="setTblData">
                  
                 </tbody>
              </table>
              <div class="col-md-4 col-sm-4 no-left-pad form-group">
                <input type="hidden" name="id" id="id">
                  <label>Status</label>
                  <select class="form-control" id="modal_status" name="modal_status"> 
                      <option value="New">New</option>
                      <option value="Solved">Solved</option>
                  </select>
              </div>
              <div class="col-md-12 no-pad form-group">          
                   <button type="button" class="btn btn-success submit"><i class="fa fa-check-circle"></i> Submit</button>
              </div>
            </div>
            <div class="modal-footer">
            </div>
         </div>
      </div>
   </div>
   <!----Modal End---->

<!-- START:: Footer -->
<?php include("application/views/admin/section/vw_footer.php"); ?>
<!-- END:: Footer -->
<script>
    $(".reptLi").addClass("active");
   $(".enquirepLi").addClass("active");
   // $("#example").DataTable();
   $('#example').wrap('<div class="resp_table"></div>');

   function viewModal(id) //view Modal
   {    
    $.ajax({
      url:"<?php echo base_url('admin/get-enquiry-support-data');?>",
      type:"POST",
      data:{"id":id},
      success:function(data)
      {
        // console.log(data);
        var setData=JSON.parse(data);        
        var setTblData='';
        if(setData[0]['user_type']=="User")
        {
          
          setTblData=$("#setTblData").html('<tr><th width="26%">User Type</th><td width="74%">'+setData[0]['user_type']+'</td></tr><tr><th>Name</th><td>'+setData[0]['first_name']+'  '+setData[0]['last_name']+'</td></tr><tr><th>Email ID.</th><td>'+setData[0]['emailid']+'</td></tr><tr><th>Subject</th><td>'+setData[0]['subject']+'</td></tr><tr><th>Description</th><td>'+setData[0]['message']+'</td></tr>');
        }
        else if(setData[0]['user_type']=="Purohit")
        {
           setTblData=$("#setTblData").html('<tr><th width="26%">User Type</th><td width="74%">'+setData[0]['user_type']+'</td></tr><tr><th>User Name</th><td>'+setData[0]['purohit_fname']+'  '+setData[0]['purohit_lname']+'</td></tr><tr><th>Mobile No.</th><td>'+setData[0]['mobile_no']+'</td></tr><tr><th>Subject</th><td>'+setData[0]['subject']+'</td></tr><tr><th>Description</th><td>'+setData[0]['message']+'</td></tr>');

        }
        
        $(".e_date").text(setData[0]['created_date']);
        $("#enquiryID").text(setData[0]['id']);
        $("#id").val(setData[0]['id']);
        if(setData[0]['status']=="Solved")
        {
          $("#modal_status").val(setData[0]['status']).trigger('change').attr("disabled",true);
          $(".submit").attr("disabled",true);
        }
        else
        {
          $("#modal_status").val(setData[0]['status']).trigger('change').attr("disabled",false);
          $(".submit").attr("disabled",false);

        }
      }
    });
   }
   //update status in modal
   $(document).on("click",".submit",function(){
      var id=$("#id").val();
      var status=$("#modal_status").val();
      $.ajax({
      url:"<?php echo base_url('admin/update-status-in-enquiry-support');?>",
      type:"POST",
      data:{"id":id,"status":status},
      success:function(data)
      {
        // console.log(data);
        var value=JSON.parse(data);
        // console.log(value['check']);
        if(value['check']=="success")
        {
          alert(value['messsage']);
        }
        else if(value['error'])
        {
          alert(value['messsage']);
        }
          window.location.href = '<?php echo base_url("admin/enquiry-support-requests"); ?>';
             
      }
    });
   });

   //seting trigger for filter
   var setTrigger=$("#set_select").val();
   if(setTrigger)
   {
    $("#serach_by_type").val(setTrigger).trigger('change');
   }
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