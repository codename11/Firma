<form id="F3">
					<!--<form id="F3" method="get" action="adminV2.php">-->

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
							<!--<button type="submit">send</button>-->
					</form>