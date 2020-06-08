<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <section class="content-header">
      <h1>Registered Purohit List
         <?php
                $fld = 'UA_priviliges';
                $userid = $this->session->userdata['UID'];
                 
                $condition = array('UA_pkey' => $userid);
                $privilige = $this->Md_database->getData('static_useradmin', $fld, $condition, '', '');
                $privilige = !empty($privilige[0]['UA_priviliges']) ? explode(',', $privilige[0]['UA_priviliges']) : '';

              // (in_array('superAdmin', $privilige) || (in_array('CMS_add', $privilige) ) ) ? '' : redirect(base_url() . 'admin/dashboard'); //redirect if session expire
        ?>
         <?php if(in_array('registered_purohit_add', $privilige)){ ?>
         <div class="pull-right">
            <a href="<?php echo base_url(); ?>admin/add-registered-purohit"><button type="button" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add New Purohit</button></a>
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
                     <form name="frmSearch" id="frmSearch" action="<?php echo base_url(); ?>admin/registered-purohit-list" method="GET" autocomplete="off">
                        
                        <input type="text" name="search_term" id="search_term" class="form-control" value="<?php echo!empty($this->input->get('search_term')) ? $this->input->get('search_term') : ''; ?>" placeholder="Search" style="width: 87%; display: inline-block;margin-left: 43px;">
                       
                        <button type="submit" class="btn btn-primary" title="Search" onclick="javascript: form.action='<?php echo base_url('admin/registered-purohit-list');?>';" style="position: absolute;top: 0;right: 0;margin-right: 15px;height: 34px;"><i class="fa fa-search"></i></button>
                     </form>
                  </div>
               </div>
               <table id="example" class="table table-bordered table-striped table-hover" width="100%">
                  <thead>
                     <tr>
                        <th width="8%" class="text-center">Sr. No.</th>
                        <th width="12%">Registered On</th>
                        <th width="15%">Purohit Name</th>
                        <th width="10%">Mobile No.</th>
                        <th width="16%">Email Id</th>
                        <th width="15%">Address</th>
                        <th width="10%">Rating</th>
                        <?php if(in_array('registered_purohit_AI', $privilige)){ ?>
                        <th width="2%">Status</th>
                         <?php }if(in_array('registered_purohit_add', $privilige) || in_array('registered_purohit_view', $privilige) || in_array('registered_purohit_delete', $privilige) ){ ?>
                        <th width="9%" class="text-center">Action</th>
                         <?php }?>
                     </tr>
                  </thead>
                  <tbody>
                       <?php if (!empty($registeredPurohit)) {
                        // echo "<pre>";
                        // print_r($registeredPurohit);
                           $page_no= !empty($this->uri->segment(3)) ? $this->uri->segment(3): 1;
                           $i = ($page_no * 10) - 9;
                           foreach ($registeredPurohit as $key => $value) {
                     ?>
                     <tr>
                        <td class="text-center"><?php echo $i;?></td>
                        <td><?php echo !empty($value['created_date'])?date("d-m-Y", strtotime($value['created_date'])):''; ?></td>
                        <td><?php echo !empty($value['first_name'])?$value['first_name']:''; ?><?php echo !empty($value['middle_name'])?' '.$value['middle_name']:''; ?><?php echo !empty($value['last_name'])?' '.$value['last_name']:''; ?></td>
                        <td><?php echo !empty($value['mobile_no'])?$value['mobile_no']:''; ?></td>
                        <td><?php echo !empty($value['email_id'])?$value['email_id']:''; ?></td>
                        <td><?php echo !empty($value['address'])?$value['address']:''; ?></td>
                        <td>
                          <!--  <ul class="star-ev">
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                           </ul> -->
                           <ul class="d-flex rating-sec" >
                        <ul>
                          <?php if (!empty($value['rating'])) {
                            ?>                            
                          <?php if(!empty($value['rating']) && $value['rating'] >="1" && $value['rating'] <"2"){  ?> 
                           <li><i class="fa fa-star filled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                           <?php if(!empty($value['rating']) && $value['rating'] >"1" && $value['rating']< "2"){  ?> 
                             <li><i class="fa fa-star filled"></i></li>
                             <li><i style="color:#ff9900 !important" class="fa fa-star-half-full"></i></li>                       
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                           <?php if(!empty($value['rating']) && $value['rating']=="2"){  ?> 
                             <li><i class="fa fa-star filled"></i></li>
                             <li><i class="fa fa-star filled"></i></li>         
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                           <?php if(!empty($value['rating']) && $value['rating']>"2" && $value['rating']<"3"){  ?> 
                             <li><i class="fa fa-star filled"></i></li>
                             <li><i class="fa fa-star filled"></i></li>         
                           <li><i style="color:#ff9900 !important" class="fa fa-star-half-full"></i></li> 
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                           <?php if(!empty($value['rating']) && $value['rating']=="3"){  ?>
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>         
                              <li><i class="fa fa-star filled"></i></li> 
                              <li><i class="fa fa-star unfilled"></i></li>
                              <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                          <?php if(!empty($value['rating']) && $value['rating']>"3" && $value['rating']<"4"){ ?> 
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>         
                              <li><i style="color:#ff9900 !important" class="fa fa-star-half-full"></i></li> 
                            <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                           <?php if(!empty($value['rating']) && $value['rating']=="4"){ ?> 
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>         
                              <li><i class="fa fa-star filled"></i></li>
                            <li><i class="fa fa-star unfilled"></i></li>
                           <?php }?>
                           <?php if(!empty($value['rating']) && $value['rating']>"4"){ ?> 
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>         
                              <li><i class="fa fa-star filled"></i></li>
                            <li><i style="color:#ff9900 !important" class="fa fa-star-half-full"></i></li> 
                           <?php }?>
                           <?php if(!empty($value['rating']) && $value['rating']=="5" || $value['rating'] >"5"){ ?> 
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>
                              <li><i class="fa fa-star filled"></i></li>         
                              <li><i class="fa fa-star filled"></i></li>
                           <li><i class="fa fa-star filled"></i></li>
                           <?php }?>
                         <?php }else{?>
                                <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                           <li><i class="fa fa-star unfilled"></i></li>
                         <?php }?>

                         </ul>
                  </ul>
                        </td>
                        <?php if(in_array('registered_purohit_AI', $privilige)){ ?>
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
                                <a onClick="return confirm('Are you sure you want to change status of this record ?')"  href="<?php echo base_url(); ?>admin/registered-purohit-status-change/<?php echo (!empty($value['pk_id']) ? $value['pk_id'] : ''); ?>/<?php echo (!empty($status) ? $status : ''); ?>"> <i class="<?php echo $class; ?>" aria-hidden="true" title="<?php echo $title; ?>"></i></a>
                        </td>
                        <?php }?>
                        <?php if(in_array('registered_purohit_delete', $privilige) || in_array('registered_purohit_view', $privilige) || in_array('registered_purohit_add', $privilige) ){ ?>
                        <td class="text-center">
                          <?php if(in_array('registered_purohit_view', $privilige)){ ?>
                          <a href="<?php echo base_url(); ?>admin/view-registered-purohit/<?php echo (!empty($value['pk_id']) ? $value['pk_id'] : ''); ?>?rate=<?php echo (!empty($value['rating']) ? $value['rating'] : ''); ?>" ><button type="button" class="btn btn-primary btn-xs" title="View"><i class="fa fa-eye"></i></button></a>
                           <?php }if(in_array('registered_purohit_add', $privilige)){ ?>
      
                        <?php $page = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 1;?>
                          <a href="<?php echo base_url(); ?>admin/add-registered-purohit/<?php echo !empty($page)? $page:'1'; ?>/<?php echo (!empty($value['pk_id']) ? $value['pk_id'] : ''); ?>"><button type="button" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil"></i></button></a> 
                            <?php }if(in_array('registered_purohit_delete', $privilige)){ ?>
                          <!--  <a href="<?php echo base_url(); ?>admin/delete-registered-purohit/<?php echo (!empty($value['pk_id']) ? $value['pk_id'] : ''); ?>" onClick="return confirm('Are you sure you want to delete record?')"><button type="button" class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash"></i></button></a>  -->
                             <?php } ?>
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
<script type="text/javascript" src="<?php echo base_url('AdminMedia/validations/js_registered_purohit/registered_purohit.js'); ?>"></script>
<script>
   $(".regpurohitLi").addClass("active");
   // $("#example").DataTable();
</script>
</body>
</html>