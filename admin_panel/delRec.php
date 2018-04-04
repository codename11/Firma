<?php
	
	if(isset($_GET["jason"])){
		echo(json_decode(json_encode($_GET["jason"]),true)); 
	}

?>