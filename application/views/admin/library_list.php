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
                                            <th colspan="1" rowspan="1" width="90" ><?php echo $this->lang->line('').'Option';?></th>
                                            <?php /*?><th colspan="1" rowspan="1" width="40" ><?php echo $this->lang->line('option');?></th><?php */?>
                                        </tr>
                                    </thead>
                                    
                                <tbody aria-relevant="all" aria-live="polite" role="alert">
<?php
if(isset($all_data)){
	foreach($all_data as $set_data){
?>                                
                                                                        
                                	

                                	

									<tr height="">
                                    	<td width="270"><span style="font-size:large">Library Background</span></td>
                                    	<td>
<?php
if(isset($set_data['library_image'])&&$set_data['library_image']!=''){
	$background = 'assets/uploads/background/thumbnails/'.$set_data['library_image'];
}
else{
	$background = 'assets/uploads/profile.JPG';
}
?>  
                                                <img src="<?php echo $background;?>" height="100" width="100" />
										
										</td>                                        
                                        <td>
<?php
if($set_data['library_image']==''){
?>
                                        <a href="admin/index/edit_welcome_page/library/<?php echo $set_data['id'];?>">Upload</a>&nbsp;&nbsp;
<?php	
}
else{
?>
                                        <a href="admin/index/edit_welcome_page/library/<?php echo $set_data['id'];?>">Upload</a>&nbsp;&nbsp;
	                                    <a href="admin/index/empty_data/library/<?php echo $set_data['id'];?>" onclick="return confirm_box();">Delete</a>
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