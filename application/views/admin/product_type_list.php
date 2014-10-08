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
                    <h5><i class="font-user"></i><?php echo $this->lang->line('').'Product Type';?></h5>
            <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">
                        <!-- Default datatable -->
                        <div class="block well" style="margin-top:30px">
                        	<div class="navbar">
                            	<div class="navbar-inner">
                                	<h5><?php echo $this->lang->line('').'List';?></h5>
                                    <div class="control-group row-fluid width50_float_left">
                                    <form action="<?php echo base_url();?>admin/product_type/index" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="controls"><input type="search" id="search" name="search" value="<?php echo $search;?>" class="focustip span6" />
						                <span style="color:#F00;"></span>
                                        <input type="submit" id="search" value="Search" name="Submit" class="btn btn-primary" />
                                        </div>
                                   
                                    </div>
                                    <div class="dataTables_length" id="data-table_length">
                                		<label> 
                                        	<div id="" class="selector">
                                				<a class="" style="float:right;margin-right:10px" tabindex="0" id="data-table_first" href="admin/product_type/add_producttype">ADD</a>
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
                                        <th><input type="checkbox" id="checkall" class="checkall" onchange="$('.rowitemdelete').prop('checked',this.checked);"></th>
                                        	<th><?php echo $this->lang->line('').'Slno.';?></th>
                                            <th ><?php echo $this->lang->line('').'Product Type Name';?></th>
                                             <th ><?php echo $this->lang->line('').'Product Type Image';?></th>
                                             <th ><?php echo $this->lang->line('').'Category';?></th>
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
                                ?>
                                <tr class="odd">
                                <td><input type="checkbox" id="checkitem" class="rowitemdelete" name="deleteitem[]" value="<?php echo $set_data['id'];?>"></td>	
                                    <td	class="dataTables" valign="top">
                                        <?php echo $i;?>
                                    </td>
                                	<td class="dataTables" valign="top">
										<?php echo $set_data['product_type_name'];?>
                                    </td> 
                                    <td class="dataTables" valign="top"><img src="<?php echo './assets/uploads/product_type_images/'.$set_data['Product_Type_Photo'];?>" style="width:100px;"/>
                                    </td>
                                   
                                    <td class="dataTables" valign="top">
										<?php echo $set_data['category_name'];?>
                                    </td>
                                   
                                	<td class="dataTables" valign="top">
                                        <?php if($set_data['status'] == "0"){ echo "Unpublished";}else{ echo "Published";}?>
				                	</td>
                                	<td class="dataTables" valign="top">
                                    <a href="admin/product_type/edit_product/<?php echo $set_data['id'];?>">Edit</a>&nbsp;&nbsp;
                                    <a href="admin/product_type/delete_product/<?php echo $set_data['id'];?>" onclick="return confirm_box();">Delete</a>
                                    </td>
                                </tr>
<?php
	$i++;
	}
}
?>
 <tr>
<td colspan="17">
<input type="submit" id="DeleteSelected" value="Delete Selected" name="DeleteSelected" class="btn btn-primary"  onclick="return confirm_box();"/>
<input type="submit" id="DeleteAll" value="Delete All" name="DeleteAll" class="btn btn-primary"  onclick="return confirm_box();"/>
</td></tr>
                               </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                        <!-- /default datatable -->


                       <!-- Pickers -->
                        </div>
                        
                        <!-- /pickers -->
					</form>
                    </div>
                    <!-- /content container -->
                
                </div>
            </div>
        </div>
    </div>