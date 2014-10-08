<script src="assets/user/js/jquery-1.10.1.min.js" type="text/javascript" ></script>
<script>
function user_status(name,id,value){
//	alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "admin/update_status", /* The country id will be sent to this file */
       data: "table_name="+name+"&id="+id+"&status="+value,
       beforeSend: function () {
	//	   alert('asa');
  //    $("#show_class").html("Loading ...");
        },
       success: function(msg){
		// alert(msg);
         //$("#show_class").html(msg);
       }
       });
} 
</script>
<script type="text/javascript">
function confirm_box(){
	var answer = confirm ("Are you sure?");
	if (!answer)
	 return false;
	}

</script> 


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
    	<div id="result"></div>    
        <div class="outer">
            <div class="inner">
                <div class="page-header">
		<!-- page title -->
                    <h5><i class="font-user"></i><?php echo $this->lang->line('').'Slider';?></h5>
            <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">
                        <!-- Default datatable -->
                        <div class="block well" style="margin-top:30px">
                        	<div class="navbar">
                            	<div class="navbar-inner">
                                	<h5><?php echo $this->lang->line('').'List';?></h5>
                                    <div class="dataTables_length" id="data-table_length">
                                		<label> 
                                        	<div id="" class="selector">
                                				<a class="" style="float:right;margin-right:10px" tabindex="0" id="data-table_first" href="admin/index/add_slider">
												<?php echo $this->lang->line('add');?></a>
                                			</div>
                                        </label>
                               		</div>
                                </div>
                            </div>
                            <div class="table-overflow">
                                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                                <table aria-describedby="data-table_info" class="table table-striped dataTable" id="data-table">
                                    <thead>
                                        <tr role="row">
                                        	<th colspan="1" rowspan="1" width="60"><?php echo $this->lang->line('').'Name';?></th>
                                            <th colspan="1" rowspan="1" ><?php echo $this->lang->line('').'Image';?></th>
                                            <th colspan="1" rowspan="1" width="40" ><?php echo $this->lang->line('status');?></th>
                                            <?php /*?><th colspan="1" rowspan="1" width="40" ><?php echo $this->lang->line('option');?></th><?php */?>
                                        </tr>
                                    </thead>
                                    
                                <tbody aria-relevant="all" aria-live="polite" role="alert">
<?php
if(isset($all_data)){
	foreach($all_data as $set_data){
?>
                                <tr class="odd">
                                	<td class="dataTables" valign="top">
		<?php echo $set_data['name'];?>
                                    </td>
                                	<td class="dataTables" valign="top">
<?php
if(isset($set_data['image'])&&$set_data['image']!=''){
	$logo = 'assets/uploads/slider/thumbnails/'.$set_data['image'];
}
else{
	$logo = 'assets/uploads/profile.JPG';
}
?>  
                                    <img src="<?php echo $logo;?>" height="100" width="100" />

                                    </td>                                	
                                	<td class="dataTables" valign="top">
										<select onchange="user_status('slider',<?php echo $set_data['id'];?>,this.value)" style="width:100px" name="martial_id">
<?php 
if($set_data['status']==1){
	echo '<option value="1" selected="selected">Active</option>';
	echo '<option value="0">Inactive</option>';
}
else if($set_data['status']==0){
	echo '<option value="1">Active</option>';
	echo '<option value="0" selected="selected">Inactive</option>';
}
?>
                                        	
                                        </select>
				                	</td>
                                	<td class="dataTables" valign="top">
                                    <a href="admin/index/edit_slider/<?php echo $set_data['id'];?>" >Edit</a>&nbsp;&nbsp;
                                    <a href="admin/index/delete/slider/<?php echo $set_data['id'];?>" onclick="return confirm_box();">Delete</a>
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
                    <!-- /content container -->
                
                </div>
            </div>
        </div>
    </div>