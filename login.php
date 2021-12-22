<?php
	session_start(); 
	
	require_once 'scripts/Database.php';
	$db = new Database();
	
	// Wird bei einer versuchten Anmeldung ausgeführt
	if(isset($_POST["mAnmelden"])){	
		// Nutzerdaten werden mit der Datenbank abgeglichen
		$sql = "SELECT * FROM users where Name Like '".$_POST["mBenutzer"]."'";
		$benutzer = $db->database->query($sql)->fetchAll();
		
		// Es gibt den eingetragenen Benutzer
		if(!empty($benutzer)){
			// Das Passwort stimmt überein
			if($benutzer[0]["Password"] == $_POST["mPasswort"]){
				// Erfolgreicher Login!				
				// Einloggen in Session
				$_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                $_SESSION['username'] = $_POST["mBenutzer"];
				$_SESSION['id'] = $benutzer[0]['ID'];
				$_SESSION['loggedin'] = true;
				
				// Check, ob user Adminrechte hat und Vermerkung dessen in Session
				if($benutzer[0]["Type"]== "ADMIN"){
				$_SESSION["usertype"] = 1;
				}
				else{
				$_SESSION["usertype"] = 2;	
				}
				
				// Nach Login geht es zurück auf die Startseite
				header("location: index");
				
				
			}
			// Passwort ist falsch
			else{
				echo "Passwort falsch";
			}
		}
		// Es gibt den Benutzernamen nicht
		else{
			echo "Login fehlgeschlagen";
		}
	 }		
	
	// Wird bei versuchter Registrierung ausgeführt
	if(isset($_POST["mRegistrieren"])){
		// Nutzername ist weder leer sein noch enthält er Leerzeichen
		if (count(explode(' ',$_POST["mBenutzerNeu"])) == 1 && $_POST["mBenutzerNeu"] != '') {
			// Passwort stimmt mit Wiederholung überein
			if($_POST["mPasswort1"] == $_POST["mPasswort2"]){
				$sql = "SELECT * FROM users where Name Like '".$_POST["mBenutzerNeu"]."'";
				$benutzer = $db->database->query($sql)->fetchAll();
				// Es gibt den angefragten Benutzernamen noch nicht
				if(empty($benutzer)){
					try{
						$sql = "INSERT INTO users (Name, Password, Type) VALUES ('".$_POST["mBenutzerNeu"]."','".$_POST["mPasswort1"]."', 'USER')";
						$db->database->query($sql);
						echo "Registrierung erfolgreich!";
					}
					catch(Exception $e){
						echo $e;
					}
				}
				// Der angefragte Benutzername wurde bereits vergeben
				else{
					echo "Benutzer bereits vergeben";
				}
			}
			// Das Passwort stimmt nicht mit seiner Wiederholung überein
			else{
				echo "die Passwörter stimmen nicht überein!";
			}
		} 
		// Der Benutzername entspricht nicht vorgegebener Struktur
		else {
			echo "Invalider Benutzername: der Benutzername darf weder leer sein noch Leerzeichen enthalten!";
		}
		
	}
	
	// Wird bei versuchter Abmeldung ausgeführt
	if (isset($_POST["mAbmelden"])){
			$_SESSION = array();
			session_destroy();
	}

	// Wird ausgeführt, wenn Benutzer gelöscht werden soll
	// Bei Löschung eines Benutzers werden auch alle seine Mehms gelöscht
	if (isset($_POST["mDelete"])){
		$sql = "SELECT * FROM users where Name Like '".$_SESSION["username"]."'";
		$benutzer = $db->database->query($sql)->fetchAll();
		// Passwort ist korrekt
		if ($_POST['mPasswort'] == $benutzer[0]['Password']) {
			$query = "DELETE FROM mehms WHERE UserID = " . $benutzer[0]['ID'];
			$db->database->query($query);
			$query = "DELETE FROM users WHERE ID = " . $benutzer[0]['ID'];
			$db->database->query($query);
			echo "Benutzer wurde erfolgreich gelöscht";
			$_SESSION = array();
			session_destroy();
		} 
		// Passwort ist falsch
		else {
			echo "Falsches Passwort";
		}
	}
	
	// Wenn Passwort geändert werden soll
	if (isset($_POST["mPwAendern"])){
		// Passwörter stimmen überein
		if($_POST["mPasswort1"] == $_POST["mPasswort2"]){
			$sql = "SELECT * FROM users where Name Like '".$_SESSION["username"]."'";
			$benutzer = $db->database->query($sql)->fetchAll();
			if(!empty($benutzer)){
				$sql = "UPDATE users SET Password = '".$_POST["mPasswort1"]."' WHERE ID=".$benutzer[0]["ID"]."";
				$db->database->query($sql);
				echo "Passwort erfolgreich geändert!";
			}
		}
		// Passwörter sind verschieden
		else{
			echo "die Passwörter stimmen nicht überein!";
		}
	}

	// Benutzername soll geändert werden
	if (isset($_POST["mUnAendern"])){
		$sql = "SELECT * FROM users where Name Like '".$_SESSION['username']."'";
		$benutzer = $db->database->query($sql)->fetchAll();
		// Benutzername entspricht Vorgaben
		if (count(explode(' ',$_POST["mUser"])) == 1 && $_POST["mUser"] != '') {
			// Passwort stimmt
			if($_POST["mPasswort"] == $benutzer[0]['Password']){
				$sql = "SELECT * FROM users where Name Like '".$_POST["mUser"]."'";
				$benutzer = $db->database->query($sql)->fetchAll();
				// Benutzername wurde noch nicht vergeben
				if(empty($benutzer)){
					try{ // UPDATE mehms SET Visible = TRUE, VisibleOn = now() WHERE ID=" . $index
						$sql = "UPDATE users SET Name='".$_POST["mUser"]."' WHERE ID=" .$_SESSION['id'];
						$db->database->query($sql);
						echo "Erfolgreiche Umbenennung";
					}
					catch(Exception $e){
						echo $e;
					}
				}
				// Benutzer existiert bereits
				else{
					echo "Benutzer bereits vergeben";
				}
			}
			// Passwort ist falsch
			else{
				echo "Falsches Passwort";
			}
		} 
		// Benutzername ist invalide
		else {
			echo "Invalider Benutzername: der Benutzername darf weder leer sein noch Leerzeichen enthalten!";
		}
	}
?>

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
	<?php 
	include("includes/header.php"); 
	
	
	// Überprüfung ob, man schon eingeloggt ist
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
		include("includes/login/logout.php");
	}
	else{
		include("includes/login/login.php");
	}
	
	
	
	
	?>
	
	<?php include("includes/footer.php"); ?>
	<?php include("includes/bottom-navigation.php"); ?>
	</body> 
</html>