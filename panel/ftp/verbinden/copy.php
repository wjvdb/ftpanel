<?php
session_start();

$useorder = $_SESSION['copyorder'];



$selectedobjects = $_SESSION["filelist"];
include 'useorder.php';
/*
	variables
	$directoriesa -- bronmappen
	$filesa -- bronbestanden
	$directoriesb -- doelmappen
	$filesb -- doelbestanden

*/
function recursivecopy($conn_id,$connect_it){
	$contents = ftp_rawlist($conn_id, ".");
foreach($contents as $v){
 $info = array();
    $vinfo = preg_split("/[\s]+/", $v, 9);
    if ($vinfo[0] !== "total") {
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
  if(!isset($rawlist)){
	//afhandeling van lege map van server a
  }
  else{
  foreach ($rawlist as $k => $v) {
    if ($v['chmod']{0} == "d") {
      $dir[$k] = $v;
    } elseif ($v['chmod']{0} == "-") {
      $file[$k] = $v;
    }
  }
  }
  

//server doel  

  $contents2 = ftp_rawlist($connect_it, ".");
  foreach($contents2 as $v2){
 $info2 = array();
    $vinfo2 = preg_split("/[\s]+/", $v2, 9);
    if ($vinfo2[0] !== "total") {
      $info2['chmod'] = $vinfo2[0];
      $info2['num'] = $vinfo2[1];
      $info2['owner'] = $vinfo2[2];
      $info2['group'] = $vinfo2[3];
      $info2['size'] = $vinfo2[4];
      $info2['month'] = $vinfo2[5];
      $info2['day'] = $vinfo2[6];
      $info2['time'] = $vinfo2[7];
      $info2['name'] = $vinfo2[8];
      $rawlist2[$info2['name']] = $info2;
    }
  }
  $dir2 = array();
  $file2 = array();
  if(!isset($rawlist2)){
	  // afhandeling van lege map in server b 
  }
  else{
  foreach ($rawlist2 as $k2 => $v2) {
    if ($v2['chmod']{0} == "d") {
      $dir2[$k2] = $v2;
    } elseif ($v2['chmod']{0} == "-") {
      $file2[$k2] = $v2;
    }
  }
  }
// mappenstructuur overnemen
foreach ($dir as $dirname => $dirinfo){
	@ftp_mkdir($connect_it,$dirname);
	ftp_chdir ($conn_id,$dirname);
		ftp_chdir ($connect_it,$dirname);
		recursivecopy($conn_id,$connect_it);
		ftp_chdir ($conn_id,"..");
		ftp_chdir ($connect_it,"..");
}
foreach ($file as $filename => $fileinfo){
	$remote_file = $filename;
	$local_file = "copytemp/$remote_file";
	$remote_file2 = "$remote_file";

	if (ftp_get($conn_id, $local_file, $remote_file, FTP_BINARY)){
		if (ftp_put ($connect_it, $remote_file2, $local_file, FTP_BINARY)){
			if (unlink ($local_file)){
				//echo ("copy voltooid");
			}
			else{
				echo ("fail");
			}
		}
		else{
			echo "fail";
		}
	}
	else{
		echo "fail";
	}
}

  
  
  
  }

function copylist($conn_id,$connect_it,$selectedobjects){

$contents = ftp_rawlist($conn_id, ".");
foreach($contents as $v){
 $info = array();
    $vinfo = preg_split("/[\s]+/", $v, 9);
    if ($vinfo[0] !== "total") {
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
  if(!isset($rawlist)){
	//afhandeling van lege map van server a
  }
  else{
  foreach ($rawlist as $k => $v) {
    if ($v['chmod']{0} == "d") {
      $dir[$k] = $v;
    } elseif ($v['chmod']{0} == "-") {
      $file[$k] = $v;
    }
  }
  }
  

//server doel  

  $contents2 = ftp_rawlist($connect_it, ".");
  foreach($contents2 as $v2){
 $info2 = array();
    $vinfo2 = preg_split("/[\s]+/", $v2, 9);
    if ($vinfo2[0] !== "total") {
      $info2['chmod'] = $vinfo2[0];
      $info2['num'] = $vinfo2[1];
      $info2['owner'] = $vinfo2[2];
      $info2['group'] = $vinfo2[3];
      $info2['size'] = $vinfo2[4];
      $info2['month'] = $vinfo2[5];
      $info2['day'] = $vinfo2[6];
      $info2['time'] = $vinfo2[7];
      $info2['name'] = $vinfo2[8];
      $rawlist2[$info2['name']] = $info2;
    }
  }
  $dir2 = array();
  $file2 = array();
  if(!isset($rawlist2)){
	  // afhandeling van lege map in server b 
  }
  else{
  foreach ($rawlist2 as $k2 => $v2) {
    if ($v2['chmod']{0} == "d") {
      $dir2[$k2] = $v2;
    } elseif ($v2['chmod']{0} == "-") {
      $file2[$k2] = $v2;
    }
  }
  }



}
//waarden voor sqlog vullen
$serverlog = $ftpidb;
$locationlog = "$ftpida $logpatha naar $ftpidb $logpathb";
$ftpidlog = $ftpida;
$userlog = $_SESSION['id'];

if(is_array($directoriesa)){
foreach ($directoriesa as $bronmap){
	@ftp_mkdir($connect_it,$bronmap);
		ftp_chdir ($conn_id,$bronmap);
		ftp_chdir ($connect_it,$bronmap);
		recursivecopy($conn_id,$connect_it);
		ftp_chdir ($conn_id,"..");
		ftp_chdir ($connect_it,"..");
		$activitylog = "map $bronmap gekopieerd";
		include 'sqlog.php';
}
}
if(is_array($filesa)){
foreach ($filesa as $bronbestand){
	$remote_file = $bronbestand;
	$local_file = "copytemp/$remote_file";
	$remote_file2 = "$remote_file";

	if (ftp_get($conn_id, $local_file, $remote_file, FTP_BINARY)){
		if (ftp_put ($connect_it, $remote_file2, $local_file, FTP_BINARY)){
			if (unlink ($local_file)){
				$activitylog = "bestand $remote_file gekopieerd";
				include 'sqlog.php';
			}
			else{
				echo ("fail");
			}
		}
		else{
			echo "fail";
		}
	}
	else{
		echo "fail";
	}
}
}




?>
<meta http-equiv='refresh' content='0;url=panel.php' />