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
$sql = "CREATE TABLE radnik (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
ime VARCHAR(30) NOT NULL,
prezime VARCHAR(30) NOT NULL,
email VARCHAR(255) NOT NULL,
JMBG  VARCHAR(13) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Uspešno kreirana tabela";
} else {
    echo "Neuspešno kreirana tabela: " . $conn->error;
}

$conn->close();
?>


