<script src="assets/user/js/jquery-1.10.1.min.js" type="text/javascript" ></script>

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
                    <h5><i class="font-user"></i><?php echo $this->lang->line('').'Cart Blocked Users';?></h5>
                    
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
                                				<a class="" href="admin/cart/delete_blocked_all" style="float:right;margin-right:10px" tabindex="0" id="data-table_first" href="admin/index/add_language">
												Delete All</a>
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
                                        	<th ><?php echo $this->lang->line('').'Sl No.';?></th>
                                            <th ><?php echo $this->lang->line('').'Name and Surname';?></th>
                                            <th ><?php echo $this->lang->line('').'Email';?></th>
                                            <th ><?php echo $this->lang->line('').'Country';?></th>
                                            <th ><?php echo $this->lang->line('').'Telephone';?></th>
                                            <th ><?php echo $this->lang->line('').'Time Remaining';?></th>
                                            <th colspan="1" rowspan="1" width="100" ><?php echo $this->lang->line('').'Option';?></th>
                                        </tr>
                                    </thead>
                                    
                                <tbody aria-relevant="all" aria-live="polite" role="alert">
								<?php
                                if(isset($all_data))
								{
									$i=1;
									//var_dump($all_data);
                                    foreach($all_data as $set_data)
									{
										$currenttimestamp = time();
										$time = time() - $set_data->created_time;
										$remaining = round($time/60, 0);
										$remaining = 120 - $remaining;
										
										if($time < 7200)
										{
										?>
                                            <tr class="odd">
                                                <td class="dataTables" valign="top">
                                                    <?php echo $i;?>
                                                </td>
                                                
                                                <td class="dataTables" valign="top">
                                                    <?php echo $set_data->user_name;?>
                                                </td>
                                                
                                                <td class="dataTables" valign="top">
                                                    <?php echo $set_data->email;?>
                                                </td> 
                                                
                                                <td class="dataTables" valign="top">
                                                    <?php echo $set_data->country;?>
                                                </td>
                                                
                                                <td class="dataTables" valign="top">
                                                    <?php echo $set_data->telephone;?>
                                                </td>
                                                
                                                <td class="dataTables" valign="top">
                                                    <?php echo $remaining; ?> minutes
                                                </td> 
                                                
                                                <td class="dataTables" valign="top"> 
                                                    <a href="admin/cart/delete_blocked/<?php echo $set_data->id;?>" onclick="return confirm_box();">Delete</a>
                                                </td> 
                                            </tr>
										<?php
                                        $i++;
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