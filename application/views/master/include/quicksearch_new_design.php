<?php 	
		$selectedcat=''; 
	 	$selectedtype=''; 
		$defaultselectedfileds=''; 
?> 
	
<form action="products/product_list" method="post" id="quick_search_form">
    <input type="hidden" name="quick_search" id="quick_search" value="quick_search">
    <div class="adv_srch"  style="margin-top:10px;">       
        <div class="col-md-12">		   	
            <div class="box-list-select" style="display:inline-block; width:100%; margin-top:-3px">
			    <div class="col-md-2"><h4 style="padding-top: 0px"> Quick Search </h4></div>
                <div class="col-md-2" style="">
                    <select name="searchtype" id="searchtype" class="form-control selectpicker">
                        <option value="0">Vehicle Type</option>
                        <option value="1">Product Type</option>
                    </select>
                </div>
				
				 <div class="col-md-2" style="">				 
				   <!-- <div class="left" id="leftblock" style="width:170px;"> -->
                        <span id="vehicle_type_span"> 
                        <select name="vehicle_category_id[]" id="vehicle_category_id" class="form-control selectpicker">
                            <!--<option value="">ALL</option>-->
                            <?php foreach($product_catagory as $catagory){?>
                                <option value="<?php echo $catagory['id'];?>"><?php echo $catagory['category_name'];?></option>
                                <?php 
                                if($selectedcat=='')
                                    $selectedcat=$catagory['id'];
                            }?>
                        </select>
           
                         </span>
                   <!--   </div> -->				 
				 </div>			
				
                <div class="col-md-2" style="">                    
                   <!--   <div class="right" id="rightblock" style="width:170px;"> -->
                        <span id="product_type_span">
                        <?php /*?>
                        <select name="product_type_id[]" id="product_type_id" class="form-control selectpicker">                                     <option value="">ALL</option>
                            <?php
                             foreach($product_types as $product_type){
                                if($selectedcat==$product_type['cat_id']){
                            ?>
                                <option value="<?php echo $product_type['id'];?>" class="<?php echo $product_type['cat_id'];?> <?php if($product_type['cat_id']==$selectedcat) echo "selected";?>"  ><?php echo $product_type['product_type_name'];?></option>     
                            <?php
                                 if($selectedtype=='')
                                    $selectedtype=$product_type['id'];
                            }}
                            ?>                                                  
                        </select><?php */?>
                        <?php 
						 echo '<select name="product_type_id[]" id="product_type_id" class="form-control selectpicker">';
						 //echo '<option value="">All</option>';
						 foreach($product_types as $category)
						 {
							if($id=='')
								echo '<option value="'.$category['id'].'">'.$category['product_type_name'].'-'.$category['category_name'].'</option>';
							else
								echo '<option value="'.$category['id'].'">'.$category['product_type_name'].'</option>';
						 } 
						 echo '</select>';
						?>
                        </span>
                   <!--  </div> -->
                </div>
                
                <div class="col-md-2" style="">
                    <span id="product_maker_span">
                    <select name="maker_id[]" id="maker_id" class="form-control selectpicker" >
                        <!--<option value="">ALL</option>-->
                        <?php foreach($product_makers as $make){
                            if($selectedtype==$make['product_type_id'] && $selectedcat==$make['vehicle_category_id'])
                            ?>
                                <option value="<?php echo $make['id'];?>"><?php echo $make['maker_name'];?></option>
                        <?php } ?>
                    </select>
                    </span>
                    <!--<select class="form-control selectpicker">
                      <option value="eng" class="opt1">Car</option>
                    </select>-->
                </div>
                <div class="col-md-2" style="display:none;">
                    <span id="product_model_span">
                            <select name="model_id[]" id="model_id" class="form-control selectpicker" >													<!--<option value="">ALL</option>-->
                            <?php foreach($product_models as $model){?>
                                <option value="<?php echo $model['id'];?>"><?php echo $model['model_name'];?></option>
                            <?php }?>
                        </select>
                   </span>
                </div>
				
		<div class="col-md-2 fix-btn-search-ad">
            <button name="quicksearch"  type="submit" class="btn btn-primary btn-search-ad" id="quicker_search"><?php echo lang('search') ?></button>	
        </div>
		
                <div class="clear"></div>
                <!--<div class="col-md-2">
                    <select class="form-control selectpicker">
                      <option value="eng" class="opt1">Land Crusier</option>
                    </select>
                </div>-->
            </div>
        </div>        
    </div>
</form>