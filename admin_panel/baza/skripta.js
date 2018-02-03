
$(document).ready(function(){

	var url1 = "inst.php";
	$("#dform").submit(function() {
		
		$.ajax({
		type : "POST",
		url : url1,
		data : $("#dform").serialize(),
		success: function(data){
					alert("Success");
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
					alert("Success");
					location.replace("../index.php");
				}
		});

		
	});
	
		
	var url3 = "baza/modalLogIn.php";
	$("#login").submit(function(e) {
		
		$.ajax({
		type : "POST",
		url : url3,
		data : $("#login").serialize(),
		success: function(data){
					alert("Success");
					location.replace("baza/admin.php");
				}
		});

		
	});
		
});
