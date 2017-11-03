<?php
session_start();
include 'db.php';
/* popup verbinding */
  function do_alert($msg) 
     {
         echo '<script type="text/javascript">alert("' . $msg . '"); </script>';
     }
$ipid1 = $_POST['servertje1'];
$ipid2 = $_POST['servertje2'];
$user = $_SESSION['userid'];
$_SESSION["servertje1"] = $ipid1;
$_SESSION["servertje2"] = $ipid2;

// sessie voor mapnavigatie
$_SESSION["serverloc1"] = "";
$_SESSION["serverloc2"] = "";
$_SESSION["currentloc1"] = "";
$_SESSION["currentloc2"] = "";

/* $user = $_SESSION['id']; */

$ftp_user_name1 = $_POST['user1'];
$ftp_user_name2 = $_POST['user2'];
$ftp_user_pass1 = $_POST['pass1'];
$ftp_user_pass2 = $_POST['pass2'];


//gegevens verzamelen server1


$sql = "SELECT * FROM ftp where id='$ipid1'";
$resultaat = mysqli_query($verbinding, $sql);
$rij1 = mysqli_fetch_array($resultaat, MYSQL_ASSOC);
$ftp_server1 = $rij1['adress'];
$port1 = $rij1['port'];
$_SESSION['selectname1'] = $rij1['name'];
@$conn_id1 = ftp_connect($ftp_server1, $port1);
@$login_result1 = ftp_login($conn_id1, $ftp_user_name1, $ftp_user_pass1);
//print_r($_POST);


//gegevens verzamelen server2


include 'db2.php';

$sql = "SELECT * FROM ftp where id='$ipid2'";
$resultaat2 = mysqli_query($verbinding2, $sql);
$rij = mysqli_fetch_array($resultaat2, MYSQL_ASSOC);
$ftp_server2 = $rij['adress'];
$port2 = $rij['port'];
$_SESSION['selectname2'] = $rij['name'];
@$conn_id2 = ftp_connect($ftp_server2,$port2);
@$login_result2 = ftp_login($conn_id2, $ftp_user_name2, $ftp_user_pass2);

//check connectie server1
if ((!$conn_id1) || (!$login_result1)) { 
  echo "<h2>FTP verbinding is mislukt!</h2><br>";
     echo "Poging tot verbinding gedaan naar $ftp_server1 <br>gebruiker:  $ftp_user_name1 <br>wachtwoord: $ftp_user_pass1 <br> poort: $port1"; 
	 echo "<br><a href='..'>terug</a>";
     exit; 
} else {
	$_SESSION["username1"] = $ftp_user_name1;
	$_SESSION["userpass1"] = $ftp_user_pass1;
	$_SESSION["ftpserver1"] = $ftp_server1;
	$_SESSION["port1"] = $port1;
	do_alert(" verbonden met: ftp server: $ftp_server1 | gebruikersnaam: $ftp_user_name1 | wachtwoord: $ftp_user_pass1 | poort: $port1");
	if ((!$conn_id2) || (!$login_result2)) { 
    echo "<h2>FTP verbinding is mislukt!</h2><br>";
     echo "Poging tot verbinding gedaan naar $ftp_server2 <br>gebruiker:  $ftp_user_name2 <br>wachtwoord: $ftp_user_pass2 <br> poort: $port2"; 
	 echo "<br><a href='..'>terug</a>";
     exit; 
} else {
	$_SESSION["username2"] = $ftp_user_name2;
	$_SESSION["userpass2"] = $ftp_user_pass2;
	$_SESSION["ftpserver2"] = $ftp_server2;
	$_SESSION["port2"] = $port2;
	do_alert(" verbonden met: ftp server: $ftp_server2 | gebruikersnaam: $ftp_user_name2 | wachtwoord: $ftp_user_pass2 | poort: $port2");
	
	//log aanmelding bij server
	$serverconnect = "ingelogd bij server " . $ipid1 . " en " . $ipid2;
	$aanmeldnummer = $_SESSION['id'];
	$sql = "INSERT INTO log(activity, gebruiker_id) VALUES('$serverconnect', '$aanmeldnummer')";
	$resultaat = mysqli_query($verbinding, $sql) or die (mysqli_error());
	
	$_SESSION["moveset"] = "empty";
	
	header ('location: panel.php');
	}

	}



?>