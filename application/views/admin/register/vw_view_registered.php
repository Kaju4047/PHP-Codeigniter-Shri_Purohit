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
         Purohit Details
         <div class="pull-right">
            <a href="<?php echo base_url()?>admin/registered"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</button></a>
         </div>
      </h1>
   </section>
   <!-- Main content -->
   <section class="content">
       <!-- End col-md-12 -->
       
      
       <div class="col-md-4 no-left-pad reg-user mob-no-pad">
               <div class="box box-primary mr-bot-10" style="min-height: 0px;">
                  <div class="box-body" style="min-height: 0px;padding: 0px;">
                     <div class="col-md-12">
                        <div class="row">
                           
                           <div class="col-md-12 text-center">
                            <img  class="teacher-img" src="http://m-staging.in/UPSCShots/AdminMedia/images/avatar5.png">
                              
                           </div>
                           <div style="padding: 5px;">
                              <table class="table">
                                 <tbody>
                                    <tr>
                                       <th width="30%">Name</th>
                                       <td style="border-top:none;" width="70%">Radhika Shankar jagtap</td>
                                    </tr>
                                    <tr>
                                       <th>Mobile No.</th>
                                       <td>8888888888</td>
                                    </tr>
                                    <tr>
                                       <th>Alt. Mobile No.</th>
                                       <td>9999999999</td>
                                    </tr>
                                    <tr>
                                       <th>Email Id</th>
                                       <td>radhika.j@mplussoft.com</td>
                                    </tr>
                                     <tr>
                                       <th>DOB</th>
                                       <td>05-01-2009</td>
                                    </tr>
                                    <tr>
                                       <th style="vertical-align: top !important;">Full Address</th>
                                       <td>Radha nagari, dighi road, bhosari, pune-39, Maharshtra.</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="box box-primary mob-mr-bot-10" style="min-height: 0px; padding: 5px;">
                  <div class="box-body" style="min-height: 0px;padding: 0px;">
                     <div class="col-md-12">
                        <div class="row">
                              <div class="creative_block">

                                <table class="table">
                                <tbody>

                                    <tr>
                                       <th>Qualification</th>
                                       <td>MCA</td>
                                    </tr>
                                    <tr>
                                       <th width="32%" style="vertical-align: top !important;">Pathshala</th>
                                       <td width="68%">Ahilyadevi Vidya Mandir</td>
                                    </tr>
                                    <tr>
                                       <th>Location</th>
                                       <td>Pune, Maharashtra</td>
                                    </tr>
                                    <tr>
                                       <th>Exp. In Years</th>
                                       <td>4</td>
                                    </tr>
                                     <tr>
                                       <th style="vertical-align: top !important;">Languages Known</th>
                                       <td>Hindi, English, Marathi  </td>
                                    </tr>
                                    <tr>
                                       <th style="vertical-align: top !important;">Certificate Image</th>
                                       <td><img src="<?php echo base_url()?>AdminMedia/images/default.png" width="70px"></td>
                                    </tr>
                                 </tbody>
                              </table>
                            </div>
                            
                       </div>
                     </div>
                   </div>
                 </div>
                  </div>
              
     
          
          
         <div class="col-md-8 no-pad">
            <div class="box box-primary">
               <div class="box-body">
                  <div class="col-md-12 no-pad">
                     
                     <div class="tab-content">
                      <div id="study_material" class="tab-pane fade in active">
                        <div class="table-responsive">
                          <!-- <table class="table table-bordered table-striped table-hover">
                            <thead class="table-example">
                              <tr>
                                <th width="6%">Sr. No.</th>
                                <th width="8%">Date</th>
                                <th width="15%">Type</th>
                                <th width="30%">Name</th>
                                <th width="15%">Purchase Cost (Rs.)</th>
                                <th width="6%">Action</th>
                              </tr>
                            </thead>
                            <tbody class="payment-history">
                              <tr>
                                <td class="text-center">1</td>
                                <td>12/12/2012</td>
                                <td>Test Series</td>
                                <td>Radhika Jagtap</td>
                                <td>1000</td>
                                <td class="text-center">                                          
                                  <a href="#"><button type="button" class="btn btn-primary btn-xs" title="View"><i class="fa fa-eye"></i></button></a>
                                </td>      
                              </tr>
                               <tr>
                                <td class="text-center">2</td>
                                <td>12/12/2012</td>
                                <td>Course PDF </td>
                                <td>Shekhar Dhumal</td>
                                <td>1200</td>
                                <td class="text-center">                                          
                                  <a href="#"><button type="button" class="btn btn-primary btn-xs" title="View"><i class="fa fa-eye"></i></button></a>
                                </td>      
                              </tr>
                            </tbody>
                          </table> -->
                          <p>No Data Available</p>
                        </div>
                      </div>                      
                    </div>
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
    $(".addpurohitLi").addClass("active");
</script>
</body>
</html>
