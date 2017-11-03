<?php
session_start();
$user = $_SESSION['user'];
$pass = $_SESSION['wachtwoord'];

	include 'db.php';
	$sql = "SELECT * FROM gebruiker WHERE user='$user' AND pass='$pass';";
		$resultaat = mysqli_query($verbinding, $sql);
		$rij = mysqli_fetch_array($resultaat, MYSQL_ASSOC);
		$aanmeldnummer = $rij['id'];
		$sql = "INSERT INTO log(activity, gebruiker_id) VALUES('aangemaakt', '$aanmeldnummer')";
		$resultaat = mysqli_query($verbinding, $sql) or die (mysqli_error());
		$_SESSION['userid']=$rij['user'];
		$_SESSION['id']=$rij['id'];
		$_SESSION['status']=$rij['status'];
		header ("location: ftp/first.php");
		
		
		


?>