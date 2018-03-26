<!DOCTYPE html>
<html lang="en">
<head>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
		textarea {resize: none;}
	</style>
	<script>
  
		$(document).ready(function(){
		
			//If you want submit a form on a click.
			/*$("#btn1").click(function(){//Click on elemnt type button to make ajax call.
				event.preventDefault();
				$.ajax({
					type: "GET",//POST or GET
					url: "pr2.php",//Where data to send.
					contentType: "text/html",//Regular html format
					data: $("#forma1").serialize(),//For displaying use this: print_r($_GET);
					//contentType: "application/json;charset=utf-8", //If you want json data type.
					//data: JSON.stringify($("#forma1").serialize()),//Serialization of form. Use this in php: echo(json_encode($_GET));
				   success: function (result) {//If succesfull 
						 $("#raport").text(result);//Display in div with id=raport.
				   },
				   error: function () {//In case of an error
						alert("Error!!!");
				   }
				});
			});*/
			
			//If you want to submit a form using event handler.
			/*$("#forma1").submit(function(event){
				event.preventDefault();//Use this if you want your fields to stay populated after submition.

				$.ajax({
					url:"pr2.php",//Where data to send.
					type:"GET",//POST or GET
					contentType: "text/html",//Regular html format
					data: $("#forma1").serialize(),//For displaying use this: print_r($_GET);
					//contentType: "application/json;charset=utf-8",//If you want json data type.
					//data:JSON.stringify($("#forma1").serialize()),//Serialization of form. Use this in php: echo(json_encode($_GET));
					success:function(result){
						$("#raport").text(result);//Display in div with id=raport.
					},
					error: function () {//In case of an error
						alert("Error!!!");
					}

				});
			});*/
		
		});
  
function serialization(phpdoc,forma,choice,elemName){
	/*First argument is where data is sent to, second is keyword 'this', third is boolean value. 
	If it's false, it is sent as ordinary formated AJAX string. If it's true, it is sent as json string.
	Forth one is an id of an element where ajax response from server you want to be displayed.
	It works on these input types: checkbox, radio, text, number, textarea, password, select-one(select) and email.
	Word of caution: If there's a radio button/s on page, one of them need to have attribute checked.
	Warning for select-one: If value attribute is not provided(ommited) in option sub-tag, it's text i.e innerHTML is used as value. 
	If value attribute is provided, but doesn't have any 'value' i.e an empty string "", it will become an value. 
	Use following line in php file to handle output:  
	
	if(isset($_GET)){
		
		if(isset($_GET["jason"])){
			echo(json_decode(json_encode($_GET["jason"]),true)); 
		}
		else{
			print_r($_GET);
		}
			
	}  
	Same is applicable if you use $_POST.
	Crucial thing is distinction between types being sought. While text, number and similar may be easy to sort out,
	checkboxes and radio buttons need to be checked if they're present AND hold value. 
	Also need to be taken into consideration is that radio buttons absolutly HAVE TO default value when page is loaded. 
	*/
	var formax = forma;//Getting form object.
	
	var obj = {//Creating JS object with arrays as values that will contan names and values of input fields.
			"name" : [],
			"value" : []
		};

	var Wboard = document.getElementById(elemName);//Getting element where we want to display response from server.
	var name = "";//String variable for temorary storage of names of input fields.
	var val = "";//String variable for temorary storage of values of input fields.
	var doc = phpdoc+"?"//String variable which will be later added to string with names and values gathered from form elements. Then it will be sent with standard ajax request. To used this, third parameter when function is called needs to be boolean false.
	var str = "";//String variable that contains string together with path to php file that has being sent with standard ajax.
	var i = 0;//Integer used as a counter in loops inside this function.

	var net = formax.querySelectorAll("#"+formax.id+" [name]");//Gathering of all elements inside a forma with cetain id. Elements are found by it's distinctive names.
	var len = net.length;//A length of sorts of how many elements are found inside a form.

	while(i<len) {

		if(net[i].type=="radio" && net[i].checked===true){//Checking if radio button is checked.
			name = net[i].name;
			val = net[i].value;	
		}
	
		if(net[i].type=="checkbox" && net[i].checked===true){//Checking if checkbox is checked. If it's true, assign name and value.
			name = net[i].name;
			val = net[i].value;	
		}
		
		if(net[i].type=="checkbox" && net[i].checked===false){//Checking if checkbox is checked. If it's true, assign name and value. In tis case, value is empty string.
			name = net[i].name;
			val = "";	
		}
		
		if(net[i].type!="checkbox" && net[i].type!="button" && net[i].type!="radio"){//If none of form inputs are of these types assign them value.
			name = net[i].name;
			val = net[i].value;
		}
		
		str += name+"="+val;//Adding collected names and values to string which is used as a entry point for sending data either as ordinary string or json string.

		if(i<len-1){
			str += "&";//Adding sign after each assigned value to the name even if values is empty string.
		}

		i++;
	}

	var res = str.split("&");//Splitting string to array to remove duplicates.
	var resLen = res.length;//Length of said array.
	res = res.filter(function(elem, index, self) {//Duplicate filtration.
		return index === self.indexOf(elem);
	});
	
	str = "";//Resseting string and adding elements wthout duplicates.
	for(i=0;i<resLen;i++){//Iterating through array, separating names from values by determined coordinates of equal sign. Names and values are then appended to string and to JS object. 
		
		if(res[i]!==undefined){
			str += res[i];//Appending filtered names and values.
			var Eqsign = res[i].indexOf("=");//Locating coordinates of equal sign.
			obj.name[i] = res[i].substring(0,Eqsign);//Assigning names to name subarray after "substring it" without equal sign.
			obj.value[i] = res[i].substring(Eqsign+1);//Assigning values to value subarray after "substring it" without equal sign.
		}
		
		if(i<resLen-1){
			str += "&";//Adding sign after every appendage except to last one.
		}
		
	}
	
	var jason = JSON.stringify(obj);//Parsing previously said object to json string.
	str = encodeURI(doc+str);//Creating string suitable for sending it with ordinary ajax request.
	str1 = str;
	
	var xhttp = new XMLHttpRequest();
			
	xhttp.onreadystatechange = function() {
		
		if((Wboard!=undefined || Wboard!=null) && this.readyState == 4 && this.status == 200){
			Wboard.innerHTML = this.responseText;
			//document.getElementById(formax.id).reset(); 
			
		}
		 
	};
	
	if(choice===false){//Sending a standard ajax string.
		xhttp.open("GET", str, false);	
		xhttp.send();
	}
		
	if(choice===true){//Sending json formated string.
		xhttp.open("GET", doc+"jason="+jason,true);
		xhttp.setRequestHeader("Content-Type", "application/json");
		xhttp.send();

	}
			
}
  </script>
</head>
<body>

<div id="raport"></div></br>
<div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
           <h2>Vertical (basic) form</h2>
  <form id="forma1">
			
			<div class="row form-group">

					<div class="col-sm-3">
						<label for="k_ime">Korisničko ime:</label>
							<input type="text" class="form-control" id="k_ime1" maxlength="30" placeholder="Unesi korisničko ime:" name="k_ime1" value="" required>
					</div>
										
					<div class="col-sm-3">
						<label for="pwd">Šifra:</label>
							<input type="password" class="form-control" id="pwd1" maxlength="30" placeholder="Unesi željenu šifru" name="pwd1" value="" required>
					</div>

					<div class="col-sm-3">
						<label for="broj">Broj:</label>
							<input type="number" class="form-control" id="broj1" maxlength="30" placeholder="Unesi broj:" name="broj1" value="" required>
					</div>
					
					<div class="col-sm-3">
						<label for="email">Email:</label>
							<input type="email" class="form-control" id="email1" maxlength="30" placeholder="Unesi email:" name="email1" value="" required>
					</div>
			
				</div>
			
			<div class="row form-group">
							
				<div class="dropdown col-sm-3">
					<button type="button" id="btn2" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						<span>Moduli</span>
						<span class="caret" id="caret1"></span>
					</button>
					<ul id="comp" class="dropdown-menu">
					  <li><a class="dropdown-item"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="adminmodul" id="adminmodul" value="x"> Admin modul</label></div></a></li>
					  <li><a class="dropdown-item"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="ksluzba" id="ksluzba" value="x"> Kadrovska služba</label></div></a></li>
					  <li><a class="dropdown-item"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="esalter" id="esalter" value="x"> E-šalter</label></div></a></li>
					  <li><a class="dropdown-item"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="evidencijaio" id="evidencijaio" value="x"> Evidencija ulaza/izlaza</label></div></a></li>
					  <li><a class="dropdown-item"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="mposlovanje" id="mposlovanje" value="x"> Materijalno poslovanje</label></div></a></li>
					  <li><a class="dropdown-item"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="emagacin" id="emagacin" value="x"> E-magacin</label></div></a></li>
					  <li><a class="dropdown-item"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="blagajna" id="blagajna" value="x"> Blagajna</label></div></a></li>
					  <li><a class="dropdown-item"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="mehanizacija" id="mehanizacija" value="x"> Mehanizacija</label></div></a></li>
					  <li><a class="dropdown-item"><div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="ekancelarija" id="ekancelarija" value="x"> E-kancelarija</label></div></a></li>
					</ul>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group col-sm-12">
					<label for="comment1">Comment:</label><textarea class="form-control" rows="5" name="comment1" id="comment1" placeholder="napisi" value="rog"></textarea>
				</div>
				</div>
				
			<div class="row">
				
				<div class="col-sm-3">
					<div class="radio-inline">
						<label><input type="radio" name="optradio" value="admin" checked>Admin</label>
					</div>
					<div class="radio-inline">
						<label><input type="radio" name="optradio" value="user">User</label>
					</div>
				</div>
				
				<div class="col-sm-3">
					<label for="sel1">Select list:</label>
					<select class="form-control" name="sel">
						<option value=""></option>
						<option value="x1">Opcija1</option>
						<option value="x2">Opcija2</option>
						<option value="x3">Opcija3</option>
						<option value="x4">Opcija4</option>
					</select>
				</div>
				
			</div>
				
			<div class="row">
				
				<div class="col-sm-3">
					<div class="radio-inline">
						<label><input type="radio" name="patak" value="car" checked>car</label>
					</div>
					<div class="radio-inline">
						<label><input type="radio" name="patak" value="kralj">kralj</label>
					</div>
				</div>
			</div>
				<!--<button id="btn1" type="submit">klik</button>-->
			</form>
			<div class="row">
			<div class="col-sm-3">
				<button type="button" class="btn btn-default" onclick="serialization('pr2.php',forma1,true,'raport')">Send</button>
			</div>
			</div>
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