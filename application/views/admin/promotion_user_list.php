<script src="assets/user/js/jquery-1.10.1.min.js" type="text/javascript" ></script>
<script>
function user_status(name,page,id,value){
	//alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "admin/index/update_status1", /* The country id will be sent to this file */
       data: "table_name="+name+"&page="+page+"&id="+id+"&value="+value,
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

$(document).ready(function() {
    
        $("#delete_all_btn").click(function(){
            if($("#delete_all_btn").is(':checked')){
                $(".blocks").prop('checked',true);
            }else{
                $(".blocks").prop('checked',false);
            }
        });
        $("#delete_checked").click(function(){            
            if($('input.blocks:checkbox:checked').length){
                var msg= "Are you sure???\nYou Want to Delete All.";
                var answer = confirm (msg);                
                if (answer){
                    var blocksarray = [];
                    $('input.blocks:checkbox:checked').each(function () {
                        blocksarray.push($(this).val());
                        $(this).parents('tr').hide();
                    });
                    var url = "admin/index/deleteAll";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {'block_ids':blocksarray, 'table':'promotion_form','deleteuser':true,'field':'email','where_field':'id'},
                        //async:false,
                        //dataType: "json",
                        success: function (data) {                            
                            $("#delete_all_btn").prop('checked',false);
                        }
                    });
                }}else {
                alert("Please select atleast one item.");
            }
        });            

    });

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
                    <h5><i class="font-user"></i><?php echo $label;?></h5>
            <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">
                        <!-- Default datatable -->
                        <div class="block well" style="margin-top:30px">
                        	<div class="navbar">
                            	<div class="navbar-inner">
                                	<h5><?php echo $this->lang->line('').'List';?></h5>
                                    <div class="pull-right" >
                                                <button id="delete_checked" style="padding: 4px;margin:5px;border: 1px solid #d5d5d5;" >Delete All</button>
                                            </div>
                                </div>
                            </div>
                            <div class="table-overflow">
                                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                                <table aria-describedby="data-table_info" class="table table-striped dataTable" id="data-table">
<?php
if(isset($all_data)){
?>
                                    <thead>
                                        <tr role="row">
                                            <th colspan="1" rowspan="1"><input id="delete_all_btn" type="checkbox" name="delete_option[]" value="all"></th>
                                            <th colspan="1" rowspan="1" width="150" ><?php echo $this->lang->line('').'User Code';?></th>
                                        	<th colspan="1" rowspan="1" width="100"><?php echo $this->lang->line('').'Name';?></th>
                                            <th colspan="1" rowspan="1" width="100" ><?php echo $this->lang->line('').'Email';?></th>
                                            <th colspan="1" rowspan="1" width="100" ><?php echo $this->lang->line('').'Contact';?></th>
                                            <th colspan="1" rowspan="1" width="100" ><?php echo $this->lang->line('').'Country';?></th>
                                            <th colspan="1" rowspan="1" width="150" ><?php echo $this->lang->line('').'Product Name';?></th>
                                            <th colspan="1" rowspan="1" width="150" ><?php echo $this->lang->line('').'Duration';?></th>
                                            <th colspan="1" rowspan="1" width="150" ><?php echo $this->lang->line('').'Download Limit';?></th>
                                            <th colspan="1" rowspan="1" width="150" ><?php echo $this->lang->line('').'Link';?></th>
                                            <th colspan="1" rowspan="1" width="150" ><?php echo $this->lang->line('').'Confirm';?></th>
                                            <th colspan="1" rowspan="1" width="150" ><?php echo $this->lang->line('').'Option';?></th>
                                        </tr>
                                    </thead>
								    <tbody aria-relevant="all" aria-live="polite" role="alert">

<?php
	foreach($all_data as $set_data){
		if($set_data['block']==0){			
			$job_data  = $this->comman_model->get_data_by_id('promotion_section',array('id'=>$set_data['promotion_id']));
?>
                                <tr class="odd">
                                    <td class="dataTables" valign="top">
                                        <input class="blocks" type="checkbox" name="delete_option[]" value="<?php echo $set_data['id']; ?>">
                                    </td>
                                	<td class="dataTables" valign="top">
		<?php echo $set_data['user_code'];?>  
                                    </td>                                	
                                	<td class="dataTables" valign="top">
		<?php echo $set_data['name'];?>
                                    </td>
                                	<td class="dataTables" valign="top">
		<?php echo $set_data['email'];?>  
                                    </td>                                	
                                	<td class="dataTables" valign="top">
		<?php echo $set_data['contact'];?>  
                                    </td>                                	
                                	<td class="dataTables" valign="top">
		<?php echo $set_data['country'];?>  
                                    </td>                                	
                                	<td class="dataTables" valign="top">
		<?php echo $job_data['name'];?>  
                                    </td>                                	
                                	<td class="dataTables" valign="top" >
										<select onchange="user_status('promotion_form','promotion_duration',<?php echo $set_data['id'];?>,this.value)" style="width:100px" name="martial_id">
<?php 
$i = 1;
for($i;$i<=100;$i++){
	$j=10*$i;
	
	if($set_data['duration']==$j){
		echo '<option value="'.$j.'" selected="selected">'.$j.' minutes</option>';
	}
	else{
			echo '<option value="'.$j.'">'.$j.' minutes</option>';
	}
}
?>
                                        	
                                        </select>
				                	</td>
                                	
                                	<td class="dataTables" valign="top" >
										<select onchange="user_status('promotion_form','promotion_download',<?php echo $set_data['id'];?>,this.value)" style="width:100px" name="martial_id">
<?php 
$i = 1;
for($i;$i<=10;$i++){
	if($set_data['total_download']==$i){
		echo '<option value="'.$i.'" selected="selected">'.$i.' times</option>';
	}
	else{
			echo '<option value="'.$i.'">'.$i.' times</option>';
	}
}
?>
                                        	
                                        </select>
				                	</td>
                                	<td class="dataTables" valign="top">
		<a href="home/user_form/<?php echo md5($set_data['id']); ?>" target="_blank">Link</a>
                                    </td>
                                	<td class="dataTables" valign="top">
<?php
if($set_data['confirm']=='confirm'){
	echo 'Confirm';
}
else{
	echo 'Not Confirm';
}
?>
                                    </td>
                                	<td class="dataTables" valign="top">
                                    <a href="admin/index/delete/promotion_user/<?php echo $set_data['id'];?>" onclick="return confirm_box();">Delete</a>
                                    </td>
                                </tr>
<?php
		}
	}
}
else if(isset($all_data1)){
?>
                                    <thead>
                                        <tr role="row">
                                            <th colspan="1" rowspan="1"><input id="delete_all_btn" type="checkbox" name="delete_option[]" value="all"></th>                                            
                                        	<th colspan="1" rowspan="1" width="100"><?php echo $this->lang->line('').'Name';?></th>
                                            <th colspan="1" rowspan="1" width="100" ><?php echo $this->lang->line('').'Email';?></th>
                                            <th colspan="1" rowspan="1" width="100" ><?php echo $this->lang->line('').'Contact';?></th>
                                            <th colspan="1" rowspan="1" width="100" ><?php echo $this->lang->line('').'Country';?></th>
                                            <th colspan="1" rowspan="1" width="100" ><?php echo $this->lang->line('').'Product Name';?></th>
                                            <th colspan="1" rowspan="1" width="150" ><?php echo $this->lang->line('').'Block';?></th>
                                            <th colspan="1" rowspan="1" width="150" ><?php echo $this->lang->line('').'Option';?></th>
                                        </tr>
                                    </thead>
								    <tbody aria-relevant="all" aria-live="polite" role="alert">

<?php
	foreach($all_data1 as $set_data){
		if($set_data['block']==1){
			$job_data  = $this->comman_model->get_data_by_id('promotion_section',array('id'=>$set_data['promotion_id']));
?>
                                <tr class="odd">
                                    <td class="dataTables" valign="top">
                                        <input class="blocks" type="checkbox" name="delete_option[]" value="<?php echo $set_data['id']; ?>">
                                    </td>
                                	<td class="dataTables" valign="top">
		<?php echo $set_data['name'];?>
                                    </td>
                                	<td class="dataTables" valign="top">
		<?php echo $set_data['email'];?>  
                                    </td>                                	
                                	<td class="dataTables" valign="top">
		<?php echo $set_data['contact'];?>  
                                    </td>                                	
                                	<td class="dataTables" valign="top">
		<?php echo $set_data['country'];?>  
                                    </td>                                	
                                	<td class="dataTables" valign="top">
		<?php echo $job_data['name'];?>  
                                    </td>                                	
                                	<td class="dataTables" valign="top">
<?php
//date_default_timezone_set('Asia/Calcutta');
$currentTime = time();
//echo '<br>current date: '.date('d-m-Y H:i',$currentTime);
//echo '<br> date: '.date('d-m-Y H:i',$set_data['block_time']);
$blockTime = strtotime('+120 minutes',$set_data['block_time']);
//echo '<br> add date: '.date('d-m-Y H:i',$blockTime);
if($blockTime>$currentTime){
	//$diff = $set_data['block_time'] - $currentTime;
	$diff = strtotime(date('d-m-Y',$currentTime)." 00:00:00") + ($blockTime - $currentTime);
	$h = date('H',$diff);
	$min = date('i',$diff);
	if($h==00||$h==0){
		$h =1;
		echo $min.' minutes';
	}
	else{
		echo (($h*60)+$min).' minutes';
	}
}
?>
                                    </td>
                                	
                                	<td class="dataTables" valign="top">
                                    <a href="admin/index/delete/promotion_block_user/<?php echo $set_data['id'];?>" onclick="return confirm_box();">Delete</a>
                                    </td>
                                </tr>
<?php
		}
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