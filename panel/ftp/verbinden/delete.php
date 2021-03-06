<?php
session_start();
$useorder = $_SESSION['deleteside'];
$selectedobjects = $_SESSION["filelist"];
include 'useorder.php';
include 'db.php';
/*
	variables
	$directoriesa -		- bronmappen
	$filesa -					- bronbestanden
	$directoriesb -		- doelmappen
	$filesb -					- doelbestanden

*/
// lijstfunctie van gekozen map
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
//bestanden in gekozen map verwijderen en mappen laten controleren
function deletetree ($conn_id,$deletefolder)
{
	$contents = ftp_rawlist($conn_id, ".");
	$rawlist = CurrentLocationInfo($contents);
	$dir = array();
	 $file = array();
	 if(empty($rawlist)){}
	 else
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

		foreach($file as $filename => $fileinfo)
		{
			ftp_delete($conn_id,$filename);
		}
		foreach($dir as $dirname => $dirinfo)
		{
			if(@!ftp_rmdir($conn_id,$dirname))
			{
				if (@ftp_chdir($conn_id,$dirname))
			{
				deletetree($conn_id,$dirname);
				ftp_chdir($conn_id,"..");
				foldercheck ($conn_id,$dirname);
				//ftp_rmdir($conn_id,$dirname);
			}
			}
		}
	  }
}
// mappen controleren of deze verwijderbaar zijn
function foldercheck($conn_id,$bronmap)
{
		if(@!ftp_rmdir($conn_id,$bronmap))
		{
			if (@ftp_chdir($conn_id,$bronmap))
			{
				deletetree($conn_id,$bronmap);
				ftp_chdir($conn_id,"..");
				//foldercheck($conn_id,$bronmap);
			} 	
		}
		if(@!ftp_rmdir($conn_id,$bronmap))
		{ }
}
//waarden voor sqlog vullen
$serverlog = NULL;
$locationlog = "$logpatha";
$ftpidlog = $ftpida;
$userlog = $_SESSION['id'];
// geselecteerde items verwerken
if(is_array($directoriesa))
{
	foreach ($directoriesa as $bronmap)
	{
		foldercheck($conn_id,$bronmap);
		foldercheck($conn_id,$bronmap);
		$activitylog = "map $bronmap verwijderd"; 
		include 'sqlog.php';
	}
}
if(is_array($filesa))
{
	foreach ($filesa as $bronbestand)
	{
		try
		{
			@ftp_chdir($conn_id,$serverloca);
			ftp_delete($conn_id,$bronbestand);
			$activitylog = " bestand $bronbestand verwijderd";
		
			
			include 'sqlog.php';
			
		}
		catch(Exception $ex)
		{
			print $ex;
		}
	}
}
echo "<meta http-equiv='refresh' content='0;url=panel.php' />";
?>