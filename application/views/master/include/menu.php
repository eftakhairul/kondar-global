<?php
$menu_img_link = array();
$menu_label = array();
foreach ($menus as $menu) {
    if ($menu['menu_name'] == 'career') {
        $menu_img_link['career'] = $menu['menu_image'];
        $menu_label['career'] = $menu['menu_label'];
    } else
    if ($menu['menu_name'] == 'contact_us') {
        $menu_img_link['contact_us'] = $menu['menu_image'];
        $menu_label['contact_us'] = $menu['menu_label'];
    } else
    if ($menu['menu_name'] == 'follow_up_order') {
        $menu_img_link['follow_up_order'] = $menu['menu_image'];
        $menu_label['follow_up_order'] = $menu['menu_label'];
    } else
    if ($menu['menu_name'] == 'warranty_claim') {
        $menu_img_link['warranty_claim'] = $menu['menu_image'];
        $menu_label['warranty_claim'] = $menu['menu_label'];
    } else
    if ($menu['menu_name'] == 'get_instant_quo') {
        $menu_img_link['get_instant_quo'] = $menu['menu_image'];
        $menu_label['get_instant_quo'] = $menu['menu_label'];
    } else
    if ($menu['menu_name'] == 'claim_award') {
        $menu_img_link['claim_award'] = $menu['menu_image'];
        $menu_label['claim_award'] = $menu['menu_label'];
    } else
    if ($menu['menu_name'] == 'supplier') {
        $menu_img_link['supplier'] = $menu['menu_image'];
        $menu_label['supplier'] = $menu['menu_label'];
    } else
    if ($menu['menu_name'] == 'investor') {
        $menu_img_link['investor'] = $menu['menu_image'];
        $menu_label['investor'] = $menu['menu_label'];
    }
} //echo "<pre>"; print_r($menu_img_link); echo "</pre>"; exit;
?>
<body>
    <div class="bodywrapper">
        <div class="container">
            <div class="header">
                <div class="row" style="min-height:130px;">
                    <div class="col-md-3">
                        <a class="logo" href="<?= base_url() ?>home"><img src="<?= img_url('logo.png', 'master/') ?>" alt="logo" style="float:left;" /></a>
                    </div>
                    <div class="col-md-6 col-xs-5 block-bg-header hidden-xs">
                        <a href="<?= base_url() ?>products"><img src="<?= img_url('logo-pic.png', 'master/') ?>" alt="Products Logo">  </a>  
                                </div>
                                <div class="col-md-3" style="float:right">
                                    <div class="ddl">
                                        
                                        <div class="box">
                                            <div class="language_container">
                                            <div id="polyglotLanguageSwitcher1">
                                                <dl id="sample" class="dropdown">
                                                    <dt>
                                                    <a href="javascript:">
                                                        <span>
                                                            <?= (isset($country_data) && !empty($country_data)) ? '<img class="flag" src="' . global_img_link($country_data[0]['image'], 'uploads/country/thumbnails/') . '" alt="English" height="11" width="16"/>' . $country_data[0]['name'] : 'No Language'; ?>
                                                        </span>
                                                    </a>
                                                    </dt>
                                                    <dd>
                                                        <ul>
                                                            <?php
                                                            if (isset($country_data) && !empty($country_data)) {
                                                                foreach ($country_data as $set_data) {
                                                                    ?>
                                                                    <li>
                                                                        <a href="javascript:"> 
                                                                            <img class="flag" src="<?= global_img_link($set_data['image'], 'uploads/country/thumbnails/') ?>" alt="<?= $set_data['name'] ?>"  height="11" width="16"/>
                                                                            <?= $set_data['name'] ?> 
                                                                        </a>
                                                                    </li>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                    </dd>
                                                </dl>
                                            </div>                         
                                        </div>
                                            <div style="clear:both"></div>
                                            
                                            <div class="date-sec">
                                                <div class="date-time color-white" id="dateActive" style="width:auto"></div>
                                                <div class="sep"></div>
                                                <div class="date-time color-white" id="timeActive"></div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                </div>


                                <div class="row">
                                    <div class="text-header">
                                        <div class="col-md-3 col-md-offset-2 text-right text-1">
                                            <h3 style="margin-top:0px"><a href="<?= base_url() ?>promotion/view_promotion/41">We Export Around the Globe</a></h3>
                                        </div>
                                        <div class="col-md-3 col-md-offset-1 text-right text-2">
                                            <h4>
                                                <a class="distribution_link blink" href="distribution" style="margin-left:-26px">Apply for A Distribution Agrement</a> 
                                            </h4>
                                        </div>
                                        <?php include('search.php'); ?>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div>
                                            <nav class="navbar navbar-default menu" role="navigation">
                                                <div class="container-fluid">
                                                    <!-- Brand and toggle get grouped for better mobile display -->
                                                    <div class="navbar-header">
                                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                                            <span class="sr-only">Toggle navigation</span>
                                                            <span class="icon-bar"></span>
                                                            <span class="icon-bar"></span>
                                                            <span class="icon-bar"></span>
                                                        </button>
                                                        <!-- <a class="navbar-brand" href="#">Navigation</a> -->
                                                    </div>
                                                    <!-- Collect the nav links, forms, and other content for toggling -->
                                                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                                        <ul class="nav navbar-nav parent">
                                                            <li class="dropdown">
                                                                <a href="home" class="dropdown-toggle1" data-toggle="dropdown1">Home <b class="caret"></b></a>
                                                                <ul class="dropdown-menu">
                                                                    <li><a style="background: url('assets/uploads/menus/<?php echo $menu_img_link['career']; ?>') no-repeat scroll right center transparent;" href="career"><?php echo $menu_label['career'];?></a></li>
                                                                    <li><a style="background: url('assets/uploads/menus/<?php echo $menu_img_link['contact_us']; ?>') no-repeat scroll right center transparent;"  href="contact"><?php echo $menu_label['contact_us'];?></a></li>
                                                                </ul>
                                                            </li>

                                                            <li class="dropdown">
                                                                <?php if (isset($productsdropdown) && $productsdropdown == true) { ?>
                                                                    <a href="products" class="dropdown-toggle1" data-toggle="dropdown1">
                                                                        Products <b class="caret"></b>
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <a href="products" class="dropdown-toggle1" data-toggle="dropdown1">
                                                                        Products <b class="caret"></b>
                                                                    </a>
                                                                <?php } ?>
                                                                <?php if (isset($menu_vehicle_categories) && !empty($menu_vehicle_categories)) { ?>
                                                                    <ul class="dropdown-menu">
                                                                        <?php foreach ($menu_vehicle_categories as $vehicle_categories1) { ?>
                                                                            <li><a href="products/product_type/<?php echo $vehicle_categories1['id']; ?>" class="cars" style="background: url('assets/uploads/vehicle_categories/<?php echo $vehicle_categories1['menu_image']; ?>') no-repeat scroll right center transparent; background-size: 30%;"><?php echo $vehicle_categories1['category_name']; ?></a></li>
                                                                        <?php } ?>                                                                        
                                                                    </ul>
                                                                <?php } ?>
                                                                <?php if (isset($menu_product_types) && !empty($menu_product_types)) { ?>
                                                                    <ul class="dropdown-menu" style="margin-left:270px;width:248px">
                                                                        <?php
                                                                        foreach ($menu_product_types as $menu_product_type) {
                                                                            $link = strtolower(str_replace(' ', '_', $menu_product_type->product_type_name));
                                                                            ?>
                                                                            <li><a href="products/vehicle_type/<?php echo $link; ?>" style="background: url('assets/uploads/product_type_images/<?php echo $menu_product_type->Product_Type_Photo; ?>') no-repeat scroll right center transparent;background-size: 25%;"><?php echo $menu_product_type->product_type_name; ?></a></li>
                                                                        <?php } ?>
                                                                    </ul>
                                                                <?php } ?>	
                                                            </li>
                                                            <li>
                                                                <a href="<?= base_url() ?>promotion">Promotion Section</a>
                                                            </li>
                                                            <li class="dropdown">
                                                                <a href="home/Login" class="dropdown-toggle" data-toggle="dropdown">
                                                                    Client Section <b class="caret"></b>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <li><a style="background: url('<?= global_img_link($menu_img_link['follow_up_order'], "uploads/menus/") ?>') no-repeat scroll right center transparent;"  href="#" class="login_pop" ><?php echo $menu_label['follow_up_order'];?></a></li>
                                                                    <li><a style="background: url('<?= global_img_link($menu_img_link['get_instant_quo'], "uploads/menus/") ?>') no-repeat scroll right center transparent;"  href="<?= base_url() ?>products" class="" ><?php echo $menu_label['get_instant_quo'];?></a></li>
                                                                    <li><a style="background: url('<?= global_img_link($menu_img_link['warranty_claim'], "uploads/menus/") ?>') no-repeat scroll right center transparent;"  href="#" class="login_pop" ><?php echo $menu_label['warranty_claim'];?></a></li>
                                                                    <li><a style="background: url('<?= global_img_link($menu_img_link['claim_award'], "uploads/menus/") ?>') no-repeat scroll right center transparent;"  href="<?= base_url() ?>promotion/awards" class="" ><?php echo $menu_label['claim_award'];?></a></li>                                                             

                                                                </ul>
                                                            </li>
                                                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Supplier &amp; Investor Section <b class="caret"></b></a>
                                                                <ul class="dropdown-menu">
                                                                    <li><a style="background: url('<?= global_img_link($menu_img_link['supplier'], "uploads/menus/") ?>') no-repeat scroll right center transparent;"  href="#" class="login_pop" ><?php echo $menu_label['supplier'];?></a></li>
                                                                    <li><a style="background: url('<?= global_img_link($menu_img_link['investor'], "uploads/menus/") ?>') no-repeat scroll right center transparent;"  href="#" class="login_pop" ><?php echo $menu_label['investor'];?></a></li>
                                                                </ul>
                                                            </li>
                                                            <li>

                                                                <a href="https://kondarglobal.frappecloud.com/#login" style="float: left; padding: 15px 0px 16px 10px; width: 95px;">Staff Login</a>
																<a href="cart" style="float: left; width: 137px; padding: 14px 0px 16px 3px;"><img src="<?= img_url('cart.png', 'master/') ?>" alt="cart" /> <span id="menu_cart_id">Cart [<?php echo $cartcount; ?>]</span></a>
                                                            </li>
															    
                                                        </ul>

                                                    </div><!-- /.navbar-collapse -->
                                                </div><!-- /.container-fluid -->
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                                <div class="slider" style="height:auto">
                                    <?php
                                    if (isset($slider_data) && !empty($slider_data)) {
                                        ?>
                                        <div class="wmuSlider example2">
                                            <div class="wmuSliderWrapper">
                                                 <?php
                                                    foreach ($slider_data as $set_data) {
                                                        $image_src = 'assets/uploads/slider/full/' . $set_data['image'];
                                                        if (file_exists($image_src)) {
                                                            ?>
                                            
                                                            <article><h2 class="hide">slider</h2>
                                                                <img src="<?php echo $image_src; ?>" alt="slider" style="height:auto;width:100%;" />
                                                            </article>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                </div>
                                </div>

                                <script>
    
                                    $(document).ready(function() {

                                        $(".dropdown img.flag").addClass("flagvisibility");

                                        $(".dropdown dt a").click(function() {

                                            $(".dropdown dd ul").toggle();

                                        });

                  

                                        $(".dropdown dd ul li a").click(function() {

                                            var text = $(this).html();

                                            $(".dropdown dt a span").html(text);

                                            $(".dropdown dd ul").hide();

                                            $("#result").html("Selected value is: " + getSelectedValue("sample"));

                                        });

                  

                                        function getSelectedValue(id) {

                                            return $("#" + id).find("dt a span.value").html();

                                        }



                                        $(document).bind('click', function(e) {

                                            var $clicked = $(e.target);

                                            if (! $clicked.parents().hasClass("dropdown"))

                                            $(".dropdown dd ul").hide();

                                    });


                                    $("#flagSwitcher").click(function() {

                                        $(".dropdown img.flag").toggleClass("flagvisibility");

                                    });

                                });


                                $(document).ready(function() {

                                    //$("#language_popup").modal('hide');

                                    $("#polyglotLanguageSwitcher1 dl dd ul li a ").click(function() {
																	  
                                        $("#language_selected").val($(this).find('img').attr('alt'));

                                    }); 

                                });

                                </script>
