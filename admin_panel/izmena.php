<?php 
session_start();
require "../header.php";

if($_SESSION["confirm"]==true){
	echo "Trenutno ulogovani korisnik: ".$_SESSION["username"];
}
else{
	header('Location: /www/knjigovodstvo/index.php');
}

?>

<div class="container" id="kont" class="kont">
	<?php require "subnav.php"; ?>

		<form id="F2" class="vcenter" autocomplete="on">

			<div class="row">

				<div class="form-group col-sm-2">
					<label for="k_ime" style="line-height: 93.5%;">Korisničko ime:</label>
					<input type="text" class="form-control" id="k_ime" onkeydown="serialization('izvestaj.php',this)" maxlength="30" placeholder="Unesi korisničko ime:" name="k_ime" value="" required>
				</div>
				
				<div class="form-group col-sm-2">
					<label for="pwd">Šifra:</label>
					<input type="password" onkeydown="serialization('izvestaj.php',this)" class="form-control" id="pwd" maxlength="30" placeholder="Unesi željenu šifru" name="pwd" value="" required>
				</div>

				<div class="form-group col-sm-3">
					<label for="ime">Ime:</label>
					<input type="text" onkeydown="serialization('izvestaj.php',this)" class="form-control" id="ime" maxlength="30" placeholder="Unesi ime:" name="ime" value="" required>
				</div>
				
				<div class="form-group col-sm-3">
					<label for="prezime">Prezime:</label>
					<input type="text" onkeydown="serialization('izvestaj.php',this)" class="form-control" id="prezime" maxlength="30" placeholder="Unesi prezime:" name="prezime" value="" required>
				</div>
				
				<div class="form-group col-sm-2">
					<label for="email">Email:</label>
					<input type="email" onkeydown="serialization('izvestaj.php',this)" class="form-control" id="email" maxlength="30" placeholder="Unesi email:" name="email" value="" required>
				</div>
			</div>
			
		<div class="row">
			<div class="form-group col-sm-3">
				<label for="tel">Telefon:</label>
				<input type="number" onkeydown="serialization('izvestaj.php',this)" class="form-control" id="tel" maxlength="10" placeholder="Unesi telefon:" name="tel" value="" required>
			</div>
			
			<?php 
			
				require_once('../funkcije.php');

				$konr = new SimpleDB("localhost", "root", "", "firma"); 
				$sqlr="SELECT id,kategorija FROM tel_kategorija"; 
				$resultr = $konr->execute($sqlr);

				
				if ($resultr->num_rows > 0) {
					// output data of each row
					echo "<div class='form-group col-sm-3'>
						<label for='sel4'>Kategorija</label>"
			?>
						<select id="sel" class="form-control" name="sel" onchange="serialization('izvestaj.php',this)">";
			<?php
					
						echo "<option value=''>"."</option>";
					
						while($row = $resultr->fetch_assoc()) {
							
						echo "<option value='".$row['id']."'>".$row['kategorija']."</option>";
						
						}
				} 
				echo "</select></div>";
			
			?>
			
			<div class="form-group col-sm-2">
				<label for="jmbg">JMBG:</label>
				<input type="number" onkeydown="serialization('izvestaj.php',this)" class="form-control" id="jmbg" maxlength="14" placeholder="Unesi jmbg:" name="jmbg" value="" required>
			</div>
					
			<div class="form-group col-sm-2">
				<label>Sortiraj po:</label>
				<select class="form-control" id="sort1" name='sort1' onchange="serialization('izvestaj.php',this)">
					<option value=""></option>
					<option value="1">ime rastuće</option>
					<option value="2">ime opadajuće</option>
					<option value="3">prezime rastuće</option>
					<option value="4">prezime opadajuće</option>
					<option value="5">broj rastuće</option>
					<option value="6">broj opadajuće</option>
					<option value="7">JMBG rastuće</option>
					<option value="8">JMBG opadajuće</option>
					<option value="9">kategorija rastuće</option>
					<option value="10">kategorija opadajuće</option>
				</select>
			</div>
			
			<div class="form-group col-sm-2">
				<label style="line-height: 93.5%;">Prikazati po stranici: </label>
				<select class="form-control" id="sort2" name='sort2' onchange="serialization('izvestaj.php',this)">
					<option value=""></option>
					<option value="2">2</option>
					<option value="5">5</option>
					<option value="10">10</option>
					<option value="25">25</option>
					<option value="50">50</option>
					
				</select>
			</div>
				
			
		</div>
			<button type="button" style="margin-top: 10px" class="btn btn-default" onclick="serialization('izvestaj.php',this)">Pošalji</button>
			
			
		</form>
		<div class="row">
			<div id="raport" class="col-xs-12" style="margin-top: 1%;">
				
			</div>
		</div>
		<div class="row">
			<div id="dmx" class="col-xs-12" style="margin-top: 1%;">
				
			</div>
		</div>
</div>
<script>
</script>
<?php 
	include "../modal1.php";

?>

