<?php
session_start();
include('db.php');
$aanmeldnummer = $_SESSION['id'];
$sql = "INSERT INTO log(activity, gebruiker_id) VALUES('logout', '$aanmeldnummer')";
		$resultaat = mysqli_query($verbinding, $sql) or die (mysqli_error());


session_destroy();
header ('location: ../error.php');
?>