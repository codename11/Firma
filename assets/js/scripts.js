
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

function serialization(phpdoc,forma,choice,elemName){
	/*First argument is where data is sent to, second is keyword 'this', third is boolean value. 
	If it's false, it is sent as ordinary formated AJAX string. If it's true, it is sent as json string.
	Forth one is an id of an element where ajax response from server you want to be displayed.
	It works on these input types: checkbox, radio, text, number, textarea, password, select-one(select) and email.
	Word of caution: If there's a radio button/s on page, one of them need to have attribute checked.
	Warning for select-one: If value attribute is not provided(ommited) in option sub-tag, it's text i.e innerHTML is used as value. 
	If value attribute is provided, but doesn't have any 'value' i.e an empty string "", it will become an value. 
	Use following line in php file to handle output:  
	
	if(isset($_GET)){
		
		if(isset($_GET["jason"])){
			echo(json_decode(json_encode($_GET["jason"]),true)); 
		}
		else{
			print_r($_GET);
		}
			
	}  
	Same is applicable if you use $_POST.
	Crucial thing is distinction between types being sought. While text, number and similar may be easy to sort out,
	checkboxes and radio buttons need to be checked if they're present AND hold value. 
	Also need to be taken into consideration is that radio buttons absolutly HAVE TO default value when page is loaded. 
	*/
	var formax = forma;//Getting form object.
	
	var obj = {//Creating JS object with arrays as values that will contan names and values of input fields.
			"name" : [],
			"value" : []
		};	
	
	var Wboard = document.getElementById(elemName);//Getting element where we want to display response from server.
	
	
	var name = "";//String variable for temorary storage of names of input fields.
	var val = "";//String variable for temorary storage of values of input fields.
	var doc = phpdoc+"?"//String variable which will be later added to string with names and values gathered from form elements. Then it will be sent with standard ajax request. To used this, third parameter when function is called needs to be boolean false.
	var str = "";//String variable that contains string together with path to php file that has being sent with standard ajax.
	var i = 0;//Integer used as a counter in loops inside this function.

	var net = formax.querySelectorAll("#"+formax.id+" [name]");//Gathering of all elements inside a forma with cetain id. Elements are found by it's distinctive names.
	var len = net.length;//A length of sorts of how many elements are found inside a form.

	while(i<len) {

		if(net[i].type=="radio" && net[i].checked===true){//Checking if radio button is checked.
			name = net[i].name;
			val = net[i].value;	
		}
	
		if(net[i].type=="checkbox" && net[i].checked===true){//Checking if checkbox is checked. If it's true, assign name and value.
			name = net[i].name;
			val = net[i].value;	
		}
		
		if(net[i].type=="checkbox" && net[i].checked===false){//Checking if checkbox is checked. If it's true, assign name and value. In tis case, value is empty string.
			name = net[i].name;
			val = "";	
		}
		
		if(net[i].type!="checkbox" && net[i].type!="button" && net[i].type!="radio"){//If none of form inputs are of these types assign them value.
			name = net[i].name;
			val = net[i].value;
		}
		
		str += name+"="+val;//Adding collected names and values to string which is used as a entry point for sending data either as ordinary string or json string.

		if(i<len-1){
			str += "&";//Adding sign after each assigned value to the name even if values is empty string.
		}

		i++;
	}
	
	var res = str.split("&");//Splitting string to array to remove duplicates.
	var resLen = res.length;//Length of said array.
	res = res.filter(function(elem, index, self) {//Duplicate filtration.
		return index === self.indexOf(elem);
	});
	
	str = "";//Resseting string and adding elements wthout duplicates.
	for(i=0;i<resLen;i++){//Iterating through array, separating names from values by determined coordinates of equal sign. Names and values are then appended to string and to JS object. 
		
		if(res[i]!==undefined){
			str += res[i];//Appending filtered names and values.
			var Eqsign = res[i].indexOf("=");//Locating coordinates of equal sign.
			obj.name[i] = res[i].substring(0,Eqsign);//Assigning names to name subarray after "substring it" without equal sign.
			obj.value[i] = res[i].substring(Eqsign+1);//Assigning values to value subarray after "substring it" without equal sign.
		}

		if(i<resLen-1){
			str += "&";//Adding sign after every appendage except to last one.
		}
		
	}
	
	var strLen = str.length;
	if(str.substring(strLen-1,strLen)=="&"){

		str = str.substring(0,strLen-1);
	}
	
	var jason = JSON.stringify(obj);//Parsing previously said object to json string.
	str = encodeURI(doc+str);//Creating string suitable for sending it with ordinary ajax request.
	str1 = str;
	
	var xhttp = new XMLHttpRequest();
			
	xhttp.onreadystatechange = function() {
		
		if((Wboard!=undefined || Wboard!=null) && this.readyState == 4 && this.status == 200){
			Wboard.innerHTML = this.responseText;
			//document.getElementById(formax.id).reset(); 
			
		}
		 
	};
	
	if(choice===false){//Sending a standard ajax string.
		xhttp.open("GET", str, false);	
		xhttp.send();
		//alert(str);
	}
		
	if(choice===true){//Sending json formated string.
		xhttp.open("GET", doc+"jason="+jason,true);
		xhttp.setRequestHeader("Content-Type", "application/json");
		xhttp.send();

	}
			
}

function serializeTrow(phpdoc,me){
	
	var row = me.closest('tr').rowIndex;
	var table_id = me.closest('table').id;
	var cells = document.getElementById(table_id).rows[row].cells;
	var len = cells.length;
	
	var i=0;
	var arr = [];

	while(i<(len-1)){
		arr[i]=cells[i].innerHTML;
		i++;
	}
	
	arr.shift();
	var arrLen = arr.length;
	
	var j=0;
	var str = "";
	
	while(j<arrLen){
		
		str += "strx"+j+"="+arr[j];
		
		if(j<arrLen-1){
			str += "&";//Adding sign after every appendage except to last one.
		}
		
		j++;
	}
	str = phpdoc+"?"+str;
	
	var modal = document.getElementById("F3");

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    
		if (this.readyState == 4 && this.status == 200) {
			
			var myObj = JSON.parse(this.responseText);
			
			var txt = "<div class='row'>";
			txt += "<div class='form-group col-sm-3'><label for='k_ime'>Korisničko ime:</label><input type='text' class='form-control' id='k_ime1' maxlength='30' placeholder='Unesi korisničko ime:' name='k_ime1' value='"+myObj.k_ime+"' required></div>";
			txt += "<div class='form-group col-sm-3'><label for='pwd'>Šifra:</label><input type='password' class='form-control' id='pwd1' maxlength='30' placeholder='Unesi željenu šifru' name='pwd1' value='"+myObj.sifra+"' required></div>";
			txt += "<div class='form-group col-sm-3'><label for='ime'>Ime:</label><input type='text' class='form-control' id='ime1' maxlength='30' placeholder='Unesi ime:' name='ime1' value='"+myObj.ime+"' required></div>";
			txt += "<div class='form-group col-sm-3'><label for='prezime'>Prezime:</label><input type='text' class='form-control' id='prezime1' maxlength='30' placeholder='Unesi prezime:' name='prezime1' value='"+myObj.prezime+"' required></div>";
			txt += "</div>";
			txt += "<div class='row'>";
			txt += "<div class='form-group col-sm-3'><label for='email'>Email:</label><input type='email' class='form-control' id='email1' maxlength='30' placeholder='Unesi email:' name='email1' value='"+myObj.email+"' required></div>";
			txt += "<div class='form-group col-sm-3'><label for='tel'>Telefon:</label><input type='number' class='form-control' id='tel1' maxlength='10' placeholder='Unesi telefon:' name='tel1' value='"+myObj.broj+"' required></div>";
			
			i=0;
			
			txt += "<div class='form-group col-sm-3'><label for='sel4'>Kategorija</label><select id='sel1' class='form-control' name='sel1'>";
			while(i<myObj.kat.length){
				
				if(myObj.tkid==myObj.katid[i]){
					txt += "<option value='"+myObj.katid[i]+"' selected>"+myObj.kat[i]+"</option>";
				}
				else{
					txt += "<option value='"+myObj.katid[i]+"'>"+myObj.kat[i]+"</option>";
				}
				i++;
			}
			txt += "</select></div>";
			
			txt += "<div class='form-group col-sm-3'><label for='jmbg'>JMBG:</label><input type='number' class='form-control' id='jmbg1' maxlength='14' placeholder='Unesi jmbg:' name='jmbg1' value='"+myObj.JMBG+"' required></div>";
			txt += "</div>";
			
			var sel = "checked";
			
			txt += "<div class='row'>";

			txt += "<div class='dropdown col-sm-3'><button type='button' id='btn2' class='btn btn-default dropdown-toggle' data-toggle='dropdown'><span>Moduli</span><span class='caret' id='caret1'></span></button><ul id='comp' class='dropdown-menu'>";
			if(myObj.Admin_modul=="x"){
				txt += "<li><a class='dropdown-item'><div class='form-check'><label class='form-check-label'><input type='checkbox' class='form-check-input' name='adminmodul' id='adminmodul' value='x' checked> Admin modul</label></div></a></li>";
			}
			else{
				txt += "<li><a class='dropdown-item'><div class='form-check'><label class='form-check-label'><input type='checkbox' class='form-check-input' name='adminmodul' id='adminmodul' value='x'> Admin modul</label></div></a></li>";
			}
			
			if(myObj.Kadrovska_sluzba=="x"){
				txt += "<li><a class='dropdown-item'><div class='form-check'><label class='form-check-label'><input type='checkbox' class='form-check-input' name='ksluzba' id='ksluzba' value='x' checked> Kadrovska služba</label></div></a></li>";
			}
			else{
				txt += "<li><a class='dropdown-item'><div class='form-check'><label class='form-check-label'><input type='checkbox' class='form-check-input' name='ksluzba' id='ksluzba' value='x'> Kadrovska služba</label></div></a></li>";
			}
			
			if(myObj.E_salter=="x"){
				txt += "<li><a class='dropdown-item'><div class='form-check'><label class='form-check-label'><input type='checkbox' class='form-check-input' name='esalter' id='esalter' value='x' checked> E-šalter</label></div></a></li>";
			}
			else{
				txt += "<li><a class='dropdown-item'><div class='form-check'><label class='form-check-label'><input type='checkbox' class='form-check-input' name='esalter' id='esalter' value='x'> E-šalter</label></div></a></li>";
			}
			
			if(myObj.Evidencija_ulaza_izlaza=="x"){
				txt += "<li><a class='dropdown-item'><div class='form-check'><label class='form-check-label'><input type='checkbox' class='form-check-input' name='evidencijaio' id='evidencijaio' value='x' checked> Evidencija ulaza/izlaza</label></div></a></li>";
			}
			else{
				txt += "<li><a class='dropdown-item'><div class='form-check'><label class='form-check-label'><input type='checkbox' class='form-check-input' name='evidencijaio' id='evidencijaio' value='x'> Evidencija ulaza/izlaza</label></div></a></li>";
			}
			
			if(myObj.Materijalno_poslovanje=="x"){
				txt += "<li><a class='dropdown-item'><div class='form-check'><label class='form-check-label'><input type='checkbox' class='form-check-input' name='mposlovanje' id='mposlovanje' value='x' checked> Materijalno poslovanje</label></div></a></li>";
			}
			else{
				txt += "<li><a class='dropdown-item'><div class='form-check'><label class='form-check-label'><input type='checkbox' class='form-check-input' name='mposlovanje' id='mposlovanje' value='x'> Materijalno poslovanje</label></div></a></li>";
			}
			
			if(myObj.E_magacin=="x"){
				txt += "<li><a class='dropdown-item'><div class='form-check'><label class='form-check-label'><input type='checkbox' class='form-check-input' name='emagacin' id='emagacin' value='x' checked> E-magacin</label></div></a></li>";
			}
			else{
				txt += "<li><a class='dropdown-item'><div class='form-check'><label class='form-check-label'><input type='checkbox' class='form-check-input' name='emagacin' id='emagacin' value='x'> E-magacin</label></div></a></li>";
			}
			if(myObj.Blagajna=="x"){
				txt += "<li><a class='dropdown-item'><div class='form-check'><label class='form-check-label'><input type='checkbox' class='form-check-input' name='blagajna' id='blagajna' value='x' checked> Blagajna</label></div></a></li>";
			}
			else{
				txt += "<li><a class='dropdown-item'><div class='form-check'><label class='form-check-label'><input type='checkbox' class='form-check-input' name='blagajna' id='blagajna' value='x'> Blagajna</label></div></a></li>";
			}
			
			if(myObj.Mehanizacija=="x"){
				txt += "<li><a class='dropdown-item'><div class='form-check'><label class='form-check-label'><input type='checkbox' class='form-check-input' name='mehanizacija' id='mehanizacija' value='x' checked> Mehanizacija</label></div></a></li>";
			}
			else{
				txt += "<li><a class='dropdown-item'><div class='form-check'><label class='form-check-label'><input type='checkbox' class='form-check-input' name='mehanizacija' id='mehanizacija' value='x'> Mehanizacija</label></div></a></li>";
			}
			
			if(myObj.E_kancelarija=="x"){
				txt += "<li><a class='dropdown-item'><div class='form-check'><label class='form-check-label'><input type='checkbox' class='form-check-input' name='ekancelarija' id='ekancelarija' value='x' checked> E-kancelarija</label></div></a></li>";
			}
			else{
				txt += "<li><a class='dropdown-item'><div class='form-check'><label class='form-check-label'><input type='checkbox' class='form-check-input' name='ekancelarija' id='ekancelarija' value='x'> E-kancelarija</label></div></a></li>";
			}
			
			txt += "</ul></div>";
			
			txt += "<div class='col-sm-3'>";
			
			if(myObj.nivo=="admin"){
				txt += "<label style='float:left'><input type='radio' name='optradio' value='admin' checked>Admin</label>";
				txt += "<label style='float:right'><input type='radio' name='optradio' value='user'>User</label>";
			}
			else if(myObj.nivo=="user"){
				txt += "<label style='float:left'><input type='radio' name='optradio' value='admin'>Admin</label>";
				txt += "<label style='float:right'><input type='radio' name='optradio' value='user' checked>User</label>";
			}												
								
			txt += "</div>";
			txt += "</div>";
			document.getElementById("F3").innerHTML=txt;
			
		}

	};
	
	xhttp.open("GET", str, true);
	xhttp.send();
	
}

var klik=0;
function pagination(me){

	var stx = "";
	input_id=me.id;

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    
		if (this.readyState == 4 && this.status == 200) {
			
			document.getElementById("raport").innerHTML =this.responseText;
      
		}

	};

	stx = str1+"&klik="+input_id;

	xhttp.open("GET", stx, true);
	
	xhttp.send();

}

function delRec(phpdoc,tab,me){
	
	var tabBox = tab.querySelectorAll("#"+tab.id+" [type=checkbox]");//Gathers all checkboxes.
	var tabLen = tabBox.length;//Counts how many checkboxes are currently displayed.
	var table=document.getElementById(tab.id);//Gets table id.
	var rowLen = table.rows[0].cells.length;//Counts how many columns are in any given row. Since all rows are the same, i used first one for this counting.
	var arr = []; //Array used for storage of data gathered from one row per one array element.
	var str = "";//String that is used as temp. storage of column contents.

	var obj = {//An JS object for stringification.
			"k_ime" : [],
			"sifra" : [],
			"ime" : [],
			"prezime" : [],
			"email" : [],
			"tel" : [],
			"kat" : [],
			"jmbg" : []
		};
	
	for(var i=0;i<tabLen;i++){//Traversing through table rows.
		
		for(var j=1;j<(rowLen);j++){//Traversing through row's columns.
			if(tabBox[i].checked===true){//If checked only then is added content from table row.
			str += tabBox[i].closest("tr").cells[j].innerHTML;//Adding column's content to string for temp storage.
			
				if(j!=(rowLen)){//It adds a ',' sign after every extraction of column's content except after last extracted element's contents.
					str += ",";
				}
			
			}
			
		}
		
		arr[i]=str;//Storing entire row content per array element.
		str="";//Resets temp storage after storing to array.
		
	}
	
	arr = arr.filter(function(n){ return n != "" });//Filter duplicates lleaving only one of each. It filters only empty array elements, then rearranges array.
	
	var arrx = [];//A temporary array for each cell individual content.
	var arrxLen = 0;//Length of said array, not yet determined.
	for(var i=0;i<arr.length;i++){//Itteration through array with row/columns content.Previously mentioned array
		
		arrx = arr[i].split(",");//Splitting each member of previous array for values are between each of ',' signs.
		arrxLen = arrx.length;  
		//Assigning values to each element of temp array from current element of previous array to JS object. 
		obj.k_ime[i] = arrx[0];
		obj.sifra[i] = arrx[1];
		obj.ime[i] = arrx[2];
		obj.prezime[i] = arrx[3];
		obj.email[i] = arrx[4];
		obj.tel[i] = arrx[5];
		obj.kat[i] = arrx[6];
		obj.jmbg[i] = arrx[7];
		
	}
	
	var xhttp = new XMLHttpRequest();
			
	xhttp.onreadystatechange = function() {
		
		if(this.readyState == 4 && this.status == 200){
			console.log(this.responseText);
			//document.getElementById(formax.id).reset(); 
			
			for(var i=0;i<tabLen;i++){//Traversing through table rows.
		
				if(tabBox[i].checked===true){//If checked only then is added content from table row.
					tabBox[i].closest("tr").remove();
					//document.getElementById(tab.id).deleteRow(i+1);
				}
					
			}

		}
		 
	};
	//alert(tab.id);
	var jason = JSON.stringify(obj);//Stringification of an object.

	xhttp.open("GET", phpdoc+"?jason="+jason,true);//Sending stringified json.
	xhttp.setRequestHeader("Content-Type", "application/json");//A header need for server to understend what kind a data has been sent to.
	xhttp.send();
	
}