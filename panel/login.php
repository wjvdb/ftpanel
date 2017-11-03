<?php
session_start();
$user = $_POST['user'];
$pass = md5($_POST['pass']);
if(!empty($_POST['user']) && !empty($_POST['pass'])){
	include 'db.php';
	$sql = "SELECT * FROM gebruiker WHERE user='$user' AND pass='$pass'";
		$resultaat = mysqli_query($verbinding, $sql);
		$rij = mysqli_fetch_array($resultaat, MYSQL_ASSOC);
		if(!$rij){
			header ('location:..\indexerr.php');
		}
		else{
		$_SESSION['userid']=$rij['user'];
		$_SESSION['id']=$rij['id'];
		$_SESSION['status']=$rij['status'];
		$aanmeldnummer = $_SESSION['id'];
		$sql = "INSERT INTO log(activity, gebruiker_id) VALUES('login', '$aanmeldnummer')";
		$resultaat = mysqli_query($verbinding, $sql) or die (mysqli_error());
		
		header ("location: ftp/startup.php");
		}
		
		
}
else{
	header ('location:..\indexempty.php');
}
?>