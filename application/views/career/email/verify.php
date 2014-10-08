<html>

	<body>

		<div style="border:solid #666">

			<div style="background-color:#000;color:#FFF;text-align:center;">
				<img src="<?php echo base_url();?>/assets/template/images/logo.png" style="border-width:0px; padding: 4px 0px 1px 9px;">
				<h1 style="margin:0px;line-height:70px;font-style:italic; font-weight:normal;"><?php echo lang('KGT VERIFICATION CODE') ?></h1>

			</div>

			<div style="background-color:#FFF;color:#000;">

				<h3 style="margin: 42px 20px 29px 20px; font-weight:normal;"><?php echo lang('Dear') ?> <?php echo $name ?>,</h3>

			</div>

          <?php /*?>  <div style="background-color:#999;color:#FFF;">

                <h3 style="margin-left:20px;line-height:80px;">Career verification code send attempt: <b style="font-weight:bold">

                  <?=$attempt?>

                  </b></h3>

              </div><?php */?>

			<div>

				<h3 style="margin: 32px 20px 29px 20px; font-weight:normal;"><?php echo lang('Your KGT Verification Code') ?>:<span style="color:red"> <?php echo $dynamic_code ?></span></h3>

			</div>

			<div style="background-color:#FFF;color:#000;padding-left:20px;font-size:24px;line-height:10px">

				<p style="font-size:12px;" >

					<?php echo lang('Regards') ?>,

					<br>

					<br>

					<?php echo lang('KGT HR Department') ?>

				</p>

			</div>

		</div>

	</body>

</html>