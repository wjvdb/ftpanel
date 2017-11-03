<?php
$controlestatus = $_SESSION['status'];
if(@$_SESSION['status']=="1"){
	session_destroy();
	header("location: ../error.php");
} 
if (!isset($controlestatus)){
		session_destroy();
	header("location: ../error.php");
}

?>