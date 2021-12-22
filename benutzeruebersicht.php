<?php
require_once 'scripts/Utils.php';
Utils::checkLogin(true);
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
	<?php include("includes/header.php");
    require_once 'scripts/Database.php';
    $db = new Database();

    if (isset($_POST["mBenutzer"]) && isset($_POST["mPasswort"]) && isset($_POST["mType"])) {
        updateUser();
    }

    // Diese Funktion updated einen User, nachdem er von einem Admin bearbeitet wurde.
    function updateUser() {
        global $db;
        $db->updateUser($_POST["mId"], $_POST["mBenutzer"], $_POST["mPasswort"], $_POST["mType"]);
    }
    ?>

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
              <th id="edit">Bearbeiten</th>
		  </tr>
		  </thead>
		  <tbody>
			<?php
				$benutzer = $db->getUser(0);
				
				// Tabelleneintrag für jeden User erstellen
				if(!empty($benutzer)){
					for($i = 0; $i < count($benutzer); $i++){
						echo "<tr>
								<td>".$benutzer[$i]["Name"]."</td>
								<td>".$benutzer[$i]["ID"]."</td>
								<td>".$benutzer[$i]["Type"]."</td>
								<td><a href=benutzerbearbeiten.php?id=".$benutzer[$i]["ID"]." class='button'>Bearbeiten</a></td>
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