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
$sql1 = "SELECT radnik.id, ime, prezime,email, JMBG FROM radnik WHERE ime='$form_var[2]' AND prezime='$form_var[3]' AND email='$form_var[4]' AND JMBG='$form_var[7]'";

$result = $kon1->execute($sql1);

$id="";
if($result->num_rows > 0){
	
	while($row = $result->fetch_assoc()) {
		$id=$row["id"];
		
	}
}

///print_r($_GET);
//print_r($servername."; ".$username."; ".$password."; ".$dbname);
//var_dump($result);
$kon2 = new SimpleDB($servername, $username, $password, $dbname); 

$sql2 = "UPDATE radnik, korisnik, tel_broj 
SET k_ime='$form_var[0]', korisnicko_ime='$form_var[0]', 
radnik.sifra='$form_var[1]', korisnik.sifra='$form_var[1]', ime='$form_var[2]', prezime='$form_var[3]', 
email='$form_var[4]', JMBG='$form_var[7]', broj='$form_var[5]', kategorija_FK='$form_var[6]' 
WHERE radnik.id='$id' AND korisnik.radnik_FK=radnik.id AND tel_broj.radnik_FK=radnik.id";
	
$kon2->execute($sql2);
echo "</br>".$id."</br>";	
print_r($form_var);
}

?>