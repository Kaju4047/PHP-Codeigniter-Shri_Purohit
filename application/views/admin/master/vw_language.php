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
               <form method="post" id="add_language" action="<?php echo base_url(); ?>admin/add-language">
                   <input type="hidden" name="txtid" id="txtid" value="<?php echo (!empty($edit['pk_id']) ? $edit['pk_id'] : ''); ?>" class="form-control">
                   <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>" class="form-control">
                  <div class="col-md-12 form-group">
                     <label>Language <span style="color: red">*</span></label>
                     <input type="text" class="form-control" name="language" id="language" autocomplete="off" value="<?php echo (!empty($edit['language']) ? $edit['language'] : ''); ?>">
                  </div>
                  <div class="clearfix"></div>
                   <?php  if(in_array('language_add', $privilige)){?>
                  <div class="col-md-12 form-group">          
                     <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
                     <a href="<?php echo base_url(); ?>admin/language" >  <button  type="button" class="btn btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> Cancel</button></a>
                  </div>
                  <!-- End form-group --> 
               </form>
            </div>
            <!-- End box-body -->
         </div>
      </div>
      <div class="col-md-8 no-pad-right m-mob-top-15 mob-no-pad">
         <h1 class="two-way-hd">Language List </h1>
         <div class="box box-primary mob-no-height">
            <div class="box-body mob-no-height">
               <div class="row">
                  <div class="col-md-6" style="display: inline-block;float: right;margin-bottom: 10px;">
                     <form name="frmSearch" id="frmSearch" action="<?php echo base_url(); ?>admin/language" method="GET" autocomplete="off">
                        
                        <input type="text" name="search_term" id="search_term" class="form-control" value="<?php echo!empty($this->input->get('search_term')) ? $this->input->get('search_term') : ''; ?>" placeholder="Search" style="width: 87%; display: inline-block;margin-left: 43px;">
                       
                        <button type="submit" class="btn btn-primary" title="Search" onclick="javascript: form.action='<?php echo base_url('admin/language');?>';" style="position: absolute;top: 0;right: 0;margin-right: 15px;height: 34px;"><i class="fa fa-search"></i></button>
                     </form>
                  </div>
               </div>
               <table id="example" class="table table-bordered table-striped table-hover">
                  <thead>

                     <tr>
                        <th width="12%" class="text-center">Sr. No.</th>
                        <th width="60%">Language</th>
                        <?php  if(in_array('language_add', $privilige)){?>
                        <th width="10%" class="text-center">Status</th>
                        <?php } if(in_array('language_add', $privilige) || in_array('language_delete', $privilige)){?>
                        <th width="15%" class="text-center">Action</th>
                      <?php }?>
                     </tr>
                  </thead>
                  <tbody>
                     <?php if (!empty($languageDetails)) {
                           $page_no= !empty($this->uri->segment(3)) ? $this->uri->segment(3): 1;
                           $i = ($page_no * 10) - 9;
                           $sr = 1;
                           foreach ($languageDetails as $key => $value) {
                     ?>
                     <tr>
                        <td class="text-center"><?php echo $sr++; ?></td>
                        <td><?php echo !empty($value['language'])?ucfirst($value['language']):''; ?></td>
                        <?php  if(in_array('language_add', $privilige)){?>
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
                             <a onClick="return confirm('Are you sure you want to change status of this record ?')"  href="<?php echo base_url(); ?>admin/language-status/<?php echo (!empty($value['pk_id']) ? $value['pk_id'] : ''); ?>/<?php echo (!empty($status) ? $status : ''); ?>"> <i class="<?php echo $class; ?>" aria-hidden="true" title="<?php echo $title; ?>"></i></a>
                        </td>
                        <?php } if(in_array('language_add', $privilige) || in_array('language_delete', $privilige)){?>
                        <td style="text-align: center;">
                           <?php $page = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 1;?>
                          <?php } if(in_array('language_add', $privilige)){?>
                           <a href="<?php echo base_url(); ?>admin/language/<?php echo $page?>?edit=<?php echo (!empty($value['pk_id']) ? $value['pk_id'] : ''); ?>"><button type="button" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil"></i></button></a>                         
                           <?php } if(in_array('language_delete', $privilige)){?>
                           <a href="<?php echo base_url(); ?>admin/delete-language/<?php echo (!empty($value['pk_id']) ? $value['pk_id'] : ''); ?>" onClick="return confirm('Are you sure you want to delete record?')"><button type="button" class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash"></i></button></a>
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
<script type="text/javascript" src="<?php echo base_url('AdminMedia/validations/js_master/language.js'); ?>"></script>
<script>
   $(".masterLi").addClass("active");
   $(".langLi").addClass("active");
   // $("#example").DataTable();
   $('#example').wrap('<div class="resp_table"></div>');
   $(".select2").select2();
</script>
</body>
</html>