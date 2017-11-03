<?php
session_start();
$_SESSION["serverloc2"] .= $_GET['dirname']."/";
$_SESSION["currentloc2"] = "-> ";
$_SESSION["currentloc2"] .= $_GET['dirname'];
if ($_GET['dirname'] == ".."){
	$_SESSION["currentloc2"] = "";
}
header ('location: panel.php');
?>