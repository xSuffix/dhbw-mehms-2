<?php
	session_start(); 
	
	//überprüfung ob Admin eingeloggt
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["usertype"] == 1){	
	}
	else{
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
		
		<section class="paper">
		
		<table>
		<thead>
		  <tr>
			<th>Benutzer</th>
			<th>ID</th>
			<th>Typ</th>
		  </tr>
		  </thead>
		  <tbody>
			<?php
				require_once 'scripts/Database.php';
				$db = new Database();
		
				$sql = "SELECT * FROM users";
				$benutzer = $db->database->query($sql)->fetchAll();
				
				//Tabelleneintrag für jeden user erstellen
				if(!empty($benutzer)){
					
				}
				for($i =0; $i <count($benutzer); $i++){
					echo "<tr>
							<td>".$benutzer[$i]["Name"]."</td>
							<td>".$benutzer[$i]["ID"]."</td>
							<td>".$benutzer[$i]["Type"]."</td>
						  </tr>";
				}
			?>
		</tbody>
		</table>
		</section>
	
	</main>
</body>
</html>