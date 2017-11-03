<?php
session_start();
$syncorder = $_SESSION['syncorder'];
if ($syncorder == "a2b"){
	echo "het werkt van a naar b";
}
else if ($syncorder == "b2a"){
	echo "het werkt van b naar a";
}

?>