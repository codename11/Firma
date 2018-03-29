<?php

require '../funkcije.php';
session_start();

$form_var = array();
if(isset($_GET)){
	
	
	foreach ($_GET as $value) { 
	
		$obj1 = new Validation($value);
		$form_var[] = $obj1 -> test_input($obj1 -> getData());
	
	}
}

/*Sadrzaj:
$form_var[0]== Korisničko ime;
$form_var[1]== Šifra;
$form_var[2]== Ime;
$form_var[3]== Prezime;
$form_var[4]== Email;
$form_var[5]== Telefon;
$form_var[6]== Kategorija;
$form_var[7]== JMBG;
$form_var[8]== Sortiraj po;
$form_var[9]== Prikazati po stranici/limit;
$form_var[10]== offset;
*/
$len = count($form_var);

$pathTo_file = "/xampp/htdocs/www/knjigovodstvo/install/config.ini";
$myfile = fopen($pathTo_file, "r+") or die("Unable to open file!");
$tekst = fread($myfile,filesize($pathTo_file));
fclose($myfile);

$arr = explode(",",$tekst);

$servername = $arr[0];
$username = $arr[1];
$password = $arr[2];
$dbname = $arr[3];

$kon = new SimpleDB($servername, $username, $password, $dbname); 

$sql1 = "SELECT radnik.id,k_ime,sifra,ime,prezime,email,JMBG,nivo, broj, kategorija, tel_kategorija.id AS tkid,
Admin_modul, Kadrovska_sluzba, E_salter, Evidencija_ulaza_izlaza, Materijalno_poslovanje, E_magacin, Blagajna, 
Mehanizacija, E_kancelarija
FROM radnik, tel_broj,tel_kategorija, moduli 
WHERE k_ime  LIKE '$form_var[0]%' AND sifra LIKE '$form_var[1]%' AND ime LIKE '$form_var[2]%' 
AND prezime LIKE '$form_var[3]%' AND email LIKE '$form_var[4]%'AND JMBG LIKE '$form_var[7]%' 
AND broj LIKE '$form_var[5]%' AND radnik.id=tel_broj.radnik_FK AND tel_kategorija.id=tel_broj.kategorija_FK 
AND radnik.id=moduli.radnik_FK";
$result = $kon->execute($sql1);

$br1=0;	

if(!isset($myObj)){
	$myObj = new \stdClass();
}

if($result->num_rows > 0){

	while($row = $result->fetch_assoc()) {
		
		$br1++;
		
		$myObj->id = $row["id"];
		$myObj->k_ime = $row["k_ime"];
		$myObj->sifra = $row["sifra"];
		$myObj->ime = $row["ime"];
		$myObj->prezime = $row["prezime"];
		$myObj->email = $row["email"];
		$myObj->broj = $row["broj"];
		$myObj->tkid = $row["tkid"];
		$myObj->kategorija = $row["kategorija"];
		$myObj->JMBG = $row["JMBG"];
		$myObj->nivo = $row["nivo"];
		$myObj->Admin_modul = $row["Admin_modul"];
		$myObj->Kadrovska_sluzba = $row["Kadrovska_sluzba"];
		$myObj->E_salter = $row["E_salter"];
		$myObj->Evidencija_ulaza_izlaza = $row["Evidencija_ulaza_izlaza"];
		$myObj->Materijalno_poslovanje = $row["Materijalno_poslovanje"];
		$myObj->E_magacin = $row["E_magacin"];
		$myObj->Blagajna = $row["Blagajna"];
		$myObj->Mehanizacija = $row["Mehanizacija"];
		$myObj->E_kancelarija = $row["E_kancelarija"];
		
		$myJSON = json_encode($myObj, JSON_UNESCAPED_UNICODE);
		echo $myJSON;
		
	}
}
?>


