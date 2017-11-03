<?php
session_start();
$gbnaam = $_POST['gbnaam'];
								$wachtwoord = md5($_POST['wachtwoord']);
								include 'db.php';
								$sql = "INSERT INTO gebruiker(user, pass)
								VALUES('$gbnaam', '$wachtwoord');";
								
							// $aanmeldnummer = $_SESSION['id'];
								// $addeduser = "gebruiker " . $gbnaam . " aangemaakt";
								// $sql = "INSERT INTO log(activity, gebruiker_id) VALUES('$addeduser', '$aanmeldnummer')";
								$resultaat = mysqli_query($verbinding, $sql) or die (mysqli_error()); 
						?>