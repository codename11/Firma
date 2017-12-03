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
$sql = "CREATE TABLE tel_kategorija (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
kategorija VARCHAR(7) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Uspešno kreirana tabela";
} else {
    echo "Neuspešno kreirana tabela: " . $conn->error;
}

$conn->close();
?>


