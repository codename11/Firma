<?php 
include '../funkcije.php';
session_start();
/*echo "Sesija: ";
print_r($_SESSION);
echo "</br>POST: ";
print_r($_POST);*/
if(!empty($_POST) && isset($_POST) && !empty($_POST["k_ime"]) && isset($_POST["k_ime"]) && !empty($_POST["pwd"]) && isset($_POST["pwd"]) && !empty($_POST["ime"]) && isset($_POST["ime"]) && !empty($_POST["prezime"]) && isset($_POST["prezime"]) && !empty($_POST["email"]) && isset($_POST["email"]) && !empty($_POST["tel"]) && isset($_POST["tel"]) && !empty($_POST["jmbg"]) && isset($_POST["jmbg"])){
	
$k_ime = test_input($_POST["k_ime"]);
$sifra = md5(test_input($_POST["pwd"]));
$ime = test_input($_POST["ime"]);
$prezime = test_input($_POST["prezime"]);
$email = test_input($_POST["email"]);
$broj = test_input($_POST["tel"]);
$kategorija = test_input($_POST["sel"]);
$jmbg = test_input($_POST["jmbg"]);
$optradio = $_POST["optradio"];

}

	if(!empty($_POST["adminmodul"]) && $_POST["adminmodul"] == "x"){
		$adminmodul = test_input($_POST["adminmodul"]);
	}
	else{
		$adminmodul = '';
	}

	if(!empty($_POST["ksluzba"]) && $_POST["ksluzba"] == "x"){
		$ksluzba = test_input($_POST["ksluzba"]);
	}
	else{
		$ksluzba = '';
	}
	
	if(!empty($_POST["esalter"]) && $_POST["esalter"] == "x"){
		$esalter = test_input($_POST["esalter"]);
	}
	else{
		$esalter = '';
	}
	
	if(!empty($_POST["evidencijaio"]) && $_POST["evidencijaio"] == "x"){
		$evidencijaio = test_input($_POST["evidencijaio"]);
	}
	else{
		$evidencijaio = '';
	}
	
	if(!empty($_POST["mposlovanje"]) && $_POST["mposlovanje"] == "x"){
		$mposlovanje = test_input($_POST["mposlovanje"]);
	}
	else{
		$mposlovanje = '';
	}
	
	if(!empty($_POST["emagacin"]) && $_POST["emagacin"] == "x"){
		$emagacin = test_input($_POST["emagacin"]);
	}
	else{
		$emagacin = '';
	}
	
	if(!empty($_POST["blagajna"]) && $_POST["blagajna"] == "x"){
		$blagajna = test_input($_POST["blagajna"]);
	}
	else{
		$blagajna = '';
	}
	
	if(!empty($_POST["mehanizacija"]) && $_POST["mehanizacija"] == "x"){
		$mehanizacija = test_input($_POST["mehanizacija"]);
	}
	else{
		$mehanizacija = '';
	}
	
	if(!empty($_POST["ekancelarija"]) && $_POST["ekancelarija"] == "x"){
		$ekancelarija = test_input($_POST["ekancelarija"]);
	}
	else{
		$ekancelarija = '';
	}
	
//Razlika je samo sto moj server nema šifru, odnosno !empty($_SESSION["password"]) mora biti true jer je šifra prazan string.
//if(!empty($_SESSION) && isset($_SESSION) && !empty($_SESSION["servername"]) && isset($_SESSION["servername"]) && !empty($_SESSION["username"]) && isset($_SESSION["username"]) && !empty($_SESSION["password"]) && isset($_SESSION["password"]) && !empty($_SESSION["dbname"]) && isset($_SESSION["dbname"])){
if(!empty($_SESSION) && isset($_SESSION) && !empty($_SESSION["servername"]) && isset($_SESSION["servername"]) && !empty($_SESSION["username"]) && isset($_SESSION["username"]) && isset($_SESSION["password"]) && !empty($_SESSION["dbname"]) && isset($_SESSION["dbname"])){
	
$servername = $_SESSION["servername"];
$username = $_SESSION["username"];
$password = $_SESSION["password"];
$dbname = $_SESSION["dbname"];

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

$sql .= "; ".$sqlx1;
echo "</br>".$sql;
multi_pristup($servername,$username,$password,$dbname,$sql);

}

?>