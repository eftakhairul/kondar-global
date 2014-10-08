<script src="<?php echo site_url('assets/admin/js/jquery-1.10.1.min.js') ?>" type="text/javascript" ></script>

<script>

    function user_status(name,id,value){

        $.ajax({

            type: "POST",

            url: "admin/update_status", /* The country id will be sent to this file */

            data: "table_name="+name+"&id="+id+"&status="+value,

            beforeSend: function () {

            },

            success: function(msg){

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
        
        $("#delete_checked_interview").click(function(){  
            if($('input.blocks:checkbox:checked').length){
                var msg= "Are you sure???\nYou Want to Delete All.";
                var answer = confirm (msg);                
                if (answer){
                    var blocksarray = [];
                    var jobidarray = [];
                    $('input.blocks:checkbox:checked').each(function () {
                        blocksarray.push($(this).val());
                        jobidarray.push($(this).data('jobid'));
                        $(this).parents('tr').hide();
                    });
                    var url = "admin/career/delete_all_interview_section";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {'block_ids':blocksarray,'jobidarray':jobidarray},                        
                        success: function (data) {                            
                            $("#delete_all_btn").prop('checked',false);
                        }
                    });
                }}else {
                alert("Please select atleast one item.");
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
                    var url = "admin/career/delete_all_user_block";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {'block_ids':blocksarray},                        
                        success: function (data) {                            
                            $("#delete_all_btn").prop('checked',false);
                        }
                    });
                }}else {
                alert("Please select atleast one item.");
            }
        }); 
        
        
        
        /*
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
                    var url = "admin/career/deleteAll";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {'block_ids':blocksarray, 'table':'apply_form','deleteuser':true},
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
        */
        
        

    });

</script>

<script type="text/javascript">

    function confirm_box(){

        var answer = confirm ("<?php echo lang('Are you sure?'); ?>");

        if (!answer)

        return false;

}



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

                <h5><i class="font-user"></i><?php echo $label; ?></h5>

                <!-- End page title -->

                <div class="body">





                    <!-- Content container -->

                    <div class="container">

                        <!-- Default datatable -->

                        <div class="block well" style="margin-top:30px">

                            <div class="navbar">

                                <div class="navbar-inner">

                                    <h5 class="pull-right"><?php echo lang('List'); ?></h5>

                                    <div class="pull-right" >
                                        
                                    <?php if (isset($all_data)) { ?>
                                        <button id="delete_checked_interview" style="padding: 4px;margin: 5px;border: 1px solid #d5d5d5;" >Delete All</button>
                                    <?php }else if (isset($all_data1)) { ?>
                                        <button id="delete_checked" style="padding: 4px;margin: 5px;border: 1px solid #d5d5d5;" >Delete All</button>
                                    <?php } ?>
                                    </div>

                                </div>

                            </div>

                            <div class="table-overflow">

                                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">

                                    <table aria-describedby="data-table_info" class="table table-striped dataTable" id="data-table">

<?php
if (isset($all_data)) {
    ?>

                                            <thead>

                                                <tr role="row">

                                                    <th colspan="1" rowspan="1"><input id="delete_all_btn" type="checkbox" name="delete_option[]" value="all"></th>

                                                    <th colspan="1" rowspan="1" width="100"><?php echo lang('Name'); ?></th>

                                                    <th colspan="1" rowspan="1" width="100" ><?php echo lang('Email'); ?></th>

                                                    <th colspan="1" rowspan="1" width="100" ><?php echo lang('Contact'); ?></th>

                                                    <th colspan="1" rowspan="1" width="100" ><?php echo lang('Country'); ?></th>

                                                    <th colspan="1" rowspan="1" width="100" ><?php echo lang('Job Section'); ?></th>

                                                    <th colspan="1" rowspan="1" width="150" ><?php echo lang('Views'); ?></th>

                                                    <th colspan="1" rowspan="1" width="150" ><?php echo lang('Document'); ?></th>

                                                    <th colspan="1" rowspan="1" width="150" ><?php echo lang('Confirm'); ?></th>

                                                    <th colspan="1" rowspan="1" width="150" ><?php echo lang('Option'); ?></th>

                                                </tr>

                                            </thead>

                                            <tbody aria-relevant="all" aria-live="polite" role="alert">



    <?php
    foreach ($all_data as $set_data) {

        if ($set_data['block'] == 0) {

            $job_data = $this->comman_model->get_data_by_id('job_section', array('id' => $set_data['job_id']));
            ?>

                                                        <tr class="odd row_<?php echo $set_data['id']; ?>">

                                                            <td class="dataTables" valign="top">
                                                                <input class="blocks" type="checkbox" name="delete_option[]" value="<?php echo $set_data['id']; ?>" data-jobid="<?php echo $set_data['job_id']; ?>">
                                                            </td>

                                                            <td class="dataTables" valign="top">

            <?php echo $set_data['name']; ?>

                                                            </td>

                                                            <td class="dataTables" valign="top">

            <?php echo $set_data['email']; ?>  

                                                            </td>                                	

                                                            <td class="dataTables" valign="top">

            <?php echo $set_data['contact']; ?>  

                                                            </td>                                	

                                                            <td class="dataTables" valign="top">

            <?php echo $set_data['country']; ?>  

                                                            </td>                                	

                                                            <td class="dataTables" valign="top">

            <?php echo $job_data['name']; ?>  

                                                            </td>                                	

                                                            <td class="dataTables" valign="top">

                                                                <a href="admin/career/interview/<?php echo $set_data['id']; ?>" ><?php echo lang('Interview'); ?></a>

                                                            </td>

                                                            <td class="dataTables" valign="top">

            <?php
            if (!empty($set_data['document'])) {
                ?>

                                                                    <a href="admin/index/download_file/<?php echo $set_data['document']; ?>" ><?php echo lang('Download'); ?></a>

                <?php
            } else {

                echo lang('No File');
            }
            ?>                                    

                                                            </td>

                                                            <td class="dataTables" valign="top">

                                                                <?php
                                                                if ($set_data['confirm'] == 'confirm') {

                                                                    echo lang('Confirm');
                                                                } else {

                                                                    echo lang('Not Confirm');
                                                                }
                                                                ?>                                    

                                                            </td>

                                                            <td class="dataTables" valign="top">

                                                                <a href="admin/career/delete_interview_section/<?php echo $set_data['id']; ?>/<?php echo $set_data['job_id']; ?>" onclick="return confirm_box();"><?php echo lang('Delete') ?></a>

                                                            </td>

                                                        </tr>

                                                                <?php
                                                            }
                                                        }
                                                    } else if (isset($all_data1)) {
                                                        ?>

                                            <thead>

                                                <tr role="row">

                                                    <th colspan="1" rowspan="1"><input id="delete_all_btn" type="checkbox" name="delete_option[]" value="all"></th>

                                                    <th colspan="1" rowspan="1" width="100"><?php echo lang('Name'); ?></th>

                                                    <th colspan="1" rowspan="1" width="100" ><?php echo lang('Email'); ?></th>

                                                    <th colspan="1" rowspan="1" width="100" ><?php echo lang('Contact'); ?></th>

                                                    <th colspan="1" rowspan="1" width="100" ><?php echo lang('Country'); ?></th>

                                                    <th colspan="1" rowspan="1" width="100" ><?php echo lang('Job Section'); ?></th>

                                                    <th colspan="1" rowspan="1" width="150" ><?php echo lang('Block'); ?></th>

                                                    <th colspan="1" rowspan="1" width="150" ><?php echo lang('Option'); ?></th>

                                                </tr>

                                            </thead>

                                            <tbody aria-relevant="all" aria-live="polite" role="alert">



    <?php
    foreach ($all_data1 as $set_data) {

        if ($set_data['block'] == 1) {

            $job_data = $this->comman_model->get_data_by_id('job_section', array('id' => $set_data['job_id']));
            ?>

                                                        <tr class="odd">

                                                            <td class="dataTables" valign="top">
                                                                <input class="blocks" type="checkbox" name="delete_option[]" value="<?php echo $set_data['id']; ?>">
                                                            </td>

                                                            <td class="dataTables" valign="top">

            <?php echo $set_data['name']; ?>

                                                            </td>

                                                            <td class="dataTables" valign="top">

            <?php echo $set_data['email']; ?>  

                                                            </td>                                	

                                                            <td class="dataTables" valign="top">

            <?php echo $set_data['contact']; ?>  

                                                            </td>                                	

                                                            <td class="dataTables" valign="top">

                                                        <?php echo $set_data['country']; ?>  

                                                            </td>                                	

                                                            <td class="dataTables" valign="top">

            <?php echo (isset($job_data) && isset($job_data['name'])) ? $job_data['name'] : ''; ?>  

                                                            </td>                                	

                                                            <td class="dataTables" valign="top">

            <?php
//date_default_timezone_set('Asia/Calcutta');

            $currentTime = time();

//echo '<br>current date: '.date('d-m-Y H:i',$currentTime);
//echo '<br> date: '.date('d-m-Y H:i',$set_data['block_time']);

            $blockTime = strtotime('+120 minutes', $set_data['block_time']);

//echo '<br> add date: '.date('d-m-Y H:i',$blockTime);

            if ($blockTime > $currentTime) {

                //$diff = $set_data['block_time'] - $currentTime;

                $diff = strtotime(date('d-m-Y', $currentTime) . " 00:00:00") + ($blockTime - $currentTime);

                $h = date('H', $diff);

                $min = date('i', $diff);

                if ($h == 00 || $h == 0) {

                    $h = 1;

                    echo $min . ' minutes';
                } else {

                    echo (($h * 60) + $min) . ' minutes';
                }
            }
            ?>

                                                            </td>



                                                            <td class="dataTables" valign="top">

                                                                <a href="admin/career/delete_user_block/<?php echo $set_data['id']; ?>" onclick="return confirm_box();"><?php echo lang('Delete'); ?></a>

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