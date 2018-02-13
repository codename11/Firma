<?php

include '../funkcije.php';
session_start();

$kon = new SimpleDB("localhost", "root", "", "firma"); 
$Admin_modul='x';
$sql = "SELECT korisnicko_ime, sifra FROM korisnik, moduli WHERE korisnik.id=moduli.radnik_FK AND moduli.Admin_modul='$Admin_modul'";

$result = $kon->execute($sql);
$num = 0;

	while($row = $result->fetch_assoc()){
		$num++;
		if(($_POST["username"] != $row["korisnicko_ime"]) && (md5($_POST["pwd"]) != $row["sifra"]) && $Admin_modul != 'x'){
			
			header( "Location: ../index.php" );
		}
		else{
			header( "Location: admin.php" );
		}

	}

?>