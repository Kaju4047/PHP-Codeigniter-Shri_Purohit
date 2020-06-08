<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>



<!-- END:: Header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>Purohit Registration</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="col-md-12  no-mob-pad no-pad">
            <div class="box box-primary">
                <div class="box-body">

                    <table id="eaxample" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="6%">Sr. No.</th>
                                <th width="15%">Name</th>
                                <th width="10%">City</th>
                                <th width="10%">Mobile No.</th>
                                <th width="10%">Qualifications</th>
                                <th width="15%">Experiance (Years)</th>
                                <th width="25%">Languages Known</th>
                                <th width="2%">Status</th>
                                <th width="8%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>Radhika Jagtap</td>
                                <td>Pune</td>
                                <td>7020351472</td>
                                <td>MCA</td>
                                <td>1.6</td>
                                <td>English, Hindi, Marathi, Kannad, Gujarati, Tamil</td>
                                <td class="text-center"><i class="fa fa-toggle-on tgle-on " aria-hidden="true" title="Active"></i></td>
                                <td class="text-center">  <a href="<?php echo base_url(); ?>admin/view-registered"><button type="button" class="btn btn-primary btn-xs" title="View"><i class="fa fa-eye"></i></button></a>
                                	<a href="#"><button type="button" class="btn btn-danger btn-xs" title="View"><i class="fa fa-trash"></i></button></a>
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center">2</td>
                                <td>Ashwini Patil</td>
                                <td>Pune</td>
                                <td>9700351472</td>
                                <td>B.Tec</td>
                                <td>10.6</td>
                                <td>English, Hindi, Marathi.</td>
                                <td class="text-center"><i class="fa fa-toggle-on tgle-on " aria-hidden="true" title="Active"></i></td>
                                <td class="text-center">  <a href="<?php echo base_url(); ?>admin/view-registered"><button type="button" class="btn btn-primary btn-xs" title="View"><i class="fa fa-eye"></i></button></a>
                                	<a href="#"><button type="button" class="btn btn-danger btn-xs" title="View"><i class="fa fa-trash"></i></button></a>
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center">3</td>
                                <td>Manish Bhumar</td>
                                <td>Mumbai</td>
                                <td>1234551472</td>
                                <td>Ph.D</td>
                                <td>11.6</td>
                                <td>English, Hindi, Tamil</td>
                                <td class="text-center"><i class="fa fa-toggle-on tgle-on " aria-hidden="true" title="Active"></i></td>
                                <td class="text-center">  <a href="<?php echo base_url(); ?>admin/view-registered"><button type="button" class="btn btn-primary btn-xs" title="View"><i class="fa fa-eye"></i></button></a>
                                	<a href="#"><button type="button" class="btn btn-danger btn-xs" title="View"><i class="fa fa-trash"></i></button></a>
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center">4</td>
                                <td>Shekhar Dhumal</td>
                                <td>Chennai</td>
                                <td>7020345611</td>
                                <td>ME</td>
                                <td>10</td>
                                <td>English, Hindi, Kannad, Gujarati</td>
                                <td class="text-center"><i class="fa fa-toggle-on tgle-on " aria-hidden="true" title="Active"></i></td>
                                <td class="text-center">  <a href="<?php echo base_url(); ?>admin/view-registered"><button type="button" class="btn btn-primary btn-xs" title="View"><i class="fa fa-eye"></i></button></a>
                                	<a href="#"><button type="button" class="btn btn-danger btn-xs" title="View"><i class="fa fa-trash"></i></button></a>
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
    </section>  <!-- End .content -->v>
    </section>  <!-- End .content -->
</div>  <!-- End .content-wrapper -->
<!-- START:: Footer -->
<?php include("application/views/admin/section/vw_footer.php"); ?>
<!-- END:: Footer -->
<script type="text/javascript">
    $(".addpurohitLi").addClass("active");
    $("#example").DataTable(); 
</script>
</body>
</html>
