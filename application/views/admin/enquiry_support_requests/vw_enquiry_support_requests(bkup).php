<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content-header">
      <h1>Enquiry / Support Requests</h1>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="col-md-12 no-mob-pad no-pad">
         <div class="box box-primary">
            <div class="box-body">
              <div class="col-md-2 no-left-pad form-group margin-bottom">
                  <label>Search By</label>
                  <select class="form-control"> 
                      <option>All</option>
                      <option>Purohit</option>
                      <option>User</option>
                  </select>
                </div>
                <div class="col-md-2 form-group">
                  <button type="button" class="btn btn-warning filter-btn"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
               </div>
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
                        <th width="23%">Subject</th>
                        <th width="5%">Status</th>
                        <th width="5%">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td class="text-center">1</td>
                        <td>123456</td>
                        <td>2-12-2019 9:43:10</td>
                        <td>Purohit</td>
                        <td>Ganesh Patil</td>
                        <td>9876543210</td>
                        <td>Pooja</td>
                        <td>New</td>
                        <td class="text-center">
                          <button type="button" class="btn btn-primary btn-xs" title="View" data-toggle="modal" data-target="#viewenqsupModal"><i class="fa fa-eye"></i></button>
                          <a href="#"><button type="button" class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash"></i></button></a> 
                        </td>
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

<!-- Modal -->
   <div class="modal fade" id="viewenqsupModal" role="dialog">
      <div class="modal-dialog">
         <!-- Payment Modal start-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
               <div class="col-md-7 col-sm-7 no-left-pad">
                  <h3 class="modal-ins-cont-hd">Enquiry Date</h3>
                  <h4 class="modal-ins-cont-subhd">1-1-2020, 10:00 am</h4>
              </div>
              <div class="col-md-5 col-sm-5">
                  <h3 class="modal-ins-cont-hd pull-right">Enquiry Id : 1234</h3>
              </div>
            </div>
            <div class="modal-body">
              <table class="usertable">
                 <tbody>
                    <tr>
                       <th width="26%">User Type</th>
                       <td width="74%">Purohit</td>
                    </tr>
                    <tr>
                       <th>User Name</th>
                       <td>Ganesh Patil</td>
                    </tr>
                    <tr>
                       <th>Mobile No.</th>
                       <td>9876543210</td>
                    </tr>
                    <tr>
                       <th>Subject</th>
                       <td>Pooja</td>
                    </tr>
                    <tr>
                       <th>Description</th>
                       <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</td>
                    </tr>
                 </tbody>
              </table>
              <div class="col-md-4 col-sm-4 no-left-pad form-group">
                  <label>Status</label>
                  <select class="form-control"> 
                      <option>New</option>
                      <option>Solved</option>
                  </select>
              </div>
              <div class="col-md-12 no-pad form-group">          
                   <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
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
   $(".enqsupLi").addClass("active");
   $("#example").DataTable();
</script>
</body>
</html>