<?php
require '../funkcije.php';
session_start();

$form_var = array();
if(isset($_GET)){
	
	
	foreach ($_GET as $value) { 
	
		$obj1 = new Validation($value);
		$form_var[] = $obj1 -> test_input($obj1 -> getData());
	
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
$form_var[9]== Prikazati po stranici;

*/

/*Sadrzaj za modal formu:
$form_var[0]== Korisničko ime;
$form_var[1]== Šifra;
$form_var[2]== Ime;
$form_var[3]== Prezime;
$form_var[4]== Email;
$form_var[5]== Telefon;
$form_var[6]== Kategorija;
$form_var[7]== JMBG;
$form_var[8]== adminmodul;
$form_var[9]== ksluzba;
$form_var[10]== esalter;
$form_var[11]== evidencijaio;
$form_var[12]== mposlovanje;
$form_var[13]== emagacin;
$form_var[14]== blagajna;
$form_var[15]== mehanizacija;
$form_var[16]== ekancelarija;
$form_var[17]== optradio-admin;
$form_var[17]== optradio-user;
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


	$kon1 = new SimpleDB($servername, $username, $password, $dbname);
	$sql1 = "SELECT sifra FROM radnik WHERE sifra='$form_var[1]'";
	$result1=$kon1->execute($sql1);
	
	$check=false;
	
	if ($result1->num_rows > 0) {
				
			while($row = $result1->fetch_assoc()){
				
				if($form_var[1]== $row['sifra']){
					$check=true;
				}
				
			}
	}
echo "</br>";
print_r($form_var);
echo "</br>".$len;
	$kon2 = new SimpleDB($servername, $username, $password, $dbname); 

	if($check == true){
		
		$sql2 = "UPDATE radnik, korisnik, tel_broj, moduli 
		SET ime='".$form_var[2]."', prezime='".$form_var[3]."', 
		email='".$form_var[4]."', JMBG='".$form_var[7]."', k_ime='".$form_var[0]."', korisnicko_ime='".$form_var[0]."', 
		broj='".$form_var[5]."', kategorija_FK='".$form_var[6]."', nivo='".$form_var[17]."', 
		Admin_modul='".$form_var[8]."', Kadrovska_sluzba='".$form_var[9]."', E_salter='".$form_var[10]."', 
		Evidencija_ulaza_izlaza='".$form_var[11]."', Materijalno_poslovanje='".$form_var[12]."', E_magacin='".$form_var[13]."', 
		Blagajna='".$form_var[14]."', Mehanizacija='".$form_var[15]."', E_kancelarija='".$form_var[16]."' 
		WHERE radnik.id='".$_SESSION["id"]."' AND korisnik.radnik_FK=radnik.id AND tel_broj.radnik_FK=radnik.id 
		AND moduli.radnik_FK=radnik.id";
		
		$kon2->execute($sql2);
	}

	if($check == false){
		
		$sql2 = "UPDATE radnik, korisnik, tel_broj 
		SET ime='".$form_var[2]."', prezime='".$form_var[3]."', 
		email='".$form_var[4]."', JMBG='".$form_var[7]."', k_ime='".$form_var[0]."', korisnicko_ime='".$form_var[0]."', 
		radnik.sifra='".md5($form_var[1])."', korisnik.sifra='".md5($form_var[1])."', 
		broj='".$form_var[5]."', kategorija_FK='".$form_var[6]."', nivo='".$form_var[17]."', 
		Admin_modul='".$form_var[8]."', Kadrovska_sluzba='".$form_var[9]."', E_salter='".$form_var[10]."', 
		Evidencija_ulaza_izlaza='".$form_var[11]."', Materijalno_poslovanje='".$form_var[12]."', E_magacin='".$form_var[13]."', 
		Blagajna='".$form_var[14]."', Mehanizacija='".$form_var[15]."', E_kancelarija='".$form_var[16]."'
		WHERE radnik.id='".$_SESSION["id"]."' AND korisnik.radnik_FK=radnik.id AND tel_broj.radnik_FK=radnik.id 
		AND moduli.radnik_FK=radnik.id";

		$kon2->execute($sql2);
		
	}

}

?>