<?php
require "../funkcije.php";

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Firma</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="/www/knjigovodstvo/assets/js/skripta.js"></script>
</head>
<body>

<div class="container">
  <h2>Instalacija</h2>
  <form id="dform">
  
	<div class="form-group">
      <label for="ipadresa">IP adresa:</label>
      <input type="text" class="form-control" id="ipadresa" placeholder="Unesi IP adresu" name="ipadresa" required>
    </div>
	
	<div class="form-group">
      <label for="base">Korisničko ime baze:</label>
      <input type="text" class="form-control" id="base" placeholder="Unesi ime za bazu" name="base" required>
    </div>
	
	<div class="form-group">
      <label for="pwd">Šifra za bazu:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Unesi šifru" name="pwd">
    </div>
	<?php include "base_list.php"; ?>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
  
</div>

</body>
</html>