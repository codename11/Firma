<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";


// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Neuspešna konekcija sa serverom: " . $conn->connect_error);
}
else{
	
	echo "Uspešna konekcija sa serverom.<br>";
	
}

// Create database
$sql = "CREATE DATABASE firma";
if ($conn->query($sql) === TRUE) {
    echo "Uspesno napravljena baza";
} else {
    echo "Neuspešno napravljena baza: " . $conn->error;
}

$conn->close();
?>