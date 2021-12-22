<?php
	session_start(); 
	
	// Überprüfung ob Admin eingeloggt ist
	if (!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["usertype"] == 1)){
		header("location: index.php");
		exit;
	}
?>

<!DOCTYPE html>
<html lang="de">

<head>
	<title>Benutzerübersicht - DHBW Admin</title>
	<link href="styles/numbers.css" rel="stylesheet">
	<?php include("includes/meta.php"); ?>
	<style>
		:root {
			--banner-top: #67bfeb;
			--banner-bottom: #fdea04;
		}

    </style>
</head>

<body>
	<?php include("includes/header.php"); ?>

	<main class="container">
		<div class="heading">
			<h1>Admin</h1>
			<h2>Benutzerübersicht</h2>
		</div>
		
		<div class="paper">
		<br>
		<table>
		<thead>
		  <tr>
			<th id="user">Benutzer</th>
			<th id="id">ID</th>
			<th id="type">Typ</th>
		  </tr>
		  </thead>
		  <tbody>
			<?php
				require_once 'scripts/Database.php';
				$db = new Database();
		
				$sql = "SELECT * FROM users";
				$benutzer = $db->database->query($sql)->fetchAll();
				
				// Tabelleneintrag für jeden User erstellen
				if(!empty($benutzer)){
					for($i =0; $i <count($benutzer); $i++){
						echo "<tr>
								<td>".$benutzer[$i]["Name"]."</td>
								<td>".$benutzer[$i]["ID"]."</td>
								<td>".$benutzer[$i]["Type"]."</td>
							  </tr>";
					}
				}
			?>
		</tbody>
		</table>
		<br>
		</div>	
	</main>
	<?php include("includes/footer.php"); ?>
	<?php include("includes/bottom-navigation.php"); ?>
</body>
</html>