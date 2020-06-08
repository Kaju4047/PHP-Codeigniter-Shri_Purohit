<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>Sub User Details
            <div class="pull-right">
                <a href="<?php echo base_url(); ?>admin/master-listing"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</button></a>
            </div>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="col-md-12 no-pad">
            <div class="box box-primary" style="min-height: 0px;">
                <div class="box-body" >
                    <div class="col-md-6">


                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label> Name</label>
                                <h2 class="view-cnt">Name</h2>
                            </div>  <!-- End form-group -->

                            <div class="col-md-6 form-group">
                                <label>Mobile No.</label>
                                <h2 class="view-cnt">454545454</h2>
                            </div>  <!-- End form-group -->

                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>  <!-- End box-body -->
            </div>  <!-- End box -->
        </div>  <!-- End col-md-4 -->
        <div class="clearfix"></div>
    </section>  <!-- End .content -->
</div>  <!-- End .content-wrapper -->
<!-- START:: Footer -->
<?php include("application/views/admin/section/vw_footer.php"); ?>
<!-- END:: Footer -->
<script>
    $(".masterLi").addClass("active");
</script>
</body>
</html>
