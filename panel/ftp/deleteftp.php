<?php
include 'db.php';
$deleteid = $_POST['servertje'];

$sql = "DELETE FROM ftp WHERE id='$deleteid';";
if(!mysqli_query($verbinding, $sql)){
	echo ("verwijderen is mislukt server is gekoppeld aan het logboek");
	exit;
}
else{
	header ("location: ftp.php");
}
?>