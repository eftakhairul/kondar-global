<div style="margin-right: 0px;" class="content">
    	<div id="result"></div>
    
    
        <div class="outer">
            <div class="inner">
                <div class="page-header">
		<!-- page title -->
                    <h5><i class="font-user"></i><?php echo $this->lang->line('currency');?> List</h5>
            <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">
<?php
if(isset($currency_data)){
?>
                       <!-- Pickers -->
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        	<input type="hidden" name="operation" value="set" />
                        	<input type="hidden" name="id" value="<?php echo $currency_data['id'];?>" />
                            <div class="row-fluid">
                                
                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5>Edit <?php echo $this->lang->line('currency');?></h5></div></div>
                                    <div class="control-group">
                                        <label class="control-label">Currency Name:</label>
                                        <div class="controls"><input id="title2" name="title" class="focustip span12" type="text" value="<?php echo $currency_data['name']; ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('title'); ?></span>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Currency Address:</label>
                                        <div class="controls"><input id="title2" name="address" class="focustip span12" type="text" value="<?php echo $currency_data['address']; ?>" ></div>
						                <span style="color:#F00;"><?php echo form_error('address'); ?></span>
                                    </div>
                                    
                                    <?php /*?><div class="control-group">
                                        <label class="control-label">Price:</label>
                                        <div class="controls"><input id="title2" name="price" class="focustip span12" type="text" value="<?php echo $currency_data['price']; ?>" ></div>
						            	<span style="color:#F00;"><?php echo form_error('price'); ?></span>
                                    </div><?php */?>
                                                                        
                                    <div class="control-group">
                                        <label class="control-label">Buy Price ($):</label>
                                        <div class="controls"><input type="text" id="content" name="buy_price" class="focustip span12" value="<?php echo $currency_data['buy_price'];?>"></div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Sell Price ($):</label>
                                        <div class="controls"><input type="text" id="content" name="sell_price" class="focustip span12" value="<?php echo $currency_data['sell_price'];?>"></div>
                                    </div>
                                    
                                    <div class="control-group">
                                        <label class="control-label">Description:</label>
                                        <div class="controls"><textarea id="content" name="description" class="focustip span12" rows="10"><?php echo $currency_data['description']; ?></textarea></div>
                                    </div>
                                    
                                      <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="Update" id="send" type="submit">
					</div>



                                            </div>
                                        
                                    </div>
                                    <!-- /time pickers -->


                                    
                                </div>
                                <!-- /column -->
                                
                            </form>
<?php
}
?>                            
                     </div>
                        
                        <!-- /pickers -->

                    </div>
                    <!-- /content container -->
                
                </div>
            </div>
        </div>

    </div>