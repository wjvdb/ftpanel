<?php
session_start();
include 'db.php';
$ipid1 = $_SESSION["servertje1"];
$ipid2 = $_SESSION["servertje2"];
$user = $_SESSION['userid'];

/* $user = $_SESSION['id']; */
//popup verbinding
 function do_alert($msg) 
    {
        echo '<script type="text/javascript">alert("' . $msg . '"); window.location = "sync.php"; </script>';
    }
//gegevens verzamelen

$ftp_user_name = $_SESSION['username'];
$ftp_user_pass = $_SESSION['userpass'];

$sql = "SELECT * FROM ftp where id='$ipid2'";
$resultaat = mysqli_query($verbinding, $sql);
$rij = mysqli_fetch_array($resultaat, MYSQL_ASSOC);
$ftp_server2 = $rij['adress'];
$port = $rij['port'];
$conn_id = ftp_connect($ftp_server2,$port);
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);


//check connectie
if ((!$conn_id) || (!$login_result)) { 
    echo "FTP connection has failed!";
    echo "Attempted to connect to $ftp_server2 for user $ftp_user_name"; 
    exit; 
} else {
    do_alert(" verbonden met: ftp server2: $ftp_server2 | gebruikersnaam: $ftp_user_name | wachtwoord: $ftp_user_pass | poort: $port");
	$_SESSION["username"] = $ftp_user_name;
$_SESSION["userpass"] = $ftp_user_pass;
$_SESSION["ftpserver2"] = $ftp_server2;
$_SESSION["port2"] = $port;


	}



?>