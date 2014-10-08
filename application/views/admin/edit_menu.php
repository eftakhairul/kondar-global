<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="assets/user/js/ckeditor.js"></script>
<script type="text/javascript" src="assets/template/js/jquery.imgareaselect.min.js"></script>
<script>
    $(document).ready(function() {
        var p = $("#uploadPreview");

        // prepare instant preview
        $("#uploadImage").change(function(){
            // fadeOut or hide preview
            //p.fadeOut();

            // prepare HTML5 FileReader
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

            oFReader.onload = function (oFREvent) {
                p.attr('src', oFREvent.target.result);
            };
        });

        // implement imgAreaSelect plug in (http://odyniec.net/projects/imgareaselect/)
        /* $('img#uploadPreview').imgAreaSelect({
            // set crop ratio (optional)
            aspectRatio: '1:1',
            onSelectEnd: setInfo
          });*/
    });
	
    function get_vehicle(name){
        //alert(name);
        $.ajax({
            type: "POST",
            url: "admin/get_vehicle", /* The country id will be sent to this file */
            data: "id="+name,
            beforeSend: function () {
                $("#Show_vehicle").html("Loading ...");
            },
            success: function(msg){
                $("#Show_vehicle").html(msg);
            }
        });
    } 

    function get_brand(name){
        //alert(name);
        $.ajax({
            type: "POST",
            url: "admin/get_brand", /* The country id will be sent to this file */
            data: "id="+name,
            beforeSend: function () {
                $("#Show_brand").html("Loading ...");
            },
            success: function(msg){
                $("#Show_brand").html(msg);
            }
        });
    } 

    function get_model(name){
        //alert(name);
        $.ajax({
            type: "POST",
            url: "admin/get_model", /* The country id will be sent to this file */
            data: "id="+name,
            beforeSend: function () {
                $("#Show_model").html("Loading ...");
            },
            success: function(msg){
                $("#Show_model").html(msg);
            }
        });
    } 

</script>
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
    <?php
    if ($this->session->flashdata('error')) {
        $msg = $this->session->flashdata('error');
        ?>
        <div class="notice outer">
            <div class="error"><?php echo $msg; ?>
            </div>
        </div>
        <?php
    }
    ?>    



    <div class="outer">
        <div class="inner">
            <div class="page-header">
                <!-- page title -->
                <h5><i class="font-user"></i><?php echo $this->lang->line('') . 'Model'; ?></h5>
                <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">
                        <?php if (isset($menu_name)) { ?>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="operation" value="set" />
                                <div class="row-fluid">

                                    <!-- Column -->
                                    <div class="span12">
                                        <!-- Time pickers -->
                                        <div class="block well">
                                            <div class="navbar"><div class="navbar-inner"><h5> <?php echo $this->lang->line('') . 'Edit ' . $menu_name; ?></h5></div></div>

                                            <div class="control-group">
                                                <label class="control-label">Menu Label</label>
                                                <div class="controls"><input id="title2" name="menu_label" class="focustip span12" type="text" value="<?php echo $menu_info[0]['menu_label']; ?>" ></div>
                                                <span style="color:#F00;"><?php echo form_error('fleet'); ?></span>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label">Photo:</label>
                                                <div class="controls" style="float:left;margin-left:0px"><input type="file" name="file" id="uploadImage" /></div>
                                                <?php
                                                if (isset($menu_info[0]['menu_image']) && !empty($menu_info[0]['menu_image'])) {
                                                    echo '<div style="float:left"><img id="uploadPreview" src="assets/uploads/menus/' . $menu_info[0]['menu_image'] . '" width="100" height="100"><br></div>';
//	echo '<a href="admin/delete/edit_job_section/'.$edit_data['id'].'" onclick="return confirm_box();">Delete</a></div>';
                                                }
                                                ?>
                                                <div style="clear:both;"></div>
                                                <p style="color:#F00;margin-left:190px"><!--Please file must be : jpg, png, gif. maximum 800KB and maximum 1024X768--></p>

                                            </div>
                                            <div class="form-actions align-right">
                                                <input class="btn btn-primary" value="Update" id="send" type="submit">
                                            </div>



                                        </div>

                                    </div>
                                    <!-- /time pickers -->



                                </div>
                                <!-- /column -->

                            </form>
                            <?php }
                        ?>
                        <!-- Pickers -->
                    </div>

                    <!-- /pickers -->

                </div>
                <!-- /content container -->

            </div>
        </div>
    </div>
</div>