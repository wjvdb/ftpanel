<?php
session_start();

$useorder = $_SESSION['downloadorder'];

$currentloc = __DIR__ . "/download/";
chdir (__DIR__ . "/download");
$selectedobjects = $_SESSION["filelist"];
include 'useorder.php';
/*
	variables
	$directoriesa -- bronmappen
	$filesa -- bronbestanden
	$directoriesb -- doelmappen
	$filesb -- doelbestanden

*/
function recursivecopy($conn_id,$currentloc)
{
	$contents = ftp_rawlist($conn_id, ".");
foreach($contents as $v){
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
  $dir = array();
  $file = array();
  if(!isset($rawlist))
  {
	//afhandeling van lege map van server a
  }
  else
  {
  foreach ($rawlist as $k => $v) 
  {
    if ($v['chmod']{0} == "d") {
      $dir[$k] = $v;
    } elseif ($v['chmod']{0} == "-") {
      $file[$k] = $v;
    }
  }
  }

// mappenstructuur overnemen
foreach ($dir as $dirname => $dirinfo)
{
	mkdir($currentloc . $dirname);
	echo "$dirname";
	ftp_chdir ($conn_id,$dirname);
		chdir ($currentloc . $dirname);
		$goto = $currentloc . $dirname . "/";
		recursivecopy($conn_id,$goto);
		ftp_chdir ($conn_id,"..");
		chdir ($currentloc . "../");
}
foreach ($file as $filename => $fileinfo)
{
	$remote_file = $filename;
	$local_file = $currentloc . "/$remote_file";
	$remote_file2 = "$remote_file";

	if (ftp_get($conn_id, $local_file, $remote_file, FTP_BINARY)){

	}
	else{
		echo "fail";
	}
}

  
  
  
  }

//waarden voor sqlog vullen
$serverlog = NULL;
$locationlog = "$logpatha";
$ftpidlog = $ftpida;
$userlog = $_SESSION['id'];

if(is_array($directoriesa))
{
foreach ($directoriesa as $bronmap)
{
	mkdir($currentloc . "/" . $bronmap);
		ftp_chdir ($conn_id,$bronmap);
		chdir ($currentloc . "/" . $bronmap);
		$goto = $currentloc . $bronmap . "/";
		recursivecopy($conn_id,$goto);
		ftp_chdir ($conn_id,"..");
		chdir (__DIR__ . "/..");
		$activitylog = "map $bronmap gedownload"; 
		include 'sqlog.php';
}
}
if(is_array($filesa))
{
foreach ($filesa as $bronbestand)
{
	$remote_file = $bronbestand;
	$local_file = $currentloc . "/" . "$remote_file";
	

	if (ftp_get($conn_id, $local_file, $remote_file, FTP_BINARY))
	{
		$activitylog = "bestand $bronbestand gedownload"; 
		include 'sqlog.php';
	}
	else
	{
		echo "fail";
	}
}
}

echo "<meta http-equiv='refresh' content='0;url=panel.php' />";
?>