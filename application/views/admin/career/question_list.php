<script src="<?php echo site_url('assets/admin/js/jquery-1.10.1.min.js')?>" type="text/javascript" ></script>
<script>
function user_status(name,id,value){
    $.ajax({
       type: "POST",
       url: "admin/career/update_status", /* The country id will be sent to this file */
       data: "table_name="+name+"&id="+id+"&status="+value,
       beforeSend: function () {
        },
       success: function(msg){
       }
       });
} 
</script>
<script type="text/javascript">
function confirm_box(){
	var answer = confirm ("<?php echo lang('Are you sure?') ?>");
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
                    <h5><i class="font-user"></i><?php echo lang('Question');?></h5>
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
                                        	<th colspan="1" rowspan="1" width=""><?php echo lang('Question');?></th>
                                            <th colspan="1" rowspan="1" width="40" ><?php echo lang('Duration');?></th>
                                            <th colspan="1" rowspan="1" width="94" ><?php echo lang('Minimum Words');?></th>
                                            <th colspan="1" rowspan="1" width="40" ><?php echo lang('status');?></th>
                                            <th colspan="1" rowspan="1" width="90" ><?php echo lang('option');?></th>
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
	echo '<option value="1" selected="selected">'. lang('Active').'</option>';
	echo '<option value="0">Inactive</option>';
}
else if($set_data['status']==0){
	echo '<option value="1">Active</option>';
	echo '<option value="0" selected="selected">'. lang('Inactive').'</option>';
}
?>
                                        	
                                        </select>
				                	</td>
                                	<td class="dataTables" valign="top">
                                    <a href="admin/career/edit_question/<?php echo $job_data['id'];?>/<?php echo $set_data['id'];?>" ><?php echo lang('Edit') ?></a>&nbsp;&nbsp;
                                    <a href="admin/career/delete_question/<?php echo $job_data['id'];?>/<?php echo $set_data['id'];?>" onclick="return confirm_box();"><?php echo lang('Delete') ?></a>
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