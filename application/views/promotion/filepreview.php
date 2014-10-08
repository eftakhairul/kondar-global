<?php
$filename = $file['file_name'];

$ext = pathinfo($filename, PATHINFO_EXTENSION);

$fileUrl = site_url("assets/uploads/winner_image/{$filename}");
?>

<input type="hidden" name="filename" value="<?php echo $filename ?>" />

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
