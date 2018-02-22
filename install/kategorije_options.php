<?php 
	require_once('../funkcije.php');

	$kon = new SimpleDB("localhost", "root", "", "firma"); 
	$sql="SELECT id,kategorija FROM tel_kategorija"; 
	$result = $kon->execute($sql);

	
	if ($result->num_rows > 0) {
		// output data of each row
		echo "<div class='form-group col-sm-3'><label for='sel4'>Kategorija</label><select id='sel' class='form-control' name='sel'>";
		echo "<option value=''>"."</option>";
		while($row = $result->fetch_assoc()) {
		echo "<option value='".$row['id']."'>".$row['kategorija']."</option>";
		}
	} 
	echo "</select></div>";
	
?>