<?php
$filename = $file['file_name'];

$ext = pathinfo($filename, PATHINFO_EXTENSION);

$fileUrl = site_url("assets/uploads/winner_image/{$filename}");
?>

<!-- Added by kipldeveloper (R) on 09 - oct -2014 -->
<?php if(!empty($file['receipt_copy'])){ ?>
<input type="hidden" id="uploadedFile" name="receipt_copy_file" value="<?php echo $filename ?>" />
<?php } ?>

<?php if(!empty($file['passport_copy'])){ ?>
<input type="hidden" id="passport_file" name="passport_copy_file" value="<?php echo $filename ?>" />
<?php } ?>
 
 <!-- End here -->

<?php
if(in_array($ext, array('jpg','JPG','png'))) :
?>
<div class="imagepreview"><img src="<?php echo $fileUrl ?>" style="height: 300px; width: 100%;margin-left: 5%">
</div>
<?php
elseif (in_array($ext,array('doc','docx','pdf'))):
?>
	<iframe  style="height: 300px; width: 100%;margin-left: 5%" src="https://docs.google.com/viewer?url=<?php echo urlencode($fileUrl); ?>&embedded=true"></iframe>
<?php
endif;
?>
