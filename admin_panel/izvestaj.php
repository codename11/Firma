<?php

require '../funkcije.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "firma";

$kon = new SimpleDB($servername, $username, $password, $dbname);

$row_cnt="SELECT COUNT(id) FROM radnik GROUP BY id";
$br = $kon->execute($row_cnt)->num_rows;

$sql="SELECT radnik.id, k_ime, ime, prezime, email, JMBG, broj FROM radnik, korisnik, tel_broj WHERE radnik.id=korisnik.radnik_FK AND radnik.id=tel_broj.radnik_FK AND tel_broj.radnik_FK=korisnik.radnik_FK";

$result = $kon->execute($sql);

$rejl1 = "<div class='podaci'>
	<table id='tabela' class='table table-hover table-bordered'>
		<thead>
			<tr>
				<th class='text-center'>Korisničko ime</th>
				<th class='text-center'>Ime</th>
				<th class='text-center'>Prezime</th>
				<th class='text-center'>Email</th>
				<th class='text-center'>JMBG</th>
				<th class='text-center'>Telefonski broj</th>
			</tr>
		</thead>
		";

		$rejl2 = "<tbody>";

		$br1=0;
		
		echo $rejl1;
			if ($result->num_rows > 0) {
				echo $rejl2;
	
				while($row = $result->fetch_assoc()) {
		
					$br=$row["id"];
					$br1++;
		
	
	
?>

					<tr>
						<td><?php echo $row["k_ime"] ?></td>
						<td><?php echo $row["ime"] ?></td>
						<td><?php echo $row["prezime"] ?></td>
						<td><?php echo $row["email"] ?></td>
						<td><?php echo $row["JMBG"] ?></td>
						<td><?php echo $row["broj"] ?></td>
					</tr>
	
<?php 
	}
	echo "</tbody>";
	}
	echo "</table></div>";
		
		
?>