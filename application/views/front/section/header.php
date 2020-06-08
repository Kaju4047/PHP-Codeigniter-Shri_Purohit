<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
   <title><?= !empty($title)?ucfirst($title):"Shri Purohit" ?></title>
    <meta name="description" content="<?php echo(!empty($description )?$description :"")?>">
    <meta name="keywords" content="<?php echo(!empty($keywords )?$keywords :"")?>">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link rel="icon" href="<?php echo base_url(); ?>AdminMedia/images/Shri-Purohit-Fevicon-PNG-icon.png" type="image/gif">

    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700,800" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>shri-purohit-website/fonts/icomoon/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>shri-purohit-website/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>shri-purohit-website/css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo base_url();?>shri-purohit-website/css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>shri-purohit-website/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>shri-purohit-website/css/fonts.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>shri-purohit-website/css/flaticon.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>shri-purohit-website/css/slick.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>shri-purohit-website/css/slick-theme.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>shri-purohit-website/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>shri-purohit-website/css/owl.theme.default.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>shri-purohit-website/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?php echo base_url();?>shri-purohit-website/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="<?php echo base_url();?>shri-purohit-website/css/aos.css">
    <link rel="stylesheet" href="<?php echo base_url();?>shri-purohit-website/css/rangeslider.css">
    <link rel="stylesheet" href="<?php echo base_url();?>shri-purohit-website/css/time-picker.css">
    <link rel="stylesheet" href="<?php echo base_url();?>shri-purohit-website/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
  </head>
  <body>
  <?php  

    $customerid=!empty($this->session->userdata('CTMRPKID'))?$this->session->userdata('CTMRPKID'):'';
  
    $condn = array('pk_id'=>$customerid,'status'=>'1');
    $ckactiveinactive = $this->Md_database->getData('customer_registration', '*', $condn);
    $customer_name=!empty($ckactiveinactive[0]['customer_name']) ? ucfirst($ckactiveinactive[0]['customer_name']) : '-'; 
  
    if(empty($ckactiveinactive) && !empty($customerid)){

       $this->session->unset_userdata('CTMRPKID');
        $this->session->unset_userdata('CTMRNAME');
        $this->session->unset_userdata('CTMREMAIL');
        $this->session->unset_userdata('CTMRPWD');
        $this->session->unset_userdata('CTMRMOBILE');
        $this->session->set_userdata('msg', '<div class="alert alert-danger ErrorsMsg">
                                                Something went wrong, please contact to admin.
                                            </div>');
    
     redirect(base_url() . 'front-customer-login');
    }


  /*Start:: get city*/
    $this->db->select('pk_id,state');
    $this->db->from('master_state');
    $this->db->where('status','1');
    $this->db->order_by('state','asc');
    $statelist=$this->db->get()->result_array();

    $finalarrayview=array();

    if(!empty($statelist)){
    foreach($statelist as $row){

        $this->db->select('city,pk_id');
        $this->db->from('master_city');
        $this->db->where('state',$row['pk_id']); 
        $this->db->where('status',1);
        $this->db->order_by('state','asc'); 
        $citydata = $this->db->get()->result_array();

        $row['cityarray'] = $citydata;
        $finalarrayview[]=$row;
        }
     }
    $citylist=$finalarrayview;
    /*End:: get city*/
    // echo "<pre>";print_r($citylist[0]['cityarray']);die();
    // if (!empty($citylist)) {
  
    //      foreach ($citylist[0]['cityarray'] as $key=>$optcitylist) {
         
            
    //            echo "<pre>";print_r($citylist[0]['cityarray']);die();
    //      }
    //    }

    $condn = array('om_pkey' => '1', 'om_status' => '1');
        $orgData = $this->Md_database->getData('static_organizationmaster', '*', $condn);
        $orgData = !empty($orgData[0]) ? $orgData[0] : '';
        $LogoLink = !empty($orgData['om_LogoImage']) ? 'AdminMedia/upload/OrgnizationLogo/' . $orgData['om_LogoImage'] : 'AdminMedia/images/default-logo.png';
        
    ?>
  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    
    <header class="site-navbar container py-0 bg-white" role="banner">

      <div class="container">
        <div class="row align-items-center">
          
          <div class="col-6 col-xl-2">
            <h1 class="mb-0 site-logo"><a href="<?php echo base_url();?>index" class="text-black mb-0"><img src="<?php echo (base_url() . $LogoLink); ?>"></a></h1>
          </div>
          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                <li class="homeLi"><a href="<?php echo base_url();?>index">Home</a></li>
                <li class="aboutLi"><a href="<?php echo base_url();?>front-about-us">About Us</a> </li>
                <!-- <li class="has-children"> -->
                  <li class="serviceLi">
                  <a href="<?php echo base_url();?>front-services">Services</a>
                 <!--  <ul class="dropdown">
                    <li><a href="#">Puja</a></li>
                    <li><a href="#">Havan</a></li>
                    <li><a href="#">Festive Puja</a></li>
                    <li><a href="#">Astrology</a></li>
                  </ul> -->
                </li>
                <!-- <li><a href="blog.html">Blog</a></li> -->
                <li class="contactLi"><a href="<?php echo base_url();?>front-contact-us">Contact Us</a></li>
             <?php if(empty($this->session->userdata('CTMREMAIL'))) {?>   
                <li class="ml-xl-3 login loginLi"><a href="<?php echo base_url();?>front-customer-login"><span class="border-left pl-xl-4"></span>Log In</a></li>
                <li class="registerLi"><a href="<?php echo base_url();?>front-customer-register">Register</a></li>
              <?php }else{?>
              <li class="ml-xl-3 login loginLi"><a href="<?php echo base_url();?>front-customer-profile"><span class="border-left pl-xl-4"></span><img src="<?php echo base_url(); ?><?php echo !empty($ckactiveinactive[0]['customer_photo']) ? 'upload/customer_profile/'.$ckactiveinactive[0]['customer_photo'] :  'shri-purohit-website/images/avatar1.png'; ?>"> <?php echo !empty($customer_name) ? $customer_name : ''; ?></a></li>
              <?php }?>
                <li><a href="<?php echo base_url();?>front-how-we-work" class="cta"><span class="bg-primary text-white rounded">How We Work</span></a></li>
              </ul>
            </nav>
          </div>


          <div class="d-inline-block d-xl-none ml-auto py-3 col-6 text-right" style="position: relative; top: 3px;">
            <a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a>
          </div>

        </div>
      </div>
      
    </header>
