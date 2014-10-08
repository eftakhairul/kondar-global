<div class="col-md-3">
    <div class="searchdiv">
        <label for="Search" style="display:none;"><?php echo lang('Search') ?>  </label> 	     
        <input id="Search" type="text" name="Articles" placeholder="Search Articles" />
        <input id="SearchBtn" type="button" class="headersearchbutton" value=" " />
        <ul id="searchresult" class="">
        </ul>
    </div>
</div>
<!--Modal request for new item in quick search-->
<div class="modal fade" id="enquiry_partnumber_details"> 
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-body"> 
                <div class="box-content-modal"> 
                    <div class="clearfix"></div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <form method="post" enctype="multipart/form-data" id="senditemenquiry" action="<?php echo base_url('contact') ?>"> 
                            <input type="hidden" class="form-control" name="code" id="code" value=" " />
                            <input type="hidden" class="country_title1" name="country_title1" value=" " />
                            <div class="col-md-10 col-md-offset-1">
                                We did not recognize your part number <span id="spnsearchedpartnumber"></span>. Please send us a detailed email about it and we will cross-reference it and revert accordingly.                                
                            </div>
                        </form>
                    </div>
                    <br />
                    <div class="btn-modal">
                        <div class="row">
                            <div class="col-md-12 col-xs-12 text-right">
                                <img id="loaderimage" style="display:none;" src="images/loading.gif" alt="Loading"/>&nbsp;<a href="javascript:" class="btn btn-primary btn-sm " id="enquirysubmit_contctredirect" style="float:left;">OK <i class="glyphicon glyphicon-chevron-right"></i></a>&nbsp;&nbsp;
                                <a style="float:right" href="javascript:" onClick="$('#enquiry_partnumber_details').modal('hide')" class="btn btn-primary btn-sm"><?php echo lang('Cancel') ?> <i class="glyphicon glyphicon-chevron-right"></i></a> 
                            </div>                            	 
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->