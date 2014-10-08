<?php
$filename = $file['file_name'];

$ext = pathinfo($filename, PATHINFO_EXTENSION);

$fileUrl = site_url("assets/uploads/document/{$filename}");
?>

<input type="hidden" name="filename" value="<?php echo $filename ?>" />

<?php
if(in_array($ext, array('jpg','JPG','png','gif'))) :
?>
<div class="imagepreview"><img src="<?php echo $fileUrl ?>" style="height: 300px; width: 300px;">
</div>
<?php
elseif (in_array($ext,array('doc' ,'docx','pdf'))):
?>
	<iframe src="https://docs.google.com/viewer?url=<?php echo urlencode($fileUrl); ?>&embedded=true"></iframe>
<?php
endif;
?>
