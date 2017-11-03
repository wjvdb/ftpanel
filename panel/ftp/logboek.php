<?php
session_start();
$user = $_SESSION['userid'];
include 'db.php';
include 'controls.php';
?>
<html>
  <head>
    <title>logboek</title>
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
                    <li class="current"><a href="logboek.php"><i class="glyphicon glyphicon-list-alt"></i> logboek</a></li>
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
		  
		  <!--log ophalen-->
			<?php
			
			?>
		   <div class="col-md-10">
  			<div class="content-box-large">
  				<div class="panel-heading">
					<div class="panel-title">logboek servers</div>
				</div>
  				<div class="panel-body">
  					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
						<thead>
							<tr>
								<th>id</th>
								<th>activity</th>
								<th>server</th>
								<th>tijd</th>
								<th>locatie</th>
								<th>ftp id</th>
								<th>user id</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$sql = "SELECT * FROM log";
						$resultaat = mysqli_query($verbinding, $sql);
						while($rij = mysqli_fetch_array($resultaat)){
							echo("<tr><td>" .$rij['id']. "</td><td>" .$rij['activity']. "</td><td>" .$rij['server']. "</td><td>" .$rij['time']. "</td><td>" .$rij['location']. "</td><td>" .$rij['ftp_id']. "</td><td>" .$rij['gebruiker_id']. "</td></tr>");
						}
						?>
						
						
						
						</tbody>
					</table>
  				</div>
  			</div>



		  </div>
		</div>
    </div>


</div>
</div>
</div>

     <!-- <link href="vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <script src="vendors/datatables/js/jquery.dataTables.min.js"></script>

    <script src="vendors/datatables/dataTables.bootstrap.js"></script>

    <script src="js/custom.js"></script>
    <script src="js/tables.js"></script>
  </body>
</html>