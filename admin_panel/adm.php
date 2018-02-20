<?php 

require "../header.php";
require_once ("../funkcije.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "firma";

$confirm = 1;

if(!empty($_SESSION["username"]) && isset($_SESSION["username"]) && !empty($_SESSION["pwd"]) && isset($_SESSION["pwd"])){
	$obj1 = new Validation($_SESSION["username"]);
	$obj2 = new Validation($_SESSION["pwd"]);

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
				
				$confirm = 0;
				
			}
			else{
				
				$confirm = 1;
				
			}
			$_SESSION["confirm"]=$confirm;
		}
	}
	
	if($confirm == 0){
		header('Location: /xampp/htdocs/www/knjigovodstvo/index.php');
		
	}
		
?>