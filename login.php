<!DOCTYPE html>
<html lang="de">
	<head>
		<link href="styles/formular.css" rel="stylesheet">
		<meta charset="UTF-8"> 
		<title> Login - DHBW Mehms </title>
	<!--< ?php include("includes/meta.php"); ?>	-->
	  <style>
		:root {
		  --banner-top: #b167eb;
		  --banner-bottom: #4bd8f6;
		}
	  </style>		
	</head>
	
	<body>
	<?php include("includes/header.php"); ?>
	<main class="container">
		<div class="heading">
			<h1>DHBW Mehms</h1>
			<h2>Anmeldung</h2>
		</div>
	<section class="login">
	 <form action="login-formular" method="post" enctype="multipart/form-data">				<!--//wohin geht der login aufruf??? -->
				<label for="kategorie" class="required">Benutzer</label>
				<input id="benutzer" type="text" placeholder="Benutzer" name="mBenutzer">
				<label for="passwort" class="required">Passwort</label>
				<input id="passwort" type="password" placeholder="Passwort" name="mPasswort" class="login">
				<br>
				<button>Anmelden</button>
			</form>
			
	<a href="registrieren.php"><b>oder registrieren ... </b></a>							<!--//wo registrieren?? -->
	</section>

	<br>
	<br> 
	<br>
	</main>
	<?php include("includes/footer.php"); ?>
	<?php include("includes/bottom-navigation.php"); ?>
	</body> 
</html>