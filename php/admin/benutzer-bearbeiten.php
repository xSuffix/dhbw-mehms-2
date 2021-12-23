<?php
require_once '../scripts/Utils.php';
Utils::checkLogin(true);

// Define path to php folder for includes in meta.php
$ROOT = '../';
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <title>Benutzerübersicht - DHBW Admin</title>
    <link href="../css/formular.css" rel="stylesheet">
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
        <h2>Benutzer bearbeiten</h2>
    </div>

    <section class="paper">
        <h1> Gespeicherte Nutzerdaten: </h1>
        <?php
        require_once 'scripts/Database.php';
        $db = new Database();

        $benutzer = $db->getUser($_GET["id"]);
        $benutzer = $benutzer[0];
        $isAdmin = $benutzer["Type"] == 'ADMIN';

        echo '<form action="benutzer-uebersicht.php" method="post" enctype="multipart/form-data">
            <label for="id">Nutzer-ID</label>
            <input id="id" required type="text" name="mId" value="' . $benutzer["ID"] . '" readonly>
            <label for="benutzer" class="required">Benutzer</label>
            <input id="benutzer" required type="text" placeholder="Benutzer" name="mBenutzer" value="' . $benutzer["Name"] . '">
            <label for="passwort" class="required">Passwort</label>
            <input id="passwort" required type="password" placeholder="Passwort" name="mPasswort" value="' . $benutzer["Password"] . '">
            <label for="type" class="required">Typ</label>
            <select name="mType" id="type" required>
              <option value="ADMIN"';
        echo $isAdmin ? "selected" : "";
        echo '>Admin</option>
              <option value="USER"';
        echo !$isAdmin ? "selected" : "";
        echo '>User</option>
            </select>
            <button>Bestätigen</button>
        </form>';
        ?>

    </section>
</main>
<?php include("includes/footer.php"); ?>
<?php include("includes/bottom-navigation.php"); ?>
</body>

</html>