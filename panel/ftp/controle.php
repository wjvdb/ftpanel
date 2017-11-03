<?php
session_start();
$loggedin = $_SESSION['userid'];
include 'db.php';
	$sql = "SELECT * FROM gebruiker WHERE user='$loggedin'";
	$resultaat = mysqli_query($verbinding, $sql);
		$rij = mysqli_fetch_array($resultaat, MYSQL_ASSOC);
		if($rij['status']=="1"){
			header ("location: logout.php");
		}
		else{
			header ("location: deleteuser.php");
		}
?>