<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>
<head>
    <title><?php echo $this->lang->line('distribution_email_title'); ?></title>
</head>
<body>

    <div style="border:solid #666">
       

        <div style="background-color:#000;color:#FFF;text-align:center;">
            <img src="<?php echo base_url(); ?>assets/template/images/logo.png" style="border-width:0px; padding: 4px 0px 1px 9px;">
            <h1 style="margin:0px;line-height:70px;font-style:italic"> <?php echo $title; ?> </h1>
        </div>

        <div style="padding: 21px 14px 0px 5px;font-size:13px;">
            <span style="font-size: 15px;">Dear</span> <?php echo $dear; ?>,<br/><br/>
        </div>
        <div style="padding:5px">
            <div style="font-size:12px;">
                <p><?php echo $content; ?></p>
            </div>	
            <table width="100%" border="1px">
                <tr>
                    <td  width="30%">Your name and surname </td>
                    <td style="padding:5px !important;color:red;" width="70%"><?php echo $_POST['applicant']; ?></td>
                </tr>
                 <tr>
                    <td  width="30%">Your company name </td>
                    <td style="padding:5px !important;color:red;" width="70%"><?php echo $_POST['company']; ?></td>
                </tr>
                 <tr>
                    <td  width="30%">Your country</td>
                    <td style="padding:5px !important;color:red;" width="70%">
                        <img src="<?php echo base_url(); ?>/assets/template/flags/<?php echo $flag_name; ?>.png"/> 
                            <?php echo ' '.$_POST['hdn_country_name']; ?>
                        
                        <?php //echo str_replace('assets/', base_url() . 'assets/', urldecode($_POST['hdn_country_label'])); ?></td>
                </tr> <tr>
                    <td  width="30%">Your address </td>
                    <td style="padding:5px !important;color:red;" width="70%"><?php echo $_POST['address']; ?></td>
                </tr> <tr>
                    <td  width="30%">Your designation within your company: </td>
                    <td style="padding:5px !important;color:red;" width="70%"><?php echo $_POST['designation']; ?></td>
                </tr>
                <tr>
                    <td  width="30%">Your telephone number  </td>
                    <td style="padding:5px !important;color:red;" width="70%"><?php echo $_POST['telephone']; ?></td>
                </tr> 
                <tr>
                    <td  width="30%">Your email address: </td>
                    <td style="padding:5px !important;color:red;" width="70%"><?php echo $_POST['email']; ?></td>
                </tr>
                <tr>
                    <td  width="100%" colspan="2">We think the following match our needs::<span style="color:red"><?php echo $_POST['companysize'] == 'big' ? $this->lang->line('modal_dist_popup_fieldset_1_1') : $this->lang->line('modal_dist_popup_fieldset_1_2'); ?></span></td>
                </tr> 
                <tr>
                    <td  width="30%" colspan="2">We want to start with KGT by distributing the following: :<span style="color:red"><?php echo $_POST['companystart']; ?></span></td>
                   
                </tr> 
                <tr>
                    <td  width="100%" colspan="2">KGT will support (<span style="color:red"><?php echo (isset($_POST['applicant']) ? $_POST['applicant'] : ''); ?></span>) with all the major promotional tools (samples. Catalog, Brochures, Posters, Audio, Visual advertising). In addition KGT will share a big percentage of the marketing campaign cost. In the other hand KGT requires (<span style="color:red"><?php echo (isset($_POST['company']) ? $_POST['company'] : ''); ?></span>) to have and maintain their own sales force as well as minimum KGT product inventory.</td>
                </tr>
                 <tr>
                    <td  width="30%">Number of Indoor Sales staffs: </td>
                    <td style="padding:5px !important;color:red;" width="70%"><?php echo $_POST['sel_indoor_sales']; ?></td>
                </tr>
                <tr>
                    <td  width="30%">Number of Outdoor Sales staffs:  </td>
                    <td style="padding:5px !important;color:red;" width="70%"><?php echo $_POST['sel_outdoor_sales']; ?></td>
                </tr>
                <tr>
                    <td  width="30%">Please write in brief all the product that you are currently selling: </td>
                    <td style="padding:5px !important;color:red;" width="70%"><?php echo $_POST['salesbrief']; ?></td>
                </tr>
                 <tr>
                    <td  width="100%" colspan="2">I am (<span style="color:red"><?php echo (isset($_POST['applicant']) ? $_POST['applicant'] : ''); ?></span>) the representative of (<span style="color:red"><?php echo (isset($_POST['company']) ? $_POST['company'] : ''); ?></span>) hereby confirms that all the above information is correct and up to date. In addition, I do not have any objection that KGT verify this data using its own ways.</td>
                </tr>
                <tr>
                    <td  width="30%">Our company trade licence copy </td>
                    <td style="padding:5px !important;" width="70%"><a href='<?php echo base_url(); ?>assets/uploads/licenses/<?php echo $_POST['filename']; ?>'> 
                    <?php echo $this->lang->line('distribution_email_license_link_2'); ?></a></span></td>
                </tr>
                
            </table>
            <div style="background-color:#FFF;color:#000;font-size:15px;line-height:10px">
                <p  style="font-size:15px; font-weight: bold;"><?php echo $this->lang->line('distribution_email_regards_1'); ?><br/><br/>
            <?php echo $regards; ?>  </p>
            </div>

        </div>
    </div>		
</body>
</html>