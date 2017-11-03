<?php
session_start();
$lijst = $_POST;


//print_r($lijst);
//verwijderen
if(array_key_exists("delete", $lijst))
{
	if ($lijst["delete"] == 'server1'){
		$_SESSION["deleteside"] = "a2b";
		$_SESSION["filelist"] = $lijst;
		header ('location: delete.php');
	}
	if ($lijst["delete"] == 'server2'){
		$_SESSION["deleteside"] = "b2a";
		$_SESSION["filelist"] = $lijst;
		header ('location: delete.php');
	}
	
}
//kopieren
else if(array_key_exists("copy", $lijst))
{
	if ($lijst["copy"] == 'server1'){
		$_SESSION["copyorder"] = "a2b";
		$_SESSION["filelist"] = $lijst;
		header ('location: copy.php');
	}
	if ($lijst["copy"] == 'server2'){
		$_SESSION["copyorder"] = "b2a";
		$_SESSION["filelist"] = $lijst;
		header ('location: copy.php');
	}
}
//downloaden
else if(array_key_exists("download", $lijst))
{
if ($lijst["download"] == 'server1'){
		$_SESSION["downloadorder"] = "a2b";
		$_SESSION["filelist"] = $lijst;
		header ('location: download.php');
	}
	if ($lijst["download"] == 'server2'){
		$_SESSION["downloadorder"] = "b2a";
		$_SESSION["filelist"] = $lijst;
		header ('location: download.php');
	}
}
//hernoemen
else if(array_key_exists("rename", $lijst))
{
		if ($lijst["rename"] == 'server1'){
		$_SESSION["rename"] = "a2b";
		$_SESSION["filelist"] = $lijst;
		header ('location: rename.php');
	}
	if ($lijst["rename"] == 'server2'){
		$_SESSION["rename"] = "b2a";
		$_SESSION["filelist"] = $lijst;
		header ('location: rename.php');
	}
}
//verplaatsen
else if(array_key_exists("move", $lijst))
{
		if ($lijst["move"] == 'server1'){
		$_SESSION["moveorder"] = "a2b";
		
		header ('location: move.php');
	}
	if ($lijst["move"] == 'server2'){
		$_SESSION["moveorder"] = "b2a";
		
		header ('location: move.php');
	}
}
//synchroniseren
else if(array_key_exists("syncorder", $lijst))
{
		if ($lijst["syncorder"] == 'a2b'){
		$ftp_user_name = $_SESSION["username1"];
		$ftp_user_pass = $_SESSION["userpass1"];
		$ftp_server = $_SESSION["ftpserver1"];
		$port = $_SESSION["port1"];
		$_SESSION['syncorder'] = "a2b";
		header ('location: mdtm.php');
	}
	if ($lijst["syncorder"] == 'b2a'){
		$ftp_user_name = $_SESSION["username2"];
		$ftp_user_pass = $_SESSION["userpass2"];
		$ftp_server = $_SESSION["ftpserver2"];
		$port = $_SESSION["port2"];
		$_SESSION['syncorder'] = "b2a";
		header ('location: mdtm.php');
	}
}
else if(array_key_exists("setmove", $lijst))
{
		if ($lijst["setmove"] == 'server1'){
		$_SESSION["movesource"] = "a2b";
		$_SESSION["filelist"] = $lijst;
		$_SESSION["moveset"] = $_SESSION['serverloc1'];
		header ('location: panel.php');
	}
	if ($lijst["setmove"] == 'server2'){
		$_SESSION["movesource"] = "b2a";
		$_SESSION["filelist"] = $lijst;
		$_SESSION["moveset"] = $_SESSION['serverloc2'];
		header ('location: panel.php');
	}
}
else if(array_key_exists("unset", $lijst))
{
		if ($lijst["unset"] == 'server1'){
		$_SESSION["movesource"] = "";
		$_SESSION["filelist"] = "";
		$_SESSION["moveset"] = "empty";
		header ('location: panel.php');
	}
	if ($lijst["unset"] == 'server2'){
		$_SESSION["movesource"] = "";
		$_SESSION["filelist"] = "";
		$_SESSION["moveset"] = "empty";
		header ('location: panel.php');
	}
}

?>