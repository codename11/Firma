<?php
require "../funkcije.php";

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Firma</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Instalacija</h2>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="dform">
  
	<div class="form-group">
      <label for="ipadresa">IP adresa:</label>
      <input type="text" class="form-control" id="ipadresa" placeholder="Unesi IP adresu" name="ipadresa" required>
    </div>
	
	<div class="form-group">
      <label for="base">Korisničko ime baze:</label>
      <input type="text" class="form-control" id="base" placeholder="Unesi ime za bazu" name="base" required>
    </div>
	
	<div class="form-group">
      <label for="pwd">Šifra za bazu:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Unesi šifru" name="pwd">
    </div>
	<?php include "base_list.php"; ?>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
  
</div>

</body>
</html>



<?php
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
		Admin_modul VARCHAR(5) NOT NULL,
		Kadrovska_služba VARCHAR(5) NOT NULL,
		E_šalter VARCHAR(5) NOT NULL,
		Evidencija_ulaza_izlaza VARCHAR(5) NOT NULL,
		Materijalno_poslovanje VARCHAR(5) NOT NULL,
		E_magacin VARCHAR(5) NOT NULL,
		Blagajna VARCHAR(5) NOT NULL,
		Mehanizacija VARCHAR(5) NOT NULL,
		E_kancelarija VARCHAR(5) NOT NULL,
		radnik_FK INT(10) UNSIGNED,
		FOREIGN KEY (radnik_FK) REFERENCES radnik(id) ON UPDATE CASCADE ON DELETE CASCADE
		)";//Prvo se kreira polje u tabeli, pa se tek onda veže da bude foreign key.
		
		
		$sql = $sql1.";".$sql2.";".$sql3.";".$sql4.";".$sql5.";".$sql6.";".$sql7;

		multi_pristup($servername, $username, $password, $dbname, $sql);	
		header("location: prvi_admin.php");
}

?>
