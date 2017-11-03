
<button class='btn btn-primary' type='submit' name='delete' value='<?php print $serversort; ?>'><i class='glyphicon glyphicon-remove'></i> verwijderen</button>
<button class='btn btn-primary' type='submit' name='copy' value='<?php print $serversort; ?>'><i class='glyphicon glyphicon-copy'></i> kopieren</button>
<button class='btn btn-primary' type='submit' name='download' value='<?php print $serversort; ?>'><i class='glyphicon glyphicon-save'></i> downloaden</button>
<button class='btn btn-primary' type='submit' name='rename' value='<?php print $serversort; ?>'><i class='glyphicon glyphicon-edit'></i> bewerken</button>




<?php

?>
<!--<div class="btn-group">
	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
		verplaatsen <span class="caret"></span>
	</button>
		<ul class="dropdown-menu" role="menu">
			<li><button class='btn btn-primary' type='submit' name='movewithin' value='<?php print $serversort; ?>' ><i class='glyphicon glyphicon-log-out'></i> binnen server</button></li>
			<li><button class='btn btn-primary' type='submit' name='movewithin' value='<?php print $serversort; ?>' ><i class='glyphicon glyphicon-log-out'></i> naar andere server</button></li>
		</ul>
</div> -->
<?php
$moveset = $_SESSION["moveset"];
if ($moveset == "empty"){
	

?>
<button class='btn btn-primary' type='submit' name='setmove' value='<?php print $serversort; ?>'><i class='glyphicon glyphicon-log-out'></i> verplaatsen</button>
<?php
}
else{
?>
<button class='btn btn-danger' type='submit' name='move' value='<?php print $serversort; ?>'><i class='glyphicon glyphicon-import'></i> plaatsen</button>
<button class='btn btn-warning' type='submit' name='unset' value='<?php print $serversort; ?>'><i class='glyphicon glyphicon-minus-sign'></i> annuleren</button>
<?php } ?>