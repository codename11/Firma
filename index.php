<?php 
session_start();
require "header.php";
require "navbar.php";
$_SESSION["increment"] = 0;
$_SESSION["rec_num"] = 0;

?>

     <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                	
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                        	<div class="logo wow fadeInDown">
                        		<a href="index.php"></a>
                        	</div>
                            <h1 class="wow fadeInLeftBig">Firma</h1>
                            <div class="description wow fadeInLeftBig">
                            	<p>
	                            	Predstavljamo vam proizvod nase softverske kuće, softver koji će koristiti svakoj ozbiljnijoj firmi kojoj je potrebna evidencija podataka o radnicima, klijentima i robi..
                            	</p>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
<div class="container-fluid kl1" id="md">
<div class="container kl2">
	<div class="row">
		<h2>Moduli poslovanja</h2>
		<hr>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<a href="#" data-toggle="modal" data-target="#myModal"><img src="/www/knjigovodstvo/assets/img/admin.jpg" class="img-responsive logo wow fadeInDown kl3" alt="admin"  data-toggle="tooltip" title="Admin"></a>
		</div>
		<div class="col-sm-4">
			<a href="#" data-toggle="modal" data-target="#myModal"><img src="/www/knjigovodstvo/assets/img/hr.jpg" class="img-responsive logo wow fadeInDown kl3" alt="kadrovska sluzba"  data-toggle="tooltip" title="Kadrovska služba"></a>
		</div>
		<div class="col-sm-4">
			<a href="#" data-toggle="modal" data-target="#myModal"><img src="/www/knjigovodstvo/assets/img/es.jpg" class="img-responsive logo wow fadeInDown kl3" alt="esalter"  data-toggle="tooltip" title="E-šalter"></a>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<a href="#" data-toggle="modal" data-target="#myModal"><img src="/www/knjigovodstvo/assets/img/io.png" class="img-responsive logo wow fadeInDown kl3" alt="ulazizlaz"  data-toggle="tooltip" title="Evidencija ulaza/izlaza"></a>
		</div>
		<div class="col-sm-4">
			<a href="#" data-toggle="modal" data-target="#myModal"><img src="/www/knjigovodstvo/assets/img/mp.jpg" class="img-responsive logo wow fadeInDown kl3" alt="mposlovanje"  data-toggle="tooltip" title="Materijalno poslovanje"></a>
		</div>
		<div class="col-sm-4">
			<a href="#" data-toggle="modal" data-target="#myModal"><img src="/www/knjigovodstvo/assets/img/em.png" class="img-responsive logo wow fadeInDown kl3" alt="emagacin"  data-toggle="tooltip" title="E-magacin"></a>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<a href="#" data-toggle="modal" data-target="#myModal"><img src="/www/knjigovodstvo/assets/img/meh.png" class="img-responsive logo wow fadeInDown kl3" alt="mehanizacija"  data-toggle="tooltip" title="Mehanizacija"></a>
		</div>
		<div class="col-sm-4">
			<a href="#" data-toggle="modal" data-target="#myModal"><img src="/www/knjigovodstvo/assets/img/bl.png" class="img-responsive logo wow fadeInDown kl3" alt="blagajna"  data-toggle="tooltip" title="Blagajna"></a>
		</div>
		<div class="col-sm-4">
			<a href="#" data-toggle="modal" data-target="#myModal"><img src="/www/knjigovodstvo/assets/img/eo.jpg" class="img-responsive logo wow fadeInDown kl3" alt="ekancelarija"  data-toggle="tooltip" title="E-kancelarija"></a>
		</div>
	</div>
	
</div>
</div>

<div class="container-fluid kl4">
<div class="container kl2">
	
	<div class="row">
		<a class="scroll-link" href="#top-content"><img src="/www/knjigovodstvo/assets/img/viz.jpg" class="img-responsive img-rounded logo wow fadeInDown kl5" alt="admin"></a>
	</div>
	<div class="row">
		<h4> Tačnost, profesionalnost i istrajnost su nam na prvom mestu</h2>
		<hr>
	</div>
</div>
</div>

<?php include "modal.php"; ?>
<?php 
require "footer.php";	
?>
