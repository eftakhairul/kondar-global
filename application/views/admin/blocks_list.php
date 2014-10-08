<script src="assets/user/js/jquery-1.10.1.min.js" type="text/javascript" ></script>
<script type="text/javascript">
    function confirm_box(msg){
    	var answer = confirm (msg);
    	if (!answer)
    	 return false;
    }

    $(document).ready(function() {
        $("#delete_all_blocks").click(function(){
            if($("#delete_all_blocks").is(':checked')){
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

                        var url = "admin/blocks_list/blocksDeleteAll";
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {'block_ids':blocksarray},
                            //async:false,
                            //dataType: "json",
                            success: function (data) {
                            }
                            });

                        }}else {
                alert("Please select atleast one item.");
            }

        });

    });
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
                    <h5><i class="font-user"></i><?php echo $this->lang->line('Blocks');?></h5>
            <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">
                        <!-- Default datatable -->
                        <div class="block well" style="margin-top:30px">
                        	<div class="navbar">
                            	<div class="navbar-inner">
                                	<h5><?php echo $this->lang->line('List');?></h5>
                                    <div class="dataTables_length" id="data-table_length">
                                		<?php echo $this->lang->line('Block_reasons');?>
                               		</div>
                                </div>
                            </div>
                            <div class="table-overflow">
                                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                                <table aria-describedby="data-table_info" class="table table-striped dataTable" id="data-table">
                                    <thead>
                                        <tr role="row">
                                            <th colspan="1" rowspan="1"><input id="delete_all_blocks" type="checkbox" name="delete_option[]" value="all"></th>
                                            <th colspan="1" rowspan="1"><?php echo $this->lang->line('SI_No');?></th>
                                        	<th colspan="1" rowspan="1"><?php echo $this->lang->line('Code_Errors');?></th>
                                        	<th colspan="1" rowspan="1"><?php echo $this->lang->line('Codes_Sent');?></th>
                                        	<th colspan="1" rowspan="1"><?php echo $this->lang->line('Block_Reason');?></th>
                                            <th colspan="1" rowspan="1"><?php echo $this->lang->line('section');?></th>
                                        	<th colspan="1" rowspan="1"><?php echo $this->lang->line('Block_Date');?></th>
                                        	<th colspan="1" rowspan="1"><?php echo $this->lang->line('Time_Remaining');?></th>
                                        	<th colspan="1" rowspan="1"><?php echo $this->lang->line('Last_Code');?></th>
                                        	<th colspan="1" rowspan="1"><?php echo $this->lang->line('Email_Block');?></th>
                                        	<th colspan="1" rowspan="1"><?php echo $this->lang->line('Applicant');?></th>
                                        	<th colspan="1" rowspan="1"><?php echo $this->lang->line('Country');?></th>
                                        	<th colspan="1" rowspan="1"><?php echo $this->lang->line('IP_Address');?></th>
                                        	<th colspan="1" rowspan="1"><?php echo $this->lang->line('Telephone');?></th>
                                            <th colspan="1" rowspan="1">
                                                <button id="delete_checked">Delete All</button>
                                            </th>
                                        </tr>
                                    </thead>
                                <tbody aria-relevant="all" aria-live="polite" role="alert">
                                <?php
                                if(isset($all_data)){
                                	$int_I = 1;
                                	foreach($all_data as $set_data){
                                ?>
                                	    <tr class="odd">
                                            <td class="dataTables" valign="top">
                                                <input class="blocks" type="checkbox" name="delete_option[]" data-section="<?php echo $set_data['region'];?>" value="<?php echo $set_data['int_id'];?>">
                                            </td>
                                	    	<td class="dataTables" valign="top">
                                	    		<?php echo $int_I++; ?>
                                	    	</td>
<!--                                	    	<td class="dataTables" valign="top">
                                				<?php // echo $set_data['int_id'];?>
                                	        </td>-->
                                	        <td class="dataTables" valign="top">
                                				<?php echo $set_data['int_errors'];?>
                                	        </td>
                                	        <td class="dataTables" valign="top">
                                				<?php echo $set_data['int_sents'];?>
                                	        </td>
                                	        <td class="dataTables" valign="top">    
                                				<?php echo $set_data['int_block'];?>
                                	        </td>
                                                <td class="dataTables" vallign="top">
                                                    <?php echo $set_data['region'];?>
                                                </td>
                                	        <td class="dataTables" valign="top">
                                				<?php echo $set_data['dte_block'];?>
                                	        </td>
                                	        <td class="dataTables" valign="top">
                                				<?php 
                                					$int_block = strtotime($set_data['dte_block']);
                                					$int_TR = 120 - intval(((time() - $int_block) / 60));
                                					if($int_TR < 0)
                                						$int_TR = 0;
                                					echo $int_TR . $this->lang->line('minute');
                                				?>
                                	        </td>
                                	        <td class="dataTables" valign="top">
                                				<?php echo $set_data['str_code'];?>
                                	        </td>
                                	        <td class="dataTables" valign="top">
                                				<?php echo $set_data['str_email'];?>
                                	        </td>
                                	        <td class="dataTables" valign="top">
                                				<?php echo $set_data['str_applicant'];?>
                                	        </td>
                                	        <td class="dataTables" valign="top">
                                				<?php echo $set_data['str_country'];?>
                                	        </td>
                                	        <td class="dataTables" valign="top">
                                				<?php echo $set_data['str_ip_address'];?>
                                	        </td>
                                			<td class="dataTables" valign="top">
                                				<?php echo $set_data['str_telephone'];?>
                                	        </td>	        
                                	    	<td class="dataTables" valign="top">
                                	        	<a href="admin/blocks_list/delete/<?php echo $set_data['int_id'];?>" onclick="return confirm_box('Are you sure you want to remove This block?');"><?php echo $this->lang->line('Delete_button'); ?></a>
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