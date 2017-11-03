<?php
session_start();
$ipid = $_SESSION["servertje1"];
include 'db.php';
/* popup verbinding */
//nodige gegevens verzamelen en omzetten naar variable
$ftp_user_name = $_SESSION["username1"];
$ftp_user_pass = $_SESSION["userpass1"];
$ftp_server = $_SESSION["ftpserver1"];
$port = $_SESSION["port1"];

$conn_id = ftp_connect($ftp_server,$port);
@$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
//check connectie
if ((!$conn_id) || (!$login_result)) { 
    echo "<h2>FTP verbinding is mislukt!</h2><br>";
     echo "Poging tot verbinding gedaan naar $ftp_server <br>gebruiker:  $ftp_user_name <br>wachtwoord: $ftp_user_pass <br> poort: $port"; 
	 echo "<br><a href='..\verbinden.php'>terug</a>";
     exit; 
 } else {
     echo "<!-- server1 correct verbonden --> <!-- voor $ftp_server als user $ftp_user_name -->"; 
 }

//verbinden met 2e server en gegevens verzamelen

$ftp_user_name2 = $_SESSION["username2"];
$ftp_user_pass2 = $_SESSION["userpass2"];
$ftp_server2 = $_SESSION["ftpserver2"];
$port2 = $_SESSION["port2"];
$connect_it = ftp_connect($ftp_server2, $port2);
@$login_result = ftp_login($connect_it, $ftp_user_name2, $ftp_user_pass2);
if ((!$connect_it) || (!$login_result)) { 
    echo "<h2>FTP verbinding is mislukt!</h2><br>";
     echo "Poging tot verbinding gedaan naar $ftp_server2 <br>gebruiker:  $ftp_user_name2 <br>wachtwoord: $ftp_user_pass2 <br> poort: $port2"; 
	 echo "<br><a href='..\verbinden.php'>terug</a>";
     exit; 
 } else {
    echo "<!-- server2 correct verbonden --><!-- voor $ftp_server2 als user $ftp_user_name2 -->"; 
 }

 
 
$currentloc1 = $_SESSION['currentloc1'];
$currentloc2 = $_SESSION['currentloc2'];
 
 $serverloc1 = $_SESSION["serverloc1"];
ftp_chdir($conn_id, "$serverloc1");
 
$serverloc2 = $_SESSION["serverloc2"];
ftp_chdir($connect_it, "$serverloc2");
$path1 = ftp_pwd($conn_id);
 $path2 =ftp_pwd($connect_it);
?>
<link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- select all scripts -->
  <script language="JavaScript">
function toggle1(source){
	  checkboxes = document.getElementsByName('dirserver1[]');
	  for (var qerw=0, op=checkboxes.length;qerw<op;qerw++){
	  checkboxes[qerw].checked = source.checked;
	  }
  }
function toggle2(source){
	  checkboxes = document.getElementsByName('fileserver1[]');
	  for (var qr=0, io=checkboxes.length;qr<io;qr++){
	  checkboxes[qr].checked = source.checked;
	  }
  }
function toggle3(source){
	  checkboxes = document.getElementsByName('dirserver2[]');
	  for (var er=0, ui=checkboxes.length;er<ui;er++){
	  checkboxes[er].checked = source.checked;
	  }
  }
function toggle4(source){
	  checkboxes = document.getElementsByName('fileserver2[]');
	  for (var rt=0, yh=checkboxes.length;rt<yh;rt++){
	  checkboxes[rt].checked = source.checked;
	  }
  }
  
  </script>
  
  
  
  
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
	
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link href="vendors/form-helpers/css/bootstrap-formhelpers.min.css" rel="stylesheet">
    <link href="vendors/select/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendors/tags/css/bootstrap-tags.css" rel="stylesheet">

    <link href="css/forms.css" rel="stylesheet">
	
<body>
<form method='post' action='test.php'>
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-4">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="../index.php">ftp panel</a></h1>
	              </div>
	           </div>
	           <div class="col-md-4">
	              
	                <div align="center" class="logo">	
	                  <h1>
					  <button class="btn btn-primary" type="submit" name="syncorder" value="b2a"><span class="glyphicon glyphicon-arrow-left"></span></button>
					  <font color="white">sync</font>
					  <button class="btn btn-primary" type="submit" name="syncorder" value="a2b"><span class="glyphicon glyphicon-arrow-right"></span></button></h1>
					  
	               
	              </div>
	           </div>
			   <div class="col-md-2">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Meer<b class="caret"></b></a>
	                        <ul class="dropdown-menu animated fadeInUp">
	                          <li><a href="mkdir.php">mappen maken</a></li>
	                          <li><a href="upload.php">uploaden</a></li>
							  
	                        </ul>
	                      </li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>

	        </div>
	     </div>
	</div>
<div class="page-content">
<!--server panelen-->
  <div class="row">
  <!--server paneel 1-->
  	<div class="col-md-6">			
  					
					
					<div class="content-box-large">
  				<div class="panel-heading">
					<div class="panel-title"><?php echo ("<a href=goto.php?dirname=..>$ftp_server $path1</a>"); ?><br>
					<?php 
					$serversort = 'server1';
					include 'action.php';
					?>
					
					</div>
				</div>
  				<div class="panel-body">
  					<table class="table table-condensed table-striped table-bordered">
						<thead>
							<tr>
								<th><input type="checkbox" onClick="toggle1(this)"/></th>
								<th>naam</th>
								<th>type</th>
								<th>eigenaar</th>
								<th>groep</th>
								<th>grootte</th>
								<th>data</th>
								
							</tr>
							
						</thead>
						
						
						<tbody role="alert" aria-live="polite" aria-relevant="all">
<?php




$contents = ftp_rawlist($conn_id, ".");
$contents2 = ftp_rawlist($connect_it, ".");
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
    if(!isset($rawlist)){
	  echo "<tr><td colspan='7'>deze map is leeg</td></tr>";
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
	  $legemap = "leeg";
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


	$teller = 0;
  foreach ($dir as $dirname => $dirinfo) 
  {
      echo "<tr><td><input type='checkbox' name='dirserver1[]' value='$dirname'/></td><td> <a href=goto.php?dirname=$dirname>$dirname</a>  </td><td>" . $dirinfo['chmod'] . " </td><td> " . $dirinfo['owner'] . " </td><td> " . $dirinfo['group'] . " </td><td></td><td> " . $dirinfo['month'] . " " . $dirinfo['day'] . " " . $dirinfo['time'] . "</td>
	  </tr>";
	  $teller++;
  }
  
  
  echo ("<tr style='color:#0b3e75'><th colspan='8'>bestanden</th></tr>");
  echo ("<tr style='color:#0b3e75' >");
echo ("<td><input type='checkbox' onClick='toggle2(this)'/></td><td>naam</td>
<td>type</td>
<td>eigenaar</td>
<td>groep</td>
<td>grootte</td>
<td>data</td>");
echo ("</tr>");
  foreach ($file as $filename => $fileinfo) {
      echo "<tr><td><input type='checkbox' name='fileserver1[]' value='$filename'/></td><td>$filename </td><td>" . $fileinfo['chmod'] . " </td><td> " . $fileinfo['owner'] . " </td><td> " . $fileinfo['group'] . " </td><td> " . $fileinfo['size'] . " Byte </td><td> " . $fileinfo['month'] . " " . $fileinfo['day'] . " " . $fileinfo['time'] . "</td></tr>";
  }
  


echo ("</table>");
?>



										
									</div>
</div>
</div>
									

	  <!--server paneel 2-->
	<div class="col-md-6">
  				
  					
					
					<div class="content-box-large">
  				<div class="panel-heading">
					<div class="panel-title"><?php echo ("<a href=go2.php?dirname=..>$ftp_server2 $path2</a>"); ?><br>
					<?php 
					$serversort = 'server2';
					include 'action.php';
					?>
					</div>
				</div>
  				<div class="panel-body">
  					<table cellpadding="0" cellspacing="0" border="0" class="table table-condensed table-striped table-bordered">
						<thead>
							<tr>
								<th><input type='checkbox' onClick='toggle3(this)'/></th>
								<th>naam</th>
								<th>type</th>
								<th>eigenaar</th>
								<th>groep</th>
								<th>grootte</th>
								<th>data</th>
							</tr>
						</thead>
						<tbody role="alert" aria-live="polite" aria-relevant="all">
	</div>
	</div>
	</div>
	<?php

  
  $teller2 = 0;
  
if(isset ($legemap)){
	echo "<tr><td colspan='7'>deze map is leeg</td></tr>";
}
	

  foreach ($dir2 as $dirname2 => $dirinfo2) 
  {
      echo "<tr><td><input type='checkbox' name='dirserver2[]' value='$dirname2'/></td><td> <a href=go2.php?dirname=$dirname2>$dirname2</a>  </td><td>" . $dirinfo2['chmod'] . " </td><td> " . $dirinfo2['owner'] . " </td><td> " . $dirinfo2['group'] . " </td><td></td><td> " . $dirinfo2['month'] . " " . $dirinfo2['day'] . " " . $dirinfo2['time'] . "</td>
	  </tr>";
	  $teller2++;
	  
  }

  
echo ("<tr style='color:#0b3e75'><th colspan='7'>bestanden</th></tr>");
  echo ("<tr style='color:#0b3e75' >");
echo ("<td><input type='checkbox' onClick='toggle4(this)'/></td>
<td>naam</td>
<td>type</td>
<td>eigenaar</td>
<td>groep</td>
<td>grootte</td>
<td>data</td>");
  foreach ($file2 as $filename2 => $fileinfo2) {
      echo "<tr><td><input type='checkbox' name='fileserver2[]' value='$filename2'/></td><td>$filename2 </td><td>" . $fileinfo2['chmod'] . " </td><td> " . $fileinfo2['owner'] . " </td><td> " . $fileinfo2['group'] . " </td><td> " . $fileinfo2['size'] . " Byte </td><td> " . $fileinfo2['time'] . " " . $fileinfo2['day'] . " " . $fileinfo2['month'] . "</td></tr>";
  }
  
?>
</form>
