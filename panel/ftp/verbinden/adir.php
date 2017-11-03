<?php



$ftp_user_name = $_POST["user"];
$ftp_user_pass = $_POST["pass"];

$ftp_server = $_POST["ftp"];
$port = $_POST["port"];

$conn_id = ftp_connect($ftp_server,$port);
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
$dir = $_POST["dirname"];

if (ftp_mkdir($conn_id, $dir)){
	echo "succesfully created $dir";
	include 'eentest.php';
} else{
	echo "fail";
}
?>