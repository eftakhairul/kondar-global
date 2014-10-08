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
                    var url = "admin/serial/deleteAll";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {'block_ids':blocksarray, 'table':'winner_list'},
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
                    <h5><i class="font-user"></i><?php echo $this->lang->line('').'Winners';?></h5>
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
                                        	 <th ><?php echo $this->lang->line('').'serial Code';?></th>
                                            <th ><?php echo $this->lang->line('').'Name';?></th>
                                            <th><?php echo $this->lang->line('').'Email';?></th> 
                                            <th><?php echo $this->lang->line('').'Winning Date';?></th>
                                            <th colspan="1" rowspan="1" width="100" ><?php echo $this->lang->line('').'Option';?></th>
                                        </tr>
                                    </thead>
                                    
                                <tbody aria-relevant="all" aria-live="polite" role="alert">
								<?php
                                if(isset($all_data)){
                                    foreach($all_data as $set_data){
                                ?>
                                <tr class="odd">

                                    <td class="dataTables" valign="top">
                                                                <input class="blocks" type="checkbox" name="delete_option[]" value="<?php echo $set_data['id']; ?>">
                                                            </td>
                                	
                                    <td class="dataTables" valign="top">
										<?php foreach($serial_codes as $serial_code){
												if($serial_code['id'] == $set_data['serial_id']){
													echo $serial_code['code'];
										} }?>
                                    </td> 
                                	<td class="dataTables" valign="top">
										<?php echo $set_data['name'];?>
                                    </td> 
                                      
                                	<td class="dataTables" valign="top">
										<?php echo $set_data['email'];?>
                                    </td> 
                                    
                                     <td class="dataTables" valign="top">
										<?php echo date('m/d/Y',$set_data['created_date']);?>
                                    </td>
                                    <td class="dataTables" valign="top"> 
                                        <a href="admin/serial/view_winner/<?php echo $set_data['id'];?>" >View</a>&nbsp;&nbsp;
                                        <a href="admin/serial/delete_winner/<?php echo $set_data['id'];?>" onclick="return confirm_box();">Delete</a>
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