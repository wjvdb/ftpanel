<?php
$localhost = "localhost";
$lgin = "root";
$wachtwoord = "";
$db_naam = "ftpanel";

$verbinding2 = mysqli_connect("$localhost","$lgin","$wachtwoord") or die ("kon geen verbinding maken met de database. ".mysqli_error());
$db = mysqli_select_db($verbinding2, "$db_naam") or die ("kon geen database selecteren. ".mysqli_error());



?>