<?php
session_start();
include 'db.php';
$deleteid = $_POST['userid'];
$sql = "SELECT * FROM gebruiker WHERE id='$deleteid'";
$resultaat = mysqli_query($verbinding, $sql);
$rij = mysqli_fetch_array($resultaat, MYSQL_ASSOC);
$setstate = $rij['status'];
if ($setstate == "0")
{
$sql = "UPDATE gebruiker SET status='1' WHERE id='$deleteid';";
$statechange = " is uitgeschakeld";
}
if ($setstate == "1")
{
$sql = "UPDATE gebruiker SET status='0' WHERE id='$deleteid';";
$statechange = " is geactiveerd";
}
$currentuser = $_SESSION['userid'];
if(!mysqli_query($verbinding, $sql)){
	
	?>
	
	
	

  <head>
    <title>ftpanel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-bg">
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-12">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.php">ftp panel</a></h1>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>
<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
			        <div class="box">
			            <div class="content-wrap">
			                <h6>verwijderen</h6>
		  				<div class="panel-body">
		  					<table class="table">
				              <thead>
				                
				                  <th>verwijderen gebruiker mislukt</th>				                  
				                  								  
				                
				              </thead>
				              
							  <tr><td>account is gekoppeld aan logbestand</td></tr>
				            </table>
		  				</div>
		  			</div>
					
  				</div>
				<div class="already">
			            <a href="signup.php">terug</a>
			        </div>


	
	<?php
	
	echo ("verwijderen is mislukt gebruiker is gekoppeld aan logboek
	<meta http-equiv='refresh' content='2;url=deleteuser.php' />");
	exit;
}
else{
	$removeduser = "gebruiker " . $deleteid . $statechange;
	$aanmeldnummer = $_SESSION['id'];
	$sql = "INSERT INTO log(activity, gebruiker_id) VALUES('$removeduser', '$aanmeldnummer')";
		$resultaat = mysqli_query($verbinding, $sql) or die (mysqli_error());
	
	
	echo ("het is gelukt");
	header ("location: controle.php");
}
?>