<?php

//------------------------------------------------------------------------------------------------------------
// server a naar b
//------------------------------------------------------------------------------------------------------------



if ($useorder == "a2b"){
	
?> <!-- volgorde van a naar b geselecteerd --> <?php
//server a
$ftp_user_name = $_SESSION['username1'];
$ftp_user_pass = $_SESSION['userpass1'];
$ftp_server = $_SESSION['ftpserver1'];
$port = $_SESSION['port1'];


$conn_id = ftp_connect($ftp_server,$port);
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
//check connectie
if ((!$conn_id) || (!$login_result)) { 
    echo "FTP connection has failed!";
      echo "Attempted to connect to $ftp_server for user $ftp_user_name"; 
     exit; 
 } else {
     ?> <!-- server1 correct verbonden --> <?php
 }
 
//server b 
$ftp_user_name2 = $_SESSION['username2'];
$ftp_user_pass2 = $_SESSION['userpass2'];
$ftp_server2 = $_SESSION['ftpserver2'];
$port2 = $_SESSION['port2'];

$connect_it = ftp_connect($ftp_server2, $port2);
$login_result = ftp_login($connect_it, $ftp_user_name2, $ftp_user_pass2);
if ((!$connect_it) || (!$login_result)) { 
     echo "FTP connection has failed!";
      echo "Attempted to connect to $ftp_server for user $ftp_user_name"; 
     exit; 
 } else {
     ?> <!-- server2 correct verbonden --> <?php
 }

// standaard richting
 
$ftpida = $_SESSION['servertje1'];
$ftpidb = $_SESSION['servertje2'];

// navigeren naar map waarin actie wordt aangeroepen
 
 $serverloca = $_SESSION["moveset"];
ftp_chdir($conn_id, "$serverloca");
 
$serverlocb = $_SESSION["serverloc2"];
ftp_chdir($connect_it, "$serverlocb");

// mappen lijst van bronserver

@$directoriesa = $selectedobjects["dirserver1"];
@$filesa = $selectedobjects["fileserver1"];
// mappen lijst van doelserver
@$directoriesb = $selectedobjects["dirserver2"];
@$filesb = $selectedobjects["fileserver2"];
$logpatha = ftp_pwd($conn_id);
 $logpathb =ftp_pwd($connect_it);
}


//------------------------------------------------------------------------------------------------------------
// server b naar a
//------------------------------------------------------------------------------------------------------------


else if($useorder == "b2a"){
	
?> <!-- volgorde van b naar a geselecteerd --> <?php
	//server a
$ftp_user_name = $_SESSION['username2'];
$ftp_user_pass = $_SESSION['userpass2'];
$ftp_server = $_SESSION['ftpserver2'];
$port = $_SESSION['port2'];

$conn_id = ftp_connect($ftp_server,$port);
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
//check connectie
if ((!$conn_id) || (!$login_result)) { 
    echo "FTP connection has failed!";
    echo "Attempted to connect to $ftp_server for user $ftp_user_name"; 
     exit; 
 } else {
     ?> <!-- server1 correct verbonden --> <?php
 }
 
//server b 
$ftp_user_name2 = $_SESSION['username1'];
$ftp_user_pass2 = $_SESSION['userpass1'];
$ftp_server2 = $_SESSION['ftpserver1'];
$port2 = $_SESSION['port1'];

$connect_it = ftp_connect($ftp_server2, $port2);
$login_result = ftp_login($connect_it, $ftp_user_name2, $ftp_user_pass2);
if ((!$connect_it) || (!$login_result)) { 
     echo "FTP connection has failed!";
     echo "Attempted to connect to $ftp_server for user $ftp_user_name"; 
     exit; 
 } else {
     ?> <!-- server2 correct verbonden --> <?php
 }

// navigeren naar map waarin actie wordt aangeroepen
 
$serverloca = $_SESSION["moveset"];
ftp_chdir($conn_id, "$serverloca");
 
$serverlocb = $_SESSION["serverloc1"];
ftp_chdir($connect_it, "$serverlocb");

$logpatha = ftp_pwd($conn_id);
 $logpathb =ftp_pwd($connect_it);

$ftpida = $_SESSION['servertje2'];
$ftpidb = $_SESSION['servertje1'];

// mappen lijst van bronserver
@$directoriesa = $selectedobjects["dirserver2"];
@$filesa = $selectedobjects["fileserver2"];
// mappen lijst van doelserver
@$directoriesb = $selectedobjects["dirserver1"];
@$filesb = $selectedobjects["fileserver1"];


}


?>