<?php
include 'db.php';
$sql = "INSERT INTO log(activity, server, location, ftp_id, gebruiker_id) VALUES('$activitylog', '$serverlog', '$locationlog', '$ftpidlog', '$userlog')";
$resultaat = mysqli_query($verbinding, $sql) or die (mysqli_error());
?>