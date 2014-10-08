<script src="<?php echo site_url('assets/admin/js/jquery-1.10.1.min.js') ?>" type="text/javascript" ></script>
<script type="text/javascript">
    function confirm_box(msg){
        var answer = confirm (msg);
        if (!answer)
            return false;
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
                    var url = "admin/distribution/deleteAll";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {'block_ids':blocksarray, 'table':'distribution_form','field':'email','where_field':'id'},
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

<div style="margin-right: 0px;" class="content">
    <?php
    if ($this->session->flashdata('success')) {
        $msg = $this->session->flashdata('success');
        ?>
        <div class="notice outer">
            <div class="note"><?php echo $msg; ?>
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
                <h5><i class="font-user"></i><?php echo 'Distribution User List'; ?></h5>
                <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">
                        <!-- Default datatable -->
                        <div class="block well" style="margin-top:30px">
                            <div class="navbar">
                                <div class="navbar-inner">
                                    <h5><?php echo $this->lang->line('List'); ?></h5>
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
                                                <th colspan="1" rowspan="1"><?php echo $this->lang->line('SI_No'); ?></th>
                                                <th colspan="1" rowspan="1"><?php echo $this->lang->line('company'); ?></th>
                                                <th colspan="1" rowspan="1"><?php echo $this->lang->line('applicant'); ?></th>
                                                <th colspan="1" rowspan="1"><?php echo $this->lang->line('country'); ?></th>
                                                <th colspan="1" rowspan="1"><?php echo $this->lang->line('designation'); ?></th>
                                                <th colspan="1" rowspan="1"><?php echo $this->lang->line('address'); ?></th>
                                                <th colspan="1" rowspan="1"><?php echo $this->lang->line('email'); ?></th>
                                                <th colspan="1" rowspan="1"><?php echo $this->lang->line('license'); ?></th>
                                                <th colspan="1" rowspan="1"><?php echo $this->lang->line('companysize'); ?></th>
                                                <th colspan="1" rowspan="1"><?php echo $this->lang->line('companystart'); ?></th>
                                                <th colspan="1" rowspan="1"><?php echo $this->lang->line('indoor_sales'); ?></th>
                                                <th colspan="1" rowspan="1"><?php echo $this->lang->line('outdoor_sales'); ?></th>
                                                <th colspan="1" rowspan="1"><?php echo $this->lang->line('sales_brief'); ?></th>
                                                <th colspan="1" rowspan="1"><?php echo $this->lang->line('Option'); ?></th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody aria-relevant="all" aria-live="polite" role="alert">
                                            <?php
                                            if (isset($all_data)) {
                                                $int_I = 1;
                                                foreach ($all_data as $set_data) {
                                                    ?>
                                                    <tr class="odd">
                                                        <td class="dataTables" valign="top">
                                                            <input class="blocks" type="checkbox" name="delete_option[]" value="<?php echo $set_data['id']; ?>">
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $int_I++; ?>
                                                        </td>
        <!--                                	    	<td class="dataTables" valign="top">
                                                        <?php // echo $set_data['int_id'];?>
                                                        </td>-->
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data['company']; ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data['salutation'] . ' ' . $set_data['applicant']; ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">    
                                                            <?php echo $set_data['country']; ?>

                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data['designation']; ?>
                                                        </td>

                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data['address']; ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data['email']; ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">

                                                            <a href="admin/distribution/download_file/<?php echo $set_data['license']; ?>" ><?php echo $this->lang->line('Download'); ?></a>

                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data['companysize']; ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data['companystart']; ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data['sel_indoor_sales']; ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <?php echo $set_data['sel_outdoor_sales']; ?>
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <div  style="max-height:100px;overflow-y:scroll;overflow-x:none;">
                                                                <?php echo $set_data['salesbrief']; ?>
                                                            </div>                                				
                                                        </td>
                                                        <td class="dataTables" valign="top">
                                                            <a href="admin/distribution/delete_distribution/<?php echo $set_data['id']; ?>" onclick="return confirm_box('Are you sure you want to remove This block?');"><?php echo $this->lang->line('Delete_button'); ?></a>
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
