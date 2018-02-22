
function scroll_to(clicked_link, nav_height) {
	var element_class = clicked_link.attr('href').replace('#', '.');
	var scroll_to = 0;
	if(element_class != '.top-content' && element_class != '#myModal1') {
		element_class += '-container';
		scroll_to = $(element_class).offset().top - nav_height;
	}
	if($(window).scrollTop() != scroll_to) {
		$('html, body').stop().animate({scrollTop: scroll_to}, 1000);
	}
}

jQuery(document).ready(function() {
	
	//Form handling
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
					location.replace("/www/knjigovodstvo/admin_panel/admin.php");
				}
		});

		
	});
	
	
	var url4 = "/www/knjigovodstvo/install/adminV1.php";
	$("#forma1").submit(function() {
		
		$.ajax({
		type : "POST",
		url : url4,
		data : $("#forma1").serialize(),
		success: function(data){
					alert("Success");
					//location.replace("/www/knjigovodstvo/admin_panel/admin.php");
				}
		});

		
	});
	
	/*
	    Navigation
	*/
	$('a.scroll-link').on('click', function(e) {
		e.preventDefault();
		scroll_to($(this), $('nav').outerHeight());
	});
	// toggle "navbar-no-bg" class
	$('.top-content .text').waypoint(function() {
		$('nav').toggleClass('navbar-no-bg');
	});
	
    /*
        Background slideshow
    */
    $('.top-content').backstretch("/www/knjigovodstvo/assets/img/backgrounds/1.jpg");
    $('.call-to-action-container').backstretch("/www/knjigovodstvo/assets/img/backgrounds/1.jpg");
    $('.testimonials-container').backstretch("/www/knjigovodstvo/assets/img/backgrounds/1.jpg");
    
    $('#top-navbar-1').on('shown.bs.collapse', function(){
    	$('.top-content').backstretch("resize");
    });
    $('#top-navbar-1').on('hidden.bs.collapse', function(){
    	$('.top-content').backstretch("resize");
    });
    
    /*
        Wow
    */
    new WOW().init();
    
    /*
	    Contact form
	*/
	$('.contact-form form input[type="text"], .contact-form form textarea').on('focus', function() {
		$('.contact-form form input[type="text"], .contact-form form textarea').removeClass('input-error');
	});
	$('.contact-form form').submit(function(e) {
		e.preventDefault();
	    $('.contact-form form input[type="text"], .contact-form form textarea').removeClass('input-error');
	    var postdata = $('.contact-form form').serialize();
	    $.ajax({
	        type: 'POST',
	        url: 'assets/contact.php',
	        data: postdata,
	        dataType: 'json',
	        success: function(json) {
	            if(json.emailMessage != '') {
	                $('.contact-form form .contact-email').addClass('input-error');
	            }
	            if(json.subjectMessage != '') {
	                $('.contact-form form .contact-subject').addClass('input-error');
	            }
	            if(json.messageMessage != '') {
	                $('.contact-form form textarea').addClass('input-error');
	            }
	            if(json.emailMessage == '' && json.subjectMessage == '' && json.messageMessage == '') {
	                $('.contact-form form').fadeOut('fast', function() {
	                    $('.contact-form').append('<p>Thanks for contacting us! We will get back to you very soon.</p>');
	                });
	            }
	        }
	    });
	});

$(function(){ //Odavde
	var current_page_URL = location.href;
		$( "a" ).each(function() {
			if ($(this).attr("href") !== "#") {
					
			var target_URL = $(this).prop("href");
					
				if (target_URL == current_page_URL) {
					$('.nav a').parents('li, ul').removeClass('active');
					$(this).parent('li').addClass('active');
					return false;
				}
					
			}
	});
}); //dovde je kod za setovanje 'active' klase navbar-a kada se promeni stranica.
	
	
});


jQuery(window).load(function() {
	
	/*
		Loader
	*/
	$(".loader-img").fadeOut();
	$(".loader").delay(1000).fadeOut("slow");
	
	/*
		Hidden images
	*/
	$(".testimonial-image img").attr("style", "width: auto !important; height: auto !important;");
	
});

function uzim_vred(phpdoc,me){
	
	var parent_id = me.parentNode.id
	var name = "";
	var val = "";
	var str = phpdoc+"?,";
	var i = 0;
		
	var net = document.getElementById(parent_id).querySelectorAll("#"+parent_id+" [name]");
	var len = document.getElementById(parent_id).length-1;
		
	var namex = "";
	var valx = "";
		
	while(i<len) {
			
		name = net[i].getAttribute("name");
		val = net[i].value;
		   
		i++
		str += name+"="+val;
			
		if(i<len){
			str += "&,"
		}
			
	}
		
	i = 0;
	var elems = str.split(",");

	str = "";
	while(i<=len){
		str += elems[i];
		i++
	}
	str = encodeURI(str);
	
	var xhttp = new XMLHttpRequest();
		
	xhttp.onreadystatechange = function() {
		
		if((document.getElementById("raport")!=undefined || document.getElementById("raport")!=null) && this.readyState == 4 && this.status == 200){
			document.getElementById("raport").innerHTML = this.responseText;
		}
		 
	};

	xhttp.open("GET", str, false);		
	xhttp.send();
	
}

