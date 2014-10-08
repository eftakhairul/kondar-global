<?php echo $this->lang->line(''); ?>
<script>
    function get_lang(name,id,value){
        //alert(name+' '+id+' '+value);
        $.ajax({
            type: "POST",
            url: "admin/index/set_lang", /* The country id will be sent to this file */
            data: "lang="+value,
            beforeSend: function () {
                //      $("#show_class").html("Loading ...");
            },
            success: function(msg){
                location.reload();
                //		 alert(msg);
                //  $("#show_class").html(msg);
            }
        });
    } 
</script>
<?php
/* echo '<pre>';
  print_r($login);
  die;
 */
?>
<!-- Left sidebar -->
<div class="sidebar" id="left-sidebar">
    <center><img src="<?php echo base_url(); ?>/assets/master/img/logo.png" width="177" alt="LOGO"></center>
    <?php /* ?><select onChange="get_lang('car_detail','1',this.value)">
      <option value="">select</option>
      <option value="english"><?php echo $this->lang->line('english');?></option>
      <option value="russian"><?php echo $this->lang->line('russian');?></option>
      </select><?php */ ?>
    <!-- Simple nav -->
    <ul class="navigation-light block">
        <li <?php if (isset($active) && $active == 'dashboard') echo 'class="active"'; ?> >
            <a href="admin/index/dashboard" title=""><img src="assets/user/images/dashboard.png" alt=""><?php echo $this->lang->line('') . 'dashboard'; ?></a>
        </li>
        <li <?php if (isset($active) && $active == 'visit') echo 'class="active"'; ?>>
            <a href="front" target="_blank" title=""><img src="assets/user/images/dashboard.png" alt=""><?php echo $this->lang->line('') . 'Visit Site'; ?></a>
        </li>

        <li <?php if (isset($active) && $active == 'welcome') echo 'class="active"'; ?>>
            <a href="admin/index/all_welcome_page" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('') . 'Welcome Page'; ?></a>
        </li>

        <li <?php if (isset($active) && $active == 'home') echo 'class="active"'; ?>>
            <a href="admin/index/all_home_page" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('') . 'Home Page'; ?></a>
        </li>

        <li <?php if (isset($active) && $active == 'country') echo 'class="active"'; ?>>
            <a href="admin/index/language" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('') . 'Language List'; ?></a>
        </li> 

        <li <?php if (isset($active) && $active == 'content') echo 'class="active"'; ?>>
            <a href="admin/index/content" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('') . 'Content Change'; ?></a>
        </li>

        <li <?php if (isset($active) && $active == 'interview') echo 'class="active"'; ?>>
            <a href="admin/career" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('') . 'Job Section'; ?></a>
        </li>

        <li <?php if (isset($active) && $active == 'serial') echo 'class="active"'; ?>>
            <a href="admin/serial" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('') . 'Serial Code'; ?></a>
        </li>


        <li <?php if (isset($active) && $active == 'blocks') echo 'class="active"'; ?>>
            <a href="admin/blocks_list" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('') . 'Blocks List'; ?></a>
        </li>

        <li <?php if (isset($active) && $active == 'd_blocks') echo 'class="active"'; ?>>
<!--        <a href="admin/distribution_blocks_list" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('') . 'Distribution Blocks List'; ?></a>-->
            <a href="admin/distribution" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('') . 'Distribution'; ?></a>
        </li>

        <li <?php if (isset($active) && $active == 'product') echo 'class="active"'; ?>>
            <a href="admin/product" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('') . 'Product List'; ?></a>
        </li>

        <li <?php if (isset($active) && $active == 'product_type') echo 'class="active"'; ?>>
            <a href="admin/product_type" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('') . 'Product Type'; ?></a>
        </li>

        <li <?php if (isset($active) && $active == 'makers') echo 'class="active"'; ?>>
            <a href="admin/makers" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('') . 'Product Makers'; ?></a>
        </li>

        <li <?php if (isset($active) && $active == 'product_model') echo 'class="active"'; ?>>
            <a href="admin/product_model" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('') . 'Product Models'; ?></a>
        </li>

        <li <?php if (isset($active) && $active == 'vehicle_categories') echo 'class="active"'; ?>>
            <a href="admin/vehicle_categories" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('') . 'Vehicle Category'; ?></a>
        </li>

        <li <?php if (isset($active) && $active == 'cart') echo 'class="active"'; ?>>
            <a href="admin/cart" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('') . 'Order Details'; ?></a>
        </li>

        <li <?php if (isset($active) && $active == 'winner_list') echo 'class="active"'; ?>>
            <a href="admin/serial/winners" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('') . 'Winners'; ?></a>
        </li>

        <li <?php if (isset($active) && $active == 'blocked') echo 'class="active"'; ?>>
            <a href="admin/serial/blocked" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('') . 'Serial Blocked Users'; ?></a>
        </li>

        <li <?php if (isset($active) && $active == 'cart_blocked') echo 'class="active"'; ?>>
            <a href="admin/cart/blocked" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('') . 'Order Blocked Users'; ?></a>
        </li>

        <li <?php if (isset($active) && $active == 'promotion_section') echo 'class="active"'; ?>>
            <a href="admin/index/promotion_page" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('') . 'Promotion Section'; ?></a>
        </li>

        <li <?php if (isset($active) && $active == 'contact_section') echo 'class="active"'; ?>>
            <a href="admin/index/contact_page" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('') . ' Contact Section'; ?></a>
        </li>

        <?php /* ?><li <?php if(isset($active)&& $active=='a') echo 'class="active"';?>>
          <a href="admin/index/" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('').' Distributor Request';?></a>
          </li><?php */ ?>

        <?php /* ?><li <?php if(isset($active)&& $active=='a') echo 'class="active"';?>>
          <a href="admin/index/" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('').'Product Section';?></a>
          </li><?php */ ?>
        <?php /* ?> <li <?php if(isset($active)&& $active=='a') echo 'class="active"';?>>
          <a href="admin/index/" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('').'Category';?></a>
          </li>
          <li <?php if(isset($active)&& $active=='a') echo 'class="active"';?>>
          <a href="admin/index/" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('').'Award';?></a>
          </li>
          <li <?php if(isset($active)&& $active=='a') echo 'class="active"';?>>
          <a href="admin/index/" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('').'Transaction History';?></a>
          </li>

          <li <?php if(isset($active)&& $active=='a') echo 'class="active"';?>>
          <a href="admin/index/" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('').'User List';?></a>
          </li><?php */ ?>

        <li <?php if (isset($active) && $active == 'a') echo 'class="active"'; ?>>
            <a href="admin/index/manage_menu/" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('') . 'Manage Menu'; ?></a>
        </li>

        <?php /* ?>        <li <?php if(isset($active)&& $active=='user') echo 'class="active"';?>>
          <a href="admin/user_list" title=""><img src="assets/user/images/messages.png" alt=""><?php echo $this->lang->line('user_list');?></a>
          </li>

          <li <?php if(isset($active)&& $active=='mail') echo 'class="active"';?>>
          <a href="admin/send_mail" title=""><img src="assets/user/images/messages.png" alt=""><?php echo $this->lang->line('').'Mass Mail';?></a>
          </li>

          <li <?php if(isset($active)&& $active=='category') echo 'class="active"';?>>
          <a href="admin/category" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('category');?></a>
          </li>

          <li <?php if(isset($active)&& $active=='event') echo 'class="active"';?>>
          <a href="admin/event" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('').'Sub category';?></a>
          </li>

          <li <?php if(isset($active)&& $active=='blog') echo 'class="active"';?>>
          <a href="admin/blog" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('blog');?></a>
          </li>

          <li <?php if(isset($active)&& $active=='content') echo 'class="active"';?>>
          <a href="admin/all_content" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('all_content');?></a>
          </li>

          <li <?php if(isset($active)&& $active=='forum') echo 'class="active"';?>>
          <a href="admin/forum" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('forum');?></a>
          </li><?php */ ?>


        <?php /* ?>        <li <?php if(isset($active)&& $active=='currency') echo 'class="active"';?>>
          <a href="admin/currency" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('currency');?></a>
          </li>

          <li <?php if(isset($active)&& $active=='payment') echo 'class="active"';?>>
          <a href="admin/payment_gateway" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('payment_gateway');?></a>
          </li>

          <li <?php if(isset($active)&& $active=='reserve') echo 'class="active"';?>>
          <a href="admin/reserve_list" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('reserve_list');?></a>
          </li>

          <li <?php if(isset($active)&& $active=='history') echo 'class="active"';?>>
          <a href="admin/history" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('history');?></a>
          </li>
          <li <?php if(isset($active)&& $active=='buy_history') echo 'class="active"';?>>
          <a href="admin/buy_history" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('buy_history');?></a>
          </li>

          <li <?php if(isset($active)&& $active=='sell_history') echo 'class="active"';?>>
          <a href="admin/sell_history" title=""><img src="assets/user/images/typography.png" alt=""><?php echo $this->lang->line('sell_history');?></a>
          </li>

          <?php */ ?>

        <li <?php if (isset($active) && $active == 'password') echo 'class="active"'; ?>>
            <a href="admin/index/password" title=""><img src="assets/user/images/typography.png" alt=""><?php echo 'Password' ?></a>
        </li>
        <li <?php if (isset($active) && $active == 'timer_cart') echo 'class="active"'; ?>>
            <a href="admin/index/timer_cart" title=""><img src="assets/user/images/typography.png" alt=""><?php echo "Timer (Cart)"; ?></a>
        </li>
        <li <?php if (isset($active) && $active == 'timer_contact') echo 'class="active"'; ?>>
            <a href="admin/index/timer_contact" title=""><img src="assets/user/images/typography.png" alt=""><?php echo "Timer (Contact)"; ?></a>
        </li>
        <li <?php if (isset($active) && $active == 'timer_promotion') echo 'class="active"'; ?>>
            <a href="admin/index/timer_promotion" title=""><img src="assets/user/images/typography.png" alt=""><?php echo "Timer (Promotion)"; ?></a>
        </li>
        <li <?php if (isset($active) && $active == 'timer_award') echo 'class="active"'; ?>>
            <a href="admin/index/timer_award" title=""><img src="assets/user/images/typography.png" alt=""><?php echo "Timer (Award)"; ?></a>
        </li>
        <li <?php if (isset($active) && $active == 'timer_career') echo 'class="active"'; ?>>
            <a href="admin/index/timer_career" title=""><img src="assets/user/images/typography.png" alt=""><?php echo "Timer (Carrer)"; ?></a>
        </li>
        <li <?php if (isset($active) && $active == 'timer_distribution') echo 'class="active"'; ?>>
            <a href="admin/index/timer_distribution" title=""><img src="assets/user/images/typography.png" alt=""><?php echo "Timer (Distribution)"; ?></a>
        </li>
        <li <?php if (isset($active) && $active == 'selection_instruction') echo 'class="active"'; ?>>
            <a href="admin/index/selection_instruction" title=""><img src="assets/user/images/typography.png" alt=""><?php echo "Selection Instruction"; ?></a>
        </li>
        <li <?php if (isset($active) && $active == 'promotion_message') echo 'class="active"'; ?>>
            <a href="admin/index/promotion_message" title=""><img src="assets/user/images/typography.png" alt=""><?php echo "Promotion Message"; ?></a>
        </li>
        <li <?php if (isset($active) && $active == 'award_message') echo 'class="active"'; ?>>
            <a href="admin/index/award_message" title=""><img src="assets/user/images/typography.png" alt=""><?php echo "Awards Message"; ?></a>
        </li>
        </li>
        <li <?php if (isset($active) && $active == 'contact_message') echo 'class="active"'; ?>>
            <a href="admin/index/contact_message" title=""><img src="assets/user/images/typography.png" alt=""><?php echo "Contact Message"; ?></a>
        </li>
        <li <?php if (isset($active) && $active == 'career_message') echo 'class="active"'; ?>>
            <a href="admin/index/career_message" title=""><img src="assets/user/images/typography.png" alt=""><?php echo "Career Message"; ?></a>
        </li>
        <li <?php if (isset($active) && $active == 'distribution_message') echo 'class="active"'; ?>>
            <a href="admin/index/distribution_message" title=""><img src="assets/user/images/typography.png" alt=""><?php echo "Distribution message"; ?></a>
        </li>
    </ul>
    <!-- /simple nav -->
    <div class="separator-doubled"></div>

    <!-- Dis code be laughing at me... I can't get rid of it and the site to carry on working :P -->
    <div class="outer sidebar-chart block" style="display: none;">
        <div class="chart" id="sidebar-bars-horizontal"></div>
    </div>
    <div class="outer sidebar-chart block" style="display: none;">
        <div class="chart" id="sidebar-bars"></div>
    </div>
    <div class="outer sidebar-chart block" style="display: none;">
        <div class="chart" id="sidebar-chart"></div>
    </div>
    <!-- IM NOT A SKID FUCK OFF -->

    <div class="appendable">

        <!-- Sidebar stats -->
        <!--<ul class="text-stats block">
            <li>
                29557<span>Total Boots</span>
            </li>
            <li>
                0<span>Your Total Boots</span>
            </li>
            <li>
                4<span>Boots Running</span>
            </li>
        </ul>-->
        <!-- /sidebar stats -->

        <!-- Links -->
        <ul class="block sidebar-links" style="margin-top: -20px; margin-bottom: 15px;">
            <li><a title="">
                    <?php
                    $user_data = $this->comman_model->get_data_by_id('admin', array('id' => $login['admin_id']));
                    ?>            	
                    <?php echo $this->lang->line('adminname'); ?>:<span style="float: right;"><?php echo $user_data['adminname']; ?></span><br>
                    <?php echo $this->lang->line('email'); ?>:<span style="float: right;"><?php echo $user_data['email']; ?></span><br>
                </a></li>
        </ul>
        <!-- /links -->

        <!--        <div class="separator-doubled"></div>-->

        <!-- Contact list -->
        <!--        <ul class="user-list block" style="margin-top: -15px;">
                    <li>
                        <a title="">
                            <span class="contact-name">
                                <strong>Themuddfamily / Jami</strong>
                                <i>Owner/Founder</i>
                            </span>
                            <span class="status_available"></span>
                        </a>
                    </li>
                    <li>
                        <a title="">
                            <span class="contact-name">
                                <strong>DARKxClutch</strong>
                                <i>Team leader</i>
                            </span>
                            <span class="status_available"></span>
                        </a>
                    </li>
                    <li>
                        <a title="">
                            <span class="contact-name">
                                <strong>Mendax</strong>
                                <i>Dancing Black Man</i>
                            </span>
                            <span class="status_available"></span>
                        </a>
                    </li>
                </ul>-->
        <!-- /contact list -->

        <div class="separator-doubled"></div>
        <!-- start session clear button-->
        <a href="admin/index/clear_session" class="btn btn-block btn-primary"><?php echo $this->lang->line('clear_session'); ?></a>
        <!-- End session clear button-->
        <!-- Form elements -->
        <a href="admin/index/logout" class="btn btn-block btn-primary"><?php echo $this->lang->line('logout'); ?></a>
        <!-- /form elements -->

    </div></div>
<!-- /left sidebar -->
