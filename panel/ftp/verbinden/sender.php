<?php
session_start();

$useorder = $_SESSION['serversort'];
$locator = $_SESSION['maplocatie'];
if ($useorder == "a2b"){
$_SESSION["serverloc1"] = $locator;
}
if ($useorder == "b2a"){
$_SESSION["serverloc2"] = $locator;
}

include 'useorder.php';
/*
	variables
	$directoriesa -- bronmappen
	$filesa -- bronbestanden
	$directoriesb -- doelmappen
	$filesb -- doelbestanden

*/
$bestanden = glob('upload/*.*');
$serverlog = NULL;
$locationlog = $locator;
if (ftp_nlist($conn_id, $locator) == false) {
    $locationlog = "/";
}
$ftpidlog = $ftpida;
$userlog = $_SESSION['id'];
foreach ($bestanden as $bestand){
	
	$uploadname = preg_split("/[\\/]+/",$bestand);
	$uploadfile = $uploadname[1];
	if (ftp_put ($conn_id, $uploadfile, $bestand, FTP_BINARY)){
		if (unlink ($bestand)){
				$activitylog = "bestand $uploadfile geupload"; 
		include 'sqlog.php';
			}
	} 

}
if ($useorder == "a2b"){
$_SESSION["serverloc1"] = "/";
}
if ($useorder == "b2a"){
$_SESSION["serverloc2"] = "/";
}
header ('location: panel.php');
?>