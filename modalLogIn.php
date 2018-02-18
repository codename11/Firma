<?php
session_start();
require "funkcije.php";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "firma";



if(!empty($_POST["username"]) && isset($_POST["username"]) && !empty($_POST["pwd"]) && isset($_POST["pwd"])){
	$obj1 = new Validation($_POST["username"]);
	$obj2 = new Validation($_POST["pwd"]);

	$user = $obj1 -> test_input($obj1 -> getData());
	$pwd = $obj2 -> test_input($obj2 -> getData());
	
	$kon = new SimpleDB($servername, $username, $password, $dbname);

	$Admin_modul='x';
	$sql = "SELECT korisnicko_ime, sifra FROM korisnik, moduli WHERE korisnik.id=moduli.radnik_FK AND moduli.Admin_modul='$Admin_modul'";

	$result = $kon->execute($sql);
	$num = 0;

		while($row = $result->fetch_assoc()){
			$num++;
			if(($user != $row["korisnicko_ime"]) && (md5($pwd) != $row["sifra"]) && $Admin_modul != 'x'){
				
				header('Location: /www/knjigovodstvo/index.php');
			}
			else{
				$_SESSION["username"] = $user;
				$_SESSION["pwd"] = $pwd;
			
			}

		}
	}



?>