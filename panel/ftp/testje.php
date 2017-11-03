<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='POST'){
	$name = $_REQUEST;
	if(empty($name)){
		echo "name is empty";
	}
	else{
		echo $_REQUEST;
	}
}

	
	?>
	
	<form method="post" name="inlog" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Name: <input type="text" name="fname">
kaas: <input type="text" name="kaas">
  <input type="submit">
</form>

	
	
	
	


