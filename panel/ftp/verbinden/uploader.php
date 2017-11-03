<?php
session_start();
if(!empty($_FILES['files']['name'][0])){
	$files = $_FILES['files'];
	$uploaded = array();
	
	foreach($files['name'] as $position => $filename)
	{
		$file_tmp = $files['tmp_name'][$position];
		$file_size = $files['size'][$position];
		$file_error = $files['error'][$position];
		$file_destination = 'upload/' . $filename;
		if(move_uploaded_file($file_tmp,$file_destination)){
			echo "succes";
		}
		
	}
}

$_SESSION['serversort'] = $_POST['serversort'];
$_SESSION['maplocatie'] = $_POST['locatie'];


header ('location: sender.php');
?>