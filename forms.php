<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Flat Login Form 3.0</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="css/reset.css">

    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

        <link rel="stylesheet" href="css/style.css">

    
    
    
  </head>

  <body>
    
<!-- Form Mixin-->
<!-- Input Mixin-->
<!-- Button Mixin-->
<!-- Pen Title-->

<!-- Form Module-->
<div class="module form-module">
  <div class="toggle"><i class="glyphicon glyphicon-pencil"></i>
    <br>
  </div>
  <div class="form">
    <h2>Inloggen </h2>
    <form method="post" action="panel/login.php">
      <input name="user" type="text" autocomplete="off" placeholder="Gebruikersnaam"/>
      <input name="pass" type="password" placeholder="Wachtwoord"/>
      <button>Login</button>
    </form>
  </div>
  <div class="form">
    <h2>Account aanmaken</h2>
    <form method="post" action="aanmaken.php">
      <input type="text" name="gbnaam" autocomplete="off" placeholder="Gebruikersnaam"/>
      <input type="password" name="wachtwoord" placeholder="Wachtwoord"/>
      <button>Registreren</button>
    </form>
  </div>
  
  <!--<div class="cta"><a href="http://andytran.me">Forgot your password?</a></div>-->
</div>
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src="js/index.js"></script>
  </body>
</html>
