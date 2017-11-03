<?php
session_start();
include 'db.php';
$gbnaam = $_POST['gbnaam'];
$_SESSION['user'] = $gbnaam;
$wachtwoord = md5($_POST['wachtwoord']);
$_SESSION['wachtwoord'] = $wachtwoord;
if(!empty($_POST['gbnaam']) && !empty($_POST['wachtwoord'])){
								$sql = "INSERT INTO gebruiker(user, pass)
								VALUES('$gbnaam', '$wachtwoord');";
								
								$resultaat = mysqli_query($verbinding, $sql) or die (mysqli_error());
								
					header ("location: panel/firstlogin.php");		
}
else{
	header ('location:indexempty.php');
}
?>
<style>
.elementToFadeInAndOut {
    
    -webkit-animation: fadein 4s linear forwards;
    animation: fadein 4s linear forwards;
    opacity: 0;
	position: absolute; 
  

}

@-webkit-keyframes fadein {
  50% { opacity: 1; }
}

@keyframes fadein {
  50% { opacity: 1; }
#test {
    
    animation: fadein 2s;
    -moz-animation: fadein 2s; /* Firefox */
    -webkit-animation: fadein 2s; /* Safari and Chrome */
    -o-animation: fadein 2s; /* Opera */
}
@keyframes fadein {
    from {
        opacity:0;
    }
    to {
        opacity:1;
    }
}
@-moz-keyframes fadein { /* Firefox */
    from {
        opacity:0;
    }
    to {
        opacity:1;
    }
}
@-webkit-keyframes fadein { /* Safari and Chrome */
    from {
        opacity:0;
    }
    to {
        opacity:1;
    }
}
@-o-keyframes fadein { /* Opera */
    from {
        opacity:0;
    }
    to {
        opacity: 1;
    }
}
  
  }
</style>
<div class=elementToFadeInAndOut><?php include 'succes.php';?></div>
<div class=test><?php include 'index.php';?></div>
