<?php
$filename = $file['file_name'];

$ext = pathinfo($filename, PATHINFO_EXTENSION);

$fileUrl = site_url("assets/uploads/licenses/{$filename}");
?>

<input type="hidden" id="filename" name="filename" value="<?php echo $filename ?>" />

<?php
if(in_array($ext, array('jpg','JPG','png','gif','tif'))) :
?>
<div class="imagepreview"><img src="<?php echo $fileUrl ?>" style="height: 300px; width: 95%;margin-left: 10px">
</div>
<?php
elseif (in_array($ext,array('doc' ,'docx','pdf'))):
?>
	<iframe style="height: 300px; width: 95%;margin-left: 10px" src="https://docs.google.com/viewer?url=<?php echo urlencode($fileUrl); ?>&embedded=true"></iframe>
<?php
endif;
?>
