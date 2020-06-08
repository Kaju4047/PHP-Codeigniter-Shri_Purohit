<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= SITE_TITLE ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 <link rel="icon" href="<?php echo base_url(); ?>AdminMedia/images/Shri-Purohit-Fevicon-PNG-icon.png" type="image/gif">
        <link rel="stylesheet" href="<?php echo base_url('AdminMedia/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('AdminMedia/css/multiple-select.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('AdminMedia/css/font-awesome.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('AdminMedia/css/ionicons.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('AdminMedia/css/AdminLTE.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('AdminMedia/css/chosen.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('AdminMedia/css/easyui.css'); ?>">
        <!--  <link rel="stylesheet" href="css/datepicker3.css"> -->
        <link rel="stylesheet" href="<?php echo base_url('AdminMedia/css/bootstrap-datepicker.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('AdminMedia/css/bootstrap-timepicker.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('AdminMedia/css/sumoselect.min.css'); ?>">

        <link rel="stylesheet" href="<?php echo base_url('AdminMedia/css/daterangepicker.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('AdminMedia/plugins/datatables/dataTables.bootstrap.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('AdminMedia/plugins/datatables/buttons.dataTables.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('AdminMedia/css/style.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('AdminMedia/css/responsive.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('AdminMedia/css/select2.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('AdminMedia/css/bootstrap-datetimepicker.css'); ?>">
       <!--  <link href="<?php echo base_url('https://cdnjs.cloudflare.com/ajax/libs/tabulator/2.11.0/tabulator.min.css'); ?>" rel="stylesheet"> -->
        <link rel="stylesheet" href="<?php echo base_url('AdminMedia/css/_all-skins.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url(); ?>AdminMedia/validations/JqueryValidation/notificationMsg.css">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <?php
        (empty($this->session->userdata['UID'])) ? redirect(base_url() . 'sessionExpire') : ''; //redirect if session expire

        /* [start::get priviliges data] */
        $condition = array('UA_pkey' => $this->session->userdata('UID'), 'UA_status' => '1');
        $user_details1 = $this->Md_database->getData('static_useradmin', '*', $condition, '', '');
        $user_details = !empty($user_details1[0]) ? $user_details1[0]['UA_priviliges'] : '';
        $privilige = ($this->session->userdata('UTYPE') == 'superAdmin') ? 'superAdmin' : $user_details;
        $privilige = !empty($privilige) ? explode(',', $privilige) : [];
        /* [end::get priviliges data] */
        /* [start::get organization data] */
        $condn = array('om_pkey' => '1', 'om_status' => '1');
        $orgData = $this->Md_database->getData('static_organizationmaster', '*', $condn);
        $orgData = !empty($orgData[0]) ? $orgData[0] : '';
        $LogoLink = !empty($orgData['om_LogoImage']) ? 'AdminMedia/upload/OrgnizationLogo/' . $orgData['om_LogoImage'] : 'AdminMedia/images/default-logo.png';


        /* [end::get organization data] */
        ?>

        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="<?php echo (base_url()); ?>" class="logo">
                    <span class="logo-mini"><img src="<?php echo base_url()?>AdminMedia/images/logo.png" class="img-responsive" style="width:  50px; padding: 10px 0px;"></span>
                    <!-- logo for regular state and mobile devices -->
                    <!--<span class="logo-lg"><?= SITE_TITLE ?></span>-->
                    <span class="logo-lg"><img src="<?php echo base_url()?>AdminMedia/images/logo.png" class="img-responsive" style="height: 53px; padding: 2px 0px;"></span>
                </a>

                <nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle anchor" data-toggle="dropdown">
                                    <?php
                                    $profileImage = 'AdminMedia/images/avatar5.png';
                                    if (in_array('superAdmin', $privilige)) {
                                        $profileImage = $LogoLink;
                                    } else if (!empty($user_details1[0]['UA_Image'])) {
                                        $profileImage = 'AdminMedia/upload/user/' . $user_details1[0]['UA_pkey'] . '/' . $user_details1[0]['UA_Image'];
                                    }
                                    ?>
                                    <img src="<?php echo (base_url() . $profileImage); ?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs">Profile</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php if (in_array('superAdmin', $privilige)) { ?>
                                        <li><a href="<?php echo base_url('admin/organisation'); ?>"><i class="fa fa-building"></i><span>Organization Master </span></a></li>
                                        <li><a href="<?php echo base_url('admin/sub-user'); ?>"><i class="fa fa-user"></i><span>Sub User</span></a></li>
                                    <?php } ?>
                                    <li><a href="<?php echo base_url('admin/setting'); ?>"><i class="fa fa-cogs"></i><span>Setting</span></a></li>

                                </ul>  <!-- End dropdown-menu -->
                            </li>  <!-- End user-menu -->
                            <li title="Logout">
                                <a href="<?php echo base_url('admin/logout'); ?>" class="anchor"><i class="fa fa-power-off"></i></a>
                            </li>
                        </ul>  <!-- End.navbar-nav -->
                    </div>
                </nav>
            </header>

