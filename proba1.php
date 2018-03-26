<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<div class="container">
  <h2>Vertical (basic) form</h2>
  <form id="fff" action="pr2.php">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="remember1" value="x1"> Remember me1</label>
    </div>
     <div class="checkbox">
      <label><input type="checkbox" name="remember2" value="x2"> Remember me2</label>
    </div>
     <div class="checkbox">
      <label><input type="checkbox" name="remember3" value="x3"> Remember me3</label>
    </div>
	<div class="radio">
      <label><input type="radio" name="remember4" value="x4.1"> Remember me4.1</label>
    </div>
	<div class="radio">
      <label><input type="radio" name="remember4" value="x4.2"> Remember me4.2</label>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>
<div id="ggg"></div>
</body>
</html>