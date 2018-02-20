<?php

if(isset($_GET["k_ime"]) && !(empty($_GET["k_ime"])) && isset($_GET["pwd"]) && !(empty($_GET["pwd"])) && isset($_GET["ime"]) && !(empty($_GET["ime"])) && isset($_GET["prezime"]) && !(empty($_GET["prezime"])) && isset($_GET["email"]) && !(empty($_GET["email"])) && isset($_GET["tel"]) && !(empty($_GET["tel"])) && isset($_GET["sel"]) && !(empty($_GET["sel"])) && isset($_GET["jmbg"]) && !(empty($_GET["jmbg"])) && isset($_GET["srt"]) && !(empty($_GET["srt"]))){
	print_r($_GET);
}

?>