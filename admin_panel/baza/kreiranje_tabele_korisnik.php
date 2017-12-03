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
$sql = "CREATE TABLE korisnik (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
korisnicko_ime VARCHAR(30) NOT NULL,
sifra VARCHAR(30) NOT NULL,
radnik_FK INT(1) UNSIGNED,
FOREIGN KEY (radnik_FK) REFERENCES radnik(id) ON UPDATE CASCADE ON DELETE CASCADE
)";

if ($conn->query($sql) === TRUE) {
    echo "Uspešno kreirana tabela";
} else {
    echo "Neuspešno kreirana tabela: " . $conn->error;
}

$conn->close();
?>
