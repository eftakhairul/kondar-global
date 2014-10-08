<div class="bodywrapper">
  <div class="container">
    <div class="main-page">
      <div class="car-lists">
        <div class="form-fill-cart">
          <div class="row"> </div>
        </div>
      </div>
    </div>
    <!--End content-->
  </div>
</div>
<script type="text/javascript">

	$(function(){
		$('.modal_block').modal('show');

	});

</script>
<div class="modal fade modal_block">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="box-content-modal">
          <h2 class="title-modal"><?php echo lang('Time Over') ?></h2>
          <p> <?php echo lang('Sorry your email ID has been blocked for 120 minutes.') ?> </p>
          <div class="clearfix"></div>
        
          <div class="btn-modal"> <a style="float:right" href="javascript:" onClick="$('.modal_block').modal('hide');document.location='<?php echo site_url("career/index") ?>'" class="block_bttn btn btn-primary btn-sm">OK <i class="glyphicon glyphicon-chevron-right"></i></a> </div> 
        </div>
      </div>
    </div>
  </div>
</div>
