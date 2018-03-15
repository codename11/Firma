<div class="container">
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

          <div class="container-fluid text-center" style="font-family:Palatino Linotype;">
	<form id="F3">

		
		
		<div class="row">

			<div class="form-group col-sm-3">
				<label for="k_ime">Korisničko ime:</label>
				<input type="text" class="form-control" id="k_imex" maxlength="30" placeholder="Unesi korisničko ime:" name="k_ime" value="" required>
			</div>
				
			<div class="form-group col-sm-3">
				<label for="pwd">Šifra:</label>
				<input type="password" class="form-control" id="pwdx" maxlength="30" placeholder="Unesi željenu šifru" name="pwd" value="" required>
			</div>

			<div class="form-group col-sm-3">
				<label for="ime">Ime:</label>
				<input type="text" class="form-control" id="imex" maxlength="30" placeholder="Unesi ime:" name="ime" value="" required>
			</div>
				
			<div class="form-group col-sm-3">
				<label for="prezime">Prezime:</label>
				<input type="text" class="form-control" id="prezimex" maxlength="30" placeholder="Unesi prezime:" name="prezime" value="" required>
			</div>
		</div>
		<div class="row">	
			<div class="form-group col-sm-3">
				<label for="email">Email:</label>
				<input type="email" class="form-control" id="emailx" maxlength="30" placeholder="Unesi email:" name="email" value="" required>
			</div>

			<div class="form-group col-sm-3">
				<label for="tel">Telefon:</label>
				<input type="number" class="form-control" id="telx" maxlength="10" placeholder="Unesi telefon:" name="tel" value="" required>
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
						echo "<div class='form-group col-sm-3'><label for='sel4'>Kategorija</label><select id='selx' class='form-control' name='selx'>";
						echo "<option value=''>"."</option>";
						while($row = $result->fetch_assoc()) {
						echo "<option value='".$row['id']."'>".$row['kategorija']."</option>";
						}
					} 
					echo "</select></div>";
	
			?>
			
			
			
			<div class="form-group col-sm-3">
				<label for="jmbg">JMBG:</label>
				<input type="number" class="form-control" id="jmbgx" maxlength="14" placeholder="Unesi jmbg:" name="jmbg" value="" required>
			</div>

		</div>
		
		<div class="row">
		
			<div class="dropdown col-sm-3">
				<button type="button" id="btn2" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					<span>Moduli</span>
					<span class="caret" id="caret1"></span>
				</button>
				<ul id="comp" class="dropdown-menu">
				  <li><a class="dropdown-item"><input type="checkbox" name="adminmodul" value="x"> Admin modul</a></li>
				  <li><a class="dropdown-item"><input type="checkbox" name="ksluzba" value="x"> Kadrovska služba</a></li>
				  <li><a class="dropdown-item"><input type="checkbox" name="esalter" value="x"> E-šalter</a></li>
				  <li><a class="dropdown-item"><input type="checkbox" name="evidencijaio" value="x"> Evidencija ulaza/izlaza</a></li>
				  <li><a class="dropdown-item"><input type="checkbox" name="mposlovanje" value="x"> Materijalno poslovanje</a></li>
				  <li><a class="dropdown-item"><input type="checkbox" name="emagacin" value="x"> E-magacin</a></li>
				  <li><a class="dropdown-item"><input type="checkbox" name="blagajna" value="x"> Blagajna</a></li>
				  <li><a class="dropdown-item"><input type="checkbox" name="mehanizacija" value="x"> Mehanizacija</a></li>
				  <li><a class="dropdown-item"><input type="checkbox" name="ekancelarija" value="x"> E-kancelarija</a></li>
				</ul>
			</div>
		
		</div>
		
		<button type="button" id="submit" style="margin-top: 10px" name="submit" class="btn btn-default" data-dismiss="modal" onclick="serialization('adminV2.php',this)">Izmeni</button>	
	</form>
		
</div>
		  
        </div>
        <div class="modal-footer">  
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      </div>
    </div>
</div>