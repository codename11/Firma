<?php

include '../funkcije.php';
session_start();

$kon = new SimpleDB("localhost", "root", "", "firma"); 

$sql = "SELECT korisnicko_ime, sifra FROM korisnik";

$result = $kon->execute($sql);
$num = 0;

	while($row = $result->fetch_assoc()){
		$num++;
		if(($_SESSION["username"] != $row["korisnicko_ime"]) && (md5($_SESSION["pwd"]) != $row["sifra"])){
			
			header( "Location: ../index.php" );
		}

	}

?>