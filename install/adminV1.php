<?php 
include '../funkcije.php';
session_start();

if(!empty($_POST) && isset($_POST) && !empty($_POST["k_ime"]) && isset($_POST["k_ime"]) && !empty($_POST["pwd"]) && isset($_POST["pwd"]) && !empty($_POST["ime"]) && isset($_POST["ime"]) && !empty($_POST["prezime"]) && isset($_POST["prezime"]) && !empty($_POST["email"]) && isset($_POST["email"]) && !empty($_POST["tel"]) && isset($_POST["tel"]) && !empty($_POST["jmbg"]) && isset($_POST["jmbg"])){

$obj1 = new Validation($_POST["k_ime"]);
$k_ime = $obj1 -> test_input($obj1 -> getData());

$obj2 = new Validation($_POST["pwd"]);
$sifra = md5($obj2 -> test_input($obj2 -> getData()));

$obj3 = new Validation($_POST["ime"]);
$ime = $obj3 -> test_input($obj3 -> getData());

$obj4 = new Validation($_POST["prezime"]);
$prezime = $obj4 -> test_input($obj4 -> getData());

$obj5 = new Validation($_POST["email"]);
$email = $obj5 -> test_input($obj5 -> getData());

$obj6 = new Validation($_POST["tel"]);
$broj = $obj6 -> test_input($obj6 -> getData());

$obj7 = new Validation($_POST["sel"]);
$kategorija = $obj7 -> test_input($obj7 -> getData());

$obj8 = new Validation($_POST["jmbg"]);
$jmbg = $obj8 -> test_input($obj8 -> getData());

$obj9 = new Validation($_POST["optradio"]);
$optradio = $obj9 -> test_input($obj9 -> getData());

}

	if(!empty($_POST["adminmodul"]) && $_POST["adminmodul"] == "x"){
		
		$obj10 = new Validation($_POST["adminmodul"]);
		$adminmodul = $obj10 -> test_input($obj10 -> getData());
	}
	else{
		$adminmodul = '';
	}

	if(!empty($_POST["ksluzba"]) && $_POST["ksluzba"] == "x"){
		
		$obj11 = new Validation($_POST["ksluzba"]);
		$ksluzba = $obj11 -> test_input($obj11 -> getData());
	}
	else{
		$ksluzba = '';
	}
	
	if(!empty($_POST["esalter"]) && $_POST["esalter"] == "x"){
		
		$obj12 = new Validation($_POST["esalter"]);
		$esalter = $obj12 -> test_input($obj12 -> getData());
	}
	else{
		$esalter = '';
	}
	
	if(!empty($_POST["evidencijaio"]) && $_POST["evidencijaio"] == "x"){
		
		$obj13 = new Validation($_POST["evidencijaio"]);
		$evidencijaio = $obj13 -> test_input($obj13 -> getData());
	}
	else{
		$evidencijaio = '';
	}
	
	if(!empty($_POST["mposlovanje"]) && $_POST["mposlovanje"] == "x"){
		
		$obj14 = new Validation($_POST["mposlovanje"]);
		$mposlovanje = $obj14 -> test_input($obj14 -> getData());
	}
	else{
		$mposlovanje = '';
	}
	
	if(!empty($_POST["emagacin"]) && $_POST["emagacin"] == "x"){
		
		$obj15 = new Validation($_POST["emagacin"]);
		$emagacin = $obj15 -> test_input($obj15 -> getData());
	}
	else{
		$emagacin = '';
	}
	
	if(!empty($_POST["blagajna"]) && $_POST["blagajna"] == "x"){
		
		$obj16 = new Validation($_POST["blagajna"]);
		$blagajna = $obj16 -> test_input($obj16 -> getData());
	}
	else{
		$blagajna = '';
	}
	
	if(!empty($_POST["mehanizacija"]) && $_POST["mehanizacija"] == "x"){
		
		$obj17 = new Validation($_POST["mehanizacija"]);
		$mehanizacija = $obj17 -> test_input($obj17 -> getData());
	}
	else{
		$mehanizacija = '';
	}
	
	if(!empty($_POST["ekancelarija"]) && $_POST["ekancelarija"] == "x"){
		
		$obj18 = new Validation($_POST["ekancelarija"]);
		$ekancelarija = $obj18 -> test_input($obj18 -> getData());
	}
	else{
		$ekancelarija = '';
	}
	
//Razlika je samo sto moj server nema šifru, odnosno !empty($_SESSION["password"]) mora biti true jer je šifra prazan string.
//if(!empty($_SESSION) && isset($_SESSION) && !empty($_SESSION["servername"]) && isset($_SESSION["servername"]) && !empty($_SESSION["username"]) && isset($_SESSION["username"]) && !empty($_SESSION["password"]) && isset($_SESSION["password"]) && !empty($_SESSION["dbname"]) && isset($_SESSION["dbname"])){

if(!empty($_POST) && isset($_POST) && !empty($_POST["servername"]) && isset($_POST["servername"]) && !empty($_POST["username"]) && isset($_POST["username"]) && isset($_POST["password"]) && !empty($_POST["dbname"]) && isset($_POST["dbname"])){
	
	$servername = $_POST["servername"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$dbname = $_POST["dbname"];
}
else{
	$servername = "127.0.0.1";
	$username = "root";
	$password = "";
	$dbname = "firma";
}

$kon = new SimpleDB($servername, $username, $password, $dbname); 

$sql="INSERT INTO radnik (k_ime, sifra, ime, prezime, email, JMBG, nivo)
VALUES ('$k_ime', '$sifra', '$ime', '$prezime', '$email', '$jmbg', '$optradio');
INSERT INTO tel_broj (broj,kategorija_FK,radnik_FK)
VALUES ('$broj', '$kategorija',(SELECT id FROM radnik WHERE id=(SELECT MAX(id) FROM radnik)))
";

$sqlx1 = "INSERT INTO moduli (Admin_modul, Kadrovska_služba, E_šalter, Evidencija_ulaza_izlaza, 
Materijalno_poslovanje, E_magacin, 	Blagajna, Mehanizacija, E_kancelarija, radnik_FK) 
VALUES('$adminmodul', '$ksluzba', '$esalter', '$evidencijaio', '$mposlovanje', '$emagacin', 
'$blagajna', '$mehanizacija', '$ekancelarija', 
(SELECT id FROM radnik WHERE id=(SELECT MAX(id) FROM radnik)))";

$sqlx2 = "INSERT INTO korisnik (korisnicko_ime, sifra, radnik_FK)
VALUES ('$k_ime', '$sifra', (SELECT id FROM radnik WHERE id=(SELECT MAX(id) FROM radnik)))";

$sql .= "; ".$sqlx1."; ".$sqlx2;

$kon->multi_execute($sql);

?>