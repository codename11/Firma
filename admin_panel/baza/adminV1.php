<?php 
include '../funkcije.php';
session_start();
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

if(!empty($_POST) && isset($_POST)){
	
	if(isset($_POST["adminmodul"])){
		$adminmodul = $_POST["adminmodul"];
	}
	
	if(isset($_POST["ksluzba"])){
		$ksluzba = $_POST["ksluzba"];
	}
	
	if(isset($_POST["esalter"])){
		$esalter = $_POST["esalter"];
	}
	
	if(isset($_POST["evidencijaio"])){
		$evidencijaio = $_POST["evidencijaio"];
	}
	
	if(isset($_POST["mposlovanje"])){
		$mposlovanje = $_POST["mposlovanje"];
	}
	
	if(isset($_POST["emagacin"])){
		$emagacin = $_POST["emagacin"];
	}
	
	if(isset($_POST["blagajna"])){
		$blagajna = $_POST["blagajna"];
	}
	
	if(isset($_POST["mehanizacija"])){
		$mehanizacija = $_POST["mehanizacija"];
	}
	
	if(isset($_POST["ekancelarija"])){
		$ekancelarija = $_POST["ekancelarija"];
	}

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

INSERT INTO tel_broj (broj,kategorija_FK,osoba_FK)
VALUES ('$broj', '$kategorija',(SELECT id FROM radnik WHERE id=(SELECT MAX(id) FROM radnik)))
";

$sqlx = ",(SELECT id FROM radnik WHERE id=(SELECT MAX(id) FROM radnik)))";

	if(!empty($adminmodul)){
		$sql1 = "INSERT INTO moduli (Admin_modul,radnik_FK)
		VALUES ('$adminmodul'".$sqlx;
		
		$sql .= "; ".$sql1;
	}

	if(!empty($ksluzba)){
		$sql2 = "INSERT INTO moduli (Kadrovska_služba,radnik_FK)
		VALUES ('$ksluzba'".$sqlx;
	
		$sql .= "; ".$sql2;
	}

	if(!empty($esalter)){
		$sql3 = "INSERT INTO moduli (E_šalter,radnik_FK)
		VALUES ('$esalter'".$sqlx;
		
		$sql .= "; ".$sql3;
	}

	if(!empty($evidencijaio)){
		$sql4 = "INSERT INTO moduli (Evidencija_ulaza_izlaza,radnik_FK)
		VALUES ('$evidencijaio'".$sqlx;
		
		$sql .= "; ".$sql4;
	}

	if(!empty($mposlovanje)){
		$sql5 = "INSERT INTO moduli (Materijalno_poslovanje,radnik_FK)
		VALUES ('$mposlovanje'".$sqlx;
		
		$sql .= "; ".$sql5;
	}

	if(!empty($emagacin)){
		$sql5 = "INSERT INTO moduli (E_magacin,radnik_FK)
		VALUES ('$emagacin'".$sqlx;
		
		$sql .= "; ".$sql6;
	}

	if(!empty($blagajna)){
		$sql6 = "INSERT INTO moduli (Blagajna,radnik_FK)
		VALUES ('$blagajna'".$sqlx;
		
		$sql .= "; ".$sql7;
	}

	if(!empty($mehanizacija)){
		$sql7 = "INSERT INTO moduli (Mehanizacija,radnik_FK)
		VALUES ('$mehanizacija'".$sqlx;
		
		$sql .= "; ".$sql8;
	}

	if(!empty($ekancelarija)){
		$sql8 = "INSERT INTO moduli (E_kancelarija,radnik_FK)
		VALUES ('$ekancelarija'".$sqlx;
		
		$sql .= "; ".$sql9;
	}


pristup($servername,$username,$password,$dbname,$sql);

}

?>