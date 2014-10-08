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
<script>
$(document).ready(function(e) {	
	$(".mainrow .minimize_block").click(function(){	 
		if($(this).val()=='+')
			$(this).val('-');
		else
			$(this).val('+');	
	  	$(this).closest(".mainrow").next(".detailedrow").toggle(100);
	});
});	
</script>
<style>
	.MainHeadDetailsBlock{/*padding: 5px 5px;*/}
	.MainHeadDetailsBlock .LeftPanel{float:left; padding-left: 14px; padding: 15px 14px 15px 23px; width: 40%;}
	.MainHeadDetailsBlock .LeftPanel .title{width: 105px; font-weight: bold;}
	.MainHeadDetailsBlock .RightPanel{float:left; padding: 15px 14px 15px 14px; width: 50%;}
	.MainHeadDetailsBlock .RightPanel .title{width: 105px; font-weight: bold;}
	.detailedrow{display:none;}
	.minimize_block{padding:5px;font-size:14px;}
	.single_product_wrapper {
			
	}
	.single_product_wrapper .detail_wrap {
		width:50%;
		float:left;
	}
	.single_product_wrapper .detail_wrap .single_detail {
		padding:5px;
	}
	.single_product_wrapper .detail_wrap .single_detail span:first-child {
		font-weight:bold;
	}
</style>

<br />

	<div id="show_class" class="note" style="display:none;"></div>  
    	<div id="result"></div>    
        <div class="outer">
            <div class="inner">
                <div class="page-header">
		<!-- page title -->
                    <h5><i class="font-user"></i><?php echo $this->lang->line('').'Product';?></h5>
            <!-- End page title -->
                <div class="body">
					<form action="<?php echo base_url();?>admin/product/index" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <!-- Content container -->
                    <div class="container">
                        <!-- Default datatable -->
                        <div class="block well" style="margin-top:30px">
                        	<div class="navbar">
                            	<div class="navbar-inner">
                                	<h5><?php echo $this->lang->line('').'List';?></h5>
                                    <div class="control-group row-fluid width50_float_left">
                                    
                                        <div class="controls"><input type="search" id="search" name="search" value="<?php echo $search;?>" class="focustip span6" />
						                <span style="color:#F00;"></span>
                                        <input type="submit" id="search" value="Search" name="Submit" class="btn btn-primary" />
                                        </div>
                                    
                                    </div>
                                    <div class="dataTables_length" id="data-table_length">
                                		<label> 
                                        	<div id="" class="selector">
                                				<a class="" style="float:right;margin-right:10px" tabindex="0" id="data-table_first" href="admin/product/add_product">ADD</a>
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
                                            <th ><?php echo $this->lang->line('').'KGT_Ref.';?></th>
                                            <th ><?php echo $this->lang->line('').'VEHICLE NAME';?></th>
                                            <th><?php echo $this->lang->line('').'MAKER';?></th>
                                            <th><?php echo $this->lang->line('').'PRODUCT TYPE';?></th>
                                            <th colspan="1" rowspan="1" width="100" ><?php echo $this->lang->line('').'Option';?></th>
                                        </tr>
                                    </thead>
                                    
                                <tbody aria-relevant="all" aria-live="polite" role="alert">
                                <?php if(empty($all_data)){?>
                                    <tr class="odd">
                                        <td class="dataTables" valign="top" colspan="16">Not Available</td> 
                                    </tr>
                                <?php }?>
								<?php
								$i=1;
                                if(isset($all_data)){
                                    foreach($all_data as $set_data){
									$privilage=explode('#',$set_data['menuprivilages']); 
                                ?>
                                <tr class="odd mainrow">
                                	<th><input type="checkbox" id="checkitem" class="rowitemdelete" name="deleteitem[]" value="<?php echo $set_data['id'];?>"></th>	
                                    <th><?php echo $i;?></th>
                                	<td><?php echo $set_data['kgt_ref_number'];?></td> 
                                    <td><?php echo $set_data['vehiclecat_name'];?></td>
                                    <td><?php echo $set_data['makername'];?></td>
                                    <td><?php echo $set_data['protype_name'];?></td>
                 
                                    <td class="dataTables" valign="top">
                                        <a href="admin/product/edit_product/<?php echo $set_data['id'];?>">Edit</a>&nbsp;&nbsp;
                                        <a href="admin/product/delete_product/<?php echo $set_data['id'];?>" onclick="return confirm_box();">Delete</a>
                                    </td>
                                      <td><input type="button" id="minimize_block_<?php echo $set_data['id'];?>" class="minimize_block" name="minimize_block" value="+"></td>
                               </tr>
                               <tr class="detailedrow minimize_block_<?php echo $set_data['id'];?>">
									<td colspan="11" style="padding-left: 68px;">
                                    <div class="single_product_wrapper">
                                        <div class="detail_wrap" style="text-align:left">
                                          
                                          <?php if(in_array("knect", $privilage)){?>
                                                <div class="single_detail">
                                                    <span>KNECT :</span>
                                                    <span><?php echo $set_data['knect'];?></span>
                                                </div>
                                            <?php } ?>
                                            <?php if(in_array("filtron", $privilage)){?>
                                                <div class="single_detail">
                                                    <span>FILTRON :</span>
                                                    <span><?php echo $set_data['filtron'];?></span>
                                                </div>
                                           <?php } ?>
                                           <?php if(in_array("modelname", $privilage)){?>
                                                <div class="single_detail">
                                                    <span>FILTRON :</span>
                                                    <span><?php echo $set_data['modelname'];?></span>
                                                </div>
                                           <?php } ?>
                                           <?php if(in_array("purflux", $privilage)){?>
                                                <div class="single_detail">
                                                    <span>PURFLUX :</span>
                                                    <span><?php echo $set_data['purflux'];?></span>
                                                </div>
                                             <?php } ?>
                                             <?php if(in_array("mecafilter", $privilage)){?>   
                                                <div class="single_detail">
                                                    <span>MECAFILER :</span>
                                                    <span><?php echo $set_data['mecafilter'];?></span>
                                                </div>
                                             <?php } ?>
                                             <?php if(in_array("oem_part_number", $privilage)){?>
                                                <div class="single_detail">
                                                    <span>OEM PART NUMBER :</span>
                                                    <span><?php echo $set_data['oem_part_number'];?></span>
                                                </div>
                                             <?php } ?>
                                             <?php if(in_array("mann", $privilage)){?>
                                                 <div class="single_detail">
                                                    <span>MANN :</span>
                                                    <span><?php echo $set_data['mann'];?></span>
                                                </div>
                                             <?php } ?>
                                             <?php if(in_array("application", $privilage)){?> 
                                                <div class="single_detail">
                                                    <span>APPLICATION :</span>
                                                    <span><?php echo $set_data['application'];?></span>
                                                </div>
                                             <?php } ?>
                                             <?php if(in_array("fleet", $privilage)){?>
                                                <div class="single_detail">
                                                    <span>FLEET :</span>
                                                    <span><?php echo $set_data['fleet'];?></span>
                                                </div>
                                             <?php } ?>
                                             <?php if(in_array("baldwin", $privilage)){?>
                                                <div class="single_detail">
                                                    <span>BALDWIN :</span>
                                                    <span><?php echo $set_data['baldwin'];?></span>
                                                </div>
                                             <?php } ?>
                                             <?php if(in_array("others", $privilage)){?> 
                                                <div class="single_detail">
                                                    <span>OTHER :</span>
                                                    <span><?php echo $set_data['others'];?></span>
                                                </div>
                                             <?php } ?>
                                             <?php if(in_array("fmsi_ref_number", $privilage)){?>  
                                                <div class="single_detail">
                                                    <span>FMSI Ref. :</span>
                                                    <span><?php echo $set_data['fmsi_ref_number'];?></span>
                                                </div>
                                             <?php } ?>
                                             <?php if(in_array("year", $privilage)){?>  
                                                <div class="single_detail">
                                                    <span>YEAR :</span>
                                                    <span><?php echo $set_data['year'];?></span>
                                                </div>
                                             <?php } ?>
                                             <?php if(in_array("front_rear", $privilage)){?> 
                                                <div class="single_detail">
                                                    <span>F/R :</span>
                                                    <span><?php echo $set_data['front_rear'];?></span>
                                                </div>
                                             <?php } ?>
                                             <?php if(in_array("designation", $privilage)){?>  
                                                <div class="single_detail">
                                                    <span>DESIGNATION :</span>
                                                    <span><?php echo $set_data['designation'];?></span>
                                                </div>
                                             <?php } ?>
                                             <?php if(in_array("wva", $privilage)){?>    
                                                <div class="single_detail">
                                                    <span>WVA :</span>
                                                    <span><?php echo $set_data['wva'];?></span>
                                                </div>
                                             <?php } ?>
                                             <?php if(in_array("qty", $privilage)){?>    
                                                <div class="single_detail">
                                                    <span>QUANTITY :</span>
                                                    <span><?php echo $set_data['qty'];?></span>
                                                </div>
                                             <?php } ?>
                                             <?php if(in_array("diameter", $privilage)){?>   
                                                <div class="single_detail">
                                                    <span>DIAMETER :</span>
                                                    <span><?php echo $set_data['diameter'];?></span>
                                                </div>
                                             <?php } ?>
                                             <?php if(in_array("width", $privilage)){?>    
                                                <div class="single_detail">
                                                    <span>WIDTH :</span>
                                                    <span><?php echo $set_data['width'];?></span>
                                                </div>
                                             <?php } ?>
                                             <?php if(in_array("holes_no", $privilage)){?>   
                                                <div class="single_detail">
                                                    <span>HOLES NO. :</span>
                                                    <span><?php echo $set_data['holes_no'];?></span>
                                                </div>
                                             <?php } ?>
                                        </div>
                                        <div class="detail_wrap" style="text-align:center">
                                        <?php if(in_array("drawing_photo", $privilage)){?>  
                                                <?php if($set_data['drawing_photo']!=''){?>
                                                    <img src="./assets/uploads/product_images/<?php echo $set_data['drawing_photo'];?>"  width="95" height="80" />
                                                <?php }else {?>
                                                    <img src="./assets/admin/previewimage.jpg" width="95" height="80" />
                                                <?php }?>
                                         <?php } ?>
                                         <?php if(in_array("product_photo", $privilage)){?>   
                                                 <?php if($set_data['product_photo']!=''){?>   
                                                    <img src="./assets/uploads/product_images/<?php echo $set_data['product_photo'];?>"  width="95" height="80" />
                                                  <?php }else {?>
                                                    <img src="./assets/admin/previewimage.jpg" width="95" height="80" />
                                                <?php }?>  
                                         <?php } ?>
                                         <?php if(in_array("vehicle_photo", $privilage)){?> 
                                                <?php if($set_data['vehicle_photo']!=''){?> 
                                                    <img src="./assets/uploads/product_images/<?php echo $set_data['vehicle_photo'];?>" width="95" height="80" />
                                                <?php }else {?>
                                                    <img src="./assets/admin/previewimage.jpg" width="95" height="80" />
                                                <?php }?>
                                          <?php } ?>       
                                        </div>
                                        <div class="clear"></div>
                                    </div>
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