<?php
session_start();

$useorder = $_SESSION['rename'];



$selectedobjects = $_SESSION["filelist"];
include 'useorder.php';
include 'templates/topform.php';
echo '<h6>namen wijzigen</h6>';
if($_SERVER['REQUEST_METHOD']=='POST')
{
	echo "<table>";
	@$rename = $_POST;
	@$folders = $rename['map'];
	@$files = $rename['bestand'];
//waarden voor sqlog vullen
$serverlog = NULL;
$locationlog = "$logpatha";
$ftpidlog = $ftpida;
$userlog = $_SESSION['id'];

	if(is_array($folders))
	{
		foreach($folders as $dnumber => $dname){
			$oldname = $directoriesa[$dnumber];
			
			if (@ftp_rename($conn_id,$oldname,$dname)){
				$activitylog = "map $oldname veranderd naar $dname"; 
				include 'sqlog.php';
			}
			else{
				echo "map $oldname NIET veranderd naar $dname ";
			}
		}
	}
	if(is_array($files))
	{
		foreach($files as $fnumber => $fname)
		{
			$oldnamef = $filesa[$fnumber];
			
			
			if (@ftp_rename($conn_id,$oldnamef,$fname)){
				
				$activitylog = "$oldnamef veranderd naar $fname"; 
				include 'sqlog.php';
			}
			else{
				echo "bestand $oldnamef NIET veranderd naar $fname ";
			}
		}
	}
	$_SESSION["filelist"] = 0;
	echo ("<meta http-equiv='refresh' content='5;url=panel.php' />");
	echo "</table>";
}
else{
/*
	variables
	$directoriesa 	-- bronmappen
	$filesa 		-- bronbestanden
	$directoriesb 	-- doelmappen
	$filesb 		-- doelbestanden
	$serverloca 	-- huidige locatie 
	$serverlocb 	-- andere locatie /// niet nodig maar beschikbaar
*/
?>
<form method="post" action="<?php echo($_SERVER["PHP_SELF"]);?>">
<table>
<?php
if(is_array($directoriesa))
{
foreach ($directoriesa as $bronmap)
	{
		echo "<tr><td style='padding:15px'>$bronmap</td><td><input class='form-control' style='width:150px' type='text' name='map[]' value='$bronmap' placeholder='$bronmap'></td></tr>";
	}
}
if(is_array($filesa))
{
foreach ($filesa as $bestanden)
	{
		echo "<tr><td style='padding:15px'>$bestanden</td><td><input class='form-control' style='width:150px' type='text' name='bestand[]' value='$bestanden' placeholder='$bestanden'></td></tr>";
	}
}

							}
?>
<tr><td colspan="2"><input class="btn btn-primary signup" type="submit" value="wijzigen" style="width: 100%"></td></tr></form></table>
<?php include 'templates/bottomform.php'; ?>