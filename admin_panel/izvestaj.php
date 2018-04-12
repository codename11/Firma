<?php

require '../funkcije.php';
session_start();

$form_var = array();
if(isset($_GET)){
	
	
	foreach ($_GET as $value) { 
	
		$obj1 = new Validation($value);
		$form_var[] = $obj1 -> test_input($obj1 -> getData());
	
	}
}

/*Sadrzaj:
$form_var[0]== Korisničko ime;
$form_var[1]== Šifra;
$form_var[2]== Ime;
$form_var[3]== Prezime;
$form_var[4]== Email;
$form_var[5]== Telefon;
$form_var[6]== Kategorija;
$form_var[7]== JMBG;
$form_var[8]== Sortiraj po;
$form_var[9]== Prikazati po stranici/limit;
$form_var[10]== offset;
*/
$len = count($form_var);

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

$sql1 = "SELECT radnik.id, k_ime, radnik.sifra, korisnik.sifra, ime, prezime, email, broj, kategorija, JMBG,tel_kategorija.id AS katid, nivo, Admin_modul,Kadrovska_sluzba, E_salter, Evidencija_ulaza_izlaza, Materijalno_poslovanje, E_magacin, Blagajna, Mehanizacija, E_kancelarija
FROM korisnik, radnik, tel_broj, tel_kategorija, moduli  
WHERE radnik.id=korisnik.radnik_FK AND radnik.id=tel_broj.radnik_FK
AND korisnicko_ime LIKE '$form_var[0]%' AND k_ime LIKE '$form_var[0]%' AND korisnicko_ime=k_ime 
AND ime LIKE '$form_var[2]%' AND prezime LIKE '$form_var[3]%' AND email LIKE '$form_var[4]%' 
AND broj LIKE '$form_var[5]%' AND tel_kategorija.id LIKE '$form_var[6]%' AND tel_kategorija.id=tel_broj.kategorija_FK 
AND tel_broj.kategorija_FK LIKE '$form_var[6]%' AND JMBG LIKE '$form_var[7]%' AND radnik.id=moduli.radnik_FK
";

$sql2=" ORDER BY ime ASC";
$sql3=" ORDER BY ime DESC";
$sql4=" ORDER BY prezime ASC";
$sql5=" ORDER BY prezime DESC";
$sql6=" ORDER BY broj ASC";
$sql7=" ORDER BY broj DESC";
$sql8=" ORDER BY JMBG ASC";
$sql9=" ORDER BY JMBG DESC";
$sql10=" ORDER BY tel_kategorija.id ASC";
$sql11=" ORDER BY tel_kategorija.id DESC";

switch ($form_var[8]) {
	
    case '1':
        $sql1.=$sql2;
        break;
    case '2':
        $sql1.=$sql3;
        break;
    case '3':
        $sql1.=$sql4;
        break;
	case '4':
        $sql1.=$sql5;
        break;
    case '5':
        $sql1.=$sql6;
        break;
    case '6':
        $sql1.=$sql7;
        break;
	case '7':
        $sql1.=$sql8;
        break;
	case '8':
        $sql1.=$sql9;
        break;
	case '9':
        $sql1.=$sql10;
        break;
	case '10':
        $sql1.=$sql11;
        break;
    default:
        $sql1.=$sql2;
		$alt_sql = $sql1;
}
$alt_sql = $sql1;

if(!(isset($form_var[10])) && empty($form_var[10])){//offset, klik, page number.
	
	$form_var[10]="";
	$offset = 0;
}

$konx = new SimpleDB($servername, $username, $password, $dbname);//Make connection
$row_cnt="SELECT COUNT(id) FROM tel_broj GROUP BY id";//Query to find out number of total ALL rows.
$row_count = $konx->execute($row_cnt)->num_rows;//Number of ALL rows.
$numOfRows = $konx->execute($sql1)->num_rows;//Number of records per page

if(isset($form_var[10])){/*Determine if eleventh array member is set. And if, what kind value contains.
	If it's no numeric value, then we increment for +1 whenever this script is called. 
	If it's numeric, then we initialize variable session-increment with said value.
	Value by which we initialize or increment is contained as id 
	of an element who envokes it by asinchronuos call(AJAX)*/
	if($form_var[10]== "prev"){
	
		$_SESSION["increment"]--;//If button with id="prev" is pressed, decrease counter.
	
	}

	if($form_var[10]== "next"){
		
		$_SESSION["increment"]++;//If button with id="next" is pressed, increase counter.
		
	}
	
	if(isset($form_var[10][3])){//If numbered buttons are pressed.
		
		if(is_numeric($form_var[10][3])===true){//Setting increment, thus now we are able to calculate offset from page number.

			$_SESSION["increment"] = $form_var[10][3];

		}
		
	}
	
}

$limit = $form_var[9];//Calculate limit.
$offset = ($form_var[9]*$_SESSION["increment"]);//Calculate offset.
$current_page = $_SESSION["increment"]+1;//Number of current page.

if($limit == 0){//If limit ..er $form_var[9] is not set
		
		$_SESSION["increment"]=0;
		$limit = 0;
		$total_pages = 1;
		$current_page = 1;
}
else{
	
	$total_pages = ceil($row_count/$limit); //Calculate pages total.
}

if($offset<0){
	
	$_SESSION["increment"] = floor($row_count/$form_var[9]);
	$offset = (floor($row_count/$form_var[9])*$form_var[9]);
	$current_page = $total_pages;
	
}

if($offset>=$row_count){
	
	$_SESSION["increment"]=0;
	$offset = 0;
	$current_page = 1;
	
}

if($offset>=$numOfRows){
	
	$_SESSION["increment"]=0;
	$offset = 0;
	$current_page = 1;
	$total_pages = $numOfRows;
	
}

if($form_var[9]>$row_count){
	$_SESSION["increment"]=0;
	$offset = 0;
	$current_page = 1;
	$total_pages = 1;
}

if($form_var[9]>$numOfRows){
	$current_page = 1;
	$total_pages = 1;
}

$sql1 = $sql1." LIMIT ".$limit." OFFSET ".$offset;

if($form_var[9]==="" && isset($form_var[9]) && empty($form_var[9])){

	$sql1 = $alt_sql;
}

$result = $kon->execute($sql1);

if(($result->num_rows)<=0){
	$current_page = 0;
	$total_pages = 0;
}

if($_SESSION["rec_num"]>=$row_count || $_SESSION["increment"] == 0){
	$_SESSION["rec_num"] = 0;
}

if($form_var[9] == ""){
	
	$_SESSION["rec_num"] = 0;
	
}

if($form_var[9] != ""){
	
	if($_SESSION["increment"] != ($_SESSION["rec_num"]/$form_var[9])){
	
		$_SESSION["rec_num"] = ($_SESSION["increment"]*$form_var[9]);
	
	}
	
}

echo "Strana ".$current_page." od ".$total_pages."</br>";

$rejl1 = "<div class='podaci table-responsive'>
	<table id='tabela' class='table table-hover table-bordered table-sm' style='background-color: black'>
		<thead>
			<tr>
				<th class='text-center'>Redni broj</th>
				<th class='text-center'>Korisničko ime</th>
				<th class='text-center'>Šifra</th>
				<th class='text-center'>Ime</th>
				<th class='text-center'>Prezime</th>
				<th class='text-center'>Email</th>
				<th class='text-center'>Telefon</th>
				<th class='text-center'>Kategorija</th>
				<th class='text-center' colspan='2'>JMBG</th>
			</tr>
		</thead>
		";

$rejl2 = "<tbody>";
$br1=0;	
	
if($result->num_rows > 0){
	echo $rejl1;
	echo $rejl2;
	
	while($row = $result->fetch_assoc()) {
		
		$br1++;
		
		if(isset($_SESSION["rec_num"]) && $_SESSION["rec_num"]>$br1){
			$br1 = ($_SESSION["rec_num"]+1);
		}
		
		
?>
		<tr>
			<td style=""><?php echo $br1; ?>. <input type="checkbox" class="form-check-input bx" value=""><?php $_SESSION["id"]=$row["id"]; ?></td><td style="border-left: none; border-top: none;"><?php echo $row["k_ime"]; ?></td><td><?php echo $row["sifra"]; ?></td><td><?php echo $row["ime"]; ?></td><td><?php echo $row["prezime"]; ?></td><td><?php echo $row["email"]; ?></td><td><?php echo $row["broj"]; ?></td><td><?php echo $row["kategorija"]; ?></td><td style="border-right: none;"><?php echo $row["JMBG"]; ?></td><td style="border-left: none; border-top: none;"><button type="button"  data-toggle="modal" data-target="#myModal1" onclick="serializeTrow('modalQuery.php',this)">Update</button></td>
		</tr>
<?php
		
		if(($br1+1)>$_SESSION["rec_num"]){
			$_SESSION["rec_num"] = $br1;
		}
		
	}
	echo "</tbody></table></div>";
	echo "";
}
else{
	echo "<p class='podaci'>Nema takvog korisnika u bazi!</p>";
}

?>
</br><button type='button' id='del1' class='btn btn-danger' onclick="delRec('delRec.php',tabela,this);">Delete/Izbriši</button></br>

<ul class="pagination">
	<li class="page-item"><a class="page-link" id="prev" href="#" onclick='pagination(this);'>Prev</a></li>
	
	<?php
	
	$i=0;
	
		while($i<$total_pages){
			
			if(($i+1>=$current_page-1 && $i+1<=$current_page) || ($i+1<=$current_page+1 && $i+1>=$current_page)){
			
				if(($i+1)==$current_page){

	?>
				<li class="page-item active"><a id="num<?php echo $i; ?>" class="page-link" href="#"  onclick='pagination(this);'><?php echo ($i+1); ?></a></li>
	<?php	
				}
				else{
	?>
				
					<li class="page-item"><a id="num<?php echo $i; ?>" class="page-link" href="#"  onclick='pagination(this);'><?php echo ($i+1); ?></a></li>
			
		<?php
				}
			}
			$i++;

		}

	?>	
  
	<li class="page-item"><a class="page-link" id="next" href="#" onclick='pagination(this);'>Next</a></li>

</ul>