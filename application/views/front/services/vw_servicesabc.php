<?php include('application/views/front/section/header.php'); ?> 
<body onbeforeunload='reset_options()'>
 <style type="text/css">
  .error {
    color: red;
    margin-bottom: 0px;
    /* padding-bottom: 2px; */
    text-align: left;
    /* text-align: right; */
    padding-top: 2px;
}

  .table > tbody > tr > td{
  border:none;
  }
   .all-inputs{color: #333 !important;}
   td{
    vertical-align: top !important;
  }
  .btnAdd, .delete-branch{
    margin-top: 30px !important; 
  }
</style>
    <div class="site-blocks-cover inner-page-cover sm-250 overlay" style="background-image: url('<?php echo base_url('shri-purohit-website/images/header/slide.jpg'); ?>');" data-aos="fade">
      <div class="container">
        <div class="row align-items-center">
                  <div class="col-md-12 align-items-center">
            <div class="form-search-wrap pad-10" data-aos="fade-up" data-aos-delay="200">
               <form method="get" action="<?php echo base_url();?>front-services" id="filterFrm" name="filterFrm">
                <div class="row">
                  <div class="col-lg-5 mb-xl-0">
                    <div class="select-wrap">
                 <!--   <span class="icon"><span class="icon-keyboard_arrow_down"></span></span> -->
                     <select class="form-control rounded all-inputs" name="cityid" id="cityid">
                        <option value="">Perform Pooja In</option>
                          <?php 
                  if (!empty($citylist)) {
                    $i=0;
                  foreach ($citylist as $val) {    
                  if (!empty($val['cityarray'])) {?>
                  <optgroup label="<?php echo ucfirst($val['state']); ?>">
                  <?php
                  foreach ($val['cityarray'] as $key=>$optcitylist) {
                  $post_cityid=!empty($post_city_id)?$post_city_id:'';


                    ?>
                    <?php if (!empty($post_cityid)) {?>
                
                  <option value="<?php echo $optcitylist['pk_id']; ?>"<?php if(!empty($optcitylist['pk_id']) && $optcitylist['pk_id']== $post_cityid){ echo "selected";} ?>><?php echo ucfirst($optcitylist['city']); ?></option>
                <?php }else{ ?>
                       <option value="<?php echo $optcitylist['pk_id']; ?>"<?php if(!empty($optcitylist['city']) && $optcitylist['city']== 'Hyderabad'){ echo "selected";} ?>><?php echo ucfirst($optcitylist['city']); ?></option>
                    <?php }?>

                    <?php }?>

                   </optgroup>
                  <?php }  }}?>
                      </select>
                      <div for="cityid" generated="true" class="error" style="color:#EC983E;" ></div>
                </div>
              </div>
              
              <div class="col-lg-4 mb-xl-0">
                <div class="select-wrap">
                <!--   <span class="icon"><span class="icon-keyboard_arrow_down"></span></span> -->
                  <select class="form-control rounded height-30 all-inputs" name="language" id="language">
                    <option value="">My Priest Preference</option>
   
                      <?php if (!empty($languagelist)) {
                          $i=0;
                        foreach ($languagelist as $key => $value) { 
                           $post_languageid=!empty($post_language_id)?$post_language_id:'';
                           // echo $post_languageid;die();
                           // print_r($value['pk_id']);die();

                           ?>
            <?php if (!empty($post_languageid)) {
             
               ?>
                    <option value="<?php echo $value['pk_id']; ?>"<?php if(!empty($value['pk_id']) && $value['pk_id']== $post_languageid){ echo "selected";} ?>><?php echo ucfirst($value['language']); ?></option>
          <?php }else{?>

                 <option value="<?php echo $value['pk_id']; ?>"<?php if(!empty($value['pk_id']) && $value['language']== 'Telugu'){ echo "selected";} ?>><?php echo ucfirst($value['language']); ?></option>
                    <?php }?>

                    <?php }}?>
            
                  </select>
                  <div for="language" generated="true" class="error" style="color:#EC983E;" ></div>
                </div>
              </div>

              
              <div class="col-lg-3 col-xl-3 ml-auto text-right">
                <input type="submit" class="btn btn-primary btn-block rounded btn-small" value="Search">
              </div>
                </div>
                </form>
              </div>
          </div>
      </div>
    </div>  
  </div>

<section class="filtrr"> 
          <div class="container">
            <div class="row">
            <div class="col-md-12">
              <nav class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              
              <ul class="navbar-nav" style="overflow-x: scroll">
                  <?php if (!empty($cat_listing)) {
                    foreach ($cat_listing as $key => $value) {
                $current_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                      $class = "";
                      if ($key == "0") {
                       $class = "active";

                      }
                      ?>
                <li class="nav-item  <?php echo $class; ?> dropdown">
                
                  
                  <a class="nav-link dropdown-toggle cat-item" href="javascript:void(0);" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="setSelectedTestPlan(this);" data-id="<?php echo !empty($value['pk_id'])?$value['pk_id']:'';?>"><?php echo !empty($value['category'])?ucfirst($value['category']):'';?> <!--<i class="fa fa-angle-down" aria-hidden="true"></i>--></a>
                  <!--<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">-->
                    <?php 
                    //if (!empty($value['pooja_list_array'])) {
                    //foreach ($value['pooja_list_array'] as $poojalist) {?>

         
                    <!-- <a class="dropdown-item" href="<?php //echo base_url();?>front-services-view/<?php //echo !empty($poojalist['pk_id'])?$poojalist['pk_id']:'';?>/description?redirect=<?php //echo base64_encode($current_link) ?>"><?php //echo !empty($poojalist['pooja_name'])?ucfirst($poojalist['pooja_name']):'';?></a> -->
              <?php //}}?>
                  <!--</div>-->
               
                </li>
               <?php }}?>
              </ul>

            </div>
          </nav>  
            </div>
          </div>   
          </div> 
        </section>

        <div class="site-section">
      <div class="container">
     
     <div class="row">

          <div class="col-lg-12 col-sm-12">
    
            <div class="row" id="products_list">
           
        
            
            </div>
          </div>          
        
        </div>
        
      </div>
    </div>


      
    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url();?>">
  <?php if(!empty($post_languageid) && !empty($post_cityid)){?>
    <input type="hidden" name="get_languageid" id="get_languageid" value="<?php echo $post_languageid;?>">
    <input type="hidden" name="get_cityid" id="get_cityid" value="<?php echo $post_cityid;?>">
     <input type="hidden" name="get_catid" id="get_catid" value="<?php echo !empty($cat_listing[0]['pk_id'])?$cat_listing[0]['pk_id']:''?>">
  <?php }else{?>
    <input type="hidden" name="get_languageid" id="get_languageid" value="<?php echo !empty($cat_listing[0]['fk_language'])? $cat_listing[0]['fk_language']:''?>">
    <input type="hidden" name="get_cityid" id="get_cityid" value="<?php echo !empty($cat_listing[0]['city_id'])?$cat_listing[0]['city_id']:''?>">
    <input type="hidden" name="get_catid" id="get_catid" value="<?php echo !empty($cat_listing[0]['pk_id'])?$cat_listing[0]['pk_id']:''?>">
  <?php }?>

<?php include('application/views/front/section/footer.php'); ?> 
 <script type="text/javascript" src="<?php echo base_url(); ?>AdminMedia/validations/front_validations/filter/js_filter.js"></script>
    <script type="text/javascript">
        $(".serviceLi").addClass("active");

    </script>

    <script type="text/javascript">
      $.sidebarMenu = function(menu) {
        var animationSpeed = 300,
          subMenuSelector = '.sidebar-submenu';

        $(menu).on('click', 'li a', function(e) {
          var $this = $(this);
          var checkElement = $this.next();

          if (checkElement.is(subMenuSelector) && checkElement.is(':visible')) {
            checkElement.slideUp(animationSpeed, function() {
              checkElement.removeClass('menu-open');
            });
            checkElement.parent("li").removeClass("active");
          }

          //If the menu is not visible
          else if ((checkElement.is(subMenuSelector)) && (!checkElement.is(':visible'))) {
            //Get the parent menu
            var parent = $this.parents('ul').first();
            //Close all open menus within the parent
            var ul = parent.find('ul:visible').slideUp(animationSpeed);
            //Remove the menu-open class from the parent
            ul.removeClass('menu-open');
            //Get the parent li
            var parent_li = $this.parent("li");

            //Open the target menu and add the menu-open class
            checkElement.slideDown(animationSpeed, function() {
              //Add the class active to the parent li
              checkElement.addClass('menu-open');
              parent.find('li.active').removeClass('active');
              parent_li.addClass('active');
            });
          }
          //if this isn't a link, prevent the page from being redirected
          if (checkElement.is(subMenuSelector)) {
            e.preventDefault();
          }
        });
      }

      $.sidebarMenu($('.sidebar-menu'))

/*Start::get lenguage by city wise through ajax*/

      // services_language();
$('#cityid').on('change', function ()
    {
      services_language();
 });

function services_language(){

        var city_id = $("#cityid").val();

// alert(city_id);
       if (city_id != '') {
        $('#language').html(''); 
      

            var base_url = $("#base_url").val();
            $.ajax({
                type: "post",
                data: {city_id: city_id},
                url: base_url + "get-language",
                dataType: 'json',
                success: function (data)
                {
                 //alert(JSON.stringify(data));
               
                    if (data != "") {
                     
                        var html='';
                        if(data!=""){
                          html +=('<option value="">Select</option>');
                        $.each( data, function( key, value ){

                          // if (key == 0) {
                          //   var selected = 'selected';
                          // }else{

                          //   var selected = '';
                          // }


                              // html +=('<option '+selected+' value ="'+value.pk_id+'">'+value.language.charAt(0).toUpperCase()+value.language.slice(1)+'</option>');
                              html +=('<option value ="'+value.pk_id+'">'+value.language.charAt(0).toUpperCase()+value.language.slice(1)+'</option>');
                      
                          });
                        }
                        $('#language').html(html); 
                     } else {
                      $('#language').html('<option value="">Select</option>'); 
                        
                    }

                }

            });
            
        } 
}
/*End::get lenguage by city wise through ajax*/


var value= $('#cityid :selected').text();
$('#hidden_city_val').val(value);

// alert(value);
    </script>
    <script>
function reset_options() {
    document.getElementById('cityid').options.length = 0;
    document.getElementById('language').options.length = 0;
    return true;
}

</script>
