<script src="assets/user/js/jquery-1.10.1.min.js" type="text/javascript" ></script>
<script>
function user_status(name,id,value){
//	alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "admin/index/update_status", /* The country id will be sent to this file */
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
                    <h5><i class="font-user"></i><?php echo $this->lang->line('').'Question';?></h5>
            <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">
                        <!-- Default datatable -->
                        <div class="block well" style="margin-top:30px">
                        	<div class="navbar">
                            	<div class="navbar-inner">
                                	<h5><?php echo $job_data['name'];?></h5>                                    
                                </div>
                            </div>
                            <div class="table-overflow">
                                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                                <table aria-describedby="data-table_info" class="table table-striped dataTable" id="data-table">
                                    <thead>
                                        <tr role="row">
                                        	<th colspan="1" rowspan="1" width=""><?php echo $this->lang->line('').'Qestion';?></th>
                                            <th colspan="1" rowspan="1" width="40" ><?php echo $this->lang->line('').'Duration';?></th>
                                            <th colspan="1" rowspan="1" width="94" ><?php echo $this->lang->line('').'Minimum Words';?></th>
                                            <th colspan="1" rowspan="1" width="40" ><?php echo $this->lang->line('status');?></th>
                                            <th colspan="1" rowspan="1" width="90" ><?php echo $this->lang->line('option');?></th>
                                        </tr>
                                    </thead>
                                    
                                <tbody aria-relevant="all" aria-live="polite" role="alert">
<?php
if(isset($all_data)){
	foreach($all_data as $set_data){
		$question  = $this->comman_model->get_all_data_by_id('question',array('job_id'=>$set_data['id']));
?>
                                <tr class="odd">
                                	<td class="dataTables" valign="top">
		<?php echo $set_data['name'];?>
                                    </td>
                                	<td class="dataTables" valign="top">
		<?php echo $set_data['duration'].' min';?>  
                                    </td>                                	
                                	<td class="dataTables" valign="top">
		<?php echo $set_data['min_words'];?>  
                                    </td>                                	
                                	<td class="dataTables" valign="top">
										<select onchange="user_status('question',<?php echo $set_data['id'];?>,this.value)" style="width:100px" name="martial_id">
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
                                    <a href="admin/index/edit_question/<?php echo $job_data['id'];?>/<?php echo $set_data['id'];?>" >Edit</a>&nbsp;&nbsp;
                                    <a href="admin/index/delete_question/<?php echo $job_data['id'];?>/<?php echo $set_data['id'];?>" onclick="return confirm_box();">Delete</a>
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