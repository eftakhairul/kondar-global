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
		   $("#show_class").show();
 		   $("#show_class").html("Loading ...");
        },
       success: function(msg){
		 var msg = "Serial Code status successfully updated. ";
         $("#show_class").html(msg);
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
                    var url = "admin/cart/deleteAll";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {'block_ids':blocksarray, 'table':'cart_users'},
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
	<div id="show_class" class="note" style="display:none;"></div>  
    	<div id="result"></div>    
        <div class="outer">
            <div class="inner">
                <div class="page-header">
		<!-- page title -->
                    <h5><i class="font-user"></i><?php echo $this->lang->line('').'Order Details';?></h5>
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
                                        <button id="delete_checked" style="padding: 4px;margin: 5px;border: 1px solid #d5d5d5;" >Delete All</button>
                                    </div>                                   
                                </div>                                
                            </div>
                            <div class="table-overflow">
                                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                                <table aria-describedby="data-table_info" class="table table-striped dataTable" id="data-table">
                                    <thead>
                                        <tr role="row">
                                            <th colspan="1" rowspan="1"><input id="delete_all_btn" type="checkbox" name="delete_option[]" value="all"></th>
                                        	<th><?php echo $this->lang->line('').'Slno.';?></th>	
                                        	<th><?php echo $this->lang->line('').'Date';?></th>
                                            <th ><?php echo $this->lang->line('').'Name';?></th>
                                            <th ><?php echo $this->lang->line('').'Company Name';?></th>
                                            <th><?php echo $this->lang->line('').'Designation';?></th>
                                            <?php /*?><th><?php echo $this->lang->line('').'Country';?></th>
                                            
                                            <th><?php echo $this->lang->line('').'Telephone';?></th><?php */?>
                                            <th><?php echo $this->lang->line('').'Email';?></th>
                                            <th><?php echo $this->lang->line('').'Deadline';?></th>
                                            
                                            <th><?php echo $this->lang->line('').'rfq';?></th>
                                           <?php /*?> <th><?php echo $this->lang->line('').'incoterms';?></th><?php */?>
                                            <th><?php echo $this->lang->line('').'Status';?></th>

                                        </tr>
                                    </thead>
                                    
                                <tbody aria-relevant="all" aria-live="polite" role="alert">
                                
                                 <?php if(empty($all_data)){?>
                                    <tr class="odd">
                                        <td class="dataTables" valign="top" colspan="5">Not Available</td> 
                                    </tr>
                                <?php }?>
                                
								<?php
								$i=1;
                                if(isset($all_data)){
                                    foreach($all_data as $set_data){
									$timestamp = $set_data->created_date;
									$splitTimeStamp = explode(" ",$timestamp);
									$date = $splitTimeStamp[0];
									$time = $splitTimeStamp[1];
									
                                ?>
                                <tr class="odd">
                                    <td class="dataTables" valign="top">
                                        <input class="blocks" type="checkbox" name="delete_option[]" value="<?php echo $set_data->id; ?>">
                                    </td>
                                	 <td class="dataTables" valign="top">
									 	<?php echo $i;?>
                                     </td>
                                	 <td class="dataTables" valign="top">
										<?php echo $date;?>
                                    </td> 
                                    
                                    <td class="dataTables" valign="top">
										<?php echo $set_data->user_name;?>
                                    </td> 
                                    <td class="dataTables" valign="top">
										<?php echo $set_data->company;?>
                                    </td> 
                                    <td class="dataTables" valign="top">
										<?php echo $set_data->designation;?>
                                    </td> 
                                   <?php /*?> <td class="dataTables" valign="top">
										<?php echo $set_data->country;?>
                                    </td> 
                                    <td class="dataTables" valign="top">
										<?php echo $set_data->telephone;?>
                                    </td> <?php */?>
                                    <td class="dataTables" valign="top">
										<?php echo $set_data->email;?>
                                    </td> 
                                    <td class="dataTables" valign="top" style="width: 85px;">
										<?php echo $set_data->deadline;?>
                                    </td> 
                                    <td class="dataTables" valign="top">
										<?php echo $set_data->rfq;?>
                                    </td> 
                                     </td> 
                                   <?php /*?> <td class="dataTables" valign="top">
										<?php echo $set_data->incoterms;?>
                                    </td> <?php */?>
                                    <?php if($set_data->status==1){?>
                                    <td class="dataTables" valign="top">
										<?php echo "Published";?>
                                    </td> 
                                    <?php }else {?>
                                    <td class="dataTables" valign="top">
										<?php echo "UnPublished";?>
                                    </td> 
                                    <?php }?>
                                    
                                    
                                    <td class="dataTables" valign="top" style="width: 85px;">
										<a href="admin/cart/listcart/<?php echo $set_data->id;?>">View&nbsp;&nbsp;(<?php echo $set_data->count_of_cart;?>)</a>&nbsp;&nbsp;
                                        <a href="admin/cart/delete/<?php echo $set_data->id;?>">Delete</a>
                                    </td>
                                </tr>
<?php
	$i++;
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