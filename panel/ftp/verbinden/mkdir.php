<!DOCTYPE html>
<?php
session_start();
$user = $_SESSION['userid'];
include 'db.php';

$server1 = $_SESSION['selectname1'];
$server2 = $_SESSION['selectname2'];
?>
<html>
  <head>
    <title>uploaden</title>
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
			                <h6>mappen aanmaken</h6>
							
							
							<form method="post" action="makeadir.php">
			                <div class="action">
								<input class="form-control" name="mapnaam" type='text' placeholder='mapnaam'/>
							</div>

							<div class="action">
			                    <select class="form-control" name="serversort">
									<option value="a2b"><?php echo ("$server1"); ?></option>
									<option value="b2a"><?php echo ("$server2"); ?></option>
									
								<select>
			                </div>
							<div class="action">
								<input class="form-control" name="locatie" type='text' placeholder='locatie'/>
								<p class="help-block">
									begin en sluit met "/"
								</p>
							</div>
			                <div class="action">
			                    <input class="btn btn-primary signup" type="submit" value="aanmaken">
			                </div>
							</form>							
			            </div>
			        </div>

			        <div class="already">
			            
			            <a href="deleteuser.php">account verwijderen?</a>
			        </div>
			    </div>
			</div>
		</div>
	</div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>