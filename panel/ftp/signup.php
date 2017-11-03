<!DOCTYPE html>
<?php
session_start();
$user = $_SESSION['userid'];
include 'db.php';
?>
<html>
  <head>
    <title>signup</title>
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
			                <h6>Sign Up</h6>
							<?php
							if($_SERVER['REQUEST_METHOD']=='POST'){
								$gbnaam = $_POST['gbnaam'];
								$wachtwoord = md5($_POST['wachtwoord']);
								if(!empty($_POST['gbnaam']) && !empty($_POST['wachtwoord']))
								{
								$sql = "INSERT INTO gebruiker(user, pass)
								VALUES('$gbnaam', '$wachtwoord')";
								$resultaat = mysqli_query($verbinding, $sql) or die (mysqli_error()); 
								
							$aanmeldnummer = $_SESSION['id'];
								$addeduser = "gebruiker " . $gbnaam . " aangemaakt";
								$sql = "INSERT INTO log(activity, gebruiker_id) VALUES('$addeduser', '$aanmeldnummer')";
								$resultaat = mysqli_query($verbinding, $sql) or die (mysqli_error()); 

								?>

								<div class='sidebar' style='display: block;'>
								<h2>het aanmaken van het account is geslaagd</h2>
								<ul class='nav'>
									<li><a href=signup.php><i class="glyphicon glyphicon-plus"></i>nieuw account aanmaken</a></li>
									<li><a href=index.php><i class="glyphicon glyphicon-home"></i>terug naar beginscherm</a></li>
								</ul>
								</div>
								<?php
								}
								else
								{ 
							?>
								<div class='sidebar' style='display: block;'>
									<h2>het aanmaken van het account is mislukt</h2>
										<ul class='nav'>
											<li><a href=signup.php><i class="glyphicon glyphicon-plus"></i>nieuw account aanmaken</a></li>
											<li><a href=index.php><i class="glyphicon glyphicon-home"></i>terug naar beginscherm</a></li>
										</ul>
								</div>
							<?php
								}
							}
							else{
							?>
							<form method="post" action="<?php echo($_SERVER["PHP_SELF"]);?>">
								<input class="form-control" name="gbnaam" type="text" placeholder="gebruikersnaam">
								<input class="form-control" name="wachtwoord" type="password" placeholder="Password">
								
								<div class="action">
									<input class="btn btn-primary signup" type="submit" value="toevoegen">
								</div>
							</form>	<?php } ?>						
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