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
$form_var[9]== Prikazati po stranici;
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

$sql1 = "SELECT radnik.id, k_ime, radnik.sifra, korisnik.sifra, ime, prezime, email, broj, kategorija, JMBG,tel_kategorija.id AS katid
FROM korisnik, radnik, tel_broj, tel_kategorija  
WHERE radnik.id=korisnik.radnik_FK AND radnik.id=tel_broj.radnik_FK
AND korisnicko_ime LIKE '$form_var[0]%' AND k_ime LIKE '$form_var[0]%' AND korisnicko_ime=k_ime 
AND ime LIKE '$form_var[2]%' AND prezime LIKE '$form_var[3]%' AND email LIKE '$form_var[4]%' 
AND broj LIKE '$form_var[5]%' AND tel_kategorija.id LIKE '$form_var[6]%' AND tel_kategorija.id=tel_broj.kategorija_FK 
AND tel_broj.kategorija_FK LIKE '$form_var[6]%' AND JMBG LIKE '$form_var[7]%' 
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
}


if(strlen($form_var[9])==0){
	$form_var[9]="1";
}

if(!(isset($form_var[10])) && empty($form_var[10])){
	
	$form_var[10]=0;
	echo $form_var[9]."*".$form_var[10]." = ".($form_var[9]*$form_var[10]);
}
else{
	
	echo $form_var[9]."*".$form_var[10]." = ".($form_var[9]*$form_var[10]);
}

$sql1=$sql1." LIMIT ".$form_var[9]." OFFSET ".($form_var[9]*$form_var[10]);

$result = $kon->execute($sql1);

$rejl1 = "<div class='podaci table-responsive'>
	<table id='tabela' class='table table-hover table-bordered table-sm'>
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
		$_SESSION["id"]=$row["id"];
		$br1++;
		
?>
		<tr>
			<td><?php echo $br1; ?></td><td><?php echo $row["k_ime"]; ?></td><td><?php echo $row["sifra"]; ?></td><td><?php echo $row["ime"]; ?></td><td><?php echo $row["prezime"]; ?></td><td><?php echo $row["email"]; ?></td><td><?php echo $row["broj"]; ?></td><td><?php echo $row["kategorija"]; ?></td><td style="border-right: none;"><?php echo $row["JMBG"]; ?></td><td style="border-left: none; border-top: none;"><button type="button"  data-toggle="modal" data-target="#myModal1" onclick="serializeTrow(this)">Update</button></td>
		</tr>
<?php
	}
	echo "</tbody></table></div>";
	
}
else{
	echo "<p class='podaci'>Nema takvog korisnika u bazi!</p>";
}

?>

<a id='left' class='btn btn-info btn-md' style='margin-right: 3px;' onclick="pag_arrow_lim(this)">
	<span class='glyphicon glyphicon-arrow-left' style='height: 16px'></span>
</a>
<a id='right' class='btn btn-info btn-md' style='margin-left: 3px;' onclick="pag_arrow_lim(this)">
	<span class='glyphicon glyphicon-arrow-right' style='height: 16px'></span>
</a>