<?php 
session_start();
require "../header.php";

if(!(isset($_SESSION["username"])) && empty($_SESSION["username"]) && !(isset($_SESSION["pwd"])) && empty($_SESSION["pwd"])){
	
	header( "Location: ../index.php" );	
}

?>

<div class="top-content">
	<div class="container" id="cont">
		<?php 
			require "subnav.php";
			require "/xampp/htdocs/www/knjigovodstvo/admin_panel/adm.php"; 
		?>			
		<span id="dmx"></span>
	</div>
</div>
