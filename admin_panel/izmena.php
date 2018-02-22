<?php 
session_start();
require "../header.php";
require "adm.php";
?>


	<div class="container" id="kont" class="kont">
	<?php require "subnav.php"; ?>

		<form id="F2" class="vcenter" autocomplete="on">

			<div class="row">

				<div class="form-group col-sm-2">
					<label for="k_ime" style="line-height: 93.5%;">Korisničko ime:</label>
					<input type="text" class="form-control" id="k_ime" maxlength="30" placeholder="Unesi korisničko ime:" name="k_ime" value="" required>
				</div>
				
				<div class="form-group col-sm-2">
					<label for="pwd">Šifra:</label>
					<input type="password" class="form-control" id="pwd" maxlength="30" placeholder="Unesi željenu šifru" name="pwd" value="" required>
				</div>

				<div class="form-group col-sm-3">
					<label for="ime">Ime:</label>
					<input type="text" class="form-control" id="ime" maxlength="30" placeholder="Unesi ime:" name="ime" value="" required>
				</div>
				
				<div class="form-group col-sm-3">
					<label for="prezime">Prezime:</label>
					<input type="text" class="form-control" id="prezime" maxlength="30" placeholder="Unesi prezime:" name="prezime" value="" required>
				</div>
				
				<div class="form-group col-sm-2">
					<label for="email">Email:</label>
					<input type="email" class="form-control" id="email" maxlength="30" placeholder="Unesi email:" name="email" value="" required>
				</div>
			</div>
			
		<div class="row">
			<div class="form-group col-sm-3">
				<label for="tel">Telefon:</label>
				<input type="number" class="form-control" id="tel" maxlength="10" placeholder="Unesi telefon:" name="tel" value="" required>
			</div>
			
			<?php require "/xampp/htdocs/www/knjigovodstvo/install/kategorije_options.php"; ?>
			
			<div class="form-group col-sm-3">
				<label for="jmbg">JMBG:</label>
				<input type="number" class="form-control" id="jmbg" maxlength="14" placeholder="Unesi jmbg:" name="jmbg" value="" required>
			</div>
					
			<div class="form-group col-sm-3">
				<label>Sortiraj po:</label>
				<select class="form-control" id="sort" name='sort'>
					<option value=""></option>
					<option value="1">ime rastuće</option>
					<option value="2">ime opadajuće</option>
					<option value="3">prezime rastuće</option>
					<option value="4">prezime opadajuće</option>
					<option value="5">broj rastuće</option>
					<option value="6">broj opadajuće</option>
				</select>
			</div>
				
			
		</div>
			<button type="button" style="margin-top: 10px" class="btn btn-default" onclick="uzim_vred('izvestaj.php',this)">Pošalji</button>
			
			
		</form>
		<div id="raport" style="margin-top: 1%;">
			
			</div>
			</div>

<?php 
	include "../modal1.php";

?>

