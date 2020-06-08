<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content-header">
      <h1>Package List
        <?php
                $fld = 'UA_priviliges';
                $userid = $this->session->userdata['UID'];
                 
                $condition = array('UA_pkey' => $userid);
                $privilige = $this->Md_database->getData('static_useradmin', $fld, $condition, '', '');
                $privilige = !empty($privilige[0]['UA_priviliges']) ? explode(',', $privilige[0]['UA_priviliges']) : '';

              // (in_array('superAdmin', $privilige) || (in_array('CMS_add', $privilige) ) ) ? '' : redirect(base_url() . 'admin/dashboard'); //redirect if session expire
        ?>
         <?php if(in_array('pacakage_add', $privilige)){ ?>

         <div class="pull-right">
            <a href="<?php echo base_url(); ?>admin/add-package"><button type="button" class="btn btn-success"><i class="fa fa-plus-circle"></i> Create New Package</button></a>
         </div>
         <?php }?>
      </h1>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="col-md-12 no-mob-pad no-pad">
         <div class="box box-primary">
            <div class="box-body">
              <div class="row">
                  <div class="col-md-6" style="display: inline-block;float: right;margin-bottom: 10px;">
                     <form name="frmSearch" id="frmSearch" action="<?php echo base_url(); ?>admin/city" method="GET" autocomplete="off">
                        
                        <input type="text" name="search_term" id="search_term" class="form-control" value="<?php echo!empty($this->input->get('search_term')) ? $this->input->get('search_term') : ''; ?>" placeholder="Search" style="width: 87%; display: inline-block;margin-left: 43px;">
                       
                        <button type="submit" class="btn btn-primary" title="Search" onclick="javascript: form.action='<?php echo base_url('admin/package-list');?>';" style="position: absolute;top: 0;right: 0;margin-right: 15px;height: 34px;"><i class="fa fa-search"></i></button>
                     </form>
                  </div>
               </div>
               <table id="example" class="table table-bordered table-striped table-hover" width="100%">
                  <thead>
                     <tr>
                        <th width="8%" class="text-center">Sr. No.</th>
                        <th width="10%">Updated On</th>
                        <th width="22%">Puja</th>
                        <th width="19%">Category</th>
                        <th width="17%">Package</th>
                        <th width="12%">Charges (Rs.)</th>
                          <?php if(in_array('pacakage_AI', $privilige)){ ?>
                        <th width="3%">Status</th>
                         <?php }if(in_array('pacakage_add', $privilige) || in_array('pacakage_view', $privilige) || in_array('puja_add', $privilige) ){ ?>
                        <th width="9%" class="text-center">Action</th>
                         <?php }?>
                     </tr>
                  </thead>
                  <tbody>
                     <?php 
                     if (!empty($packageDetails)){
                           $page_no= !empty($this->uri->segment(3)) ? $this->uri->segment(3): 1;
                           $i = ($page_no * 10) - 9;
                           foreach ($packageDetails as $key => $value){
                     ?>
                     <tr>
                        <td class="text-center"><?php echo $i;?></td>
                        <!-- <td>1-12-2019</td>updated_date -->
                        <td><?php echo !empty($value['updated_date'])?date("d-m-Y", strtotime($value['updated_date'])):''; ?></td>
                        <td><?php echo !empty($value['pooja_name'])?ucfirst($value['pooja_name']):''; ?></td>
                        <td><?php echo !empty($value['category'])?ucfirst($value['category']):''; ?></td>
                        <td><?php echo !empty($value['package'])?ucfirst($value['package']):''; ?></td>
                        <td><?php echo !empty($value['package_charges'])?$value['package_charges']:''; ?></td>
                        <?php if(in_array('pacakage_AI', $privilige)){ ?>
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
                                <a onClick="return confirm('Are you sure you want to change status of this record ?')"  href="<?php echo base_url(); ?>admin/package-status/<?php echo (!empty($value['pk_id']) ? $value['pk_id'] : ''); ?>/<?php echo (!empty($status) ? $status : ''); ?>"> <i class="<?php echo $class; ?>" aria-hidden="true" title="<?php echo $title; ?>"></i></a>
                        </td>
                        <?php }?>
                        <?php if(in_array('pacakage_delete', $privilige) || in_array('pacakage_view', $privilige) || in_array('pacakage_add', $privilige) ){ ?>
                        <td class="text-center">
                            <?php if(in_array('pacakage_view', $privilige)){ ?>
                           <a href="<?php echo base_url(); ?>admin/view-package/<?php echo (!empty($value['pk_id']) ? $value['pk_id'] : ''); ?>"><button type="button" class="btn btn-primary btn-xs" title="View"><i class="fa fa-eye"></i></button></a>
                            <?php }if(in_array('pacakage_add', $privilige)){ ?>

                           <?php $page = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 1;?>
                           <a href="<?php echo base_url(); ?>admin/add-package/<?php echo $page?>?edit=<?php echo (!empty($value['pk_id']) ? $value['pk_id'] : ''); ?>"><button type="button" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil"></i></button></a>
                            <?php }if(in_array('pacakage_delete', $privilige)){ ?>
                     
                          <a href="<?php echo base_url(); ?>admin/delete-package/<?php echo (!empty($value['pk_id']) ? $value['pk_id'] : ''); ?>" onClick="return confirm('Are you sure you want to delete record?')"><button type="button" class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash"></i></button></a> 
                           <?php } ?>
                        </td>
                         <?php }?>
                     </tr>
                     <?php 
                     $i++; }
                     }
                     ?>
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
   $(".packageLi").addClass("active");
   // $("#example").DataTable();
</script>
</body>
</html>