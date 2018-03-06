var klik=0;
function pag_arrow_lim(me){
	
	var parentId = me.parentElement.id
	var x = document.getElementById(parentId).childElementCount-1;//Minus th.

	var stx = "";
	input_id=me.id;
	
	if(input_id=="prev"){
		klik--;
	}
	
	if(input_id=="next"){
		klik++;
	}
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    
		if (this.readyState == 4 && this.status == 200) {
			
			document.getElementById("raport").innerHTML =this.responseText;
			
			/*var elems = document.querySelectorAll(".klasicax");
			[].forEach.call(elems, function(el) {
				el.classList.add("klasicay");
				el.classList.add("btn");
				el.classList.add("btn-info");
				el.classList.add("btn-sm");
				el.classList.add("podaci");
			});
	
			document.getElementById("trash"+(klik+1)).className = "klasicax btn btn-info btn-sm podaci";*/
      
		}

	};

	stx = str1+"&offset="+klik;
	xhttp.open("GET", stx, true);

	xhttp.send();
	
}
********************
if($row_count<$form_var[10]){
	echo "Blah!";
}
**************
//$br1; $row["k_ime"]; $row["sifra"]; $row["ime"]; $row["prezime"]; $row["email"]; $row["broj"]; $row["kategorija"]; $row["JMBG"]; 
************
if(!(isset($form_var[10])) && empty($form_var[10])){//offset/klik
	
	if($form_var[10]>$row_count || $form_var[10]<$row_count){
		
		$form_var[10]=0;//Ako je offset(klik) veci ili manji od broja redova ili stranica, resetovati offset.
		
	}
	
	echo $form_var[9]."*".$form_var[10]." = ".($form_var[9]*$form_var[10]);
}
else{
	
	echo $form_var[9]."*".$form_var[10]." = ".($form_var[9]*$form_var[10]);
}
**************************
if(isset($form_var[10]) && !(empty($form_var[10]))){
	
	if($form_var[10]>$row_count || $form_var[10]<$row_count){
		
		$form_var[10]=0;//Ako je offset(klik) veci ili manji od broja redova ili stranica, resetovati offset.
		
	}
	
}
else if(!(isset($form_var[10])) && empty($form_var[10])){//offset/klik
	
	$form_var[10]=0;//Ako je offset veci ili manji od broja redova ili stranica, resetovati offset
	//echo $form_var[9]."*".$form_var[10]." = ".($form_var[9]*$form_var[10]);
}
***************
klik++; if((<?php echo $form_var[10]; ?>)==0){ klik=0; }; 