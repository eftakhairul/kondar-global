<script type="text/javascript">
function confirm_box(){
	var answer = confirm ("Are you sure?");
	if (!answer)
	 return false;
	}

</script>
<!-- Main content -->
<div style="margin-right: 0px;" class="content">
<?php
if($this->session->flashdata('success')) {
    $msg = $this->session->flashdata('success');
?>
    <div class="notice outer">
      <div class="note"><?php echo $msg;?>
      </div>
    </div>
<?php
}
?>    
<?php
if($this->session->flashdata('error')) {
    $msg = $this->session->flashdata('error');
?>
    <div class="notice outer">
      <div class="error"><?php echo $msg;?>
      </div>
    </div>
<?php
}
?>    
    


    <div class="outer">
        <div class="inner">
            <div class="page-header">
    <!-- page title -->
                <h5><i class="font-user"></i>Welcome Page Setting</h5>
        <!-- End page title -->
<div class="body">


                    <!-- Content container -->
                    <div class="container">
                        <!-- Default datatable -->
                        <div class="block well" style="margin-top:30px">
                        	<div class="navbar">
                            	<div class="navbar-inner">
                                	<h5><?php echo $this->lang->line('').'List';?></h5>
                                    
                                </div>
                            </div>
                            <div class="table-overflow">
                                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                                <table aria-describedby="data-table_info" class="table table-striped dataTable" id="data-table">
                                    <thead>
                                        <tr role="row">
                                        	<th colspan="1" rowspan="1" width="60"><?php echo $this->lang->line('').'Name';?></th>
                                            <th colspan="1" rowspan="1" ><?php echo $this->lang->line('').'Image';?></th>
                                            <th colspan="1" rowspan="1" width="40" ><?php echo $this->lang->line('').'Option';?></th>
                                            <?php /*?><th colspan="1" rowspan="1" width="40" ><?php echo $this->lang->line('option');?></th><?php */?>
                                        </tr>
                                    </thead>
                                    
                                <tbody aria-relevant="all" aria-live="polite" role="alert">
<?php
if(isset($all_data)){
	foreach($all_data as $set_data){
?>                                
                                                                        
                                	<tr height="120" class="odd">
                                    	<td ><span style="font-size:large">Time Position</span></td>
                                    	<td width="130"><span style="font-size:16px">
<?php 
if($set_data['time_position']=='top_left' ){
	echo 'Top Left'; 
}
else if($set_data['time_position']=='top_right' ){
	echo 'Top Right'; 
}
else if($set_data['time_position']=='bottom_left' ){
	echo 'Botttom Left'; 
}
else if($set_data['time_position']=='bottom_right' ){
	echo 'Bottom Right'; 
}
?>
										</span></td>
                                        <td><a href="admin/index/edit_welcome_page/time/<?php echo $set_data['id'];?>">Edit</a>&nbsp;&nbsp;</td>
                                    </tr>

                                	<tr height="" class="odd">
                                    	<td width=""><span style="font-size:large">Logo</span></td>
                                    	<td>
<?php
if(isset($set_data['logo'])&&$set_data['logo']!=''){
	$logo = 'assets/uploads/logo/thumbnails/'.$set_data['logo'];
}
else{
	$logo = 'assets/uploads/profile.JPG';
}
?>  
                                                <img src="<?php echo $logo;?>" height="100" width="100" />
										
										</td>                                        
                                        <td>
<?php
if($set_data['logo']==''){
?>
                                        <a href="admin/index/edit_welcome_page/logo/<?php echo $set_data['id'];?>">Upload</a>&nbsp;&nbsp;
<?php	
}
else{
?>
                                        <a href="admin/index/edit_welcome_page/logo/<?php echo $set_data['id'];?>">Upload</a>&nbsp;&nbsp;
	                                    <a href="admin/index/empty_data/logo/<?php echo $set_data['id'];?>" onclick="return confirm_box();">Delete</a>
<?php	
}
?> 
                                        
                                        </td>
                                    </tr>

									<tr height="">
                                    	<td width="270"><span style="font-size:large">Background Image</span></td>
                                    	<td>
<?php
if(isset($set_data['background_image'])&&$set_data['background_image']!=''){
	$background = 'assets/uploads/background/thumbnails/'.$set_data['background_image'];
}
else{
	$background = 'assets/uploads/profile.JPG';
}
?>  
                                                <img src="<?php echo $background;?>" height="100" width="100" />
										
										</td>                                        
                                        <td>
<?php
if($set_data['background_image']==''){
?>
                                        <a href="admin/index/edit_welcome_page/background/<?php echo $set_data['id'];?>">Upload</a>&nbsp;&nbsp;
<?php	
}
else{
?>
                                        <a href="admin/index/edit_welcome_page/background/<?php echo $set_data['id'];?>">Upload</a>&nbsp;&nbsp;
	                                    <a href="admin/index/empty_data/background/<?php echo $set_data['id'];?>" onclick="return confirm_box();">Delete</a>
<?php	
}
?>                                         
                                        </td>
                                    </tr>
                                    
                                    <tr height="">
                                    	<td width="170"><span style="font-size:large">Globe Image</span></td>
                                    	<td>
<?php
if(isset($set_data['globe_image'])&&$set_data['globe_image']!=''){
	$globe = 'assets/uploads/logo/thumbnails/'.$set_data['globe_image'];
}
else{
	$globe = 'assets/uploads/profile.JPG';
}
?>  
                                                <img src="<?php echo $globe;?>" height="100" width="100" />
										
										</td>                                        
                                        <td>
<?php
if($set_data['globe_image']==''){
?>
                                        <a href="admin/index/edit_welcome_page/globe/<?php echo $set_data['id'];?>">Upload</a>&nbsp;&nbsp;
<?php	
}
else{
?>
                                        <a href="admin/index/edit_welcome_page/globe/<?php echo $set_data['id'];?>">Upload</a>&nbsp;&nbsp;
	                                    <a href="admin/index/empty_data/globe/<?php echo $set_data['id'];?>" onclick="return confirm_box();">Delete</a>
<?php	
}
?> 
                                        </td>
                                    </tr>                                   

									<tr height="120">
                                    	<td ><span style="font-size:large">Globe Position</span></td>
                                    	<td width="130"><span style="font-size:16px">
<?php 
if($set_data['globe_position']=='left' ){
	echo 'Left Position'; 
}
else if($set_data['globe_position']=='right' ){
	echo 'Right Position'; 
}
else if($set_data['globe_position']=='center' ){
	echo 'Center Position'; 
}
?>
										</span></td>
                                        <td><a href="admin/index/edit_welcome_page/globe_position/<?php echo $set_data['id'];?>">Edit</a>&nbsp;&nbsp;</td>
                                    </tr>                                    
                                    
                                    <tr height="120">
                                    	<td ><span style="font-size:large">Globe Size</span></td>
                                    	<td width="130"><span style="font-size:16px">
<?php 
if($set_data['globe_size']=='large'){
	echo 'Large'; 
}
else if($set_data['globe_size']=='meduim'){
	echo 'Meduim'; 
}
else if($set_data['globe_size']=='small' ){
	echo 'Small'; 
}
?>
										</span></td>
                                        <td><a href="admin/index/edit_welcome_page/globe_size/<?php echo $set_data['id'];?>">Edit</a>&nbsp;&nbsp;</td>
                                    </tr>
                                    
                                    <tr height="120">
                                    	<td ><span style="font-size:large">Product Position</span></td>
                                    	<td width="130"><span style="font-size:16px">
<?php 
if($set_data['product_position']=='left' ){
	echo 'Left Position'; 
}
else if($set_data['product_position']=='right' ){
	echo 'Right Position'; 
}
else if($set_data['product_position']=='center' ){
	echo 'Center Position'; 
}
?>
										</span></td>
                                        <td><a href="admin/index/edit_welcome_page/product_position/<?php echo $set_data['id'];?>">Edit</a>&nbsp;&nbsp;</td>
                                    </tr>                                    
                                    
                                    <tr height="120">
                                    	<td width="170"><span style="font-size:large">Footer Name</span></td>
                                    	<td><?php echo $set_data['footer_name'];?></td>                                        
                                        <td>
<?php
if($set_data['footer_name']==''){
?>
                                        <a href="admin/index/edit_welcome_page/footer_name/<?php echo $set_data['id'];?>">Add</a>&nbsp;&nbsp;
<?php	
}
else{
?>
                                        <a href="admin/index/edit_welcome_page/footer_name/<?php echo $set_data['id'];?>">Edit</a>&nbsp;&nbsp;
	                                    <a href="admin/index/empty_data/footer_name/<?php echo $set_data['id'];?>" onclick="return confirm_box();">Delete</a>
<?php	
}
?> 
                                        </td>
                                    </tr>
                                      <tr height="120">
                                    	<td width="170"><span style="font-size:large">Admin Mail ID</span></td>
                                    	<td><?php echo $set_data['admin_mail'];?></td>                                        
                                        <td>
<?php
if($set_data['admin_mail']==''){
?>
                                        <a href="admin/index/edit_home_page/admin_mail/<?php echo $set_data['id'];?>">Add</a>&nbsp;&nbsp;
<?php	
}
else{
?>
                                        <a href="admin/index/edit_home_page/admin_mail/<?php echo $set_data['id'];?>">Edit</a>&nbsp;&nbsp;
	                                    <a href="admin/index/empty_data/admin_mail/<?php echo $set_data['id'];?>" onclick="return confirm_box();">Delete</a>
<?php	
}
?> 
                                        </td>
                                    </tr>
                                    <tr height="120">
                                    	<td width="170"><span style="font-size:large">Footer</span></td>
                                    	<td>
<?php
if(isset($set_data['footer_image'])&&$set_data['footer_image']!=''){
	$footer = 'assets/uploads/footer/thumbnails/'.$set_data['footer_image'];
}
else{
	$footer = 'assets/uploads/profile.JPG';
}
?>  
                                                <img src="<?php echo $footer;?>" height="100" width="100" />
										
										</td>                                        
                                        <td>
<?php
if($set_data['footer_image']==''){
?>
                                        <a href="admin/index/edit_welcome_page/footer/<?php echo $set_data['id'];?>">Upload</a>&nbsp;&nbsp;
<?php	
}
else{
?>
                                        <a href="admin/index/edit_welcome_page/footer/<?php echo $set_data['id'];?>">Upload</a>&nbsp;&nbsp;
	                                    <a href="admin/index/empty_data/footer/<?php echo $set_data['id'];?>" onclick="return confirm_box();">Delete</a>
<?php	
}
?> 
                                       
                                        </td>
                                    </tr>
                                    
<?php
	}
}
?>                                    
                                </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                        <!-- /default datatable -->


                       <!-- Pickers -->
                        </div>
                        
                        <!-- /pickers -->

                    </div>
			  
        </div>
    </div>
</div>
<!-- /content -->

<!-- Right sidebar -->

<!-- /right sidebar -->    
</div>
<!-- /main wrapper -->