<script type="text/javascript" src="<?php echo site_url('assets/admin/js/jquery-1.10.1.min.js') ?>"></script>

<script src="assets/admin/js/bootstrap.min.js"></script>

<link href="assets/admin/css/font-awesome.min.css" rel="stylesheet">
<link href="assets/admin/css/codemirror.min.css" rel="stylesheet">
<link href="assets/admin/css/blackboard.min.css" rel="stylesheet">
<link href="assets/admin/css/monokai.min.css" rel="stylesheet">
<link href="assets/admin/css/summernote.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>
<script src="assets/admin/js/summernote.min.js"></script>

<script type="text/javascript">
    function confirm_box() {
        var answer = confirm("Are you sure?");
        if (!answer)
            return false;
    }

</script>

<script type="text/javascript"> 
    $(function(){
        var counter = 1;
	
	
	
        $(document).on('click','.removeques',function(e){
            e = e.target;
            $(e).closest(".onequstion").remove();
            countQuestions();
        });
			
        $("#addButton").click(function() {
		
            var el = $(".onequstiontemplate").clone()
            .removeClass('onequstiontemplate')
            .addClass('onequstion');
		
            $(el).find('label.quesnum').text('<?php echo lang('Question'); ?> ' + counter + ' :');

            $(el).appendTo('#TextBoxesGroup').show();

            counter++;

            $('#cont').val(counter);
            //alert(counter);
			
			
            countQuestions();
        });
    });
	
	
	
    function countQuestions()
    {
        var i =0;
        $('#TextBoxesGroup .onequstion .quesnum').each(function(){i++;$(this).text('<?php echo 'Question' ?> ' + i + ' :')});	
    }
</script>

<style>
    .error {
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
                <h5><i class="font-user"></i><?php echo $this->lang->line('') . $product_name; ?></h5>
                <!-- End page title -->
                <div class="body">


                    <!-- Content container -->
                    <div class="container">

                        <!-- Pickers -->
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="operation" value="set" />
                            <div class="row-fluid">

                                <!-- Column -->
                                <div class="span12">
                                    <!-- Time pickers -->
                                    <div class="block well">
                                        <div class="navbar">
                                            <div class="navbar-inner"><h5> <?php echo lang('Add') . ' ' . $product_name; ?></h5></div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang('Category') ?>:</label>
                                            <div class="controls">
                                                <select name="category" required>
                                                    <option value=""><?php echo lang('Select') ?></option>
                                                    <option value="Permanent Job"><?php echo lang('Permanent Job') ?></option>
                                                    <option value="Internship Program"><?php echo lang('Internship Program') ?></option>
                                                    <option value="Part Time Job"><?php echo lang('Part Time Job') ?></option>
                                                    <option value="Projects Contractors"><?php echo lang('Projects Contractors') ?></option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang('Job Title') ?>:</label>
                                            <div class="controls"><input id="title2" name="title" class="focustip span12" type="text" value="<?php echo set_value('title'); ?>" ></div>
                                            <span style="color:#F00;"><?php echo form_error('title'); ?></span>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang('Scope') ?>:</label>
                                            <div class="controls" id="scope">
                                                <textarea id="content" class="ckeditor" name="scope" ></textarea>
                                                <!--<input type="hidden" id="content_scope" name="scope" value="" />-->
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><?php echo lang('Qualification') ?>:</label>
                                            <div class="controls" id="qualification">
                                                <textarea id="content1" class="ckeditor" name="qualification" ></textarea>
                                                <!--<input type="hidden" id="content_qualification" name="qualification" value="" />-->
                                            </div>
                                        </div>                                                                

                                        <div class="control-group">
                                            <label class="control-label">Photo:</label>
                                            <div class="controls">


                                                <input type="file" style="float:left;margin-left:0px" name="file"  /></div>

                                            <div class="divjobimage">

                                                <div style="float:left">
                                                    <img class="hide" src="" alt="job image" >
                                                    <br>
                                                    <a class="job_delete_image hide" href="#" onclick="return confirm_box();"><?php echo lang('Delete') ?></a>
                                                </div>

                                                <input type="hidden" id="imagefile" name="imagefile" value=""/>

                                            </div>
                                            <div style="clear:both;">

                                                <p style="color:#F00"><?php echo lang('Please file must be : jpg, png, gif. maximum 800KB and maximum 1024X768') ?></p>

                                            </div>
                                        </div>
                                        <div id='TextBoxesGroup'></div>
                                        <input type='button'  value='<?php echo lang('Add Question') ?>' id="addButton" class="btn" >


                                        <div class="form-actions align-right">
                                            <input class="btn btn-primary" value="<?php echo lang('Add') ?>" id="send" type="submit">
                                        </div>



                                    </div>

                                </div>
                                <!-- /time pickers -->



                            </div>
                            <!-- /column -->

                        </form></div>

                    <!-- /pickers -->

                </div>
                <!-- /content container -->

            </div>
        </div>
    </div>
</div>




<div class="onequstiontemplate hide">
    <input type="hidden" name="quesid[]" value="">
    <div class="control-group">
        <label class="quesnum control-label">Question X:</label>
        <div class="controls">
            <input id="title2" name="question[]" class="focustip span10" type="text" value="" required="">
        </div>
        <br>
        <label class="control-label"><?php echo lang('Duration') ?> :</label>

        <div class="controls">
            <select name="duration[]" required="">
                <option><?php echo lang('Select'); ?></option>
                <?php
                $durations = array('1', '5', '10', '20', '30', '40', '50', '60');

                foreach ($durations as $dur):
                    ?>
                    <option value="<?php echo $dur ?>"><?php echo $dur ? $dur : "select" ?></option>													  
                    <?php
                endforeach;
                ?>
            </select>
        </div><br>
        <label class="control-label"><?php echo lang('Minimum Word') ?>:</label><div class="controls">
            <input type="text" name="minword[]" value="">
        </div></div>
    <span class="removeques" style="float:right;margin:-70px 56px;cursor:pointer"><?php echo lang('Remove'); ?></span>
</div>
</div>


<script type="text/javascript" src="<?php echo site_url('assets/admin/js/jquery.iframe-transport.js') ?>"></script>

<script type="text/javascript">
    $(document).on('change', 'input[type="file"]', function(event) {
        $.ajax(document.location + "?ajaxupload=1", {
            files : $(":file"),
            iframe : true,
        }).success(function(data) {
            data = $(data).text() ? $(data).text() : data;
            $(".divjobimage img").prop('src', 'assets/uploads/job_section/small/' + data).show();
            $("#imagefile").val(data);
            $(".job_delete_image").show();
        });

    });

    $(document).on('click', '.job_delete_image', function(event) {
        event.preventDefault();
        $(".divjobimage img").prop('src', '').hide();
        $(".job_delete_image").hide();
    });
</script>

<script>
    
    $(function(){        
         
        $('#scope .content').summernote({
            height: 150
        });
        
        $('#qualification .content').summernote({            
            height: 150
        });
        
        $("#scope ul.dropdown-menu li a").attr("href","javascript:void");
        $("#qualification ul.dropdown-menu li a").attr("href","javascript:void");
        
        $("#send").hover(function(){       
            
            //alert($("#scope .note-editable").html());
            
            $("#content_scope").val($("#scope .note-editable").html());
            
            //alert($("#qualification .note-editable").html());

            $("#content_qualification").val($("#qualification .note-editable").html());
            
        });
        
       
    });
            
</script>

<script type="text/javascript">
//<![CDATA[

	// This call can be placed at any point after the
	// <textarea>, or inside a <head><script> in a
	// window.onload event handler.

	// Replace the <textarea id="editor"> with an CKEditor
	// instance, using default configurations.
	CKEDITOR.replace( 'content',
    {
           filebrowserBrowseUrl :'<?php echo URLpath; ?>/ckeditor/filemanager/browser/default/browser.html?Connector=<?php echo URLpath; ?>/ckeditor/filemanager/connectors/php/connector.php',
           filebrowserImageBrowseUrl : '<?php echo URLpath; ?>/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?php echo URLpath; ?>/ckeditor/filemanager/connectors/php/connector.php',
           filebrowserFlashBrowseUrl :'<?php echo URLpath; ?>/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?php echo URLpath; ?>/ckeditor/filemanager/connectors/php/connector.php',
			  filebrowserUploadUrl  :'<?php echo URLpath; ?>/ckeditor/filemanager/connectors/php/upload.php?Type=File',
			  filebrowserImageUploadUrl : '<?php echo URLpath; ?>/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
		     filebrowserFlashUploadUrl : '<?php echo URLpath; ?>/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
	});
	
CKEDITOR.replace( 'content1',
    {
           filebrowserBrowseUrl :'<?php echo URLpath; ?>/ckeditor/filemanager/browser/default/browser.html?Connector=<?php echo URLpath; ?>/ckeditor/filemanager/connectors/php/connector.php',
           filebrowserImageBrowseUrl : '<?php echo URLpath; ?>/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?php echo URLpath; ?>/ckeditor/filemanager/connectors/php/connector.php',
           filebrowserFlashBrowseUrl :'<?php echo URLpath; ?>/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?php echo URLpath; ?>/ckeditor/filemanager/connectors/php/connector.php',
			  filebrowserUploadUrl  :'<?php echo URLpath; ?>/ckeditor/filemanager/connectors/php/upload.php?Type=File',
			  filebrowserImageUploadUrl : '<?php echo URLpath; ?>/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
		     filebrowserFlashUploadUrl : '<?php echo URLpath; ?>/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
	});

//]]>
</script>
