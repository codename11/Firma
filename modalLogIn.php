<?php

session_start();
require "funkcije.php";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "firma";

$confirm = false;
$user="";
	if(isset($_POST["username"]) && !(empty($_POST["username"])) && isset($_POST["pwd"]) && !(empty($_POST["pwd"]))){
	$obj1 = new Validation($_POST["username"]);
	$obj2 = new Validation($_POST["pwd"]);

	$user = $obj1 -> test_input($obj1 -> getData());
	$pwd = md5($obj2 -> test_input($obj2 -> getData()));
	
	$kon = new SimpleDB($servername, $username, $password, $dbname);

	$Admin_modul='x';
	$sql = "SELECT korisnicko_ime, korisnik.sifra AS ttt FROM radnik, korisnik, moduli WHERE radnik.id=korisnik.radnik_FK AND korisnicko_ime='$user' AND korisnik.sifra='$pwd' AND moduli.Admin_modul='$Admin_modul'";

	$result = $kon->execute($sql);
	$num = 0;

		if ($result->num_rows > 0) {
			
			while($row = $result->fetch_assoc()){
				$num++;
				
				if($user == $row["korisnicko_ime"] && $pwd== $row["ttt"] && $Admin_modul == 'x'){
					
					$confirm = true;
					
				}
				else{
					$confirm = false;	
					
				}
			}
		}
		
	}
	
	if($confirm == true){
		$_SESSION["confirm"]=$confirm;
		$_SESSION["username"]=$user;
		header('Location: /www/knjigovodstvo/admin_panel/admin.php');
	}
	
	if($confirm == false){
		$_SESSION["confirm"]=$confirm;
		header('Location: /www/knjigovodstvo/index.php');
	}
	
?>