<?php
session_start();
$_SESSION["serverloc1"] .= $_GET['dirname']."/";
$_SESSION["currentloc1"] = "-> ";
$_SESSION["currentloc1"] .= $_GET['dirname'];
if ($_GET['dirname'] == ".."){
	$_SESSION["currentloc1"] = "";
}
header ('location: panel.php');
?>