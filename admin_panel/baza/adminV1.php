<?php 
include '../funkcije.php';
session_start();
if(!empty($_POST) && isset($_POST) && !empty($_POST["k_ime"]) && isset($_POST["k_ime"]) && !empty($_POST["pwd"]) && isset($_POST["pwd"]) && !empty($_POST["ime"]) && isset($_POST["ime"]) && !empty($_POST["prezime"]) && isset($_POST["prezime"]) && !empty($_POST["email"]) && isset($_POST["email"]) && !empty($_POST["tel"]) && isset($_POST["tel"]) && !empty($_POST["jmbg"]) && isset($_POST["jmbg"])){
	
$k_ime = test_input($_POST["k_ime"]);
$sifra = md5(test_input($_POST["pwd"]));
$ime = test_input($_POST["ime"]);
$prezime = test_input($_POST["prezime"]);
$email = test_input($_POST["email"]);
$tel = test_input($_POST["tel"]);
$jmbg = test_input($_POST["jmbg"]);
$optradio = $_POST["optradio"];
//echo $korisnicko_ime.", ".$sifra.", ".$ime.", ".$prezime.", ".$email.", ".$tel.", ".$jmbg.", ".$optradio;
}


//Ralika je samo sto moj server nema šifru, odnosno !empty($_SESSION["password"]) mora biti true jer je šifra prazan string.
//if(!empty($_SESSION) && isset($_SESSION) && !empty($_SESSION["servername"]) && isset($_SESSION["servername"]) && !empty($_SESSION["username"]) && isset($_SESSION["username"]) && !empty($_SESSION["password"]) && isset($_SESSION["password"]) && !empty($_SESSION["dbname"]) && isset($_SESSION["dbname"])){
if(!empty($_SESSION) && isset($_SESSION) && !empty($_SESSION["servername"]) && isset($_SESSION["servername"]) && !empty($_SESSION["username"]) && isset($_SESSION["username"]) && isset($_SESSION["password"]) && !empty($_SESSION["dbname"]) && isset($_SESSION["dbname"])){
	
$servername = $_SESSION["servername"];
$username = $_SESSION["username"];
$password = $_SESSION["password"];
$dbname = $_SESSION["dbname"];

$sql="INSERT INTO radnik (k_ime, sifra, ime, prezime, email,telefon, JMBG, nivo)
VALUES ('$k_ime', '$sifra', '$ime', '$prezime', '$email', '$tel', '$jmbg', '$optradio')";

pristup($servername,$username,$password,$dbname,$sql);

}

?>