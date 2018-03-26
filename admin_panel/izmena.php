<?php 
session_start();
require "../header.php";

if($_SESSION["confirm"]==true){
	echo "Trenutno ulogovani korisnik: ".$_SESSION["username"];
}
else{
	header('Location: /www/knjigovodstvo/index.php');
}
$_SESSION["increment"] = 0;
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
						<select id="sel" class="form-control" name="sel" onchange="serialization('izvestaj.php',F2,false,'raport')">";
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
				<input type="number" class="form-control" id="jmbg" maxlength="14" placeholder="Unesi jmbg:" name="jmbg" value="" required>
			</div>
					
			<div class="form-group col-sm-2">
				<label>Sortiraj po:</label>
				<select class="form-control" id="sort1" name='sort1' onchange="serialization('izvestaj.php',F2,false,'raport')">
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
				<select class="form-control" id="sort2" name='sort2' onchange="serialization('izvestaj.php',F2,false,'raport')">
					<option value=""></option>
					<option value="2">2</option>
					<option value="5">5</option>
					<option value="10">10</option>
					<option value="25">25</option>
					<option value="50">50</option>
					
				</select>
			</div>
				
			
		</div>
			<!--<button type="button" style="margin-top: 10px" class="btn btn-default" onclick="serialization('izvestaj.php',this)">Pošalji</button>-->
			
			
		</form>
		<button type="button" class="btn btn-default" onclick="serialization('izvestaj.php',F2,false,'raport')">Pošalji</button>
		<div class="row">
			<div id="raport" class="col-xs-12" style="margin-top: 1%;">
				
			</div>
		</div>
		<div class="row">
			<div id="dmx" class="col-xs-12" style="margin-top: 1%;">
				
			</div>
		</div>
</div>

<div class="container-fluid text-center" style="font-family:Palatino Linotype;">
	<!-- Modal -->
	<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Update/Izmena</h4>
			</div>
			<div class="modal-body">
				
					<!--<form id="F3">-->
					<form id="F3" method="get" action="adminV2.php">

						<div class="row">

							<div class="form-group col-sm-3">
								<label for="k_ime">Korisničko ime:</label>
								<input type="text" class="form-control" id="k_ime1" maxlength="30" placeholder="Unesi korisničko ime:" name="k_ime1" value="" required>
							</div>
								
							<div class="form-group col-sm-3">
								<label for="pwd">Šifra:</label>
								<input type="password" class="form-control" id="pwd1" maxlength="30" placeholder="Unesi željenu šifru" name="pwd1" value="" required>
							</div>

							<div class="form-group col-sm-3">
								<label for="ime">Ime:</label>
								<input type="text" class="form-control" id="ime1" maxlength="30" placeholder="Unesi ime:" name="ime1" value="" required>
							</div>
								
							<div class="form-group col-sm-3">
								<label for="prezime">Prezime:</label>
								<input type="text" class="form-control" id="prezime1" maxlength="30" placeholder="Unesi prezime:" name="prezime1" value="" required>
							</div>
						</div>
						<div class="row">	
							<div class="form-group col-sm-3">
								<label for="email">Email:</label>
								<input type="email" class="form-control" id="email1" maxlength="30" placeholder="Unesi email:" name="email1" value="" required>
							</div>

							<div class="form-group col-sm-3">
								<label for="tel">Telefon:</label>
								<input type="number" class="form-control" id="tel1" maxlength="10" placeholder="Unesi telefon:" name="tel1" value="" required>
							</div>
							
							<?php 

									$pathTo_file = "/xampp/htdocs/www/knjigovodstvo/install/config.ini";
									$myfile = fopen($pathTo_file, "r+") or die("Unable to open file!");
									$tekst = fread($myfile,filesize($pathTo_file));
									fclose($myfile);

									$arr = explode(",",$tekst);

									$servername = $arr[0];
									$username = $arr[1];
									$password = $arr[2];
									$dbname = $arr[3];

									$kon = new SimpleDB($servername, $username, $password, $dbname); 
									$sql="SELECT id,kategorija FROM tel_kategorija"; 
									$result = $kon->execute($sql);

									
									if ($result->num_rows > 0) {
										// output data of each row
										echo "<div class='form-group col-sm-3'><label for='sel4'>Kategorija</label><select id='sel1' class='form-control' name='sel1'>";
										echo "<option value=''>"."</option>";
										while($row = $result->fetch_assoc()) {
										echo "<option value='".$row['id']."'>".$row['kategorija']."</option>";
										}
									} 
									echo "</select></div>";
					
							?>
							
							
							
							<div class="form-group col-sm-3">
								<label for="jmbg">JMBG:</label>
								<input type="number" class="form-control" id="jmbg1" maxlength="14" placeholder="Unesi jmbg:" name="jmbg1" value="" required>
							</div>

						</div>
						
						<div class="row form-group">
						
							<div class="dropdown col-sm-3">
								<button type="button" id="btn2" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									<span>Moduli</span>
									<span class="caret" id="caret1"></span>
								</button>
								<ul id="comp" class="dropdown-menu">
								  <li><a class="dropdown-item"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="adminmodul" id="adminmodul" value="x1"> Admin modul</label></div></a></li>
								  <li><a class="dropdown-item"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="ksluzba" id="ksluzba" value="x2"> Kadrovska služba</label></div></a></li>
								  <li><a class="dropdown-item"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="esalter" id="esalter" value="x3"> E-šalter</label></div></a></li>
								  <li><a class="dropdown-item"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="evidencijaio" id="evidencijaio" value="x4"> Evidencija ulaza/izlaza</label></div></a></li>
								  <li><a class="dropdown-item"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="mposlovanje" id="mposlovanje" value="x5"> Materijalno poslovanje</label></div></a></li>
								  <li><a class="dropdown-item"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="emagacin" id="emagacin" value="x6"> E-magacin</label></div></a></li>
								  <li><a class="dropdown-item"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="blagajna" id="blagajna" value="x7"> Blagajna</label></div></a></li>
								  <li><a class="dropdown-item"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="mehanizacija" id="mehanizacija" value="x8"> Mehanizacija</label></div></a></li>
								  <li><a class="dropdown-item"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="ekancelarija" id="ekancelarija" value="x9"> E-kancelarija</label></div></a></li>
								</ul>
							</div>
							
							<div class="col-sm-3">
								
									<label><input type="radio" name="optradio" value="admin" checked>Admin</label>
								
								
									<label><input type="radio" name="optradio" value="user">User</label>
								
							</div>
						
						</div>
<button type="submit">send</button>
					</form>	
					<!--<button type="button" id="submit" style="margin-top: 10px" name="submit" class="btn btn-default" data-dismiss="modal" onclick="serialization('/www/knjigovodstvo/admin_panel/adminV2.php',F3,false,'raport')">Izmeni</button>-->
			
			</div>
        <div class="modal-footer">  
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      </div>
    </div>
</div>

</body>
</html>