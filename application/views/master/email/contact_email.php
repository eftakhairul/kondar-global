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
                <h1 style="margin:0px;line-height:70px;font-style:italic; font-weight:normal;">New contact us form</h1>
                
            </div>
            <div style="background-color:#FFF;color:#000;">
                <?php if ($user == 'admin') { ?>
                    <h3 style="margin-left:20px;line-height:50px; font-weight:normal;">Dear Customer service manager,</h3>
                <?php } else { ?>
                    <h3 style="margin-left:20px;line-height:50px; font-weight:normal;">Dear <?=$user?>,</h3>
                <?php } ?>
                <?php if ($user == 'admin') { ?>
                    <p style="margin-left:20px;font-size:12px">The following is a new contact us form verified by KGT. Please review and act accordingly.</p>
                <?php } else { ?>
                    <p style="margin-left:20px;font-size:12px">Thank you for contacting KGT. This is a copy of the email that you just sent us. We should review and act accordingly. If it is urgent, then please feel free to contact us by phone, as we are available 24/7. Thank you again for your valuable time.</p>
                <?php } ?>
            </div>
            <div style="padding:20px">
<!--                <h2 style="font-weight:normal;">User Information</h2>-->
                <table width="100%" border="1px">
                    <tr>
                        <td  width="30%">KGT Branch </td>
                        <td style="padding:5px !important;color:red;" width="70%"><img src="<?php echo base_url(); ?>/assets/template/flags/<?php echo $this->session->userdata['user_contact_data']['branchflag']; ?>.png"/><?=$user_data1['branch']?></td>
                    </tr>
                    <tr>
                        <td style="padding:5px !important" width="30%">Company :</td>
                        <td style="padding:5px !important;color:red;" width="70%"><?=$user_data1['company']?></td>
                    </tr>
                    <tr>
                        <td style="padding:5px !important" width="30%">Designation :</td>
                        <td style="padding:5px !important;color:red;" width="70%"><?=$user_data1['designation']?></td>
                    </tr>
                    <tr>
                        <td style="padding:5px !important" width="30%">Country :</td>
                        <td style="padding:5px !important;color:red;" width="70%"><img src="<?php echo base_url(); ?>/assets/template/flags/<?php echo $this->session->userdata['user_contact_data']['countryflag']; ?>.png"/><?=$user_data1['country']?></td>
                    </tr>
                    <tr>
                        <td style="padding:5px !important" width="30%">Telephone :</td>
                        <td style="padding:5px !important;color:red;" width="70%"><?=$user_data1['contact']?></td>
                    </tr>
                    <tr>
                        <td style="padding:5px !important" width="30%" style="vertical-align:top;">Message :</td>
                        <td style="padding:5px !important;color:red;" width="70%"><?=$user_data1['message']?></td>
                    </tr>
                </table>
            </div>
            <div style="background-color:#FFF;color:#000;padding-left:20px;font-size:24px;line-height:10px">
                <p  style="font-size:12px;">Regards,<br>
                    <br><?php if ($user == 'admin') {
                    echo $user_data1['name'];
                } else {
                    echo 'KGT Customer Service Department';
                }; ?>
                </p>
            </div>
        </div>
    </body>
</html>
<style type="text/css">
    td{
        padding: 5px;
    }
</style>