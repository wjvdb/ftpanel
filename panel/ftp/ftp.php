<?php
session_start();
$user = $_SESSION['userid'];
include 'db.php';
include 'controls.php';
?>
<html>
  <head>
    <title>ftp beheer</title>
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
  <body>
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.php">ftp panel</a></h1>
	              </div>
	           </div>
	           <div class="col-md-5">
	              <div class="row">
	                <div class="col-lg-12">
	                  
	                </div>
	              </div>
	           </div>
	           <div class="col-md-2">
	               <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li class="dropdown">
	                        <a  href="logout.php">uitloggen</a>
	                        
	                      </li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <li><a href="verbinden.php"><i class="glyphicon glyphicon-cloud"></i> verbinden</a></li>
                    <li><a href="logboek.php"><i class="glyphicon glyphicon-list-alt"></i> logboek</a></li>
                    <li class="submenu">
                         <a href="#">
                            <i class="glyphicon glyphicon-plus"></i> beheer
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li><a href="ftp.php">ftp</a></li>
                            <li><a href="signup.php">gebruiker</a></li>
                        </ul>
                    </li>
                </ul>
             </div>
		  </div>
		  <div class="col-md-10">
		  	<div class="row">
		  		<div class="col-md-6">
		  			<div class="content-box-large">
		  				<div class="panel-heading">
							<div class="panel-title">server toevoegen</div>
							
							<div class="panel-options">
								<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
								<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
							</div>
						</div>
		  				<div class="panel-body">
		  					<?php
							if($_SERVER['REQUEST_METHOD']=='POST'){
								$server = $_POST['server'];
								$poort = $_POST['poort'];
								$naam = $_POST['naam'];
								
								$sql = "INSERT INTO ftp(adress, port, name)
								VALUES('$server', '$poort','$naam')";
								
								$resultaat = mysqli_query($verbinding, $sql) or die (mysqli_error());
								
								echo ("<h2> de gegevens zijn met success ingevoegd </h2><br><h5><a href=ftp.php>klik hier om nog een server toe te voegen</a></h5>");
								
							}
							else{
							?>
							
							<form method="post" action="<?php echo($_SERVER["PHP_SELF"]);?>">
							<input class="form-control" name="server" type='text' placeholder='adresnaam' style="width: 250px" />
							<input class="form-control" name="poort" type='text' placeholder='poort' style="width: 250px" />
							<input class="form-control" name="naam" type='text' placeholder='server naam' style="width: 250px" />
							<td><input class="btn btn-primary signup" type="submit" value="toevoegen"></td></form>
							
							
							
							
							
							<?php 
							}
							?>
							<br /><br />
		  				</div>
		  			</div>
		  		</div>
				
				<!--server verwijderen-->
		  		
				<div class="col-md-6">
		  			<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<div class="panel-title">server verwijderen</div>
								
								<div class="panel-options">
									<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
									<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
								</div>
				  			</div>
				  			<div class="content-box-large box-with-header">
								<form method="post" action="deleteftp.php">
				  				<?php
								
									$sql = "SELECT id, name FROM  ftp";
									$resultaat = mysqli_query($verbinding, $sql);
									?>
								</tr><tr>
									<td><select class="form-control" name="servertje" style="width: 250px">
									<?php
									while($rij = mysqli_fetch_array($resultaat)){
									echo ("<option value=".$rij['id']." >".$rij['name']."</option>");
									}
									?></td>
									</select>
									     
       
      

									<td><input class="btn btn-danger" type="submit" value="verwijderen"></td> 
								
									</form>
								<br /><br />
							</div>
		  				</div>
		  			</div>
		  			
		  		</div>
		  	</div>

		  	<div class="row">
		  		<div class="col-md-12 panel-warning">
		  			<div class="content-box-header panel-heading">
	  					<div class="panel-title ">ftp servers</div>
						
						<div class="panel-options">
							<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
							<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
						</div>
		  			</div>
		  			<div class="content-box-large box-with-header">
						<table class="table table-condensed table-striped table-bordered">
							<thead>
							<tr>
								<th>id</th>
								<th>naam</th>
								<th>adres</th>
								<th>poort</th>
							</tr>
							
						</thead>
						
						
						
							<?php
							$sql = "SELECT * FROM  ftp";
										$resultaat = mysqli_query($verbinding, $sql);
							while($rij = mysqli_fetch_array($resultaat)){
							echo ("<tr><td>".$rij['id']."</td><td>".$rij['name']."</td><td>".$rij['adress']."</td><td>".$rij['port']."</td></tr>");
										}
							?>
						</table>
					</div>
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