<?php
//download image
if(isset($_GET['file'])){
	$filename = $_GET['file'];
	$filepath = "uploads/".$filename;
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
	header('Content-Length: ' . filesize($filepath));
	readfile($filepath);
	exit;
}
?>
