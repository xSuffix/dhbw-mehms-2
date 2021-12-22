<?php
	session_start(); 
	
	require_once 'scripts/Database.php';
	$db = new Database();
	
	//Anmelden
	if(isset($_POST["mAnmelden"])){	
		//Abgleich Nutzerdaten mit der Datenbank
		$sql = "SELECT * FROM users where Name Like '".$_POST["mBenutzer"]."'";
		$benutzer = $db->database->query($sql)->fetchAll();
		
		if(!empty($benutzer)){
			if($benutzer[0]["Password"] == $_POST["mPasswort"]){				
				//Einloggen in Session
				$_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                $_SESSION['username'] = $_POST["mBenutzer"];
				$_SESSION['id'] = $benutzer[0]['ID'];
				$_SESSION['loggedin'] = true;
				
				//Check ob user Admin
				if($benutzer[0]["Type"]== "ADMIN"){
				$_SESSION["usertype"] = 1;
				}
				else{
				$_SESSION["usertype"] = 2;	
				}
				
				//Nach einloggen zurück zur Startseite
				header("location: index");
				
				
			}
			else{
				echo "Passwort falsch";
			}
		}
		else{
			echo "Login fehlgeschlagen";
		}
	 }		
	
	//Registrieren
	if(isset($_POST["mRegistrieren"])){
		if (count(explode(' ',$_POST["mBenutzerNeu"])) == 1 && $_POST["mBenutzerNeu"] != '') {
			if($_POST["mPasswort1"] == $_POST["mPasswort2"]){
				$sql = "SELECT * FROM users where Name Like '".$_POST["mBenutzerNeu"]."'";
				$benutzer = $db->database->query($sql)->fetchAll();
				
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
				else{
					echo "Benutzer bereits vergeben";
				}
			}
			else{
				echo "die Passwörter stimmen nicht überein!";
			}
		} else {
			echo "Invalider Benutzername: der Benutzername darf weder leer sein noch Leerzeichen enthalten!";
		}
		
	}
	
	//Abmelden
	if (isset($_POST["mAbmelden"])){
			$_SESSION = array();
			session_destroy();
	}

	//Benutzer löschen
	if (isset($_POST["mDelete"])){
		$sql = "SELECT * FROM users where Name Like '".$_SESSION["username"]."'";
		$benutzer = $db->database->query($sql)->fetchAll();
		if ($_POST['mPasswort'] == $benutzer[0]['Password']) {
			$query = "DELETE FROM mehms WHERE UserID = " . $benutzer[0]['ID'];
			$db->database->query($query);
			$query = "DELETE FROM users WHERE ID = " . $benutzer[0]['ID'];
			$db->database->query($query);
			echo "Benutzer wurde erfolgreich gelöscht";
			$_SESSION = array();
			session_destroy();
		} else {
			echo "Falsches Passwort";
		}
	}
	
	//Passwort ändern
	if (isset($_POST["mPwAendern"])){
		if($_POST["mPasswort1"] == $_POST["mPasswort2"]){
			$sql = "SELECT * FROM users where Name Like '".$_SESSION["username"]."'";
			$benutzer = $db->database->query($sql)->fetchAll();
			if(!empty($benutzer)){
				$sql = "UPDATE users SET Password = '".$_POST["mPasswort1"]."' WHERE ID=".$benutzer[0]["ID"]."";
				$db->database->query($sql);
				echo "Passwort erfolgreich geändert!";
			}
		}
		else{
			echo "die Passwörter stimmen nicht überein!";
		}
	}

	if (isset($_POST["mUnAendern"])){
		$sql = "SELECT * FROM users where Name Like '".$_SESSION['username']."'";
		$benutzer = $db->database->query($sql)->fetchAll();
		if (count(explode(' ',$_POST["mUser"])) == 1 && $_POST["mUser"] != '') {
			if($_POST["mPasswort"] == $benutzer[0]['Password']){
				$sql = "SELECT * FROM users where Name Like '".$_POST["mUser"]."'";
				$benutzer = $db->database->query($sql)->fetchAll();
				
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
				else{
					echo "Benutzer bereits vergeben";
				}
			}
			else{
				echo "Falsches Passwort";
			}
		} else {
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
	
	
	//überprüfung ob schon eingeloggt
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