<!DOCTYPE html>
<html>
<body>
<form id="trt">
Checkbox: <input type="checkbox" name="adminmodul" value="1">
<button type="submit" onclick="serialization(this)">Check Checkbox</button>
</form>


<script>

function serialization(me){
	
	var FormId = me.form.id;
	
	var name = "";
	var val = "";
	var str = "?";
	var i = 0;
		
	var net = document.getElementById(FormId).querySelectorAll("#"+FormId+" [name]");
	var len = document.getElementById(FormId).length-1;
		
	while(i<len) {
		
		/*if(net[i].type=="checkbox" && net[i].checked===true){
			name = net[i].getAttribute("name");
			net[i].value = "x";
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
		}*/
		
		
				//alert(net[i].value);
			
		
		name = net[i].name;
		val = net[i].value;
		
		i++;
		str += name+"="+val;
			
		if(i<len){
			str += "&";
		}
			

			
	}

	str = encodeURI(str);
	
	alert(str);
}
</script>

</body>
</html>
