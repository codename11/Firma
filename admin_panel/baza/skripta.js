$(document).ready(function(){

var url1 = "inst.php";
	$("#dform").submit(function() {
		
		$.ajax({
		type : "POST",
		url : url1,
		data : $("#dform").serialize(),
		success: function(data){
					alert(data);
					location.replace("prvi_admin.php");
				}
		});

		
	});

var url2 = "adminV1.php";
	$("#forma").submit(function() {
		
		$.ajax({
		type : "POST",
		url : url2,
		data : $("#forma").serialize(),
		success: function(data){
					alert(data);
					location.replace("../index.php");
				}
		});

		
	});
	
		
});
