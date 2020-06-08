<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->


<!-- END:: Header -->
<style type="text/css">




    input[type=file] {
        padding: 2px;
        display: block;
    }

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>Add Master
            <div class="pull-right">
                <a href="<?php echo base_url(); ?>admin/master-listing">  <button class="btn btn-danger btn-size"><i class="fa fa-arrow-circle-left"></i> Back</button></a>
            </div>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="col-md-12 no-pad">
            <div class="box box-primary">
                <form class="" role="form" method="post" id="Frmuser" name="Frmuser" action="" enctype="multipart/form-data">


                    <div class="box-body">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label>Name<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="txtName" name="txtName" >
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Mobile No.<span style="color: red;">*</span></label>
                                    <input type="text" id="txtMobile" name="txtMobile" class="form-control isInteger"value="">
                                </div>
                            </div>



                            <div class="col-md-12 button-box" style="padding-top: 15px;">
                                <button type="submit" class="btn btn-success btn submit"><i class="fa fa-check-circle"></i> Submit</button>
                                <a href="<?php echo base_url() . $this->uri->uri_string(); ?>"><button type="button" name="button" id="button" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancel</button></a>
                            </div>
                        </div>


                    </div>
                </form>
            </div>
        </div>  <!-- End col-md-12 -->
        <div class="clearfix"></div>
    </section>  <!-- End .content -->

</div>  <!-- End .content-wrapper --> <!-- End .content-wrapper -->

<!-- START:: Footer -->
<?php include("application/views/admin/section/vw_footer.php"); ?>
<!-- END:: Footer -->
<script>
    $(".masterLi").addClass("active");
</script>
</body>
</html>