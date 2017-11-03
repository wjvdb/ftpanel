<?php
session_start();
?>
<style>
.elementToFadeInAndOut {
    
    -webkit-animation: fadein 4s linear forwards;
    animation: fadein 4s linear forwards;
    opacity: 0;
	
  

}

@-webkit-keyframes fadein {
  50% { opacity: 1; }
}

@keyframes fadein {
  50% { opacity: 1; }

}
  
 
</style>
<div class=elementToFadeInAndOut><?php include 'errormessage.php';?></div>


<div class=box fade-in three><meta http-equiv="refresh" content="5;url=../index.php" />
</div>

