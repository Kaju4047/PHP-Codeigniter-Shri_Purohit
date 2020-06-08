<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content-header">
      <h1>
        New Transaction 
         <div class="pull-right">
            <a href="<?php echo base_url();?>admin/purohit-transaction-history-list"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back </button></a>
         </div>
      </h1>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="col-md-12 no-mob-pad no-pad">
         <div class="box box-primary">
            <div class="box-body">
            <form method="post" id="add_purohit_transction_history" action="<?php echo base_url()?>admin/add-purohit-transaction-action">
               <div class="col-md-3 form-group">
                  <label>Purohit</label>
                  <select class="form-control select2" name="purohit_id" id="purohit_id" onchange="getPurohitBalance();"  style="color: #555">
                     <option value="">Select Purohit</option>
                     <?php if (!empty($purohit_list)) {
                     foreach($purohit_list as $key => $value)
                     {?>
                     <option value="<?php echo $value['pk_id'];?>"><?php echo $value['purohit_name'];?></option>
                     <?php }}?>
                  </select>
                  <div for="purohit_id" generated="true" class="error"></div>
               </div>
               <div class="col-md-3 form-group">
                  <label>Balance</label>
                  <input type="text" class="form-control" name="balance" id="balance" readonly="">
               </div>
               <div class="clearfix"></div>
               <div class="col-md-3 form-group">
                  <label>Transaction Date </label>
                  <div class="input-group date" data-date-format="dd.mm.yyyy" >
                     <input type="text"  id="date" name="date" class="form-control" placeholder="dd-mm-yyyy" autocomplete="off"  style="color: #555">
                     <div class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                     </div>
                  </div>
                   <div for="date" generated="true" class="error"></div>
                   <div class="clearfix"></div>
               </div>
               <div class="col-md-3 form-group">
                  <label>Time</label>
                  <div class="input-group time" >
                     <input type="text" class="form-control" id="time" name="time"  autocomplete="off"  style="color: #555" />
                     <span class="input-group-addon">
                     <span class="glyphicon glyphicon-time"></span>
                     </span>
                  </div>
                     <div for="time" generated="true" class="error"></div>
                   <div class="clearfix"></div>
               </div>
              
               <div class="col-md-3 form-group">
                  <label>Amount</label>
                  <input type="text" class="form-control" name="amount" id="amount" autocomplete="off"  style="color: #555">
               </div>
               <div class="col-md-3 form-group">
                  <label>Transaction Id</label>
                  <input type="text" class="form-control" name="transaction_id" id="transaction_id" autocomplete="off"  style="color: #555">
               </div>
               <div class="clearfix"></div>
               <div class="col-md-6 form-group">
                  <label>Remark</label>
                  <textarea rows="2" class="form-control" style="resize: none;" name="remark" id="remark "></textarea>
               </div>
               <div class="clearfix"></div>
               <div class="col-md-12 mg-top-10 form-group">          
                  <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
                  <!-- <button type="button" class="btn btn-danger" href="<?php echo base_url(); ?>admin/additional-services"><i class="fa fa-times-circle"></i> Cancel</button> -->
                  <a href="<?php echo base_url(); ?>admin/add-purohit-transaction-history" ><button type="button"  class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancel</button></a>
               </div>
               </form>
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
   </section>
</div>
<!-- End .content-wrapper -->
<!-- START:: Footer -->
<?php include("application/views/admin/section/vw_footer.php"); ?>
<!-- END:: Footer -->
<script type="text/javascript" src="<?php echo base_url('AdminMedia/validations/js_purohit_transcation_history/purohit_transcation_history.js'); ?>"></script>
<script>
   $(".purtranhisLi").addClass("active");
   
   $(".select2").select2();
  
   $('#time').datetimepicker({
    format: 'LT'
   });
   
   $('#date').datepicker(
      { 
        format: "dd-mm-yyyy",   
        autoclose:true,     
        todayHighlight: true,
        startDate: new Date()
      });

     function getPurohitBalance(Id) {
 

        // $("#purohit_id").val('');
        var purohit_id = $("#purohit_id option:selected").val();
      
        var base_url = "<?php echo base_url(); ?>";
        $.ajax({
            type: "POST",
            data: {purohit_id: purohit_id},
            url: base_url + "admin/purohit_transaction_history/Cn_purohit_transaction_history/getPurohitBalance",
            dataType: 'json',
 
            success: function (data){          
                 $("#balance").val(data.balance);
            }
        });
                                      
    } 



</script>
</body>
</html>