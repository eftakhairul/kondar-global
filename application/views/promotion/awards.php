<script type="text/javascript">

    var result = '<?php echo $result; ?>';
    var successmsg = '<?php echo $msg; ?>';
    var sesstion_user_email = '<?php echo $sesstion_user_email; ?>';


    $(document).ready(function() {
       
        // the following block is commented by dhrubo, because in each module is not same at all
        // in some module if verification popup cancels then no block but in other module it does
        // so to make this common, i commented this block, now if any user cancels the verificaiton 
        //form of the award then he will not be blocked
       
        //        if ($.trim(sesstion_user_email) != "")
        //        {
        //            $.ajax({
        //                type: "POST",
        //                url: "promotion/checkTimeInBlock",
        //                data: 'email=' + sesstion_user_email,
        //                beforeSend: function() {
        //                    //	   alert('asa');
        //                    // $("#show_class").show();
        //                    // $("#show_class").html("Loading ...");
        //                },
        //                success: function(msg) {
        //                    //alert(msg);
        //                    var split_ele = msg.split('##*##');
        //                    msg = split_ele[0];
        //                    if ($.trim(split_ele[1]) == 1)
        //                    {
        //                        var block_min = Math.round(msg / 60);
        //                        block_min = 120 - block_min;
        //                        $('#user_block_box').modal('show');
        //                        $('#blockMsg').html('You have been blocked because the page is refreshed and for security  resaon you will be able to use your email in our website only after ' + block_min + ' minutes');
        //                        popwindowactive = false;
        //                    }
        //                }
        //            });
        //        }
        if ($.trim(result) == 'true')
        {
            if ($.trim(successmsg) == '1')
            {
                $('#notify_award_w0n_thanks_submsg').hide();
                $('#notify_award_w0n_thanks_msg').hide();
                $('#notify_award_w0n_thanks_msg1').show();
                successmsg = 0;

            }
            else
            {
                $('#notify_award_w0n_thanks_submsg').show();
                 $('#notify_award_w0n_thanks_msg').show();
                 $('#notify_award_w0n_thanks_msg1').hide();
            }
            $("#claim_award_form")[0].reset();
            sesstion_user_email = "";
            result = "";
            $('#awardstab').trigger('click');
            $('#claim_award_data').modal('hide');
            $('#notify_award_w0n_thanks').modal('show');
        }
        
        //        $(".imgInp").change(function() {
        //            readURL(this);
        //        });
        
        
        $(document).on('change','.imgInp', function(event) {
            $(".filepreview").html("");
            $(".filepreview").append("<blink><span style='margin-left:10%; color:red;'>Please wait we are generating preview ...</span><blink>");
       
            //alert($(".filepreview").html());
        
            blink(1);
        
            $.ajax("promotion/award_form_upload", {
                files: $(":file",this),
                iframe: true,
            }).success(function(data) {
                
                $("blink").remove();
                blink(0);
                $(".filepreview").addClass("notempty").html(data);
                
            });

        });  
        
        
        $(document).on('change','.imgInp1', function(event) {
        
            $(".filepreview1").html("");
            $(".filepreview1").append("<blink><span style='margin-left:10%; color:red;'>Please wait we are generating preview ...</span><blink>");
       
            //alert($(".filepreview1").html());
        
            blink(1);
        
            $.ajax("promotion/receipt_form_upload", {
                files: $(":file",this),
                iframe: true,
            }).success(function(data) {
                
                $("blink").remove();
                blink(0);
                
                $(".filepreview1").addClass("notempty").html(data);                
            });

        }); 
        
        
    
    });

    //    function readURL(input)
    //    {
    //        if (input.files && input.files[0])
    //        {
    //            var reader = new FileReader();
    //            reader.onload = function(e)
    //            {
    //                $('#blah_' + input.id).attr('src', e.target.result);
    //            }
    //            reader.readAsDataURL(input.files[0]);
    //        }
    //    }
  
    (function($, undefined) {
        "use strict";
        //alert("fdhd");
        // Register a prefilter that checks whether the `iframe` option is set, and
        // switches to the "iframe" data type if it is `true`.
        $.ajaxPrefilter(function(options, origOptions, jqXHR) {
            if (options.iframe) {
                options.originalURL = options.url;
                return "iframe";
            }
        });

        // Register a transport for the "iframe" data type. It will only activate
        // when the "files" option has been set to a non-empty list of enabled file
        // inputs.
        $.ajaxTransport("iframe", function(options, origOptions, jqXHR) {
            var form = null,
            iframe = null,
            name = "iframe-" + $.now(),
            files = $(options.files).filter(":file:enabled"),
            markers = null,
            accepts = null;

            // This function gets called after a successful submission or an abortion
            // and should revert all changes made to the page to enable the
            // submission via this transport.
            function cleanUp() {
                markers.prop("disabled", false);
                form.remove();
                iframe.one("load", function() { iframe.remove(); });
                iframe.attr("src", "javascript:false;");
            }

            // Remove "iframe" from the data types list so that further processing is
            // based on the content type returned by the server, without attempting an
            // (unsupported) conversion from "iframe" to the actual type.
            options.dataTypes.shift();

            // Use the data from the original AJAX options, as it doesn't seem to be 
            // copied over since jQuery 1.7.
            // See https://github.com/cmlenz/jquery-iframe-transport/issues/6
            options.data = origOptions.data;
    
            //alert(files.length);
    
            if (files.length) {
                form = $("<form enctype='multipart/form-data' method='post'></form>").
                    hide().attr({action: options.originalURL, target: name});

                // If there is any additional data specified via the `data` option,
                // we add it as hidden fields to the form. This (currently) requires
                // the `processData` option to be set to false so that the data doesn't
                // get serialized to a string.
                if (typeof(options.data) === "string" && options.data.length > 0) {
                    $.error("data must not be serialized");
                }
                $.each(options.data || {}, function(name, value) {
                    if ($.isPlainObject(value)) {
                        name = value.name;
                        value = value.value;
                    }
                    $("<input type='hidden' />").attr({name:  name, value: value}).
                        appendTo(form);
                });

                // Add a hidden `X-Requested-With` field with the value `IFrame` to the
                // field, to help server-side code to determine that the upload happened
                // through this transport.
                $("<input type='hidden' value='IFrame' name='X-Requested-With' />").
                    appendTo(form);

                // Borrowed straight from the JQuery source.
                // Provides a way of specifying the accepted data type similar to the
                // HTTP "Accept" header
                if (options.dataTypes[0] && options.accepts[options.dataTypes[0]]) {
                    accepts = options.accepts[options.dataTypes[0]] +
                        (options.dataTypes[0] !== "*" ? ", */*; q=0.01" : "");
                } else {
                    accepts = options.accepts["*"];
                }
                $("<input type='hidden' name='X-HTTP-Accept'>").
                    attr("value", accepts).appendTo(form);

                // Move the file fields into the hidden form, but first remember their
                // original locations in the document by replacing them with disabled
                // clones. This should also avoid introducing unwanted changes to the
                // page layout during submission.
                markers = files.after(function(idx) {
                    return $(this).clone();
                }).next();
                files.appendTo(form);

                return {

                    // The `send` function is called by jQuery when the request should be
                    // sent.
                    send: function(headers, completeCallback) {
                        iframe = $("<iframe src='javascript:false;' name='" + name +
                            "' id='" + name + "' style='display:none'></iframe>");

                        // The first load event gets fired after the iframe has been injected
                        // into the DOM, and is used to prepare the actual submission.
                        iframe.one("load", function() {

                            // The second load event gets fired when the response to the form
                            // submission is received. The implementation detects whether the
                            // actual payload is embedded in a `<textarea>` element, and
                            // prepares the required conversions to be made in that case.
                            iframe.one("load", function() {
                                var doc = this.contentWindow ? this.contentWindow.document :
                                    (this.contentDocument ? this.contentDocument : this.document),
                                root = doc.documentElement ? doc.documentElement : doc.body,
                                textarea = root.getElementsByTagName("textarea")[0],
                                type = textarea && textarea.getAttribute("data-type") || null,
                                status = textarea && textarea.getAttribute("data-status") || 200,
                                statusText = textarea && textarea.getAttribute("data-statusText") || "OK",
                                content = {
                                    html: root.innerHTML,
                                    text: type ?
                                        textarea.value :
                                        root ? (root.textContent || root.innerText) : null
                                };
                                cleanUp();
                                completeCallback(status, statusText, content, type ?
                                    ("Content-Type: " + type) :
                                    null);
                            });

                            // Now that the load handler has been set up, submit the form.
                            form[0].submit();
                        });

                        // After everything has been set up correctly, the form and iframe
                        // get injected into the DOM so that the submission can be
                        // initiated.
                        $("body").append(form, iframe);
                    },

                    // The `abort` function is called by jQuery when the request should be
                    // aborted.
                    abort: function() {
                        if (iframe !== null) {
                            iframe.unbind("load").attr("src", "javascript:false;");
                            cleanUp();
                        }
                    }

                };
            }
        });

    })(jQuery);
  
</script>
<script type="text/javascript">
    function blink(n) {
        var blinks = document.getElementsByTagName("blink");
        var visibility = n % 2 === 0 ? "visible" : "hidden";
        for (var i = 0; i < blinks.length; i++) {
            blinks[i].style.visibility = visibility;
        }
        setTimeout(function() {
            blink(n + 1);
        }, 500);
    }
    $(document).ready(function() {
        blink(1);
    });
</script>

<div class="container">
    <div class="row bread" style="display:none;">
        <div class="col-md-6"> 
            <div class="text-bread">
                <?php
                if (isset($page_data)) {
                    ?>
                    <a href="home"><?php echo lang('Home') ?></a>    / <a href="promotion"><?php echo lang('Promotion') ?></a> / <?php echo lang('awards'); ?>
                <?php } else { ?>
                    <a href="home"><?php echo lang('Home') ?></a>     / <a href="promotion"><?php echo lang('Promotion') ?></a>

                    <?php
                }
                ?>

                <?php echo lang('PROMOTION SECTION') ?> / <?php echo lang('AWARDS') ?>
            </div>
        </div>

    </div>
</div>

<div class="container">
    <div class="main-page">

        <div class="car-lists">
            <div class="form-fill-cart dis-form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="promotion-page">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li><a href="<?php echo base_url(); ?>promotion/index/#download-material"><?php echo lang('DOWNLOAD MATERIALS') ?> (<?php echo count($download_material); ?>)</a></li>
                                <li><a href="<?php echo base_url(); ?>promotion/index/#profile"><?php echo lang('PRESS RELEASE') ?> (<?php echo count($press_release); ?>)</a></li>
                                <li><a href="<?php echo base_url(); ?>promotion/index/#messages"><?php echo lang('CLIENT TESTIMONIAL') ?> (<?php echo count($client_testi); ?>) </a></li>
                                <li><a href="<?php echo base_url(); ?>promotion/index/#knowledge_center"><?php echo lang('KNOWLEDGE CENTER') ?> (<?php echo count($knowledge_center); ?>)</a></li>
                                <li class="active"><a href="<?php echo base_url(); ?>promotion/awards" id="awardstab"><?php echo lang('AWARDS') ?> </a></li>
                                <!-- data-toggle="tab"-->
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <?php /* ?><div class="tab-pane active" id="download-material">
                                  <div class="download-material">
                                  <div class="row">
                                  Downloads
                                  </div>
                                  </div>
                                  </div><!--End download-material-->
                                  <div class="tab-pane" id="profile">
                                  <div class="row">
                                  Profile
                                  </div>
                                  </div>
                                  <div class="tab-pane" id="messages">
                                  Messages
                                  </div><?php */ ?>

                                <div class="tab-pane active" id="awards">
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12">
                                            <div class="main-tab-award text-center">
                                                <img src="<?php echo base_url(); ?>/assets/template/images/enter_serial_number.png" class="img-responsive" alt="" style="margin:0 auto; margin-top:30px;" />
                                                <div class="clearfix"></div>
                                                <div class="col-xs-12">
                                                    <input class="serial_number" type="text" name="serial_number" id="serial_number" value="" placeholder="">
                                                </div>

                                                <div class="clearfix"></div>
                                                <div class="nav-prex-next text-center">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <a href="javascript:void(0);" id="checkSerialNumber" class="btn btn-primary btn-sm" style="width:50px">OK</a>	
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
<!--                                            <h5><?php //echo lang('Win a Laptop')  ?></h5>-->

                                            <h5><?php echo $award[0]['name']; ?></h5>

                                            <div><?php echo $award[0]['sort']; ?></div>
                                            <br/>
                                            <div>
                                                <?php echo $award[0]['description']; ?>

                                            </div>
                                        </div>
                                    </div>

                                </div><!--end of awards-->
                                <?php /* ?><div class="tab-pane" id="knowledge_center">

                                  <div class="row">
                                  </div>
                                  </div><!--End knowledge center--><?php */ ?>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div><!--End content-->
</div>



<!--Modal shopping decision cart-->
<div class="modal fade" id="enter_user_details"> 
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
            </div> -->
            <div class="modal-body nopadmodal_na"> 
                <div class="box-content-modal"> 

                    <div class="clearfix"></div>
                    <h2 class="title-modal normaltext"><?php echo $award_msg[0]['dealing_msg']; ?></h2>
                    <div class="clearfix"></div>
                    <div class="row">
                        <form method="post" enctype="multipart/form-data" id="saveBasicDetailsForm"> 
                            <input type="hidden" class="form-control" name="code" value="" >
                            <input type="hidden" class="country_title1" name="country_title1" id="country_title1" value="" >
                            <input type="hidden" name="code" id="code" value="">
                            <!--<div class="col-md-10 col-md-offset-1">-->
                            <div class="col-md-10">

                                <div class="margin_bottom_50 form-group">
                                    <label class="col-sm-5"><?php echo lang('Title') ?></label>
                                    <div class="col-sm-7">
                                        <select name="salutation" class="form-control">
                                            <option value='Mr.' data-title="Mr">Mr.</option>
                                            <option value='Ms.'  data-title="Ms">Ms.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                                <div class="margin_bottom_50 form-group">
                                    <label class="col-sm-5"><?php echo lang('Name and Surname') ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="name" id="name" value="" placeholder="Name and Surname">
                                    </div>

                                </div>
                                <div class="clearfix"></div>
                                <div class="margin_bottom_50 form-group">
                                    <label class="col-sm-5"><?php echo lang('Country') ?></label>
                                    <div class="col-sm-7" id="popupboxcountrywrap">

                                        <select name="country" id="country"  style="width:220px;">                                    	
                                            <?php foreach ($countries as $country) { ?>
                                                <option value='<?php echo $country['idCountry']; ?>' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo $country['alpha_2']; ?>" data-title="<?php echo $country['countryName']; ?>" <?php
                                            if ($country['countryName'] == "Canada") {
                                                echo "selected='selected'";
                                            }
                                                ?>><?php echo $country['countryName']; ?></option>
                                                    <?php } ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="clearfix"></div>
                                <div class="margin_bottom_50 form-group">
                                    <label class="col-sm-5"><?php echo lang('Telephone') ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="telephone" id="telephone" value="" placeholder="Telephone">
                                    </div>

                                </div>
                                <div class="clearfix"></div>
                                <div class="margin_bottom_50 form-group">
                                    <label class="col-sm-5"><?php echo lang('Email') ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="email" id="email" value="" placeholder="Email">
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="btn-modal">
                        <div class="row">
                            <div class="col-md-12 col-xs-12 text-right">
                                <img style="display:none;" src="images/loading.gif"  alt="Loading" class="loaderimage" />&nbsp;<a href="javascript:void(0);" class="btn btn-primary btn-sm" id="saveBasicDetails"><?php echo lang('Continue') ?> <i class="glyphicon glyphicon-chevron-right"></i></a>	
                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--Modal shopping decision cart-->
<div class="modal fade" id="check_mail_code"> 
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
            </div> -->
            <div class="modal-body"> 
                <div class="box-content-modal"> 

                    <div class="clearfix"></div>

                    <h2 class="title-modal text-align-center" style="text-decoration: none; text-transform: inherit;"><?php echo lang('Email verification process') ?></h2>

                    <div class="blink alert-danger emailcode-error" style="display:none; margin-left: 49px; width: 407px;"></div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <form method="post" enctype="multipart/form-data" id="checkVerificationCode"> 
                            <input type="hidden" class="form-control" name="code_VerificationCode" id="code_VerificationCode" value="" >
                            <input type="hidden" class="form-control" name="user_email" id="user_email" value="" >
                            <input type="hidden" class="form-control" name="user_details_name" id="user_details_name" value="" >
                            <input type="hidden" class="form-control" name="user_details_countries" id="user_details_countries" value="" >
                            <input type="hidden" class="form-control" name="user_details_telephone" id="user_details_telephone" value="" >

                            <div class="col-md-10 col-md-offset-1">

                                <div class="verification_msg">
                                    <div id="emailawardtyped"></div>
                                    
                                    <?php echo str_replace('REPLACE_EMAIL',$sesstion_user_email,$award_msg[0]['email_verification_message']);  ?>
                                    
<!--                                    Thank you for assisting us validate your email address. We just sent a verification code to your email: <span id="msg_email_span"></span>. Please enter the correct verification code in three attempts and within 20 minutes. In addition, we request you to avoid refresh the page, as it will block your email for 120 minutes.   -->

                                </div>
                                <div style="width: 33%; margin: 0 auto; padding-top: 5px; padding-bottom: 12px;">
                                    <div id="timer1"></div>
                                </div>
                                <div class="margin_bottom_80 form-group">
                                    <label class="col-sm-5"><?php echo lang('Verification Code') ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="emailVerificationCode" id="emailVerificationCode" value="" placeholder="Verification Code">
                                    </div>

                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <div class="btn-modal">
                        <div class="row">
                            <div class="col-md-12 col-xs-12 text-right">
                                <img id="loaderimagecontinue" style="display:none;" src="images/loading.gif" alt="Loading" />	<a href="javascript:void(0);" class="btn btn-primary btn-sm" id="emailVerificationCodeSubmit"><?php echo lang('Continue') ?> <i class="glyphicon glyphicon-chevron-right"></i></a>	
                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!--Modal shopping decision cart-->
<div class="modal fade" id="notify_award_fail">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
            </div> -->
            <div class="modal-body">
                <div class="box-content-modal">
                    <img src="<?php echo base_url(); ?>assets/template/images/award_fail.jpg" alt="" class="img-responsive" >
                    <h2 class="title-modal"><?php echo $award_msg[0]['not_winning_no']?></h2>
                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <div class="row">

                            <div class="col-md-12 col-xs-12 text-right">
                                <a href="javascript:void(0);" onClick="$('#notify_award_fail').modal('hide');
                                    $('#serial_number').val('');" class="btn btn-primary btn-sm"><?php echo lang('OK') ?> <i class="glyphicon glyphicon-chevron-right"></i></a>	
                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--Modal shopping decision cart-->
<div class="modal fade" id="notify_award_w0n">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
            </div> -->
            <div class="modal-body">
                <div class="box-content-modal">
                    <img src="<?php echo base_url(); ?>assets/template/images/won.jpg" alt="" class="img-responsive">
                    <h2 class="title-modal newstylewinner"><span id="awards_file"></span></h2>
                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <div class="row">

                            <div class="col-md-12 col-xs-12 text-right">
                                <a href="javascript:void(0);" onClick="ClaimAwardForm();" class="btn btn-primary btn-sm"><?php echo lang('Claim Award') ?> <i class="glyphicon glyphicon-chevron-right"></i></a>	
                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--Modal shopping decision cart-->
<div class="modal fade" id="user_block_box">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
            </div> -->
            <div class="modal-body">
                <div class="box-content-modal">
                    <?php /* ?><img src="<?php echo base_url();?>assets/template/images/Blocked.jpg" alt="" class="img-responsive"><?php */ ?>
                    <div class="blockElementWrap">
                        <div class="blockMsg" id="blockMsg"><?php echo $award_msg[0]['verification_timeout'];  ?></div>
                    </div>
                                    <!--<h2 class="title-modal" id="blockMsg1"><?php echo lang('You Have Been Blocked. Please Try After 120 minutes.') ?></h2>-->
                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <div class="row">

                            <div class="col-md-12 col-xs-12 text-right">
                                <a href="javascript:void(0);" onClick="$('#user_block_box').modal('hide');
                                    $('#serial_number').val('');" class="btn btn-primary btn-sm" id="block_confirm_msg"><?php echo lang('OK') ?> <i class="glyphicon glyphicon-chevron-right"></i></a>	
                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--Modal shopping decision cart-->
<div class="modal fade" id="not_kgt_part_no">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
            </div> -->
            <div class="modal-body">
                <div class="box-content-modal">


                    <div class="not_kgt_part_no_title" style="font-size: 18px;text-transform: uppercase;color: red;font-weight: bold;
                         text-decoration: underline;"><?php echo lang('This is not a KGT Part Number.') ?></div>
                    <div class="not_kgt_part_no_sub_title"  style="font-size: 13px;text-transform: uppercase;font-weight: bold;
                         "><?php echo lang('Please double check your record.') ?></div>
                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <div class="row">

                            <div class="col-md-12 col-xs-12 text-right">
                                <a href="javascript:void(0);" onClick="$('#not_kgt_part_no').modal('hide');
                                    $('#serial_number').val('');" class="btn btn-primary btn-sm"><?php echo lang('OK') ?> <i class="glyphicon glyphicon-chevron-right"></i></a>	
                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Modal shopping decision cart-->
<div class="modal fade" id="notify_award_w0n_thanks">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
            </div> -->
            <div class="modal-body">
                <div class="box-content-modal">

                    <div class="not_kgt_part_no_title" style="font-size: 18px;text-transform: uppercase;color: red;font-weight: bold;
                         text-decoration: underline;" id="notify_award_w0n_thanks_msg"><?php echo $award_msg[0]['Thank_you_header']; ?></div>
                    <div class="not_kgt_part_no_title" style="font-size: 18px;text-transform: uppercase;color: red;font-weight: bold;
                         text-decoration: underline;" id="notify_award_w0n_thanks_msg1"><?php echo $award_msg[0]['already_submitted']; ?></div>
                    <div class="not_kgt_part_no_sub_title"  style="font-size: 13px;text-transform: uppercase;font-weight: bold;
                         " id="notify_award_w0n_thanks_submsg"><?php echo $award_msg[0]['Thank_you_msg']; ?></div>
                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <div class="row">

                            <div class="col-md-12 col-xs-12 text-right">
                                <a href="javascript:void(0);" onClick="$('#notify_award_w0n_thanks').modal('hide');
                                    $('#serial_number').val('');" class="btn btn-primary btn-sm"><?php echo lang('OK') ?> <i class="glyphicon glyphicon-chevron-right"></i></a>	
                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--Modal shopping decision cart-->
<div class="modal fade" id="claim_award">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
            </div> -->
            <div class="modal-body">
                <div class="box-content-modal">
                    <div class="clearfix"></div>
                    <h2 class="title-modal text-align-center"><?php echo lang('Please enter Your details') ?></h2>
                    <div class="clearfix"></div>
                    <div style="width: 32%; margin: 0 auto; padding-top: 5px; padding-bottom: 12px;">
                        <div id="promotiontimer"></div>
                    </div>
                    <div class="row">

                        <div class="col-md-11">
                            <form class="form-horizontal" role="form" enctype="multipart/form-data" id="claim_award_form" method="post">
                                <input type="hidden" name="claim_award_countries_title1" id="claim_award_countries_title1" class="form-control" >
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><?php echo lang('WINNING NUMBER') ?> </label>
                                    <input type="hidden" name="claim_award_code_VerificationCode" id="claim_award_code_VerificationCode" value="#arva#asd50">
                                    <div class="col-sm-7" id="claim_award_winning_number" >
                                        012012-54525485648-4590458345-45435
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><?php echo lang('Title') ?></label>
                                    <div class="col-sm-7">
                                        <select name="salutation" id="salutation" class="form-control">
                                            <option value='Mr.' data-title="Mr">Mr.</option>
                                            <option value='Ms.'  data-title="Ms">Ms.</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><?php echo lang('Name and Surname') ?> </label>
                                    <div class="col-sm-7">
                                        <input type="text" name="claim_award_name" id="claim_award_name" class="form-control" placeholder="Name and Surname">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><?php echo lang('Country') ?></label>
                                    <div class="col-sm-7" id="popupboxcountrywrap2">
                                        <select name="claim_award_countries" id="claim_award_countries"  style="width:262px;">                                    	
                                            <?php
                                            foreach ($countries as $country) {
                                                if ($country['countryName'] == 'Canada') {
                                                    ?>
                                                    <option selected="selected" value='<?php echo $country['idCountry']; ?>' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo $country['alpha_2']; ?>" data-title="<?php echo $country['countryName']; ?>"><?php echo $country['countryName']; ?></option>
                                                <?php } else { ?>
                                                    <option value='<?php echo $country['idCountry']; ?>' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag <?php echo $country['alpha_2']; ?>" data-title="<?php echo $country['countryName']; ?>"><?php echo $country['countryName']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>                                 
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><?php echo lang('Telephone') ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="claim_award_telephone" id="claim_award_telephone" placeholder="Telephone">
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><?php echo lang('Email') ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="claim_award_email" name="claim_award_email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><?php echo lang('Passport ID') ?> </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control input-address" id="claim_award_passport_id" name="passport_id" placeholder="Passport ID">
                                    </div>
                                </div>

                                <div class="form-group imgInp">
                                    <label class="col-sm-5 control-label"><?php echo lang('Upload passport copy') ?></label>
                                    <div class="col-sm-7 imgInp">

<input type="file" style="float:left" id="imgInp2" name="passport_copy"> <!-- <div class="img-preview" id="img-preview11"><img src="" class="margin-bottom-top_-10" width="70" height="70" alt=""  id="blah_imgInp2"></div>-->
                                        <span class="help" style="display:block; clear:both">
                                            <?php echo lang('Png. jpeg, pdf with 1Mb size acceptable') ?>
                                        </span>



                                    </div>
                                    <div class="form-group">
                                        <div class="filepreview">                                                            


                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><?php echo lang('Address') ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="claim_award_address" name="address" placeholder="Address">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><?php echo lang('Occupation') ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="claim_award_occupation" name="occupation" placeholder="Occupation">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label"><?php echo lang('Product supplier') ?></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="claim_award_product_supplier" name="product_supplier" placeholder="Product supplier">
                                    </div>
                                </div>

                                <div class="form-group imgInp1">
                                    <label class="col-sm-5 control-label"><?php echo lang('Receipt copy') ?></label>
                                    <div class="col-sm-7 imgInp1">
                                        <input type="file" style="float:left"  id="imgInp1" name="receipt_copy"> <!-- <div class="img-preview" id="img-preview22"><img src="" class="margin-bottom-top_-10" alt="" width="70" height="70"  id="blah_imgInp1"></div>-->
                                        <span class="help" style="display:block; clear:both">
                                            <?php echo lang('Png. jpeg, pdf with 1Mb size acceptable') ?>
                                        </span>


                                    </div>

                                    <div class="form-group">
                                        <div class="filepreview1">                                                            


                                        </div>
                                    </div>
                                </div>


                            </form>

                        </div>
                    </div>
                    <div class="btn-modal">
                        <div class="row">

                            <div class="col-md-12 col-xs-12 text-right">
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" id="claim_award_button"><?php echo lang('Continue') ?> <i class="glyphicon glyphicon-chevron-right"></i></a>	
                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Modal shopping decision cart-->
<div class="modal fade" id="claim_award_data">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Modal title</h4>
            </div> -->
            <div class="modal-body">
                <div class="box-content-modal">
                    <div class="clearfix"></div>
                    <h2 class="title-modal text-align-center"><?php echo lang('Please check Your details') ?></h2>
                    <div class="clearfix"></div>
                    <div style="width: 32%; margin: 0 auto; padding-top: 5px; padding-bottom: 12px;">
                        <div id="timer3"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group">
                                <label class="col-sm-5 control-label"><?php echo lang('WINNING NUMBER') ?> </label>
                                <div class="col-sm-7" id="claim_award_winning_number_data" >

                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label"><?php echo lang('Title') ?> </label>
                                <div class="col-sm-7" id="claim_award_salutation">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label"><?php echo lang('Name and Surname') ?> </label>
                                <div class="col-sm-7" id="claim_award_data_name">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label"><?php echo lang('Country') ?></label>
                                <div class="col-sm-7" id="claim_award_data_country">


                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label"><?php echo lang('Telephone') ?></label>
                                <div class="col-sm-7" id="claim_award_data_telephone">
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <div class="form-group">
                                <label class="col-sm-5 control-label"><?php echo lang('Email') ?></label>
                                <div class="col-sm-7" id="claim_award_data_email">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label"><?php echo lang('Passport ID') ?> </label>
                                <div class="col-sm-7"  id="claim_award_data_passport_id">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <label class="col-sm-5 control-label"><?php echo lang('Upload passport copy') ?></label>
                            <div class="form-group">



                                <div class="filepreview" id="img-preview1"></div>

                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label"><?php echo lang('Address') ?></label>
                                <div class="col-sm-7"   id="claim_award_data_address">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label"><?php echo lang('Occupation') ?></label>
                                <div class="col-sm-7"   id="claim_award_data_occupation">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-sm-5 control-label"><?php echo lang('Product supplier') ?></label>
                                <div class="col-sm-7"  id="claim_award_data_product_supplier">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <label class="col-sm-5 control-label"><?php echo lang('Receipt copy') ?></label>
                            <div class="form-group">


                                <div class="filepreview" id="img-preview2"></div>

                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="clearfix"></div>
                    <div class="btn-modal">
                        <div class="row margin_bottom_top_20">
                            <div class="col-md-5 col-xs-5 text-left">
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" id="backtoconfirmpage"><i class="glyphicon glyphicon-chevron-left"></i><?php echo lang('Back') ?> </a>
                            </div>
                            <div class="col-md-6 col-xs-6 text-right">
                                <img id="loaderclaimawarddatabutton" style="display:none;" src="images/loading.gif"  alt="Loading"  /> <a href="javascript:void(0);" class="btn btn-primary btn-sm" id="claim_award_data_button"><?php echo lang('Continue') ?> <i class="glyphicon glyphicon-chevron-right"></i></a>	
                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
