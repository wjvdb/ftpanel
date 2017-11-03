<?php
session_start();

$syncorder = $_SESSION['syncorder'];
include 'db.php';

// server a naar b


if ($syncorder == "a2b")
{
	//server a
	$ftp_user_name = $_SESSION['username1'];
	$ftp_user_pass = $_SESSION['userpass1'];
	$ftp_server = $_SESSION['ftpserver1'];
	$port = $_SESSION['port1'];


	$conn_id = ftp_connect($ftp_server,$port);
	$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
	//check connectie
	if ((!$conn_id) || (!$login_result)) 
	{
		echo "FTP connection has failed!";
		echo "Attempted to connect to $ftp_server for user $ftp_user_name"; 
		exit; 
	} 
	else
	{
		?> <!-- server1 correct verbonden --> <?php
	}
	 
	//server b 
	$ftp_user_name2 = $_SESSION['username2'];
	$ftp_user_pass2 = $_SESSION['userpass2'];
	$ftp_server2 = $_SESSION['ftpserver2'];
	$port2 = $_SESSION['port2'];

	$connect_it = ftp_connect($ftp_server2, $port2);
	$login_result = ftp_login($connect_it, $ftp_user_name2, $ftp_user_pass2);
	if ((!$connect_it) || (!$login_result)) 
	{ 
		echo "FTP connection has failed!";
		echo "Attempted to connect to $ftp_server for user $ftp_user_name"; 
		exit; 
	} 
	else 
	{
		?> <!-- server2 correct verbonden --> <?php
	}
	 
	$ftpida = $_SESSION['servertje1'];
	$ftpidb = $_SESSION['servertje2'];
}

// server b naar a

else if($syncorder == "b2a")
{
	//server a
	$ftp_user_name = $_SESSION['username2'];
	$ftp_user_pass = $_SESSION['userpass2'];
	$ftp_server = $_SESSION['ftpserver2'];
	$port = $_SESSION['port2'];

	$conn_id = ftp_connect($ftp_server,$port);
	$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
	//check connectie
	if ((!$conn_id) || (!$login_result)) 
	{ 
		echo "FTP connection has failed!";
		echo "Attempted to connect to $ftp_server for user $ftp_user_name"; 
		exit; 
	}
	else 
	{
		?> <!-- server1 correct verbonden --> <?php
	}
	 
	//server b 
	$ftp_user_name2 = $_SESSION['username1'];
	$ftp_user_pass2 = $_SESSION['userpass1'];
	$ftp_server2 = $_SESSION['ftpserver1'];
	$port2 = $_SESSION['port1'];

	$connect_it = ftp_connect($ftp_server2, $port2);
	$login_result = ftp_login($connect_it, $ftp_user_name2, $ftp_user_pass2);
	if ((!$connect_it) || (!$login_result)) 
	{ 
			 echo "FTP connection has failed!";
			 echo "Attempted to connect to $ftp_server for user $ftp_user_name"; 
			 exit; 
	} 
	else 
	{
		?> <!-- server2 correct verbonden --> <?php
	}
	 
	$ftpida = $_SESSION['servertje2'];
	$ftpidb = $_SESSION['servertje1'];
}
 
// controle tijd instellen 

$remotepin = "startpin.html";
$localpin = $remotepin;
if (@ftp_get($conn_id, $localpin, $remotepin, FTP_BINARY))
{
	
	$starttime = ftp_mdtm($conn_id,"startpin.html");
	
}
else{
	fopen ($remotepin, "x");
	ftp_put($conn_id, $remotepin, $localpin, FTP_BINARY);
	$starttime = mktime(0, 0, 0, 1, 1, 1975);
}

//log in startpin
$synclog = fopen ("startpin.html", "a+") or die("niet beschikbaar");
$logtijdid = date("m d Y H:i:s");
$logtijdlink = date ("m.d.Y.H.i.s");
$begintijd = "<br><br><h3> starttijd $logtijdid van synchronisatie </h3><a href='#$logtijdlink'>ga naar bodem</a><br>\n";
fwrite($synclog,$begintijd);

fclose($synclog);


function CurrentLocationInfo($contents)
{
	$rawlist = array();
	foreach($contents as $v)
	{
		$info = array();
		$vinfo = preg_split("/[\s]+/", $v, 9);
		if ($vinfo[0] !== "total") 
		{
		  $info['chmod'] = $vinfo[0];
		  $info['num'] = $vinfo[1];
		  $info['owner'] = $vinfo[2];
		  $info['group'] = $vinfo[3];
		  $info['size'] = $vinfo[4];
		  $info['month'] = $vinfo[5];
		  $info['day'] = $vinfo[6];
		  $info['time'] = $vinfo[7];
		  $info['name'] = $vinfo[8];
		  $rawlist[$info['name']] = $info;
		}
	}
	
	return $rawlist;
}



function SelectDir($conn_id,$connect_it,$dirname,$starttime)
{
				ftp_chdir ($conn_id,$dirname);
				ftp_chdir ($connect_it,$dirname);
				synctool($conn_id,$connect_it,$starttime);
				ftp_chdir ($conn_id,"..");
				ftp_chdir ($connect_it,"..");
				$locarray = array($conn_id,$connect_it,$dirname,$starttime);
				return $locarray;
}

function LogWriter($dirname,$action)
{
	$dirnamelog = $dirname . $action . "<br>\n";
	$synclog = fopen ("startpin.html", "a+") or die("niet beschikbaar");
	fwrite($synclog,$dirnamelog);
	fclose($synclog);
}



//functie synchronisatie tool
function synctool($conn_id,$connect_it,$starttime)
{	
	$contents = ftp_rawlist($conn_id, ".");
	$rawlist = CurrentLocationInfo($contents);
	$dir = array();
	$file = array();
	if(!empty($rawlist))
	{
		foreach ($rawlist as $k => $v) 
		{
			if ($v['chmod']{0} == "d") 
			{
			  $dir[$k] = $v;
			} 
			elseif ($v['chmod']{0} == "-") 
			{
			  $file[$k] = $v;
			}
		}
	}

	//server doel  
	$contents = ftp_rawlist($connect_it, ".");
	$rawlist2 = CurrentLocationInfo($contents);
	$dir2 = array();
	$file2 = array();
	if(!empty($rawlist2))
	{
		foreach ($rawlist2 as $k => $v) 
		{
			if ($v['chmod']{0} == "d") 
			{
			  $dir2[$k] = $v;
			} 
			elseif ($v['chmod']{0} == "-") 
			{
			  $file2[$k] = $v;
			}
		}
	}
	  
	  


	  //controle op mappen en aanmaken ervan
		foreach ($dir as $dirname => $dirinfo)
		{
			
				if (array_key_exists($dirname,$dir2))
				{
					SelectDir($conn_id,$connect_it,$dirname,$starttime);
					
				}
				else
				{
					$dirbuf = ftp_mdtm($conn_id,$dirname);
					if($dirbuf != -1)
					{
						if (date("m d Y H:i:s.", $dirbuf) < date("m d Y H:i:s.", $starttime))
						{
							if (!array_key_exists($dirname,$dir2))
							{
								ftp_mkdir($connect_it,$dirname);
								echo "<font color='purple'><br> map $dirname is aangemaakt</font>";
								LogWriter($dirname," aangemaakt");
								SelectDir($conn_id,$connect_it,$dirname,$starttime);
							}
							else
							{
								SelectDir($conn_id,$connect_it,$dirname,$starttime);
							}
						}
						else
						{
							ftp_mkdir($connect_it,$dirname);
							echo "<font color='purple'><br> map $dirname is bijgewerkt</font>";
							LogWriter($dirname," aangemaakt");			
							SelectDir($conn_id,$connect_it,$dirname,$starttime);
							
						}
					}
				}
					 
		}
	 
		 //verwijderde mappen ook legen en vervolgens verwijderen
		 


					
					 
				
	 //controle op bestanden en eventueel kopieren of overschrijven
	  foreach ($file as $filename => $fileinfo)
		{
		  $buff = ftp_mdtm($conn_id,$filename);
			if($buff != -1)
			{
			
					
				if (date("m d Y H:i:s.", $buff) < date("m d Y H:i:s.", $starttime))
				{

				}
				else 
				{
					echo "<font color='purple'><br> bestand $filename is bijgewerkt</font>";
					if (date("m d Y H:i:s.", $buff) == date("m d Y H:i:s.", $starttime))
					{
						echo "<font color='red'> dit is het controlebestand</font>";
					}
					else
					{
						$remote_file = $filename;
						$local_file = "temp/$remote_file";
						$remote_file2 = "$remote_file";
						if (ftp_get($conn_id, $local_file, $remote_file, FTP_BINARY))
						{
							if (ftp_put($connect_it, $remote_file2, $local_file, FTP_BINARY))
							{
								if(unlink($local_file))
								{
									LogWriter($remote_file," gesynchroniseerd");
								}
								else
								{
									LogWriter($remote_file,"<font color='red'> lokaal niet verwijderd </font>");									
								}
							}
							else
							{
								LogWriter($remote_file,"<font color='red'> bestand kan niet worden geupload </font>");
							}
						}
						else
						{
							LogWriter($remote_file,"<font color='red'> niet kunnen downloaden </font>");
						}
					}
				}
			}
			else
			{
				LogWriter($remote_file,"<font color='red'> let op dit bestand heeft geen volledige informatie over zijn wijzegingstijd </font>");
			}
		}

 }
 

 
 
//functie synchronisatie aanroepen
synctool($conn_id,$connect_it,$starttime);
echo "<h1 color='blue'>sync voltooid</h1>";
$synclog = fopen ("startpin.html", "a+") or die("niet beschikbaar");
$filelogger = "<div id='$logtijdlink'><h3>----einde log van $logtijdid---</h3></div>\n";
fwrite($synclog,$filelogger);
fclose($synclog);
if (ftp_put($conn_id, $remotepin, $localpin, FTP_BINARY))
{
	echo "tijdspin gezet";
	

}
else
{
	echo "tijdpin niet gezet";
}

$syncfile = "<a href=ftp://$ftp_server/startpin.html>synclog</a>";
	
$aanmeldnummer = $_SESSION['id'];
$sql = "INSERT INTO log(activity, server, location, ftp_id, gebruiker_id) VALUES('synchronisatie', '$ftpidb', '$syncfile', '$ftpida', '$aanmeldnummer')";
$resultaat = mysqli_query($verbinding, $sql) or die (mysqli_error());
header ("location: panel.php");
?>