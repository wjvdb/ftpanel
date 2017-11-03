<?php
@session_start();

$user = $_SESSION['userid'];
include 'controls.php';


if($_SERVER['REQUEST_METHOD']=='POST'){
	$note = $_POST['note'];
	$note2 = htmlspecialchars("$note");
	$number = $_POST['number'];
	include 'db.php';
	$sql1 = "SELECT * FROM  note ORDER BY id DESC LIMIT 1";
$resultaatpost = mysqli_query($verbinding, $sql1);
$newnote = mysqli_fetch_array($resultaatpost);
include 'db.php';
$newnote1 = mysqli_insert_id($verbinding);
$noteid = $number + 1;

include 'db.php';
$usenote = $_SESSION['id'];
$sql = "INSERT INTO note(id, gebruiker_id) VALUES('$noteid', '$usenote')";
$resultaat = mysqli_query($verbinding, $sql) or die (mysqli_error());

$writenote = fopen("note/$noteid.txt", "w");
fwrite ($writenote, $note2);
fclose($writenote);
}
$note = "";

?>
<html>
  <head>
    <title>dashboard</title>
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
                    <li class="current"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
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
							<div class="panel-title">welkom <?php echo ($_SESSION['userid']); ?></div>
							
							<div class="panel-options">
								<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
								<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
							</div>
						</div>
		  				<div class="panel-body">
		  					
						


				
					          
<?php
									$note = "";
									include 'db.php';
									$sql = "SELECT id, gebruiker_id FROM  note";
									$resultaat = mysqli_query($verbinding, $sql);
									while($rij = mysqli_fetch_array($resultaat)){
									$logname = $rij['gebruiker_id'];
									include 'db.php';
									$sql2 = "SELECT * FROM  gebruiker WHERE id='$logname'";
									$result = mysqli_query($verbinding, $sql2);
									
									$row = mysqli_fetch_array($result,  MYSQL_ASSOC);

									
									$note = $rij['id'];
									$name = $row['user'];
									
									echo "opmerking van $name: <br>";
									
									include "note/$note.txt";
									
									
							?>
<br>
							<div class="btn btn-danger btn-xs">
								<a  style="color : rgb(255,255,255)" href="unnote.php?number=<?php echo "$note"; ?>">verwijderen</a></div><hr>
							<?php echo ""; } ?>
			  													  				</div>
		  			</div>
		  		</div>

						<div class="col-md-6">
							<div class="content-box-large">
								<div class="panel-heading">
									<div class="panel-title">notities</div>

								</div>
								<div class="panel-body">
									<form method="post" action="index.php">
										<fieldset>
												<div class="form-group">
													
													<textarea name="note" class="form-control" placeholder="Typ hier uw tekst" rows="3"></textarea>
												</div>
											<input type = "hidden" value='<?php echo "$note"; ?>' name='number'>
										</fieldset>
										
											
												<input class="btn btn-primary signup" type="submit" value="toevoegen">
										
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