<?php
function pristup($servername, $username, $password, $dbname, $sql){

	$conn=new mysqli($servername, $username, $password, $dbname);
	
	if($conn->connect_error){
	
		die("Neuspela konekcija: ".$conn->connect_error);
	
	}
	
	$result = $conn->query($sql);
	if ($result == TRUE) {
    //echo "Uspela konekcija";
} else {
    echo "Neuspešno izvršavanje upita: " . $conn->error;
}
	return $result;

	$conn->close();
	
}

function multi_pristup($servername, $username, $password, $dbname, $sql){
/*Kada treba dase prikaze ovom funkcijom nesto, onda se u php fajlu treba ubaciti i 
while($row = $result->fetch_assoc()) {
	**.$row["id"]."</td>"."<td>".$row["ime"]."</td>" , tj. nesto u tom fazonu row["id"] i sl....
} */
	$conn=new mysqli($servername, $username, $password, $dbname);
	
	if($conn->connect_error){
	
		die("Neuspela konekcija: ".$conn->connect_error);
	
	}
	
	$result = $conn->multi_query($sql);
	if ($result === TRUE) {
    echo "New records created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
	
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

function proverai($prom){
	$prom = test_input($prom);
	if (preg_match("/^[a-zA-Z]*$/",$prom)){
	
	$niz=str_split($prom);
	$str="";
	$i=0;
	for($i=0;$i<sizeof($niz);$i++){
		
		$str.=$niz[$i];
		
	}
	$str = test_input($str);
	return $str;

	}
	else{
		return 1;
	}
}

function proverae($prom){
	
	$niz=array("err"=>"","prom"=>"","greska"=>0);
	if (empty($prom)) {
     $niz["err"] = "Potrebno je uneti email.";
	 $niz["prom"] ="";
	 $niz["greska"]++;
   } else {
     $prom = test_input($prom);
     if (!filter_var($prom, FILTER_VALIDATE_EMAIL)) {
       $niz["err"] = "Nepravilno unet email."; 
	   $niz["prom"] ="";
	   $niz["greska"]++;
     }
	 $niz["prom"] =$prom;
   }
	return $niz;
}

function proveras($prom){
	
	$niz=array("err"=>"","prom"=>"","greska"=>0);
	if (empty($prom)) {
     $niz["err"] = "Potrebno je uneti sifru.";
	 $niz["prom"] ="";
	 $niz["greska"]++;
   } else {
     $prom = test_input($prom);
     if (!preg_match("/^[a-zA-Z0-9 ]*$/",$prom)) {
       $niz["err"] = "Dozvoljena su slova, brojevi i prazna mesta."; 
	   $niz["prom"] ="";
	   $niz["greska"]++;
     }
	 $niz["prom"]= $prom;
   }
	return $niz;
}

function proverab($prom){
	
	$niz=array("err"=>"","prom"=>"","greska"=>0);
	if (empty($prom)) {
     $niz["err"] = "Potrebno je uneti broj.";
	 $niz["prom"] ="";
	 $niz["greska"]++;
   } else {
     $prom = test_input($prom);
     if (!preg_match("/^[0-9 ]*$/",$prom)) {
       $niz["err"] = "Dozvoljeni su samo brojevi."; 
	   $niz["prom"] ="";
	   $niz["greska"]++;
     }
	 $niz["prom"]= $prom;
   }
   
   if (preg_match("/^[0-9 ]*$/",$prom)) {
       return $niz;
     }
   
}

function proverafonbr($prom){
	$prom = test_input($prom);
	if (preg_match("/^[0-9]*$/",$prom)){
	
	$niz=str_split($prom);
	$str="";
	$i=0;
	
	for($i=0;$i<3;$i++){
		
		$str.=$niz[$i];
		
	}
	$str.="/";
	
	for($i=3;$i<6;$i++){
		
		$str.=$niz[$i];
		
	}
	$str.="-";
	
	for($i=6;$i<count($niz);$i++){
		
		$str.=$niz[$i];
		
	}
	
	return $str;
}
else{
	return 1;
}
}
?>
