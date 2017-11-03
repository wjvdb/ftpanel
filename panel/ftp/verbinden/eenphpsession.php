<?php
session_start();
include 'db.php';
$ipid = $_POST['servertje'];
$user = $_SESSION['userid'];
$_SESSION["servertje"] = $ipid;
/* $user = $_SESSION['id']; */
//popup verbinding
 function do_alert($msg) 
    {
        echo '<script type="text/javascript">alert("' . $msg . '"); window.location = "eentest.php"; </script>';
    }
//gegevens verzamelen

$ftp_user_name = $_POST['user'];
$ftp_user_pass = $_POST['pass'];

$sql = "SELECT * FROM ftp where id='$ipid'";
$resultaat = mysqli_query($verbinding, $sql);
$rij = mysqli_fetch_array($resultaat, MYSQL_ASSOC);
$ftp_server = $rij['adress'];
$port = $rij['port'];
$conn_id = ftp_connect($ftp_server,$port);
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);


//check connectie
if ((!$conn_id) || (!$login_result)) { 
    echo "FTP connection has failed!";
    echo "Attempted to connect to $ftp_server for user $ftp_user_name"; 
    exit; 
} else {
    do_alert(" verbonden met: ftp server: $ftp_server | gebruikersnaam: $ftp_user_name | wachtwoord: $ftp_user_pass | poort: $port");
	$_SESSION["username"] = $ftp_user_name;
$_SESSION["userpass"] = $ftp_user_pass;
$_SESSION["ftpserver"] = $ftp_server;
$_SESSION["port"] = $port;


	}



?>