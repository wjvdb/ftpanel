<?php
include 'db.php';
$number = $_GET['number'];
$sql = "DELETE  FROM  note WHERE id=$number";
	echo "$number";
	
	if(!mysqli_query($verbinding, $sql)){
		echo ("verwijderen van abonnee is mislukt");
		exit;
	}
	else{
		unlink ("note/$number.txt");
		header ("location: index.php");
	}
?>