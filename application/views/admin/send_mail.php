<div style="margin-right: 0px;" class="content">
    	<div id="result"></div>
    
    
        <div class="outer">
            <div class="inner">
                <div class="page-header">
		<!-- page title -->
                    <h5><i class="font-user"></i><?php echo $this->lang->line('').'Mail';?></h5>
            <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">

                       <!-- Pickers -->
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        	<input type="hidden" name="operation" value="set" />
                            <div class="row-fluid">
                                
                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar"><div class="navbar-inner"><h5><?php echo $this->lang->line('').'Mail';?></h5></div></div>
                                    
                                    <div class="control-group">
                                        <label class="control-label">Title:</label>
                                        <div class="controls"><input type="text" name="title" class="focustip span12" value="<?php echo set_value('title'); ?>" required ></div>
						                <span style="color:#F00;"><?php echo form_error('title'); ?></span>
                                    </div>
                                    
									<div class="control-group">
                                        <label class="control-label">Subject:</label>
                                        <div class="controls"><input type="text" name="subject" class="focustip span12" value="<?php echo set_value('title'); ?>" required ></div>
						                <span style="color:#F00;"><?php echo form_error('title'); ?></span>
                                    </div>
                                    
                                    <div class="control-group">
                                        <label class="control-label">Message:</label>
                                        <div class="controls"><textarea id="content" name="description" class="focustip span12" rows="10"></textarea></div>
                                    </div>
                                    
                                      <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="Send" id="send" type="submit">
                                                <input class="btn btn-danger" type="reset">
					</div>



                                            </div>
                                        
                                    </div>
                                    <!-- /time pickers -->


                                    
                                </div>
                                <!-- /column -->
                                
                            </form></div>
                        
                        <!-- /pickers -->

                    </div>
                    <!-- /content container -->
                
                </div>
            </div>
        </div>
    </div>