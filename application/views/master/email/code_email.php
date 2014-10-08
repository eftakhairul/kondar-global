<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>email</title>
</head>
<body>
<div style="border:solid #666">
  <div style="background-color:#000;color:#FFF;text-align:center;">
      <img src="<?php echo base_url();?>/assets/template/images/logo.png" style="border-width:0px; padding: 4px 0px 1px 9px;">
    <h1 style="margin:0px;line-height:70px;font-style:italic; font-weight:normal;">KGT VERIFICATION CODE</h1>
    
  </div>
  <div style="background-color:#FFF;color:#000;">
    <h3 style="margin-left:20px;line-height:50px; font-weight:normal;">Dear
      <?=$name?>
      ,</h3>
  </div>
 <?php /*?> <div style="background-color:#999;color:#FFF;">
    <h3 style="margin-left:20px;line-height:80px;">Contact us verification code send attempt: <b style="font-weight:bold">
      <?=$attempt?>
      </b></h3>
  </div><?php */?>
  <div>
      <h3 style="margin-left:20px;line-height:30px; font-weight:normal;">Your contact us form verification code is :<span style="color:red"><?=$dynamic_code?></span>
      
     </h3>
  </div>
  <div style="background-color:#FFF;color:#000;padding-left:20px;font-size:24px;line-height:10px">
    <p style="font-size:12px;" >Regards,<br>
      <br>
      KGT Customer Service Department</p>
  </div>
</div>
</body>
</html>
