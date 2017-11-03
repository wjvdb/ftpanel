<?php
session_start();
$user = $_SESSION['userid'];
include 'db.php';
include 'controls.php';
?>
<html>
  <head>
    <title>verbinden</title>
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
                    <li ><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <li class="current"><a href="verbinden.php"><i class="glyphicon glyphicon-cloud"></i> verbinden</a></li>
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
		  
		  <!-- verbinding met 1 server -->
		  
		  <div class="col-md-10">
		  	<div class="row">
		  <!--	<div class="col-md-6">
		  			<div class="content-box-large">
		  				<div class="panel-heading">
							<div class="panel-title">welkom <?php echo ("$user"); ?></div>
							
							<div class="panel-options">
								<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
								<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
							</div>
						</div>
		  				<div class="panel-body">
							<form method="post" action="verbinden/eenphpsession.php">
								<table>
								<tr>
									<td>verbinden met een enkele ftp server</td>
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
									     
       
									<input class="form-control" name="user" type='text' placeholder='gebruikersnaam' style="width: 250px" />
									<input class="form-control" name='pass' type='text' placeholder='wachtwoord' style="width: 250px" />

									<td><input class="btn btn-primary signup" type="submit" value="verbinden"></td>
									</tr>
								</table>
							</form>
		  				</div>
		  			</div>
		  		</div> -->
				
				<!--verbinden met 2 servers-->

		  		<div class="col-md-6">
		  			<div class="row">
		  				<div class="col-md-12">
		  					<div class="content-box-header">
			  					<div class="panel-title">verbinden met 2 servers</div>
								
								<div class="panel-options">
									<a href="verbinden.php" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
									<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
								</div>
				  			</div>
							
								<div class="content-box-large box-with-header">
									<div class="row">
									<button class="btn btn-default" style="width: 250px">server 1</button>
									<button class="btn btn-default" style="width: 250px">server 2</button>
									</div>
									<form method="post" class="form-inline "action="verbinden/tweephpsession.php">
									<div class="row">
										
										<?php
										$sql = "SELECT id, name FROM  ftp";
										$resultaat = mysqli_query($verbinding, $sql);
										?>
							
										<select class="form-control" name="servertje1" style="width: 250px">
										<?php
										while($rij = mysqli_fetch_array($resultaat)){
										echo ("<option value=".$rij['id']." >".$rij['name']."</option>");
										}
										?>
										
										</select>
										
										<?php
										$sql = "SELECT id, name FROM  ftp";
										$resultaat = mysqli_query($verbinding, $sql);
										?>						
										<select class="form-control" name="servertje2" style="width: 250px">
										<?php
										while($rij = mysqli_fetch_array($resultaat)){
										echo ("<option value=".$rij['id']." >".$rij['name']."</option>");
										}									
										?>
										</select>
										
									</div>
									
									<div class="row">
										<input class="form-control" name='user1' type='text' placeholder='gebruikersnaam' style="width: 250px" />
										<input class="form-control" name='user2' type='text' placeholder='gebruikersnaam' style="width: 250px" />
									</div>
									<div class="row">
										<input class="form-control" name='pass1' type='password' placeholder='wachtwoord' style="width: 250px" />
										<input class="form-control" name='pass2' type='password' placeholder='wachtwoord' style="width: 250px" />
									</div>
									<div class="row">
									<input class="btn btn-primary signup" type="submit" value="verbinden" style="width: 500px">
									</div>
								
									<br /><br />
								</div>
							</form>
		  				</div>
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