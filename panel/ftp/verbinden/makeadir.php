<?php
session_start();

$useorder = $_POST['serversort'];
$locator = $_POST['locatie'];
if ($useorder == "a2b"){
$_SESSION["serverloc1"] = $locator;
$_SESSION['serverpath1'] = $pathlog;
}
if ($useorder == "b2a"){
	$_SESSION["serverloc2"] = $locator;
	$_SESSION['serverpath2'] = $pathlog;
}
$newdir = $_POST['mapnaam'];
include 'useorder.php';
$dirname = $locator . $newdir;
ftp_mkdir ($conn_id,$dirname);
$serverlog = NULL;
$locationlog = "$locator";
$ftpidlog = $ftpida;
$userlog = $_SESSION['id'];
$activitylog = "map $newdir aangemaakt"; 
include 'sqlog.php';
if ($useorder == "a2b"){
	$_SESSION["serverloc1"] = "/";
}
if ($useorder == "b2a"){
	$_SESSION["serverloc2"] = "/";
}
header ('location: panel.php');
?>