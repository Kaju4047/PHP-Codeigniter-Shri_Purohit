 <?php include('application/views/front/section/header.php'); ?>  
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(shri-purohit-website/images/horoscope-blog-banner.jpg);" data-aos="fade">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-12">
             <div class="d-flex">
              <div class="content-box">
                <div class="title-box ml-0">
                  <h3><b>Frequently Asked Questions</b></h3>
                  <ul class="flex text-white">
                    <li><a href="<?php echo base_url();?>index">Home /</a> </li>
                    <li>FAQ</li>
                  </ul>
                </div>
              </div>
             </div>
          </div>
        </div>
    </div>  
  </div>
    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-justify">
               <?php echo !empty($faq[0]['cms_text'])? $faq[0]['cms_text']:'';?>
            </div>
          </div>
        </div>
      </div>
    </div>

   <?php include('application/views/front/section/footer.php'); ?>  
    <script type="text/javascript">
        $(".contactLi").addClass("active");
    </script>
  </body>
</html>