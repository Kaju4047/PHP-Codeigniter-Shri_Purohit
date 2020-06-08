<?php include('application/views/front/section/header.php'); ?>
<style>
    .mb-10{
        margin-bottom:100px;
    }
</style>

    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url('<?php echo base_url('shri-purohit-website/images/horoscope-blog-banner.jpg'); ?>');" data-aos="fade">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="d-flex">
                        <div class="content-box">
                            <div class="title-box ml-0">
                                <h3><b><?php echo !empty($pooja_view_data[0]['pooja_name'])? ucwords($pooja_view_data[0]['pooja_name']):'';?></b></h3>
                                <ul class="d-flex-only rating-sec">
                                    <ul>
                                        <?php if (!empty($pooja_total_rating)) {?>

                                            <?php if(!empty($pooja_total_rating) && $pooja_total_rating >="1" && $pooja_total_rating <"2"){  ?>
                                                <li><i class="fa fa-star filled"></i></li>
                                                <li><i class="fa fa-star unfilled"></i></li>
                                                <li><i class="fa fa-star unfilled"></i></li>
                                                <li><i class="fa fa-star unfilled"></i></li>
                                                <li><i class="fa fa-star unfilled"></i></li>
                                                <?php }?>
                                                    <?php if(!empty($pooja_total_rating) && $pooja_total_rating >"1" && $pooja_total_rating< "2"){  ?>
                                                        <li><i class="fa fa-star filled"></i></li>
                                                        <li><i style="color:#ff9900 !important" class="fa fa-star-half-full"></i></li>
                                                        <li><i class="fa fa-star unfilled"></i></li>
                                                        <li><i class="fa fa-star unfilled"></i></li>
                                                        <li><i class="fa fa-star unfilled"></i></li>
                                                        <?php }?>
                                                            <?php if(!empty($pooja_total_rating) && $pooja_total_rating=="2"){  ?>
                                                                <li><i class="fa fa-star filled"></i></li>
                                                                <li><i class="fa fa-star filled"></i></li>
                                                                <li><i class="fa fa-star unfilled"></i></li>
                                                                <li><i class="fa fa-star unfilled"></i></li>
                                                                <li><i class="fa fa-star unfilled"></i></li>
                                                                <?php }?>
                                                                    <?php if(!empty($pooja_total_rating) && $pooja_total_rating>"2" && $pooja_total_rating<"3"){  ?>
                                                                        <li><i class="fa fa-star filled"></i></li>
                                                                        <li><i class="fa fa-star filled"></i></li>
                                                                        <li><i style="color:#ff9900 !important" class="fa fa-star-half-full"></i></li>
                                                                        <li><i class="fa fa-star unfilled"></i></li>
                                                                        <li><i class="fa fa-star unfilled"></i></li>
                                                                        <?php }?>
                                                                            <?php if(!empty($pooja_total_rating) && $pooja_total_rating=="3"){  ?>
                                                                                <li><i class="fa fa-star filled"></i></li>
                                                                                <li><i class="fa fa-star filled"></i></li>
                                                                                <li><i class="fa fa-star filled"></i></li>
                                                                                <li><i class="fa fa-star unfilled"></i></li>
                                                                                <li><i class="fa fa-star unfilled"></i></li>
                                                                                <?php }?>
                                                                                    <?php if(!empty($pooja_total_rating) && $pooja_total_rating>"3" && $pooja_total_rating<"4"){ ?>
                                                                                        <li><i class="fa fa-star filled"></i></li>
                                                                                        <li><i class="fa fa-star filled"></i></li>
                                                                                        <li><i class="fa fa-star filled"></i></li>
                                                                                        <li><i style="color:#ff9900 !important" class="fa fa-star-half-full"></i></li>
                                                                                        <li><i class="fa fa-star unfilled"></i></li>
                                                                                        <?php }?>
                                                                                            <?php if(!empty($pooja_total_rating) && $pooja_total_rating=="4"){ ?>
                                                                                                <li><i class="fa fa-star filled"></i></li>
                                                                                                <li><i class="fa fa-star filled"></i></li>
                                                                                                <li><i class="fa fa-star filled"></i></li>
                                                                                                <li><i class="fa fa-star filled"></i></li>
                                                                                                <li><i class="fa fa-star unfilled"></i></li>
                                                                                                <?php }?>
                                                                                                    <?php if(!empty($pooja_total_rating) && $pooja_total_rating>"4" && $pooja_total_rating<"5"){ ?>
                                                                                                        <li><i class="fa fa-star filled"></i></li>
                                                                                                        <li><i class="fa fa-star filled"></i></li>
                                                                                                        <li><i class="fa fa-star filled"></i></li>
                                                                                                        <li><i class="fa fa-star filled"></i></li>
                                                                                                        <li><i style="color:#ff9900 !important" class="fa fa-star-half-full"></i></li>
                                                                                                        <?php }?>
                                                                                                            <?php if(!empty($pooja_total_rating) && $pooja_total_rating=="5" || $pooja_total_rating >"5"){ ?>
                                                                                                                <li><i class="fa fa-star filled"></i></li>
                                                                                                                <li><i class="fa fa-star filled"></i></li>
                                                                                                                <li><i class="fa fa-star filled"></i></li>
                                                                                                                <li><i class="fa fa-star filled"></i></li>
                                                                                                                <li><i class="fa fa-star filled"></i></li>
                                                                                                                <?php }?>
                                                                                                                    <?php }else{?>
                                                                                                                        <li><i class="fa fa-star unfilled"></i></li>
                                                                                                                        <li><i class="fa fa-star unfilled"></i></li>
                                                                                                                        <li><i class="fa fa-star unfilled"></i></li>
                                                                                                                        <li><i class="fa fa-star unfilled"></i></li>
                                                                                                                        <li><i class="fa fa-star unfilled"></i></li>
                                                                                                                        <?php }?>

                                    </ul>

                                    <li>
                                        <p>
                                            <?=  substr($pooja_total_rating,0,1); ?>
                                                <?=  substr($pooja_total_rating,1,2); ?> (
                                                    <?php echo !empty($totalcount)? $totalcount:'0';?> Reviews )</p>
                                    </li>
                                    <li>
                                        <p></p>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="button-box">

                            <!--<a href=""  class="">-->
                            
                            <?php //if(current_url() == $_SERVER['HTTP_REFERER']) {  ?>
                                <!--<button onclick="window.history.go(-2);" class="btn btn-success"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</button>-->
                                <?php //} else { ?>
                            <button onclick="window.history.go(-1);" class="btn btn-success"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</button>    
                                <?php //} ?>
                            <!--</a>-->
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">

                    <div class="mb-10">

                        <div>
                            <?php $imgdata = !empty($pooja_view_data[0]['pooja_image'])? 'upload/admin/pooja/'.$pooja_view_data[0]['pooja_image']: 'AdminMedia/images/default.png' ?>
                                <img src="<?php echo base_url( $imgdata);?>" alt="Image" class="img-fluid service-img"></div>

                    </div>
                    
                    <div class="mb-3">
                        <h6><b>Related Services</b></h6></div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if (!empty($related_pooja_list)) {
                       foreach ($related_pooja_list as $key => $value) {
                        $current_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        ?>

                                <a href="<?php echo base_url();?>front-services-view/<?php echo !empty($value['pk_id'])?$value['pk_id']:'';?>/description?redirect=<?php echo base64_encode($current_link) ?>">
                                    <div class="hs_shop_prodt_main_box">
                                        <div class="hs_shop_prodt_img_wrapper">
                                            <?php $imgLink = !empty($value['pooja_image']) ? 'upload/admin/pooja/' . $value['pooja_image'] : 'AdminMedia/images/default-img.png'; ?>
                                                <img src="<?php echo base_url() . $imgLink; ?>" alt="shop_product">

                                        </div>
                                        <div class="hs_shop_prodt_img_cont_wrapper">
                                            <h6><?php echo !empty($value['pooja_name'])?ucwords($value['pooja_name']):'';?></h6>
                                        </div>
                                    </div>
                                </a>
                                <?php }}?>
                        </div>

                    </div>

                </div>
                <div class="col-lg-9 ml-auto">

                    <div class="hs_about_right_cont_wrapper mt-0">

                        <?php  $current_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

           ?>
                            <p>
                                <?php echo !empty($pooja_view_data[0]['short_description'])? ucfirst($pooja_view_data[0]['short_description']):'';?>
                            </p>
                            <div class="mb-3">
                                <a href="<?php echo base_url();?>front-view-packages/<?php echo !empty($pooja_view_data[0]['pk_id'])? ucfirst($pooja_view_data[0]['pk_id']):'';?>?redirect2=<?php echo $current_link ?>">
                                    <button name="viewpackages" data-id="42644~2" class="viewprice-package btn btn-success" style=""> <span style="float: right;"> View Pricing and Packages </span> <i class="icon icon-arrow-right6"></i></button>
                                </a>
                                <a href="<?php echo base_url();?>front-contact-us" class="ml-1">
                                    <button name="viewpackages" data-id="42644~2" class="viewprice-package btn btn-success" style=""> <span style="float: right;"> Enquiry Now </span> <i class="icon icon-arrow-right6"></i></button>
                                </a>
                            </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    <div class="package-details mb-3" style="min-height: 482">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                                    <ul id="myTab" class="nav nav-tabs nav-tabs-responsive" role="tablist">

                                        <li role="presentation" class="<?php echo !empty($this->uri->segment(3)) && $this->uri->segment(3)=='description'?'active':'';  ?>">
                                            <a href="<?php echo base_url(); ?>front-services-view/<?php echo !empty($this->uri->segment(2))?$this->uri->segment(2):''; ?>/description?redirect=<?php echo $this->input->get('redirect') ?>">
                                                <span class="text">Description</span>
                                            </a>
                                        </li>

                                        <li role="presentation" class="<?php echo !empty($this->uri->segment(3)) && $this->uri->segment(3)=='features'?'active':'';  ?>">
                                            <a href="<?php echo base_url(); ?>front-services-view/<?php echo !empty($this->uri->segment(2))?$this->uri->segment(2):''; ?>/features?redirect=<?php echo $this->input->get('redirect') ?>">
                                                <span class="text">Salient Features</span>
                                            </a>
                                        </li>
                                        <li role="presentation" class="<?php echo !empty($this->uri->segment(3)) && $this->uri->segment(3)=='reviews'?'active':'';  ?>">
                                            <a href="<?php echo base_url(); ?>front-services-view/<?php echo !empty($this->uri->segment(2))?$this->uri->segment(2):''; ?>/reviews?redirect=<?php echo $this->input->get('redirect') ?>">
                                                <span class="text">Reviews ( <?php echo !empty($totalcount)? $totalcount:'0';?>)</span>
                                            </a>
                                        </li>

                                    </ul>

                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane <?php echo !empty($this->uri->segment(3)) && $this->uri->segment(3)=='description'?'in active':'';  ?>">
                                            <p>
                                                <?php echo !empty($pooja_view_data[0]['long_description'])? ucfirst($pooja_view_data[0]['long_description']):'';?>

                                        </div>
                                        <div role="tabpanel" class="tab-pane fade <?php echo !empty($this->uri->segment(3)) && $this->uri->segment(3)=='reviews'?'in active':'';  ?>">
                                            <?php if (!empty($puja_rating_list)) {
                                  foreach ($puja_rating_list as $key => $value) {

                                    ?>
                                                <div>

                                                    <p>
                                                        <?php echo  !empty($value['comment'])? ucfirst($value['comment']):'';?>
                                                    </p>
                                                    <div class="reviewrow">
                                                        <div class="revied-priestdetails">
                                                            <?php   $profile_pic= !empty($value['upload_profile_Image']) ? base_url().'upload/android/registartion/purohit_profile/'.$value['upload_profile_Image']:base_url().'AdminMedia/images/photo.png';?>
                                                                <img src="<?php echo $profile_pic ?>">

                                                                <p>Pooja Performed by,</p>
                                                                <span><?php echo !empty($value['first_name'])? ucfirst($value['first_name']):'';?> <?php echo !empty($value['middle_name'])? ucfirst($value['middle_name']):'';?> <?php echo !empty($value['last_name'])? ucfirst($value['last_name']):'';?> </span> </div>

                                                        <div class="reviedcustomer-details">
                                                            <div class="reviecustphoto">

                                                                <p class="meta">
                                                                    <strong itemprop="author">  <?php echo !empty($value['customer_name'])? ucfirst($value['customer_name']):'';?></strong>
                                                                    <time class="datetimealign" itemprop="datePublished">
                                                                        <?= !empty($value['created_date']) ? date('M d,Y', strtotime($value['created_date'])) : "-"; ?>
                                                                    </time>
                                                                </p>

                                                            </div>
                                                            <p>Pooja performance rating </p>
                                                            <div class="ratingandstarcenter rating-sec">
                                                                <ul>
                                                                    <?php if(!empty($value['rating']) && $value['rating']=="1"){  ?>
                                                                        <li> <i class="fa fa-star filled"></i></li>
                                                                        <li><i class="fa fa-star unfilled"></i></li>
                                                                        <li><i class="fa fa-star unfilled"></i></li>
                                                                        <li><i class="fa fa-star unfilled"></i></li>
                                                                        <li><i class="fa fa-star unfilled"></i></li>
                                                                        <?php }?>

                                                                            <?php if(!empty($value['rating']) && $value['rating']=="2"){  ?>
                                                                                <li><i class="fa fa-star filled"></i></li>
                                                                                <li><i class="fa fa-star filled"></i></li>
                                                                                <li><i class="fa fa-star unfilled"></i></li>
                                                                                <li><i class="fa fa-star unfilled"></i></li>
                                                                                <li><i class="fa fa-star unfilled"></i></li>
                                                                                <?php }?>

                                                                                    <?php if(!empty($value['rating']) && $value['rating']=="3"){  ?>
                                                                                        <li><i class="fa fa-star filled"></i></li>
                                                                                        <li><i class="fa fa-star filled"></i></li>
                                                                                        <li><i class="fa fa-star filled"></i></li>
                                                                                        <li><i class="fa fa-star unfilled"></i></li>
                                                                                        <li><i class="fa fa-star unfilled"></i></li>
                                                                                        <?php }?>

                                                                                            <?php if(!empty($value['rating']) && $value['rating']=="4"){ ?>
                                                                                                <li><i class="fa fa-star filled"></i></li>
                                                                                                <li><i class="fa fa-star filled"></i></li>
                                                                                                <li><i class="fa fa-star filled"></i></li>
                                                                                                <li><i class="fa fa-star filled"></i></li>
                                                                                                <li><i class="fa fa-star unfilled"></i></li>
                                                                                                <?php }?>

                                                                                                    <?php if(!empty($value['rating']) && $value['rating']=="5"){ ?>
                                                                                                        <li><i class="fa fa-star filled"></i></li>
                                                                                                        <li><i class="fa fa-star filled"></i></li>
                                                                                                        <li><i class="fa fa-star filled"></i></li>
                                                                                                        <li><i class="fa fa-star filled"></i></li>
                                                                                                        <li><i class="fa fa-star filled"></i></li>
                                                                                                        <?php }?>
                                                                </ul>

                                                                <span class="starcountno ml-2"><?php echo !empty($value['rating'])? ucfirst($value['rating']):'';?>/5 </span>
                                                                <div itemprop="reviewRating" itemscope="" itemtype="http://schema.org/Rating" class="star-rating" title="">

                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <hr class="dash-hr mt-4">
                                                <?php }}?>

                                                    <ul class="pagination pull-right">
                                                        <?php if (isset($follow_links) && !empty($follow_links)) { ?>
                                                            <p>
                                                                <?php echo $follow_links ?>
                                                            </p>
                                                            <?php } ?>
                                                    </ul>

                                        </div>
                                        <!--                 <div role="tabpanel" class="tab-pane fade" id="samsa" aria-labelledby="samsa-tab">
                                <p>
                                  One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.
                                </p>
                                <p>
                                  He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections.
                                </p>
                                <p>
                                  The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What's happened to me?
                                </p>
                                <p>
                                  " he thought. It wasn't a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls.
                                </p>
                                <p>
                                  A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.
                                </p>
                                <p>
                                  It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather.
                                </p>
                                <p>
                                  Drops of rain could be heard hitting the pane, which made him feel quite sad.
                                </p>
                                <p>
                                  "How about if I sleep a little bit longer and forget all this nonsense", he thought, but that was something he was unable to do because he was used to sleeping on his right, and in his present state couldn't get into that position. However hard he threw
                                  himself onto his right, he always rolled back to where he was.
                                </p>
                                <p>
                                  He must have tried it a hundred times, shut his eyes so that he wouldn't have to look at the floundering legs, and only stopped when he began to feel a mild, dull pain there that he had never felt before. "Oh, God", he thought, "what a strenuous career
                                  it is that I've chosen!
                                </p>
                              </div> -->

                                        <div role="tabpanel" class="tab-pane <?php echo !empty($this->uri->segment(3)) && $this->uri->segment(3)=='features'?'in active':'';  ?>">

                                            <?php echo !empty($pooja_view_data[0]['silent_feature'])?$pooja_view_data[0]['silent_feature']:'';?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <?php include('application/views/front/section/footer.php'); ?>
        <script type="text/javascript">
            $(".serviceLi").addClass("active");
        </script>

        <script type="text/javascript">
            // $('.nav-tabs-responsive').on('click', 'li', function() {
            // $('li.active').removeClass('active');
            // $(this).addClass('active');
            // });
        </script>

        </body>

        </html>