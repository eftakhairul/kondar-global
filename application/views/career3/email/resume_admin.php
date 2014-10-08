<html>
<body>
<div style="border:solid #666">
  <div style="background-color:#000;color:#FFF;text-align:center;">
  <img src="<?php echo base_url();?>/assets/template/images/logo.png" style="border-width:0px; padding: 4px 0px 1px 9px;">
    <h1 style="margin:0px;line-height:70px;font-style:italic">New job application form</h1>
  </div>
  <div style="background-color:#FFF;color:#000;">
    <h3 style="margin-left:20px;line-height:50px; font-weight:normal;">Dear HR Manager,</h3>
    <p style="margin-left:20px;font-size:15px;font-weight: bold; "> The following is my job application. I hope it will meet your expectations. </p>
  </div>
  <div style="padding:20px;">
    <table width="100%" border="1px">
      <tr>
        <td style="width:30%; padding: 5px">Name and surname</td>
        <td style="width:70%; padding: 5px;color:red;"><?php echo $user_data1['name'] ?></td>
      </tr>
      <tr>
        <td style="width:30%; padding: 5px">Candidate email address</td>
        <td style="width:70%; padding: 5px;color:red;"><?php echo $user_data1['email'] ?></td>
      </tr>
      <tr>
        <td style="width:30%; padding: 5px">Candidate phone number</td>
        <td style="width:70%; padding: 5px;color:red;"><?php echo $user_data1['contact'] ?></td>
      </tr>
      <tr>
        <td style="width:30%; padding: 5px">Country</td>
        <td style="width:70%; padding: 5px;color:red;"><img src="<?php echo base_url(); ?>/assets/template/flags/<?php echo $user_data1['flag_name']; ?>.png"/> <?php echo ' '.$user_data1['country'] ?></td>
      </tr>
      <tr>
        <td style="width:30%; padding: 5px">Job Designation</td>
        <td style="width:70%; padding: 5px;color:red;"><?php echo $job['name'] ?></td>
      </tr>
    </table>
    <h3 style="font-weight:normal;">Screening questions</h3>
    <table width="100%" border="1px">
      <?php					
	  $i = 1;					
	  reset($set_data);					
	  foreach ($answer as $set_data) : $question = $this -> comman_model -> get_data_by_id('question', array('id' => $set_data['question_id']));	
      ?>
      <tr>
        <td style="width:100%; padding: 5px"><?php echo lang('Question') ?> <?php echo $i ?>: <?php echo $question['name'] ?></td>
      </tr>
      <tr>
        <td style="width:100%; padding: 5px"><?php echo lang('Answer') ?>:<span style="color:red;"> <?php echo $set_data['answer'] ?></span></td>
      </tr>
      <?php					$i++;					endforeach;					?>
    </table>
  </div>
  <div style="background-color:#FFF;color:#000;padding-left:20px;font-size:24px;line-height:10px">
    <p  style="font-size:20px; font-weight: bold;"><?php echo lang('Regards') ?>,<br/>
      <br/>
      <?php echo $user_data1['name'] ?></p>
  </div>
</div>
</body>
</html>
