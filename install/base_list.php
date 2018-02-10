<?php 

// Usage without mysql_list_dbs()
$link = mysql_connect('127.0.0.1', 'root', '');
$res = mysql_query("SHOW DATABASES");


	echo "<div class='form-group'>
				<label for='sel1'>Izaberi bazu:</label>
				<select class='form-control' id='sel' name='baza' required>
					<option>Spisak baza:</option>";
				
	while ($row = mysql_fetch_assoc($res)) {
		echo "<option>".$row['Database']."</option>";
	}
	
	echo "</select>
		</div>";

				
			

?>