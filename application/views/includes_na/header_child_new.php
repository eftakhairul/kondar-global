<div class="container">
            
        	<div class="header">
                
                <div>
                    <div class="row" style="min-height:130px;">
                        <div class="col-md-3">
            	           <a class="logo" href="front/home/"><img src="assets/template/images/logo.png" alt="logo" style="float:left;" /></a>
                        </div>
                        <div class="col-md-6 col-xs-5 block-bg-header hidden-xs">
                            <img src="assets/template/images/logo-pic.png" alt="">    
                        </div>
                        <div class="col-md-3">
                            <div class="ddl">
                               <div class="language_container">
                                    <label for="polyglot-language-options" class="hide">Select Language</label>
                                    <div id="polyglotLanguageSwitcher">
                                        <form action="#">
                                            <select id="polyglot-language-options">
                                                <option id="en" value="en" selected>English</option>
                                                <option id="fr" value="fr">Fran&ccedil;ais</option>
                                                <option id="de" value="de">Deutsch</option>
                                                <option id="it" value="it">Italiano</option>
                                                <option id="es" value="es">Espa&ntilde;ol</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>

                                <div class="box">
                     		        <label   style="font-family: arial; font-size: 12px; font-weight: bold; padding-left: -1px;">Wednesday. February 12, 2014</label> <hr  style="margin-top: 1px; margin-bottom:0px;" />
                                    <label    style="font-family: arial; font-size: 12px; font-weight: bold; letter-spacing: 3px; padding-left: 1px;">11&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;34&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;PM</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="row">
                    <div class="text-header">
                        <div class="col-md-3 col-md-offset-2 text-right text-1">
                            <h3 style="margin-top:0px">We Export Around the Globe</h3>
                        </div>
                        <div class="col-md-3 col-md-offset-2 text-right text-2">
                            <h4>
                            <a href="front/home/distribution">Apply for A Distribution Agrement </a> 
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
                                              <a href="front/home/" class="dropdown-toggle" data-toggle="dropdown">Home <b class="caret"></b></a>
                                                  <ul class="dropdown-menu">
                                                    <li><a href="front/home/career">Career</a></li>
                                                    <li><a href="front/home/contact_us">Contact Us</a></li>
                                                  </ul>
                                            </li>
                                            
                                            <li class="dropdown">
                                                <a href="products" class="dropdown-toggle" data-toggle="dropdown">
                                                    Products <b class="caret"></b>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <!-- <li><a href="product.php" class="cars" style="background:none"><b>PRODUCT</b></a></li> -->
                                                    <!-- <li class="divider"></li> -->
                                                    <?php
													 foreach($menu_vehicle_categories as $vehicle_categories1){?>
                                                    	<li><a href="products/product_type/<?php echo $vehicle_categories1['id'];?>" class="cars" style="background: url('assets/uploads/vehicle_categories/<?php echo $vehicle_categories1['menu_image'];?>') no-repeat scroll right center transparent;"><?php echo $vehicle_categories1['category_name'];?></a></li>
                                                    <?php }?>
                                                    <li><a href="javascript:void(0)">&nbsp;</a></li>
                                                    <!--<li><a href="front/home/car" class="van">Van & Pickup</a></li>
                                                    <li><a href="front/home/truck" class="truck">Truck & Bus</a></li>
                                                    <li><a href="front/home/truck_brand" class="others">Others</a></li>-->
                                                </ul>
                                                <ul class="dropdown-menu" style="margin-left:270px;width:248px">
													<?php foreach($menu_product_types as $menu_product_type){
													$link = strtolower(str_replace(' ', '_',$menu_product_type->product_type_name));
													?>
                                                    <li><a href="products/vehicle_type/<?php echo $link;?>" style="background: url('assets/uploads/product_type_images/<?php echo $menu_product_type->Product_Type_Photo;?>') no-repeat scroll right center transparent; background-size: 25%;"><?php echo $menu_product_type->product_type_name;?></a></li>
                                                    <?php }?>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="promotion/index">Promotion Section</a>
                                            </li>
                                            <li class="dropdown">
                                                <a href="front/home/Login" class="dropdown-toggle" data-toggle="dropdown">
                                                    Client Section <b class="caret"></b>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="front/home/Login" >Follow Up Order</a></li>
                                                    <li><a href="front/home/Login" >Warranty Claim</a></li>
                                                    <li><a href="front/home/Login" >Instant RFQ</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown"><a href="front/home/Login" class="dropdown-toggle" data-toggle="dropdown">Supplier & Investor Section <b class="caret"></b></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="front/home/Login" >Supplier</a></li>
                                                    <li><a href="front/home/Login">Investor</a></li>
                                                </ul>
                                            </li>
                                         
                                            <li>
                                            <a href="front/cart"><img src="assets/template/images/cart.png" alt="cart" />  <span id="menu_cart_id">Cart [<?php echo $cartcount;?>]</span></a>
                                            </li>
                                      </ul>
                                  
                                </div><!-- /.navbar-collapse -->
                              </div><!-- /.container-fluid -->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>