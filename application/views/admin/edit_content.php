<!--<script src="assets/user/js/ckeditor.js"></script>-->

<script src="assets/admin/js/jquery-1.9.1.min.js"></script>

<script src="assets/admin/js/bootstrap.min.js"></script>

<link href="assets/admin/css/font-awesome.min.css" rel="stylesheet">
<link href="assets/admin/css/codemirror.min.css" rel="stylesheet">
<link href="assets/admin/css/blackboard.min.css" rel="stylesheet">
<link href="assets/admin/css/monokai.min.css" rel="stylesheet">
<link href="assets/admin/css/summernote.css" rel="stylesheet">

<script src="assets/admin/js/summernote.min.js"></script>

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

                <h5><i class="font-user"></i><?php echo $this->lang->line('') . 'Content'; ?></h5>

                <!-- End page title -->

                <div class="body">

                    <!-- Content container -->

                    <div class="container">

                        <?php
                        if (isset($edit_data) && !empty($edit_data)) {

                            if ($edit_data['type'] == 'about') {
                                ?>

                                <form class="form-horizontal" method="post" enctype="multipart/form-data">

                                    <input type="hidden" name="about" value="set" />

                                    <div class="row-fluid">



                                        <!-- Column -->

                                        <div class="span12">

                                            <!-- Time pickers -->

                                            <div class="block well">

                                                <div class="navbar"><div class="navbar-inner"><h5> <?php echo $this->lang->line('') . 'Edit About'; ?></h5></div></div>

                                                <div class="control-group">

                                                    <label class="control-label">Title:</label>

                                                    <div class="controls"><input id="title2" name="title" class="focustip span12" type="text" value="<?php echo $edit_data['title']; ?>" ></div>

                                                    <span style="color:#F00;"><?php echo form_error('title'); ?></span>

                                                </div>



                                                <div class="control-group" style="display:none;">

                                                    <label class="control-label">Photo:</label>

                                                    <div class="controls"><input type="file" name="file" /></div>

                                                </div>



                                                <div class="control-group" style="display:none;">

                                                    <label class="control-label">video:</label>

                                                    <div class="controls"><input type="file" id="video" name="video" ></div>

                                                </div>


                                                <div class="control-group">

                                                    <label class="control-label">Sort Description:</label>

                                                    <div class="controls" id="content_sort">

                                                        <textarea class="content" name="sort"><?php echo $edit_data['sort']; ?></textarea>
                                                        <input type="hidden" id="sort" name="sort" value="" />

                                                    </div>

                                                </div>                                    



                                                <div class="control-group">

                                                    <label class="control-label">Description:</label>

                                                    <div class="controls" id="content_desc">
                                                        <textarea class="content" name="description" ><?php echo $edit_data['description']; ?></textarea>
                                                        <input type="hidden" id="desc" name="description" value="" />

                                                    </div>

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

                                <?php
                            } else if ($edit_data['type'] == 'vision') {
                                ?>

                                <form class="form-horizontal" method="post" enctype="multipart/form-data">

                                    <input type="hidden" name="vision" value="set" />

                                    <div class="row-fluid">



                                        <!-- Column -->

                                        <div class="span12">

                                            <!-- Time pickers -->

                                            <div class="block well">

                                                <div class="navbar"><div class="navbar-inner"><h5> <?php echo $this->lang->line('') . 'Edit Vision'; ?></h5></div></div>

                                                <div class="control-group">

                                                    <label class="control-label">Title:</label>

                                                    <div class="controls"><input id="title2" name="title" class="focustip span12" type="text" value="<?php echo $edit_data['title']; ?>" ></div>

                                                    <span style="color:#F00;"><?php echo form_error('title'); ?></span>

                                                </div>

                                                <div class="control-group" style="display:none;">

                                                    <label class="control-label">Photo:</label>

                                                    <div class="controls"><input type="file" name="file" /></div>

                                                </div>



                                                <div class="control-group" style="display:none;">

                                                    <label class="control-label">video:</label>

                                                    <div class="controls"><input type="file" id="video" name="video" ></div>

                                                </div>





                                                <div class="control-group">

                                                    <label class="control-label">Sort Description:</label>

                                                    <div class="controls" id="content_sort">

                                                        <textarea class="content" name="sort"><?php echo $edit_data['sort']; ?></textarea>
                                                        <input type="hidden" id="sort" name="sort" value="" />

                                                    </div>

                                                </div>



                                                <div class="control-group">

                                                    <label class="control-label">Description:</label>

                                                   <div class="controls" id="content_desc">
                                                        <textarea class="content" name="description" ><?php echo $edit_data['description']; ?></textarea>
                                                        <input type="hidden" id="desc" name="description" value="" />

                                                    </div>
                                                    
                                                </div>

                                                <div class="form-actions align-right">

                                                    <input class="btn btn-primary" value="Update" id="send" type="submit">

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- /column -->

                                </form>

                                <?php
                            } else if ($edit_data['type'] == 'mission') {
                                ?>

                                <form class="form-horizontal" method="post" enctype="multipart/form-data">

                                    <input type="hidden" name="mission" value="set" />

                                    <div class="row-fluid">



                                        <!-- Column -->

                                        <div class="span12">

                                            <!-- Time pickers -->

                                            <div class="block well">

                                                <div class="navbar"><div class="navbar-inner"><h5> <?php echo $this->lang->line('') . 'Edit Mission'; ?></h5></div></div>

                                                <div class="control-group">

                                                    <label class="control-label">Title:</label>

                                                    <div class="controls"><input id="title2" name="title" class="focustip span12" type="text" value="<?php echo $edit_data['title']; ?>" ></div>

                                                    <span style="color:#F00;"><?php echo form_error('title'); ?></span>

                                                </div>

                                                <div class="control-group" style="display:none;">

                                                    <label class="control-label">Photo:</label>

                                                    <div class="controls"><input type="file" name="file" /></div>

                                                </div>



                                                <div class="control-group" style="display:none;">

                                                    <label class="control-label">video:</label>

                                                    <div class="controls"><input type="file" id="video" name="video" ></div>

                                                </div>





                                                <div class="control-group">

                                                    <label class="control-label">Sort Description:</label>

                                                    <div class="controls" id="content_sort">

                                                        <textarea class="content" name="sort"><?php echo $edit_data['sort']; ?></textarea>
                                                        <input type="hidden" id="sort" name="sort" value="" />

                                                    </div>

                                                </div>



                                                <div class="control-group">

                                                    <label class="control-label">Description:</label>

                                                   <div class="controls" id="content_desc">
                                                        <textarea class="content" name="description" ><?php echo $edit_data['description']; ?></textarea>
                                                        <input type="hidden" id="desc" name="description" value="" />

                                                    </div>

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

                                <?php
                            } else if ($edit_data['type'] == 'career') {
                                ?>

                                <form class="form-horizontal" method="post" enctype="multipart/form-data">

                                    <input type="hidden" name="career" value="set" />

                                    <div class="row-fluid">



                                        <!-- Column -->

                                        <div class="span12">

                                            <!-- Time pickers -->

                                            <div class="block well">

                                                <div class="navbar"><div class="navbar-inner"><h5> <?php echo $this->lang->line('') . 'Edit Career'; ?></h5></div></div>

                                                <div class="control-group">

                                                    <label class="control-label">Title:</label>

                                                    <div class="controls"><input id="title2" name="title" class="focustip span12" type="text" value="<?php echo $edit_data['title']; ?>" ></div>

                                                    <span style="color:#F00;"><?php echo form_error('title'); ?></span>

                                                </div>



                                                <div class="control-group">

                                                    <label class="control-label">Sort Description:</label>

                                                    <div class="controls" id="content_sort">

                                                        <textarea class="content" name="sort"><?php echo $edit_data['sort']; ?></textarea>
                                                        <input type="hidden" id="sort" name="sort" value="" />

                                                    </div>

                                                </div>



                                                <div class="control-group">

                                                    <label class="control-label">Description:</label>

                                                    <div class="controls"><textarea id="content" name="description" class="focustip span12" rows="10"><?php echo $edit_data['description']; ?></textarea>

                                                        <script>

                                                            CKEDITOR.replace( 'description', {

                                                                uiColor: '#F5F5F5',

                                                                toolbar: [

                                                                    [ 'Bold', 'Italic','Underline', '-', 'NumberedList', 'BulletedList', '-'],

                                                                    ['Strike','Subscript','Superscript'],

                                                                    [ 'TextColor', 'BGColor', 'FontFamily' ],

                                                                    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],

                                                                    ['Styles','Format','FontSize'],

                                                                    ['Table','Maximize','Image']

                                                                ]

                                                            });								

                                                        </script>



                                                    </div>

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

                                <?php
                            }
                        }
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

<script>
    $(function(){        
         
        $('#content_sort .content').summernote({
            height: 150   //set editable area's height
        });
       
        $('#content_desc .content').summernote({
            height: 150   //set editable area's height
        });       
        
        $("#content_sort ul.dropdown-menu li a").attr("href","javascript:void");
        $("#content_desc ul.dropdown-menu li a").attr("href","javascript:void");
        
        $("#send").hover(function(){       
            
            //alert($("#content_about .note-editable").html());
            
            $("#sort").val($("#content_sort .note-editable").html());
            $("#desc").val($("#content_desc .note-editable").html());
            
        });        
       
    });
            
</script>