
<body onLoad="itemSize();" onResize="onResizeWindow();" id="mainBG"
<?php
if (isset($all_data['background_image']) && $all_data['background_image']) {
    ?>
          style="background:url(<?= global_img_link($all_data['background_image'], 'uploads/background/thumbnails/'); ?>) no-repeat center center fixed !important; background-size: 100% !important;"
          <?php
      }
      ?>
      >

    <div id="header" >

        <div class="logo">

            <?php
            //	var_dump($all_data);
            if (isset($all_data['logo']) && $all_data['logo'] != '') {

                $logo = global_img_link($all_data['logo'], 'uploads/logo/thumbnails/');
                ?>

                <img src="<?= $logo ?>" alt="logo">

                <?php
            }
            ?>  

        </div>

        <div class="date-sec">
            <div class="date-time color-white" id="dateActive" style="width:auto"></div>
            <div class="sep"></div>
            <div class="date-time color-white" id="timeActive"></div>
        </div>      

        <div class="language_container">

            <div id="polyglotLanguageSwitcher1">

                <dl id="sample" class="dropdown">

                    <dt><a href="javascript:" onclick="return false;"><span>

                            <?= (isset($country_data) && !empty($country_data)) ? '<img class="flag" src="' . global_img_link($country_data[0]['image'], 'uploads/country/thumbnails/') . '" alt="English" height="11" width="16"/>' . $country_data[0]['name'] : 'No Language' ?>

                        </span></a></dt>

                    <dd>

                        <ul>

                            <?php
                            if (isset($country_data) && !empty($country_data)) {

                                foreach ($country_data as $set_data) {
                                    ?>

                                    <li>

                                        <a href="javascript:" onclick="return false;"> <img class="flag" src="<?= global_img_link($set_data['image'], 'uploads/country/thumbnails/') ?>" alt="<?= $set_data['name'] ?>"  height="11" width="16"/>

                                            <?= $set_data['name'] ?> </a>

                                    </li>

                                    <?php
                                }
                            }
                            ?>



                        </ul>

                    </dd>

                </dl>

            </div>

            <input type="submit" class="button" id="submit_form" value="ENTER">

            <div class="clear"></div>

        </div>

    </div>

    <div class="modal fade" id="language_popup">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-body">

                    <div class="box-content-modal">

                        <h2 class="title-modal">This version is still under development. Please check back later. Thank you</h2>

                        <div class="clearfix"></div>

                        <div class="btn-modal"> <br />

                            <div class="row" style="float:right;">

                                <div class="col-xs-3 col-md-2 text-center"> <a style="float:right" href="#" onClick="$('#language_popup').modal('hide');return false;" class="btn btn-primary btn-sm">Ok <i class="glyphicon glyphicon-chevron-right"></i></a> </div>	

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>



    </div>

    <div id="content">

        <div id="container" class="<?= (isset($all_data['globe_position'])) ? $all_data['globe_position'] : 'left' ?>" >

            <canvas id="sphere"  class="<?= (isset($all_data['globe_size'])) ? $all_data['globe_size'] : 'medium' ?>"  width="350" height="350"></canvas>

            <div id="carousel" class="<?= (isset($product_position)) ? $product_position : 'center' ?>" ></div>

        </div>

    </div>

    <div id="footer">

        <div style="height:91%"></div>

        <div style="height:9%">

            <div id="copyright"><?php echo isset($all_data['footer_name']) ? $all_data['footer_name'] : ''; ?></div>

        </div>

