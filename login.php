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
	}
	
	//Abmelden
	if (isset($_POST["mAbmelden"])){
			$_SESSION = array();
			session_destroy();
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