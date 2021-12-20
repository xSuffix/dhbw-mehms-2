<!DOCTYPE html>
<html lang="de">
	<head>
		<link href="styles/formular.css" rel="stylesheet">
		<meta charset="UTF-8"> 
		<title> Login - DHBW Mehms </title>
	<?php include("includes/meta.php"); ?>
	  <style>
		:root {
		  --banner-top: #b167eb;
		  --banner-bottom: #4bd8f6;
		}
	  </style>		
	</head>
	
	<body>
	<?php include("includes/header.php"); 
	 global $db;
	 if(isset($_POST["mAnmelden"])){
		
		require_once 'scripts/Database.php';
		$db = new Database();
		
		
		$sql = "SELECT * FROM users where Name Like '".$_POST["mBenutzer"]."'";
		$benutzer = $db->database->query($sql)->fetchAll();
		//print_r($benutzer);
		
		if(!empty($benutzer)){
			if($benutzer[0]["Password"] == $_POST["mPasswort"]){
				echo "richtiiiigg";
				//hier nun irgendwie einloggen!!!
			}
			else{
				echo "Passwort Falsch";
			}
		}
	 }		
	?>
	<main class="container">
		<div class="heading">
			<h1>DHBW Mehms</h1>
			<h2>Anmeldung</h2>
		</div>
	<section class="paper">
	 <form action="login" method="post" enctype="multipart/form-data">				<!--//wohin geht der login aufruf??? -->
				<label for="kategorie" class="required">Benutzer</label>
				<input id="benutzer" type="text" placeholder="Benutzer" name="mBenutzer">
				<label for="passwort" class="required">Passwort</label>
				<input id="passwort" type="password" placeholder="Passwort" name="mPasswort">
				<br>
				<button name="mAnmelden">Anmelden</button>
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