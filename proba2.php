<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
function serialization(phpdoc,formId,choice,elemName){
	/*First argument is where data is sent to, second is form id from whom we gather values, third is boolean value. 
	If it's false, it is sent as ordinary formated AJAX string. If it's true, it is sent as json string.
	Forth one is an id of an element where ajax response from server you want to be displayed.
	It works on these input types: checkbox, radio, text, number, textarea and email.*/

	var data = $("#"+formId).serialize();
	var elem = document.getElementById(elemName);
alert(data);
	var obj = {
			"name" : [],
			"value" : []
		};

	str = encodeURI(phpdoc+"?"+data);
	str1 = str;
	
	var xhttp = new XMLHttpRequest();
			
	xhttp.onreadystatechange = function() {
		
		if((elem!=undefined || elem!=null) && this.readyState == 4 && this.status == 200){
			elem.innerHTML = this.responseText;
			document.getElementById(formId).reset();
		}
		 
	};
		
	if(choice===false){
		xhttp.open("GET", str, false);	
		xhttp.send();
		alert(str);
	}
		
	if(choice===true){
		
		var jason = JSON.stringify(obj);
		alert(jason);
	}
			
}
  </script>
</head>
<body>

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
			<form id="forma1">
			
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
						<label for="broj">Broj:</label>
							<input type="number" class="form-control" id="broj1" maxlength="30" placeholder="Unesi broj:" name="broj1" value="" required>
					</div>
					
					<div class="form-group col-sm-3">
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
				<div class="form-group">
					<label for="comment">Comment:</label><textarea class="form-control" rows="5" name="comment1" id="comment1" placeholder="napisi" value="rog"></textarea>
				</div>
				<div class="radio-inline">
					<label><input type="radio" name="optradio" value="admin">Admin</label>
				</div>
				<div class="radio-inline">
					<label><input type="radio" name="optradio" value="user">User</label>
				</div>
			</div>
				<button type="button" data-dismiss="modal" onclick="serialization('pr2.php','forma1',false,'raport')">Send</button>
			</form>
			
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		  </div>
		  
		</div>
  </div>
  
</div>
<div id="raport"></div>
</body>
</html>
