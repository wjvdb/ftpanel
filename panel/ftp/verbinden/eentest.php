<?php
session_start();
$ipid = $_SESSION["servertje"];
include 'db.php';
/* popup verbinding */
 // function do_alert($msg) 
    // {
        // echo '<script type="text/javascript">alert("' . $msg . '"); </script>';
    // }
//nodige gegevens verzamelen
$ftp_user_name = $_SESSION["username"];
$ftp_user_pass = $_SESSION["userpass"];

$ftp_server = $_SESSION["ftpserver"];
$port = $_SESSION["port"];
$conn_id = ftp_connect($ftp_server,$port);
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
//check connectie
// if ((!$conn_id) || (!$login_result)) { 
    // echo "FTP connection has failed!";
    // echo "Attempted to connect to $ftp_server for user $ftp_user_name"; 
    // exit; 
// } else {
    // do_alert(" verbonden met: ftp server: $ftp_server | gebruikersnaam: $ftp_user_name | wachtwoord: $ftp_user_pass | poort: $port");
// }
$dirnamegen = rand(1,1000);
$_SESSION['iddir'] = $dirnamegen;
$iddir = $_SESSION['iddir'];






?>
<link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
	
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link href="vendors/form-helpers/css/bootstrap-formhelpers.min.css" rel="stylesheet">
    <link href="vendors/select/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendors/tags/css/bootstrap-tags.css" rel="stylesheet">

    <link href="css/forms.css" rel="stylesheet">
	
<body>
  <div class="row">
  				
  					
					
					<div class="content-box-large">
  				<div class="panel-heading">
					<div class="panel-title">Bootstrap dataTables<br></div>
				</div>
  				<div class="panel-body">
  					<table cellpadding="0" cellspacing="0" border="0" class="table table-condensed table-striped table-bordered">
						<thead>
							<tr>
								<th>naam</th>
								<th>type</th>
								<th>eigenaar</th>
								<th>groep</th>
								<th>grootte</th>
								<th>maand</th>
								<th>dag</th>
								<th>tijd</th>
								<th>verwijderen</th>
							</tr>
						</thead>
						<tbody role="alert" aria-live="polite" aria-relevant="all">
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
/*   echo("<table style='background: #0b3e75;border-radius:8px;-moz-border-radius:5px;-webkit-border-radius:5px;'>");
  echo ("<tr style='color:#0b3e75'><th colspan='8'><a href=eentest.php>mappen</a></th></tr>");
  echo ("<tr style='color:#0b3e75' >");
	echo ("<td>naam</td>
	<td>type</td>
	<td>eigenaar</td>
	<td>groep</td>
	<td>grootte</td>
	<td>maand</td>
	<td>dag</td>
	<td>tijd</td>");
	echo ("</tr>"); */

	$teller = 0;
  foreach ($dir as $dirname => $dirinfo) 
  {
      echo "<tr><td> $dirname  </td><td>" . $dirinfo['chmod'] . " </td><td> " . $dirinfo['owner'] . " </td><td> " . $dirinfo['group'] . " </td><td></td><td> " . $dirinfo['month'] . " </td><td> " . $dirinfo['day'] . " </td><td> " . $dirinfo['time'] . "</td><td align='center'>
	  <form method='post' action='delete.php'>
	  <input type='hidden' name='ftp[]' value='$ftp_server'>
	  <input type='hidden' name='user[]' value='$ftp_user_name'>
	  <input type='hidden' name='pass[]' value='$ftp_user_pass'>
	  <input type='hidden' name='port[]' value='$port'>
	  <input type='hidden' name='dirname[]' value='$dirname'>
	  <button class='btn btn-danger' type='submit' name='del' value='$teller'>Delete</button></form></td>
	  <td><form method='post' action='eentest.php'>
	  <button class='btn btn-primary' type='submit' name='dir' value='$dirname'>open</button></form></td>
	  <td><button class='btn btn-primary' data-toggle='collapse' data-target='#$teller'>bewerken</button>
	  <div id='$teller' class='collapse'>
	  <form method='post' action='editdir.php' class='form-inline'>
	  <input type='hidden' name='dirname' value='$dirname'>
	  <input type='text' class='form-control' name='newname' placeholder='nieuwe map naam'>
	  <button class='btn btn-primary' type='submit' name='del' value='$teller'>Wijzig</button></form></td>
	  </div></td>
	  </tr>";
	  $teller++;
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
?>

  
<?php
echo ("</table>");
?>

<!--mappen aanmaken-->
<form method="post" action="adir.php" class="form-inline">
							
								
									<div class="form-group col-sm-3">
									<?php echo "	<input type='hidden' name='ftp' value='$ftp_server'>
	  <input type='hidden' name='user' value='$ftp_user_name'>
	  <input type='hidden' name='pass' value='$ftp_user_pass'>
	  <input type='hidden' name='port' value='$port'> "; ?>
										<input  class="form-control" id="exampleInputEmail2" name="dirname" autocomplete="off" placeholder="map toevoegen">
									</div>

									<input class="btn btn-primary" type="submit" value="toevoegen">
							
								
</form>

<!--upload bestanden -->

<form method="post" action="upload.php" class="form-inline">
							
								
									<div class="form-group col-sm-3">
									<?php echo "	<input type='hidden' name='ftp' value='$ftp_server'>
	  <input type='hidden' name='user' value='$ftp_user_name'>
	  <input type='hidden' name='pass' value='$ftp_user_pass'>
	  <input type='hidden' name='port' value='$port'> "; ?>
	  <input type="file" class="btn btn-default" name="uploaden">
												<p class="help-block">
													some help text here.
												</p> 
										
									</div>

									<input class="btn btn-primary" type="submit" value="uploaden">
							
								
							</form>
<script src="https://code.jquery.com/jquery.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <script src="vendors/datatables/js/jquery.dataTables.min.js"></script>

    <script src="vendors/datatables/dataTables.bootstrap.js"></script>

    <script src="js/custom.js"></script>
    <script src="js/tables.js"></script>