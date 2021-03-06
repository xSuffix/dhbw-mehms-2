<?php
// Define path to php folder for includes
$ROOT = '../';

require_once $ROOT . 'scripts/utils.php';
Utils::checkLogin(true);
?>

<!DOCTYPE html>
<html lang="de">

<head>
  <title>Benutzerübersicht - DHBW Admin</title>
  <link href="<?php echo $ROOT ?>../css/table.css" rel="stylesheet">
  <?php include($ROOT . "includes/meta.php"); ?>
  <style>
    :root {
      --banner-top: #67bfeb;
      --banner-bottom: #fdea04;
    }

    .paper {
      padding: 2rem 1rem;
    }
  </style>
</head>

<body>
  <?php
  include($ROOT . "includes/header.php");
  require_once $ROOT . 'scripts/database.php';
  $db = new Database();

  if (isset($_POST["mBenutzer"]) && isset($_POST["mPasswort"]) && isset($_POST["mType"])) {
    $db->updateUser($_POST["mId"], $_POST["mBenutzer"], $_POST["mPasswort"], $_POST["mType"]);
  }

  if (isset($_GET["delete"])) {
    $db->deleteUser($_GET["id"]);
  }
  ?>

  <main class="container">
    <div class="heading">
      <h1>Admin</h1>
      <h2>Benutzerübersicht</h2>
    </div>

    <div class="paper">
      <table>
        <thead>
          <tr>
            <th id="user">Benutzer</th>
            <th id="id">ID</th>
            <th id="type">Typ</th>
            <th id="edit">Bearbeiten</th>
            <th id="delete">Löschen</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $benutzer = $db->getUser(0);

          // Tabelleneintrag für jeden User erstellen
          if (!empty($benutzer)) {
            for ($i = 0; $i < count($benutzer); $i++) {
              echo '<tr>
								<td>' . $benutzer[$i]["Name"] . '</td>
								<td>' . $benutzer[$i]["ID"] . '</td>
								<td>' . $benutzer[$i]["Type"] . '</td>
								<td><a href="benutzer-bearbeiten?id=' . $benutzer[$i]["ID"] . '" class="underline">Bearbeiten</a></td>
								<td><a href="benutzer-uebersicht?id=' . $benutzer[$i]["ID"] . '&delete=true" class="underline">Löschen</a></td>
							  </tr>';
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </main>
  <?php include($ROOT . "includes/footer.php"); ?>
  <?php include($ROOT . "includes/bottom-navigation.php"); ?>
</body>

</html>