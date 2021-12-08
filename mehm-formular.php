<!DOCTYPE html>
<html lang="de">
	<head>
		<link href="styles/formular.css" rel="stylesheet">
		<meta charset="UTF-8"> 
		<title> Dein Mehm - upload </title>
	<?php include("includes/meta.php"); ?>
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
	  <section class="paper">
		<?php $target_dir = "uploads/";	
		$target_file = $target_dir . basename($_FILES["mDatei"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
		if (move_uploaded_file($_FILES["mDatei"]["tmp_name"], $target_file)) {
		echo "<h1> Viele Dank für deine Einsedung der Kategorie ". $_POST["mKategorie"]. "!</h1> <br><p class=\"response\"> Die Datei ". htmlspecialchars( basename( $_FILES["mDatei"]["name"])). " wurde erfolgreich hochgeladen. </p>";
		
		} else {
		echo "<h1> Tut uns Leid, es ist ein Fehler aufgetreten. Bitte versuche es erneut!</h1>";}
		
		?>
	  </section>
	</main>
	<?php include("includes/footer.php"); ?>
	<?php include("includes/bottom-navigation.php"); ?>
	</body> 
</html>