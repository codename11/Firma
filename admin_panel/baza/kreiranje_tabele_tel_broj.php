<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "firma";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE tel_broj (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
broj VARCHAR(10) NOT NULL,
kategorija_FK INT(1) UNSIGNED,
FOREIGN KEY (kategorija_FK) REFERENCES tel_kategorija(id) ON UPDATE CASCADE ON DELETE CASCADE,
radnik_FK INT(1) UNSIGNED,
FOREIGN KEY (radnik_FK) REFERENCES radnik(id) ON UPDATE CASCADE ON DELETE CASCADE
)";//Prvo se kreira polje u tabeli, pa se tek onda veze da bude foreign key.

if ($conn->query($sql) === TRUE) {
    echo "Uspešno kreirana tabela";
} else {
    echo "Neuspešno kreirana tabela: " . $conn->error;
}

$conn->close();
?>


