<script src="assets/user/js/jquery-1.10.1.min.js" type="text/javascript" ></script>


<div style="margin-right: 0px;" class="content">
 
	<div id="show_class" class="note" style="display:none;"></div>  
    	<div id="result"></div>    
        <div class="outer">
            <div class="inner">
                <div class="page-header">
		<!-- page title -->
                    <h5><i class="font-user"></i><?php echo $this->lang->line('').'View Winner';?> : <?php echo $set_data['name'];?></h5>
            <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">
                        <!-- Default datatable -->
                        <div class="block well" style="margin-top:30px">
                        	
                            <div class="table-overflow">
                                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                                <table aria-describedby="data-table_info" class="table table-striped dataTable" id="data-table">
                                    
                                    <tbody aria-relevant="all" aria-live="polite" role="alert">
                                    
                                        <tr class="odd">
                                            <td class="dataTables" valign="top">name</td>
                                            <td class="dataTables" valign="top"><?php echo $set_data['name'];?></td>
                                        </tr>
                                        
                                        <tr class="odd">
                                            <td class="dataTables" valign="top">Telephone</td>
                                            <td class="dataTables" valign="top"><?php echo $set_data['telephone'];?></td>
                                        </tr>
                                        
                                        <tr class="odd">
                                            <td class="dataTables" valign="top">Email</td>
                                            <td class="dataTables" valign="top"><?php echo $set_data['email'];?></td>
                                        </tr>
                                        
                                        <tr class="odd">
                                            <td class="dataTables" valign="top">Address</td>
                                            <td class="dataTables" valign="top"><?php echo $set_data['address'];?></td>
                                        </tr>
                                        
                                        <tr class="odd">
                                            <td class="dataTables" valign="top">Occupation</td>
                                            <td class="dataTables" valign="top"><?php echo $set_data['occupation'];?></td>
                                        </tr>
                                        
                                        <tr class="odd">
                                            <td class="dataTables" valign="top">Occupation</td>
                                            <td class="dataTables" valign="top"><?php echo $set_data['occupation'];?></td>
                                        </tr>
                                        
                                        <tr class="odd">
                                            <td class="dataTables" valign="top">Product supplier</td>
                                            <td class="dataTables" valign="top"><?php echo $set_data['product_supplier'];?></td>
                                        </tr>
                                        
                                        <tr class="odd">
                                            <td class="dataTables" valign="top">Passport id</td>
                                            <td class="dataTables" valign="top"><?php echo $set_data['passport_id'];?></td>
                                        </tr>
                                        
                                         <tr class="odd">
                                            <td class="dataTables" valign="top">Winning Date</td>
                                            <td class="dataTables" valign="top"><?php echo date('m/d/Y',$set_data['created_date']);?></td>
                                        </tr>
                                        
                                        <tr class="odd">
                                            <td class="dataTables" valign="top">Passport</td>
                                            <td class="dataTables" valign="top">
                                                <a href="<?php echo base_url();?>assets/uploads/winner_image/<?php echo $set_data['passport_copy'];?>" target="_blank"><img src="assets/uploads/winner_image/<?php echo $set_data['passport_copy'];?>" width="70" height="70" /></a>
                                            </td>
                                        </tr>
                                        
                                        <tr class="odd">
                                            <td class="dataTables" valign="top">Receipt</td>
                                            <td class="dataTables" valign="top">
                                                <a href="<?php echo base_url();?>assets/uploads/winner_image/<?php echo $set_data['receipt_copy'];?>"  target="_blank"><img src="assets/uploads/winner_image/<?php echo $set_data['receipt_copy'];?>" width="70" height="70" /></a>
                                            </td>
                                        </tr>
                                    
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