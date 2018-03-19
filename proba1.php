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
function serialization(me){
	
	var FormId = me.form.id;
	
	var name = "";
	var val = "";
	var str = "?";
	var i = 0;
		
	var net = me.form.querySelectorAll("#"+FormId+" [name]");
	var len = net.length;	
	while(i<len) {

		if(net[i].type=="checkbox" && net[i].checked===true){
			name = net[i].name;
			val = net[i].value;	
		}
		
		if(net[i].type=="checkbox" && net[i].checked===false){
			name = net[i].getAttribute("name");
			net[i].value = "";
			val = net[i].value;	
		}
		
		if(net[i].type!="checkbox" && net[i].type!="button"){
			name = net[i].getAttribute("name");
			val = net[i].value;
		}
		
		i++;
		str += name+"="+val;
			
		if(i<len){
			str += "&";
		}
			
	}
	alert(str);
	str = encodeURI(str);
	
	
}
</script>
</head>
<body>

<div class="container">
  <h2>Vertical (basic) form</h2>
  <form id="fff">
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
    <button type="submit" class="btn btn-default" onclick="serialization(this)">Submit</button>
  </form>
</div>
<div id="ggg"></div>
</body>
</html>