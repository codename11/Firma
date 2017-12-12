$(document).ready(function(){

var url = "adminV1.php";
	$("#forma").submit(function() {
		
		$.ajax({
		type : "POST",
		url : url,
		data : $("#forma").serialize(),
		success: function(data){
					alert(data);
					location.replace("../index.php");
				}
		});

		
	});
		
});
