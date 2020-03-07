<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/intermediate/font-awesome.min.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/intermediate/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/intermediate/style.css"> <!-- Resource style -->
	<script src="js/intermediate/modernizr.js"></script> <!-- Modernizr -->
  	<script src="http://maps.googleapis.com/maps/api/js"></script>
	<script>
		function initialize() {
		var mapProp = {
		center:new google.maps.LatLng(12.4243894,76.6903270),
		zoom:17,
		mapTypeId:google.maps.MapTypeId.ROADMAP
		};
		var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
		}
		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
	<title>ಆಕರಭಾರತಿ</title>
</head>
<body>
	<header class="cd-main-header">
		<a class="cd-logo" href="../index.html"><i class="fa fa-home fa-2x"></i></a>

		<ul class="cd-header-buttons">
			<li><a class="cd-search-trigger" href="#cd-search">Search<span></span></a></li>
			<li><a class="cd-nav-trigger" href="#cd-primary-nav">Menu<span></span></a></li>
		</ul> <!-- cd-header-buttons -->
	</header>
	
	<main class="cd-main-content">
		<section id="about">
			<h2>ಸಂಪರ್ಕಿಸಿ</h2>
			<div id="about_p" class="center">
				<p>ಶ್ರೀರಂಗ ಡಿಜಿಟಲ್ ಟೆಕ್ನೋಲಜೀಸ್</p><br />
					<p>೧ನೇ ಅಡ್ಡ ರಸ್ತೆ,<br />ರಂಗನಾಥನಗರ, ಶ್ರೀರಂಗಪಟ್ಟಣ<br />
					   ದೂರವಾಣಿ&nbsp;:&nbsp;+೯೧ ೮೨೩೬ ೨೯೨೪೩೨<br />
<!--
					   ಇ-ಮೇಲ್<blockquote>info@aakarabharati.in</blockquote></p><br />
-->
					   <!-- <div id="googleMap" style="width:900px;height:380px;"></div><br /><br /><br /> -->
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d848.5363779397553!2d76.68169282916814!3d12.421834809161371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3baf6972e44db099%3A0xb00f353589fc6ce8!2sebooks!5e1!3m2!1sen!2sin!4v1583571134835!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
			</div>
	  </section>
	</main>
   <?php include("nav.php"); ?>
	<div id="cd-search" class="cd-search">
		<form>
			<input type="search" placeholder="Coming soon...">
		</form>
	</div>
		 <?php include("footer.php"); ?>
