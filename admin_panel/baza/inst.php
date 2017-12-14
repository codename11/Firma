<?php

include '../funkcije.php';
session_start();
//Install database and it's table appropriately.

if(!empty($_POST)){
	
$servername = test_input($_POST["ipadresa"]);
$username = test_input($_POST["base"]);
$password = test_input($_POST["pwd"]);
$dbname = test_input($_POST["baza"]);

$myfile = fopen("config.ini", "w") or die("Unable to open file!");
//echo fread($myfile,filesize("config.ini"));
$txt = $servername.",".$username.",".$password.",".$dbname;
fwrite($myfile, $txt);
fclose($myfile);

$myfile = fopen("config.ini", "r+") or die("Unable to open file!");
$tekst = fread($myfile,filesize("config.ini"));

fclose($myfile);

$arr = explode(",",$tekst);

}

if(!empty($arr)){
	
	$servername = test_input($arr[0]);
	$username = test_input($arr[1]);
	$password = test_input($arr[2]);
	$dbname = test_input($arr[3]);
	
	$conn=new mysqli($servername, $username, $password, $dbname);
	
	if($conn->connect_error){
	
		die("Neuspela konekcija: ".$conn->connect_error);
	
	}
	
	$_SESSION["servername"] = $servername;
	$_SESSION["username"] = $username;
	$_SESSION["password"] = $password;
	$_SESSION["dbname"] = $dbname;
	

	$conn->close();

	//require 'kreiranje_baze.php'; Ručno se treba kreirati baza.
		
		$sql1  = "CREATE TABLE radnik (
		id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		k_ime VARCHAR(30) NOT NULL, 
		sifra VARCHAR(30) NOT NULL, 
		ime VARCHAR(30) NOT NULL,
		prezime VARCHAR(30) NOT NULL,
		email VARCHAR(30) NOT NULL,
		JMBG  VARCHAR(14) NOT NULL,
		nivo VARCHAR(5) NOT NULL
		)";

		$sql2 = "CREATE TABLE korisnik (
		id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		korisnicko_ime VARCHAR(30) NOT NULL,
		sifra VARCHAR(30) NOT NULL,
		radnik_FK INT(10) UNSIGNED,
		FOREIGN KEY (radnik_FK) REFERENCES radnik(id) ON UPDATE CASCADE ON DELETE CASCADE
		)";

		$sql3 = "CREATE TABLE tel_kategorija (
		id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		kategorija VARCHAR(7) NOT NULL
		)";

		$sql4 = "INSERT INTO tel_kategorija (kategorija)
				VALUES ('fiksni')";
				
		$sql5 = "INSERT INTO tel_kategorija (kategorija)
				VALUES ('mobilni')";		
		
		$sql6 = "CREATE TABLE tel_broj (
		id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		broj VARCHAR(10) NOT NULL,
		kategorija_FK INT(1) UNSIGNED,
		FOREIGN KEY (kategorija_FK) REFERENCES tel_kategorija(id) ON UPDATE CASCADE ON DELETE CASCADE,
		radnik_FK INT(10) UNSIGNED,
		FOREIGN KEY (radnik_FK) REFERENCES radnik(id) ON UPDATE CASCADE ON DELETE CASCADE
		)";//Prvo se kreira polje u tabeli, pa se tek onda veže da bude foreign key.

		$sql7 = "CREATE TABLE moduli (
		id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		Admin_modul VARCHAR(5) NOT NULL DEFAULT '0',
		Kadrovska_služba VARCHAR(5) NOT NULL DEFAULT '0',
		E_šalter VARCHAR(5) NOT NULL DEFAULT '0',
		Evidencija_ulaza_izlaza VARCHAR(5) NOT NULL DEFAULT '0',
		Materijalno_poslovanje VARCHAR(5) NOT NULL DEFAULT '0',
		E_magacin VARCHAR(5) NOT NULL DEFAULT '0',
		Blagajna VARCHAR(5) NOT NULL DEFAULT '0',
		Mehanizacija VARCHAR(5) NOT NULL DEFAULT '0',
		E_kancelarija VARCHAR(5) NOT NULL DEFAULT '0',
		radnik_FK INT(10) UNSIGNED,
		FOREIGN KEY (radnik_FK) REFERENCES radnik(id) ON UPDATE CASCADE ON DELETE CASCADE
		)";//Prvo se kreira polje u tabeli, pa se tek onda veže da bude foreign key.
		
		
		$sql = $sql1.";".$sql2.";".$sql3.";".$sql4.";".$sql5.";".$sql6.";".$sql7;

		multi_pristup($servername, $username, $password, $dbname, $sql);	
		//header("location: prvi_admin.php");
}

?>