<!doctype html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>email</title></head>
<body><div style="border:solid #666"><div style="background-color:#000;color:#FFF;text-align:center;">
<img src="{base_url}/assets/template/images/logo.png" style="border-width:0px; padding: 4px 0px 1px 9px;">
<h1 style="margin:0px;line-height:70px;font-style:italic; font-weight:normal;">user Information</h1>
</div>
<div style="background-color:#FFF;color:#000;">
<h3 style="margin-left:20px;line-height:50px; font-weight:normal;">Dear <?=$user?></h3>
<p style="margin-left:20px;font-size:12px">This email ID successfully verified by KGT. Please send them product code and downloadable link of relevant product</p></div>
<div style="padding:20px">
<h2 style="font-weight:normal;">User Information</h2>
<table width="100%" border="1px">
<tr><td>Name</td><td><?=$user_data1['name']?></td></tr>
<tr><td>Email</td><td><?=$user_data1['email']?></td></tr>
<tr><td>Company</td><td><?=$user_data1['company']?></td></tr>
<tr><td>Contact</td><td><?=$user_data1['contact']?></td></tr>
<tr><td>Country</td><td><?=$user_data1['country']?></td></tr>
<tr><td>Branch</td><td><?=$user_data1['branch']?></td></tr>
<tr><td>Designation</td><td><?=$user_data1['designation']?></td></tr>
<tr><td>Message</td><td><?=$user_data1['message']?></td></tr>
<tr><td>Product Name</td><td><?=$product['name']?></td></tr>
<?php if($is_admin) {?><tr><td>Download brochure</td><td><?=$user_data1['user_code']?></td></tr><?php }?>
</table>
</div><div style="background-color:#FFF;color:#000;padding-left:20px;font-size:24px;line-height:10px"><p  style="font-size:12px;">Regards,<br><br>KGT HR Department</p>
</div></div></body></html>
