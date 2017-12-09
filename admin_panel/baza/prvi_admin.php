
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Firma</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="skripta.js"></script>
</head>
<body>

<div class="container" id="cont">
  <h2>Setovanje prvog administratorskog naloga </h2>
  <form id="forma">

	<div class="form-group">
		<label for="k_ime">Korisničko ime:</label>
		<input type="text" class="form-control" id="k_ime" maxlength="30" placeholder="Unesi korisničko ime:" name="k_ime" value="" required>
    </div>
	
	<div class="form-group">
		<label for="pwd">Šifra:</label>
		<input type="password" class="form-control" id="pwd" maxlength="30" placeholder="Unesi željenu šifru" name="pwd" value="" required>
    </div>

	<div class="form-group">
		<label for="ime">Ime:</label>
		<input type="text" class="form-control" id="ime" maxlength="30" placeholder="Unesi ime:" name="ime" value="" required>
    </div>
	
	<div class="form-group">
		<label for="prezime">Prezime:</label>
		<input type="text" class="form-control" id="prezime" maxlength="30" placeholder="Unesi prezime:" name="prezime" value="" required>
    </div>
	
	<div class="form-group">
		<label for="email">Email:</label>
		<input type="email" class="form-control" id="email" maxlength="30" placeholder="Unesi email:" name="email" value="" required>
    </div>
	
	<div class="form-group">
		<label for="tel">Telefon:</label>
		<input type="number" class="form-control" id="tel" maxlength="14" placeholder="Unesi telefon:" name="tel" value="" required>
    </div>
	
	<div class="form-group">
		<label for="jmbg">JMBG:</label>
		<input type="number" class="form-control" id="jmbg" maxlength="14" placeholder="Unesi jmbg:" name="jmbg" value="" required>
    </div>
	
	<div class="radio">
		<label><input type="radio" id="optradio1" name="optradio" value="admin">Admin</label>
    </div>
	
    <div class="radio">
		<label><input type="radio" id="optradio2" name="optradio" value="user">User</label>
    </div>
	<button id="btn1" type="submit" class="btn btn-default">Submit</button>
  </form>
  
</div>
<div id="demo"></div>

</body>
</html>

