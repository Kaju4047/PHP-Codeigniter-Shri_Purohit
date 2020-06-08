<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

   <!-- Main content -->
   <section class="content">
      <div class="col-md-4 no-pad">
         <h1 class="two-way-hd">Add Language </h1>
         <div class="box box-primary mob-no-height" style="min-height: auto;">
            <div class="box-body mob-no-height">
              <form method="post" id="add_citywise_language" action="<?php echo base_url()?>admin/add-citywise-language">
                  <input type="hidden" name="txtid" id="txtid" value="<?php echo (!empty($edit['pk_id']) ? $edit['pk_id'] : ''); ?>" class="form-control">
                  <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url() ?>" class="form-control">
                  <div class="col-md-12 form-group">
                     <label>City <span style="color: red">*</span></label>

                     <select class="form-control" id="city" name="city" style="color: #555">
                        <option value="" selected disabled>Select City</option>
                        <?php if (!empty($cityDetails)) {
                           foreach ($cityDetails as $key => $value) { ?>
                           <option value="<?= $value['pk_id'];?>"<?php echo ((!empty($edit['fk_city']) && $edit['fk_city'] == $value['pk_id']) ? 'selected' : ''); ?>><?= ucfirst($value['city']);?></option>
                        <?php }}?>                     
                    </select>
                  </div>
                  <div class="col-md-12 form-group">
                     <label>Language <span style="color: red">*</span></label>
                       <select class="form-control" id="language" name="language" style="color: #555">
                        <option  value="" selected disabled>Select Language</option>
                        <?php if (!empty($languageDetails)) {
                           foreach ($languageDetails as $key => $value) { ?>
                           <option value="<?= $value['pk_id'];?>"<?php echo ((!empty($edit['fk_language']) && $edit['fk_language'] == $value['pk_id']) ? 'selected' : ''); ?>><?= ucfirst($value['language']);?></option>
                        <?php }}?>                     
                    </select>
                    
                  </div>
                  <div class="clearfix"></div>
                  <?php  if(in_array('citywiselang_add', $privilige)){?>
                  <div class="col-md-12 form-group">          
                     <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>                     
                     <a href="<?php echo base_url(); ?>admin/citywise-language" ><button type="button" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancel</button></a>
                  </div>
                  <?php }?>
                  <!-- End form-group --> 
               </form>
            </div>
            <!-- End box-body -->
         </div>
      </div>
      <div class="col-md-8 no-pad-right m-mob-top-15 mob-no-pad">
         <h1 class="two-way-hd">Language List </h1>
         <div class="box box-primary no-height">
       <!--   <form id="filter"  method='get'   enctype="multipart/form-data">  -->
            <form id="filter"  method='get'   enctype="multipart/form-data"> 
            <div class="box-body no-height margin-bottom">
               <div class="col-md-4 form-group">
                    <label>City</label>                      
                      <input type="text" class="form-control" name="filter_city" id="filter_city" value="<?php echo !empty($filter_city) ?$filter_city: '';?>" autocomplete="off">                   
                </div>
                <div class="col-md-4 form-group">
                    <label>Language</label>
                      <input type="text" class="form-control" name="filter_language" id="filter_language" value="<?php echo !empty($filter_language) ?$filter_language: '';?>" autocomplete="off"> 
                </div>
                <div class="col-md-2 form-group">
                    <button type="submit" class="btn btn-primary filter-btn" onclick="javascript: form.action='<?php echo base_url('admin/citywise-language');?>';" >Search</button>

               </div>
            </div>
         </form>
         </div>
         <div class="box box-primary mob-no-height">
            <div class="box-body mob-no-height">
               <table id="example" class="table table-bordered table-striped table-hover">
                  <thead>
                     <tr>
                        <th width="12%" class="text-center">Sr. No.</th>
                        <th width="30%">City</th>
                        <th width="35%">Language</th>
                         <?php  if(in_array('citywiselang_AI', $privilige)){?>
                        <th width="5%" class="text-center">Status</th>
                        <?php } if(in_array('citywiselang_add', $privilige) || in_array('citywiselang_delete', $privilige)){?>

                        <th width="8%" class="text-center">Action</th>
                           <?php }?>
                     </tr>
                  </thead>
                  <tbody>
                     <?php if (!empty($citywiseLanguage)) {
                           $page_no= !empty($this->uri->segment(3)) ? $this->uri->segment(3): 1;
                           $i = ($page_no * 10) - 9;
                           foreach ($citywiseLanguage as $key => $value) {
                     ?>
                     <tr>
                        <td class="text-center"><?php echo $i;?></td>
                        <td><?php echo !empty($value['city'])?ucfirst($value['city']):''; ?></td>
                        <td><?php echo !empty($value['language'])?ucfirst($value['language']):''; ?></td>
                          <?php  if(in_array('citywiselang_AI', $privilige)){?>
                         <td class="text-center">
                                <?php
                                $status = ""; 
                                if ($value['status'] == "1") {
                                    $status = "2";
                                    $class = "fa fa-toggle-on tgle-on";
                                    $title = "Active";
                                } else if ($value['status'] == "2") {
                                    $status = "1";
                                    $class = "fa fa-toggle-on fa-rotate-180 tgle-off";
                                    $title = "Inactive";
                                }
                                ?>
                                <a onClick="return confirm('Are you sure you want to change status of this record ?')"  href="<?php echo base_url(); ?>admin/citywise-language-status/<?php echo (!empty($value['pk_id']) ? $value['pk_id'] : ''); ?>/<?php echo (!empty($status) ? $status : ''); ?>"> <i class="<?php echo $class; ?>" aria-hidden="true" title="<?php echo $title; ?>"></i></a>
                        </td>
                         <?php } if(in_array('citywiselang_add', $privilige) || in_array('citywiselang_delete', $privilige)){?>
                        <td style="text-align: center;">
                             <?php $page = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 1;?>
                         <?php  if(in_array('citywiselang_add', $privilige) || in_array('citywiselang_delete', $privilige)){?>
                           <a href="<?php echo base_url(); ?>admin/citywise-language/<?php echo $page?>?edit=<?php echo (!empty($value['pk_id']) ? $value['pk_id'] : ''); ?>"><button type="button" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil"></i></button></a>                         
                         <?php } if( in_array('citywiselang_delete', $privilige)){?>
                           <a href="<?php echo base_url(); ?>admin/delete-citywise-language/<?php echo (!empty($value['pk_id']) ? $value['pk_id'] : ''); ?>" onClick="return confirm('Are you sure you want to delete record?')"><button type="button" class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash"></i></button></a>
                         <?php }?>
                        </td>
                         <?php }?>
                     </tr>
                      <?php  $i++;
                        }
                     }?>                    
                  </tbody>
               </table>
               <ul class="pagination pull-right" >
                    <?php if (isset($follow_links) && !empty($follow_links)) { ?>
                   <p><?php echo $follow_links ?></p>
                 <?php } ?>
              </ul>
            </div>
         </div>
         <!-- End col-md-8 -->
      </div>
      <div class="clearfix"></div>
   </section>
   <!-- End .content -->
</div>
<!-- End .content-wrapper -->
<!-- START:: Footer -->
<?php include("application/views/admin/section/vw_footer.php"); ?>
<!-- END:: Footer -->
<script type="text/javascript" src="<?php echo base_url('AdminMedia/validations/js_master/citywise_language.js'); ?>"></script>
<script>
   $(".masterLi").addClass("active");
   $(".langcityLi").addClass("active");
   // $("#example").DataTable();
   $('#example').wrap('<div class="resp_table"></div>');
   $(".select2").select2();
</script>
</body>
</html>