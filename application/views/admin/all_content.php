<style>
.error{
  background: url("../images/elements/ui/progress_overlay.png") repeat scroll 0 0%, -moz-linear-gradient(center top , #CD4900 0%, #CD0200 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
  border-radius: 3px;
  box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 1px 1px #333333;
  color: #FFFFFF;
  font-size: 12px;
  padding: 9px 35px 8px;
  text-align: center;
}
</style>

<script src="assets/user/js/jquery-1.10.1.min.js" type="text/javascript" ></script>
<script>
function get_status(name,id,value){
//	alert(name+' '+id+' '+value);
    $.ajax({
       type: "POST",
       url: "user/update_status", /* The country id will be sent to this file */
       data: "table_name="+name+"&id="+id+"&status="+value,
       beforeSend: function () {
	//	   alert('asa');
      $("#show_class").html("Loading ...");
        },
       success: function(msg){
		// alert(msg);
         //$("#show_class").html(msg);
       }
       });
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
<?php
if($this->session->flashdata('error')) {
    $msg = $this->session->flashdata('error');
?>
    <div class="notice outer">
      <div class="error"><?php echo $msg;?>
      </div>
    </div>
<?php
}
?>    

        <div class="outer">
            <div class="inner">
                <div class="page-header">
		<!-- page title -->
                    <h5><i class="font-user"></i><?php echo $this->lang->line(''); ?> All Content</h5>
            <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">
                        <!-- Default datatable -->
                        <div class="block well" style="margin-top:30px">
                        	<div class="navbar">
                            	<div class="navbar-inner">
                                	<h5><?php echo $this->lang->line(''); ?>Content</h5>
                                </div>
                            </div>
<style>
.selector{
	width:150px !important;
	padding:3px 13px !important;
}
</style>
                            <div class="table-overflow">
                                <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                                <div class="datatable-header" style="padding:10px">
                                    <a href="admin/index/menu_category"style="float:left;margin-right:10px;"  >
                                    	<div id="" class="selector" ><?php echo $this->lang->line('menu_category');?></div>
                                    </a>
									<div style="clear:both;padding:5px"></div>

                                    <a href="admin/index/menu_content"style="float:left;margin-right:10px;"  >
                                    	<div id="" class="selector" ><?php echo $this->lang->line('menu_content');?></div>
                                    </a>
									<div style="clear:both;padding:5px"></div>

                                    <a href="admin/index/content" style="float:left;margin-right:10px;">
                                    	<div id="" class="selector" ><?php echo $this->lang->line('content');?></div>
                                    </a>
<!--									<div style="clear:both;padding:5px"></div>
                                    <a href="" style="float:left;margin-right:10px;">
                                    <div id="" class="selector" >subscribed predictions
                                    </div></a>-->
									</div>
                                
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