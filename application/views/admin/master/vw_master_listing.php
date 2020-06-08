<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->


<style>

    .table td{
        text-align: left;
    }
    .table th{
        text-align: center;
    }

    .table tr td.text-center { /* I don't think they are 0 based */
        text-align: center;
    }


</style>

<div class="content-wrapper">
    <section class="content-header">

        <h1>Master List

            <div class="pull-right">
                <a href="<?php echo base_url(); ?>admin/add-master"><button type="button" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add User
                    </button></a>
            </div>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="col-md-12  no-mob-pad no-pad">
            <div class="box box-primary">
                <div class="box-body">

                    <table id="" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="7%">Sr No.</th>
                                <th width="30%">Name</th>
                                <th width="22%">Email</th>
                                <th width="12%">Mobile No.</th>
                                <th width="18%">City</th>
                                <th width="2%">Status</th>
                                <th width="9%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>test</td>
                                <td>  <a href="<?php echo base_url(); ?>admin/view-master"><button type="button" class="btn btn-primary btn-xs" title="View"><i class="fa fa-eye"></i></button></a>
                                </td>

                            </tr>

                        </tbody>
                    </table>
                    <nav aria-label="..." class="pagn-left">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>

                </div>  <!-- End box-body -->
            </div>  <!-- End box -->
        </div>  <!-- End col-md-8 -->
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
