<?php

require '../funkcije.php';
session_start();
//Install database and it's table appropriately.
$kon = new SimpleDB("localhost", "root", "", "firma"); 

if(!empty($_POST)){

$obj1 = new Validation($_POST["ipadresa"]);
$servername = $obj1 -> test_input($obj1 -> getData());

$obj2 = new Validation($_POST["base"]);
$username = $obj2 -> test_input($obj2 -> getData());

$obj3 = new Validation($_POST["pwd"]);
$password = $obj3 -> test_input($obj3 -> getData());

$obj4 = new Validation($_POST["baza"]);
$dbname = $obj4 -> test_input($obj4 -> getData());

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
	
	$obj5 = new Validation($arr[0]);
	$obj6 = new Validation($arr[1]);
	$obj7 = new Validation($arr[2]);
	$obj8 = new Validation($arr[3]);

	$servername = $obj5 -> test_input($obj5 -> getData());
	$username = $obj6 -> test_input($obj6 -> getData());
	$password = $obj7 -> test_input($obj7 -> getData());
	$dbname = $obj8 -> test_input($obj8 -> getData());
	
	
	
	$_SESSION["servername"] = $servername;
	$_SESSION["username"] = $username;
	$_SESSION["password"] = $password;
	$_SESSION["dbname"] = $dbname;
	
	//require 'kreiranje_baze.php'; Ručno se treba kreirati baza.
		
		
		
		$sql1  = "CREATE TABLE radnik (
		id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		k_ime VARCHAR(30) NOT NULL, 
		sifra VARCHAR(255) NOT NULL, 
		ime VARCHAR(30) NOT NULL,
		prezime VARCHAR(30) NOT NULL,
		email VARCHAR(30) NOT NULL,
		JMBG  VARCHAR(14) NOT NULL,
		nivo VARCHAR(5) NOT NULL
		)";

		$sql2 = "CREATE TABLE korisnik (
		id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		korisnicko_ime VARCHAR(30) NOT NULL,
		sifra VARCHAR(255) NOT NULL,
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
		$kon->multi_execute($sql);
		
		
		//header("location: prvi_admin.php");
}

?>