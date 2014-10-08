<!-- Main content -->
<div style="margin-right: 0px;" class="content">
    


    <div class="outer">
        <div class="inner">
            <div class="page-header">
    <!-- page title -->
                <h5><i class="font-user"></i>Content</h5>
        <!-- End page title -->
            <div class="body">

                <!-- Content container -->
                <div class="container">
                    
                    <!-- Pickers -->
                    
                    <!-- /pickers -->
                
                    
                                
                    <!-- Loaders, tooltips -->
                    <div class="row-fluid" style="margin-top:30px">

                        <!-- Column -->
                        <div class="span12">
                            <!-- News list -->
                            <div class="block well">
                                <div class="navbar"><div class="navbar-inner"><h5>
<?php

if(isset($view_data)){
	echo $view_data['title'];
}
?>    
							</h5></div></div>
                                <table style="margin:5px 10px" border="0">
<?php
/*$my_user	= $this->comman_model->get_data_by_id('user',array('id'=>$login['']));

if($login[''])
*/
if(isset($view_data)){
?>                                
                                    </tr>
                                	<?php /*?><tr height="">
                                    	<td width="130"><span style="font-size:large">:</span></td>
                                    	<td><span style="font-size:16px"><?php echo $view_data['name'];?></span></td>
                                        <td rowspan="9">
                                        <div class="span3" style="width:auto">
                                            <div class="block well">                                
                                                <div class="control-group">
<?php
if(isset($view_data['image'])&&$view_data['image']!=''){
$image = 'assets/uploads/bookies/thumbnails/'.$view_data['image'];
}
?>                                
                                                <img src="<?php echo $image?>" height="200" width="200" />
                                                </div>
                                            </div>
                                        </div>
                                      	</td>
                                    </tr><?php */?>
                                                                        
                                	

                                	<tr height="">
                                    	<td ><span style="font-size:large">Description:</span></td>
                                    	<td width="700"><span style="font-size:16px"><?php echo $view_data['sort'];?></span></td>
                                    </tr>

                                	<tr height="">
                                    	<td ><span style="font-size:large">Date:</span></td>
                                    	<td><span style="font-size:16px"><?php echo date('d-m-Y',$view_data['update_date']);?></span></td>
                                    </tr>

                                	<tr height="">
                                    	<td ><span style="font-size:large">Status:</span></td>
                                    	<td><span style="font-size:16px"><?php echo $view_data['status']==1?'Active':'Inactive';?></span></td>
                                    </tr>
<?php
}
?>                                    
                                </table>
                        
                                
                            </div>
                            <!-- /news list -->

                        </div>
                    </div>
                    <!-- /loaders/ tooltips -->

                </div>
                <!-- /content container -->
            
            </div>
        </div>
    </div>
</div>
<!-- /content -->

<!-- Right sidebar -->
<div class="sidebar" id="right-sidebar">
    
</div>
<!-- /right sidebar -->    
</div>
<!-- /main wrapper -->