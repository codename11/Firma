<?php 
	include '../funkcije.php';
	$servername="localhost"; //ime/adresa/url servera
	$username="root"; // ime korisnika koji pristupa serveru
	$password=""; // pass za server
	$dbname="firma"; // ime bazu u kojoj se vrsi upit
	$sql="SELECT id,kategorija FROM tel_kategorija"; 
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 


	$result = pristup($servername, $username, $password, $dbname, $sql);

	if ($result->num_rows > 0) {
		// output data of each row
		echo "<div class='col-sm-2'><label for='sel4'>Kategorija</label><select id='sel' class='form-control' name='sel'>";
		echo "<option value=''>"."</option>";
		while($row = $result->fetch_assoc()) {
		echo "<option value='".$row['id']."'>".$row['kategorija']."</option>";
		}
	} 
	echo "</select></div>";
	$conn->close();
?>