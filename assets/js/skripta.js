
$(document).ready(function(){

	var url1 = "/www/knjigovodstvo/install/inst.php";
	$("#dform").submit(function() {
		
		$.ajax({
		type : "POST",
		url : url1,
		data : $("#dform").serialize(),
		success: function(data){
					alert("Success");
					location.replace("/www/knjigovodstvo/install/prvi_admin.php");
				}
		});

		
	});

	var url2 = "/www/knjigovodstvo/install/adminV1.php";
	$("#forma").submit(function() {
		
		$.ajax({
		type : "POST",
		url : url2,
		data : $("#forma").serialize(),
		success: function(data){
					alert("Success");
					location.replace("/www/knjigovodstvo/index.php");
				}
		});

		
	});
	
		
	var url3 = "/www/knjigovodstvo/modalLogIn.php";
	$("#login").submit(function(e) {
		
		$.ajax({
		type : "POST",
		url : url3,
		data : $("#login").serialize(),
		success: function(data){
					alert("Success");
					location.replace("/www/knjigovodstvo/admin_panel/provera_admin.php");
				}
		});

		
	});
		
});
