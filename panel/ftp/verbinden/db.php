<?php
$localhost = "localhost";
$lgin = "root";
$wachtwoord = "";
$db_naam = "ftpanel";

$verbinding = mysqli_connect("$localhost","$lgin","$wachtwoord") or die ("kon geen verbinding maken met de database. ".mysqli_error());
$db = mysqli_select_db($verbinding, "$db_naam") or die ("kon geen database selecteren. ".mysqli_error());


/* function doLog($activitylog, $serverlog, $locationlog, $ftpidlog, $userlog,$verbinding)
{
	echo "startlog ";
	echo "$activitylog, $serverlog, $locationlog, $ftpidlog, $userlog <br>";
$sql = "INSERT INTO log(activity, server, location, ftp_id, gebruiker_id) VALUES('$activitylog', '$serverlog', '$locationlog', '$ftpidlog', '$userlog')";
print $sql."<br/>";
echo "midlog ";
return mysqli_query($verbinding, $sql) or die (mysqli_error($verbinding));
echo "endlog ";
} */



?>