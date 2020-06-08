<?php include('application/views/front/section/header.php'); ?>
    <div class="site-blocks-cover sm-height inner-page-cover overlay" style="background-image: url(<?php echo base_url('shri-purohit-website/images/horoscope-blog-banner.jpg'); ?>);" data-aos="fade">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-12">
             <div class="d-flex">
              <div class="content-box">
                <div class="title-box ml-0">
                  <h3><b>About Us</b></h3>
                  <ul class="flex text-white">
                    <li class="font-15"><a href="<?php echo base_url();?>index">Home /</a> </li>
                    <li class="font-15">About Us</li>
                  </ul>
                </div>
              </div>
             </div>
          </div>
        </div>
    </div>  
  </div>

    

    
    <div class="site-section">
      <div class="container">
        <div class="row align-items-center">
        <div class="col-md-5">
            <img style="margin-bottom: 170px;" src="<?php echo base_url();?>shri-purohit-website/images/pandit.png" alt="Image" class="img-fluid rounded">
          </div> 
          <div class="col-md-7 ml-auto">
             <?php echo !empty($aboutus[0]['cms_text'])? $aboutus[0]['cms_text']:'';?>
           
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="site-section bg-light"  data-aos="fade">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-4 text-left border-primary">
            <h2 class="font-weight-light text-primary pb-3">Our Services</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">      
            <div class="text-center bg-white service-box">
                <img src="images/havanam.png" alt="Image" class="img-fluid mb-3 service-icon">
                <h3 class="h4">Havanam</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum facilis, sint libero commodi tenetur ducimus accusantium inventore.</p>
            </div>
          </div>
           <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">      
            <div class="text-center bg-white service-box">
            <img src="images/abhishekam.png" alt="Image" class="img-fluid mb-3 service-icon">
            <h3 class="h4">Abhishekam</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam voluptas autem qui alias officia eligendi, nam in.</p>
          </div>
        </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">      
            <div class="text-center bg-white service-box">
            <img src="images/swastik.png" alt="Image" class="img-fluid mb-3 service-icon">
            <h3 class="h4">Swastik</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore animi quam, est vero. Omnis sunt, totam qui!</p>
          </div>
        </div>
        </div>

      </div>
    </div> -->
 <?php include('application/views/front/section/footer.php'); ?>
    <script type="text/javascript">
        $(".aboutLi").addClass("active");
    </script>
  </body>
</html>