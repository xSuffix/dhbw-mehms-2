<?php
require_once 'scripts/Utils.php';
Utils::checkLogin(true);
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <title>Benutzerübersicht - DHBW Admin</title>
    <link href="styles/formular.css" rel="stylesheet">
    <?php include("includes/meta.php"); ?>
    <style>
        :root {
            --banner-top: #67bfeb;
            --banner-bottom: #fdea04;
        }

        a.button {
            -webkit-appearance: button;
            -moz-appearance: button;
            appearance: button;

            text-decoration: none;
            color: initial;
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

        echo '<form action="benutzeruebersicht.php" method="post" enctype="multipart/form-data">
            <label for="id">Nutzer-ID</label>
            <input id="id" required type="text" name="mId" value="' . $benutzer["ID"] . '" readonly>
            <br>
            <label for="benutzer" class="required">Benutzer</label>
            <input id="benutzer" required type="text" placeholder="Benutzer" name="mBenutzer" value="' . $benutzer["Name"] . '">
            <br>
            <label for="passwort" class="required">Passwort</label>
            <input id="passwort" required type="password" placeholder="Passwort" name="mPasswort" value="' . $benutzer["Password"] . '">
            <br>
            <label for="type" class="required">Typ</label>
            <select name="mType" id="type" required>
                <option value="ADMIN"';
                 echo $isAdmin ? "selected" : "";
                 echo '>Admin</option>
                <option value="USER"';
                 echo !$isAdmin ? "selected" : "";
                 echo '>User</option>
            </select>
            <br>
            <button>Bestätigen</button>
        </form>';

        ?>

        <br>
    </section>
</main>
<?php include("includes/footer.php"); ?>
<?php include("includes/bottom-navigation.php"); ?>
</body>
</html>