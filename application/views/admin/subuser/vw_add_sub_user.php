<!-- START:: Header -->
<?php include("application/views/admin/section/vw_header.php"); ?>
<!-- END:: Header -->
<!-- START:: Header -->
<?php include("application/views/admin/section/vw_sidebar.php"); ?>
<!-- END:: Header -->

<?php
(in_array('superAdmin', $privilige) ) ? '' : redirect(base_url() . 'admin/dashboard'); //redirect if session expire
?>
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
        <h1><?php if (empty($editData['UA_pkey'])) { ?>Add Sub User<?php } else { ?>Edit Sub User<?php } ?>
            <div class="pull-right">
                <a href="<?php echo base_url(); ?>admin/sub-user">  <button class="btn btn-danger btn-size"><i class="fa fa-arrow-circle-left"></i> Back</button></a>
            </div>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="col-md-12 no-pad">
            <div class="box box-primary">
                <form class="" role="form" method="post" id="Frmuser" name="Frmuser" action="<?php echo base_url(); ?>admin/add-sub-user-action" enctype="multipart/form-data">

                    <input type="hidden" id="txtPkey" name="txtPkey" value="<?php echo!empty($editData['UA_pkey']) ? $editData['UA_pkey'] : ""; ?>">

                    <div class="box-body">
                        <div class="col-sm-12 no-pad">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label>Name<span style="color: red;">*</span></label>
                                        <input type="text" class="form-control isAlpha" id="txtName" name="txtName" value="<?php echo!empty($editData['UA_Name']) ? $editData['UA_Name'] : ""; ?>">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Mobile No.<span style="color: red;">*</span></label>
                                        <input type="text" id="txtMobile" name="txtMobile" class="form-control isInteger" minlength="10" maxlength="10" value="<?php echo!empty($editData['UA_mobile']) ? $editData['UA_mobile'] : ""; ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label>Address<span style="color: red;">*</span></label>

                                        <textarea class="form-control" id="txtAddress" name="txtAddress" rows="3" style="resize: none;"><?php echo!empty($editData['UA_Address']) ? $editData['UA_Address'] : ""; ?></textarea>

                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>City<span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" id="txtCity" name="txtCity" value="<?php echo!empty($editData['UA_City']) ? $editData['UA_City'] : ""; ?>">
                                    </div>
                                </div>

                                <!--  <div class="col-sm-4 form-group">
                                   <label>Email Id</label>
                                       <input type="text" class="form-control">
                                 </div> -->
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label>Email<span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" id="txtEmail" name="txtEmail" value="<?php echo!empty($editData['UA_email']) ? $editData['UA_email'] : ""; ?>" <?php echo!empty($editData['UA_email']) ? 'readonly' : ""; ?>>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Password<span style="color: red;">*</span></label>
                                        <?php
                                        if (!empty($editData['UA_password'])) {
                                            $UA_password = "";
                                            $UA_password = base64_decode($editData['UA_password']);
                                        }
                                        ?>
                                        <input type="text" class="form-control" id="txtPassword" name="txtPassword" value="<?php echo!empty($UA_password) ? $UA_password : ""; ?>" >
                                    </div>

                                </div>


                            </div>

                            <div class="col-md-3">

                                <?php $LogoLink = (!empty($editData['UA_Image']) && !empty($editData['UA_pkey'])) ? 'AdminMedia/upload/user/' . $editData['UA_pkey'] . '/' . $editData['UA_Image'] : 'AdminMedia/images/default.png'; ?>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="lab-photo">Profile Photo</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <img src=" <?php echo!empty($LogoLink) ? base_url() . $LogoLink : ""; ?>" class="prof-photo" width="150">
                                </div>

                                <input name="fileCmpLogo" class="form-control" id="my-prf" type="file" >


                            </div>

                        </div>


                        <div class="col-md-9 no-pad m-t-10">
                            <div class="col-md-12">
                                <label>Privileges<span style="color: red;">*</span></label>


                                <table id="" class="table color-table info-table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="10%" class="text-center">Sr. No.</th>
                                            <th width="50%">Pages</th>
                                            <th width="10%" class="text-center">Add/Update</th>
                                            <th width="10%" class="text-center">View</th>
                                            <th width="10%" class="text-center">Active/Inactive</th>
                                            <th width="10%" class="text-center">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>Dashboard</td>
                                            <td class="text-center"></td>
                                            <td class="text-center"><input value="dashboard_view" id="dashboard_view" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>Master State</td>
                                            <td class="text-center"><input value="state_add" id="state_add" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"><input value="state_AI" id="state_AI" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"><input value="state_delete" id="state_delete" name="priviliges[]"  type="checkbox"></td>
                                   
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>Master City</td>
                                            <td class="text-center"><input value="city_add" id="city_add" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"><input value="city_AI" id="city_AI" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"><input value="city_delete" id="city_delete" name="priviliges[]"  type="checkbox"></td>
                                   
                                        </tr>
                                        <tr>
                                            <td class="text-center">4</td>
                                            <td>Master Language</td>
                                            <td class="text-center"><input value="language_add" id="language_add" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"><input value="language_AI" id="language_AI" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"><input value="language_delete" id="language_delete" name="priviliges[]"  type="checkbox"></td>
                                   
                                        </tr>
                                        <tr>
                                            <td class="text-center">5</td>
                                            <td>Master City wise Language</td>
                                            <td class="text-center"><input value="citywiselang_add" id="citywiselang_add" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"><input value="citywiselang_AI" id="citywiselang_AI" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"><input value="citywiselang_delete" id="citywiselang_delete" name="priviliges[]"  type="checkbox"></td>
                                   
                                        </tr>
                                        <tr>
                                            <td class="text-center">6</td>
                                            <td>Master Category</td>
                                            <td class="text-center"><input value="category_add" id="category_add" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"><input value="category_AI" id="category_AI" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"><input value="category_delete" id="category_delete" name="priviliges[]"  type="checkbox"></td>                                   
                                        </tr>
                                        <tr>
                                            <td class="text-center">7</td>
                                            <td>Master Cnacellation Charges</td>
                                            <td class="text-center"><input value="cancellation_charges_add" id="cancellation_charges_add" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"><input value="cancellation_charges_AI" id="cancellation_charges_AI" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"></td>                                  
                                        </tr>
                                        <tr>
                                            <td class="text-center">8</td>
                                            <td>Master Tax</td>
                                            <td class="text-center"><input value="tax_add" id="tax_add" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"><input value="tax_AI" id="tax_AI" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"></td>
                                   
                                        </tr>
                                        <tr>
                                            <td class="text-center">9</td>
                                            <td>Master Additional Services</td>
                                            <td class="text-center"><input value="additional_service_add" id="additional_service_add" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"><input value="additional_service_AI" id="additional_service_AI" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"><input value="additional_service_delete" id="additional_service_delete" name="priviliges[]"  type="checkbox"></td>
                                   
                                        </tr>
                                        <tr>
                                            <td class="text-center">10</td>
                                            <td>Master Cancellation % For Purohit</td>
                                            <td class="text-center"><input value="cancellation_per_purohit_add" id="cancellation_per_purohit_add" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"><input value="cancellation_per_purohit_AI" id="cancellation_per_purohit_AI" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"><input value="cancellation_per_purohit_delete" id="cancellation_per_purohit_delete" name="priviliges[]"  type="checkbox"></td>
                                   
                                        </tr>
                                        <tr>
                                            <td class="text-center">11</td>
                                            <td>Master Fine For Purohit</td>
                                            <td class="text-center"><input value="fine_for_purohit_add" id="fine_for_purohit_add" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"><input value="fine_for_purohit_AI" id="fine_for_purohit_AI" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"><input value="fine_for_purohit_delete" id="fine_for_purohit_delete" name="priviliges[]"  type="checkbox"></td>
                                   
                                        </tr> 
                                        <tr>
                                            <td class="text-center">12</td>
                                            <td>CMS</td>
                                            <td class="text-center"><input value="CMS_add" id="CMS_add" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">13</td>
                                            <td>Puja</td>
                                            <td class="text-center"><input value="puja_add" id="puja_add" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"><input value="puja_view" id="puja_view" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"><input value="puja_AI" id="puja_AI" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"><input value="puja_delete" id="puja_delete" name="priviliges[]"  type="checkbox"></td>
                                        </tr> 
                                        <tr>
                                            <td class="text-center">14</td>
                                            <td>Pacakage</td>
                                            <td class="text-center"><input value="pacakage_add" id="pacakage_add" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"><input value="pacakage_view" id="pacakage_view" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"><input value="pacakage_AI" id="pacakage_AI" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"><input value="pacakage_delete" id="pacakage_delete" name="priviliges[]"  type="checkbox"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">15</td>
                                            <td>Registered Purohit</td>
                                            <td class="text-center"><input value="registered_purohit_add" id="registered_purohit_add" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"><input value="registered_purohit_view" id="registered_purohit_view" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"><input value="registered_purohit_AI" id="registered_purohit_AI" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"><input value="registered_purohit_delete" id="registered_purohit_delete" name="priviliges[]"  type="checkbox"></td>
                                        </tr> 
                                        <tr>
                                            <td class="text-center">16</td>
                                            <td>Customers</td>
                                            <td class="text-center"></td>
                                            <td class="text-center"><input value="customers_view" id="customers_view" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"><input value="customers_AI" id="customers_AI" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"><input value="customers_delete" id="customers_delete" name="priviliges[]"  type="checkbox"></td>
                                        </tr> 
                                        <tr>
                                            <td class="text-center">17</td>
                                            <td>Pooja Booking</td>
                                            <td class="text-center"></td>
                                            <td class="text-center"><input value="pooja_booking_view" id="ppoja_booking_view" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"><input value="pooja_booking_delete" id="pooja_booking_delete" name="priviliges[]"  type="checkbox"></td>
                                        </tr>  
                                         
                                       <!--  <tr>
                                            <td class="text-center">2</td>
                                            <td>Payment History</td>
                                            <td class="text-center"><input value="payment_history_add" id="payment_history_add" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"><input value="payment_history_view" id="payment_history_view" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"><input value="payment_history_AI" id="payment_history_AI" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"><input value="payment_history_delete" id="payment_history_delete" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                        </tr> -->

                                        <tr>
                                            <td class="text-center">18</td>
                                            <td>Enquiry/Support Requests </td>
                                            <td class="text-center"></td>
                                            <td class="text-center"><input value="enquiry_view" id="enquiry_view" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"><input value="enquiry_delete" id="enquiry_delete" name="priviliges[]"  type="checkbox"></td>
                                        </tr>  
                                        <tr>
                                            <td class="text-center">19</td>
                                            <td>Purohit Transaction History </td>
                                            <td class="text-center"><input value="purohit_transaction_add" id="purohit_transaction_add" name="priviliges[]"  type="checkbox"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                        </tr>  
                                    </tbody>
                                </table>
                                <div for="priviliges[]" generated="true" class="mandSpan"></div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success btn submit"><i class="fa fa-check-circle"></i> Submit</button>
                            <a href="<?php echo base_url() . $this->uri->uri_string(); ?>"><button type="button" name="button" id="button" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancel</button></a>
                        </div>

                </form>

            </div>
        </div>
</div>  <!-- End col-md-12 -->
<div class="clearfix"></div>
</section>  <!-- End .content -->

</div>  <!-- End .content-wrapper --> <!-- End .content-wrapper -->

<!-- START:: Footer -->
<?php include("application/views/admin/section/vw_footer.php"); ?>
<!-- END:: Footer -->
<script type="text/javascript">
    $.validator.addMethod("alphabetsnspace", function (value, element) {
        return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
    });
</script>
<script type="text/javascript">
    $.validator.addMethod("alphabetsnspace2", function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test(value);
    });
</script>
<script type="text/javascript">
    /*[start::code to set priviliges checked at time of update user]*/
    $(document).ready(function () {
        setSelectedPriviliges();
    });

    function setSelectedPriviliges() {
        var priviliges = '<?php echo!empty($editData['UA_priviliges']) ? $editData['UA_priviliges'] : ''; ?>';

        if (priviliges != "") {
            var privliges_array = priviliges.split(",");
            var length = privliges_array.length;
            for (var n = 0; n < length; n++) {
                $("#" + privliges_array[n]).prop("checked", true);
            }
        }
    }
    /*[end::code to set priviliges checked at time of update user]*/

    /*[start::code to set profile image when it change on time]*/
    $("#my-prf").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });
    function imageIsLoaded(e) {
        $('.prof-photo').attr("src", e.target.result);
    }
    /*[start::code to set profile image when it change on time]*/
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>AdminMedia/validations/js_userAdminstration/js_userAdminstration.js"></script>

</body>
</html>