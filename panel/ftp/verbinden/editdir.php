<?php
session_start();

$newname = $_POST['newname'];
$dirname = $_POST['dirname'];
$ftp_user_name = $_SESSION["username"];
$ftp_user_pass = $_SESSION["userpass"];
$ftp_server = $_SESSION["ftpserver"];
$port = $_SESSION["port"];
echo ("huidige mapnaam $dirname <br> nieuwe mapnaam $newname <br> ftp gebruiker $ftp_user_name <br> ftp wachtwoord $ftp_user_pass 
<br> ftp server $ftp_server <br> poort $port");


$conn_id = ftp_connect($ftp_server);

$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

if (ftp_rename($conn_id, $dirname, $newname)){
	echo "success";
	//echo "<meta http-equiv='refresh' content='1;url=eentest.php' />";
}
else{
	echo "fail";
}

//gegevens registreren in database
include 'db.php';
$servertje = $_SESSION['servertje'];
$paneluser = $_SESSION['userid'];
$activity = "$dirname gewijzigd naar $newname";
$server = "single server";
$sql = "INSERT INTO log(activity) VALUES ('$activity')";
$resultaat = mysqli_query($verbinding, $sql) or die (mysqli_error());

$sql = "INSERT INTO log(location, ftp_id, gebruiker_id) VALUES ('$ftp_server', '$servertje', '$paneluser')";
$resultaat = mysqli_query($verbinding, $sql) or die (mysqli_error());
?>