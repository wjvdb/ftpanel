<?php 
session_start();

$useorder = $_SESSION['moveorder'];
include 'useorder.php';
$fileget = "";
$emptydir = "/move";
$scandir = __DIR__ . "\move";
$scanlist = scandir($scandir);
chdir (__DIR__ . "\move"); 

// locale mappen verzenden naar de ftp server
function dirarray($dir, $conn_id,$fileget){
	$result = array();
	$cdir = scandir($dir);
	foreach($cdir as $key => $value)
	{
		if(!in_array($value,array(".","..")))
		{
			if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
			{
				ftp_mkdir($conn_id, $value);
				ftp_chdir($conn_id, $value);
			//	echo "<font color='blue'>$value //</font>";
				$pathtofile = $fileget . "/" . $value;
				$result[$value] = dirarray($dir . DIRECTORY_SEPARATOR . $value, $conn_id,$pathtofile);
				ftp_chdir($conn_id,"..");
			}
			else
			{
			$result[] = $value;
				$localfile = $dir . "/" . $value;
				ftp_put($conn_id, $value,$localfile, FTP_BINARY);
				unlink($localfile);
		//	echo "$localfile<br>";
			}
		}
	}
	//echo "<br>";
//	return $result;
}
/* lokale bestanden legen
git folder kan niet worden verwijderd */
function folderclean($dir,$fileget){
	$result = array();
	$cdir = scandir($dir);
	foreach($cdir as $key => $value)
	{
		if(!in_array($value,array(".","..")))
		{
			if (!is_dir($dir . DIRECTORY_SEPARATOR . $value))
			{
			$result[] = $value;
				$localfile = $dir . "/" . $value;
				unlink($localfile);
			//echo "$dir \ <font color='red'>$value</font><br>";
			}
			else
			{
				//echo "<font color='blue'>$value //</font>";
				$pathtofile = $fileget . "/" . $value;
				$result[$value] = folderclean($dir . DIRECTORY_SEPARATOR . $value,$pathtofile);
					rmdir($dir . "/" . $value);
			}
		}
	}	
}



function removetempfiles($scandir){
	echo "$scandir";
}

//$test = dirarray($scandir);
echo "<pre>";
//print_r($test);
echo "</pre>";
dirarray($scandir, $conn_id,$fileget);
folderclean($scandir,$emptydir);

header ('location: removesource.php');

?>