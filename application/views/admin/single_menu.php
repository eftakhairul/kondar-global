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
                    <h5><i class="font-user"></i><?php echo $this->lang->line('').'Menu Information';?></h5>
            <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">
                        <!-- Default datatable -->
                        <div class="block well" style="margin-top:30px">
                            <div class="table-overflow">
                                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                                <table aria-describedby="data-table_info" class="table table-striped dataTable" id="data-table">
                                    <thead>
                                        <tr role="row">
                                        	<th colspan="1" rowspan="1" width="60"><?php echo $this->lang->line('').'Name';?></th>
                                            <th colspan="1" rowspan="1" ><?php echo $this->lang->line('').'Image';?></th>
                                            <?php /*?><th colspan="1" rowspan="1" width="40" ><?php echo $this->lang->line('option');?></th><?php */?>
                                        </tr>
                                    </thead>
                                    
                                <tbody aria-relevant="all" aria-live="polite" role="alert">
<?php
if(isset($menu_name)){ ?>
                                <tr class="odd">
                                	<td class="dataTables" valign="top">
                                		<?php echo $menu_name;?>
                                    </td>
                                    
                                	<td class="dataTables" valign="top">
										<?php
										 if(isset($menu_image) && !empty($menu_image)){
											$logo = 'assets/uploads/menus/'.$menu_image;
										}
										else{
											$logo = 'assets/uploads/profile.jpg';
										} 
										?>  
                                   		<img src="<?php echo $logo;?>" height="100" width="100" />

                                    </td>                                	
                                	
                                	<td class="dataTables" valign="top">
	                                    <a href="admin/index/edit_menu/<?php echo $menu_name; ?>">Edit</a>&nbsp;&nbsp;
                                    </td>
                                </tr>
<?php
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