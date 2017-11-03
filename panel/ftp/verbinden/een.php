<?php
session_start();
$ipid = $_POST['servertje'];
include 'db.php';
//popup verbinding
 function do_alert($msg) 
    {
        echo '<script type="text/javascript">alert("' . $msg . '"); </script>';
    }
//nodige gegevens verzamelen
$ftp_user_name = $_POST['user'];
$ftp_user_pass = $_POST['pass'];

$sql = "SELECT * FROM ftp where id='$ipid'";
$resultaat = mysqli_query($verbinding, $sql);
$rij = mysqli_fetch_array($resultaat, MYSQL_ASSOC);
$ftp_server = $rij['adress'];
$port = $rij['port'];
$conn_id = ftp_connect($ftp_server,$port);
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
//check connectie
if ((!$conn_id) || (!$login_result)) { 
    echo "FTP connection has failed!";
    echo "Attempted to connect to $ftp_server for user $ftp_user_name"; 
    exit; 
} else {
    do_alert(" verbonden met: ftp server: $ftp_server | gebruikersnaam: $ftp_user_name | wachtwoord: $ftp_user_pass | poort: $port");
}
//verwijderen van gekozen object






?>
<style>
<!--table, th, td {
    border: 1px solid white;
    border-left-style:none;
	border-right-style:none;
	border-top-style:none;
}-->
tr:nth-child(even){
	background-color: #e8f2fd;
}
tr:nth-child(odd){
	background-color: #b9d8f8;
}
</style>
<?php




$contents = ftp_rawlist($conn_id, ".");
function rawlist_dump(){
	
}
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
  foreach ($rawlist as $k => $v) {
    if ($v['chmod']{0} == "d") {
      $dir[$k] = $v;
    } elseif ($v['chmod']{0} == "-") {
      $file[$k] = $v;
    }
  }
  echo("<table style='background: #0b3e75;border-radius:8px;-moz-border-radius:5px;-webkit-border-radius:5px;'>");
  echo ("<tr style='color:#0b3e75'><th colspan='8'>mappen</th></tr>");
  echo ("<tr style='color:#0b3e75' >");
	echo ("<td>naam</td>
	<td>type</td>
	<td>eigenaar</td>
	<td>groep</td>
	<td>grootte</td>
	<td>maand</td>
	<td>dag</td>
	<td>tijd</td>");
	echo ("</tr>");

  foreach ($dir as $dirname => $dirinfo) {
      echo "<tr><td> $dirname  </td><td>" . $dirinfo['chmod'] . " </td><td> " . $dirinfo['owner'] . " </td><td> " . $dirinfo['group'] . " </td><td></td><td> " . $dirinfo['month'] . " </td><td> " . $dirinfo['day'] . " </td><td> " . $dirinfo['time'] . "</td><td align='center'>
	  <form method='post' action='delete.php'>
	  <input type='hidden' name='ftp' value='$ftp_server'>
	  <input type='hidden' name='user' value='$ftp_user_name'>
	  <input type='hidden' name='pass' value='$ftp_user_pass'>
	  <input type='hidden' name='port' value='$port'>
	  <input type='hidden' name='id' value='$dirname'>
	  <input type='submit' value='delete'></td></tr>";
  }
  echo ("<tr style='color:#0b3e75'><th colspan='8'>bestanden</th></tr>");
  echo ("<tr style='color:#0b3e75' >");
echo ("<td>naam</td>
<td>type</td>
<td>eigenaar</td>
<td>groep</td>
<td>grootte</td>
<td>maand</td>
<td>dag</td>
<td>tijd</td>");
echo ("</tr>");
  foreach ($file as $filename => $fileinfo) {
      echo "<tr><td>$filename </td><td>" . $fileinfo['chmod'] . " </td><td> " . $fileinfo['owner'] . " </td><td> " . $fileinfo['group'] . " </td><td> " . $fileinfo['size'] . " Byte </td><td> " . $fileinfo['month'] . " </td><td> " . $fileinfo['day'] . " </td><td> " . $fileinfo['time'] . "</td><td align='center'>
	  <form method='post' action='deletef.php'>
	  <input type='hidden' name='ftp' value='$ftp_server'>
	  <input type='hidden' name='user' value='$ftp_user_name'>
	  <input type='hidden' name='pass' value='$ftp_user_pass'>
	  <input type='hidden' name='port' value='$port'>
	  <input type='hidden' name='id' value='$filename'>
	  <input type='submit' value='delete'></td></tr>";
  }
echo ("</table>");
?>