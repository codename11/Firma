<?php

require '../funkcije.php';
session_start();

	if(isset($_GET["jason"])){
		$obj = json_decode($_GET["jason"], false);
	}

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

$sqlx = "SELECT id FROM radnik WHERE ";
for($i=0;$i<$len;$i++){
	
	$k_ime = "k_ime='".$obj->k_ime[$i]."'";
	$sifra = "sifra='".$obj->sifra[$i]."'";
	$ime = "ime='".$obj->ime[$i]."'";
	$prezime = "prezime='".$obj->prezime[$i]."'";
	$email = "email='".$obj->email[$i]."'";
	$JMBG = "JMBG='".$obj->jmbg[$i]."'";

	$sqlx .= "(".$k_ime." AND ".$sifra." AND ".$ime." AND ".$prezime." AND ".$email." AND ".$JMBG.")";
	
	if($i<$len-1 && $len>1){
		$sqlx .= " OR ";
	}
	
}

$str = "";

if(substr($sqlx,strlen($sqlx)-1,strlen($sqlx))==")"){
	
	$kon = new SimpleDB($servername, $username, $password, $dbname);

	$result=$kon->execute($sqlx);
	$rowLen = $result->num_rows;

	if ($result->num_rows > 0) {
					
		while($row = $result->fetch_assoc()){
			
			$str .= $row["id"].",";
		}
	}
	
}

$sql1 = "";
	
if(substr($str,strlen($str)-1,strlen($str))===","){
	$str = substr($str,0,strlen($str)-1);
}

if($str != ""){
	
	$sql1 = "DELETE FROM radnik WHERE id IN (".$str.")";
	$kon1 = new SimpleDB($servername, $username, $password, $dbname);
	$result1=$kon1->execute($sql1);	
	echo "</br>tttt: ".$sql1."</br>";
	
}

?>