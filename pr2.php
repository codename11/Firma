<?php
//echo json_encode($_GET); //Should use this if it's jquery ajax json string.
//print_r($_GET);//Should use this if it's jquery ajax ordinary string.
	if(isset($_GET)){
		
		if(isset($_GET["jason"])){
		echo(json_decode(json_encode($_GET["jason"]),true)); 
		}
		else{
			print_r($_GET);
		}
	
	}

?>