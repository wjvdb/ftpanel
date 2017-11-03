<?php
session_start();
include 'db.php';
include 'controls.php'
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
				                <tr>
				                  <th>#</th>				                  
				                  <th>Username</th>								  
				                </tr>
				              </thead>
				              <?php
							  $sql = "SELECT id, user, status FROM gebruiker";
							  $resultaat = $verbinding->query($sql);
							  while($rij = $resultaat->fetch_assoc()){
								  echo ("<tr>");
								  
									  echo ("<th>".$rij['id']."</th><th>".$rij['user']."</th>");
								  
								  $usertid = $rij['id'];
								  $status = $rij['status'];
								  if ($status == "0")
								  {
								  echo ("<th><form method='post' action='userrem.php'><input type='hidden' name='userid' value='$usertid'>
								  <button class='btn btn-danger' name='del' type='submit'>Delete</button></form></th>");
								  }
								  if($status =="1")
								  {
									  echo ("<th><form method='post' action='userrem.php'><input type='hidden' name='userid' value='$usertid'>
								  <button class='btn btn-primary' name='del' type='submit'>activate</button></form></th>");
								  }
								  echo "</tr>";
							  }
							  ?>
				            </table>
		  				</div>
		  			</div>
					
  				</div>
				<div class="already">
			            <a href="signup.php">terug</a>
			        </div>

