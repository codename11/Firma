<?php

require '../funkcije.php';
session_start();
//header("Content-Type: application/json; charset=UTF-8");

	if(isset($_GET["jason"])){
		$obj = json_decode($_GET["jason"], false);
	}


//print_r($obj);
$len = count($obj->k_ime);

$pathTo_file = "/xampp/htdocs/www/knjigovodstvo/install/config.ini";
$myfile = fopen($pathTo_file, "r+") or die("Unable to open file!");
$tekst = fread($myfile,filesize($pathTo_file));
fclose($myfile);

$arr = explode(",",$tekst);

$servername = $arr[0];
$username = $arr[1];
$password = $arr[2];
$dbname = $arr[3];


$sqlx = "(";
for($i=0;$i<$len;$i++){
	
	$k_ime = "k_ime='".$obj->k_ime[$i]."'";
	$sifra = "sifra='".$obj->sifra[$i]."'";
	$ime = "ime='".$obj->ime[$i]."'";
	$prezime = "prezime='".$obj->prezime[$i]."'";
	$email = "email='".$obj->email[$i]."'";
	$JMBG = "JMBG='".$obj->jmbg[$i]."'";

	$sqlx .= "(SELECT id FROM radnik WHERE ".$k_ime." AND ".$sifra." AND ".$ime." AND ".$prezime." AND ".$email." AND ".$JMBG.")";
	
	if($i<$len-1 && $len>1){
		$sqlx .= ", ";
	}
	
}

$sqlx .= ");";
//echo "</br>".gettype($sqlx)."</br>";
$kon = new SimpleDB($servername, $username, $password, $dbname);
$sql = "DELETE FROM radnik 
WHERE id IN ".$sqlx;

echo $sql;
$result=$kon->execute($sql);


?>