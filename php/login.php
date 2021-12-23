<?php
session_start();

require_once 'scripts/Database.php';
$db = new Database();
const BASE_QUERY = "SELECT * FROM users where Name Like '";

$text = '';
$error = false;

// Wird bei einer versuchten Anmeldung ausgeführt
if (isset($_POST["mAnmelden"])) {
    // Nutzerdaten werden mit der Datenbank abgeglichen
    $sql = BASE_QUERY . $_POST["mBenutzer"] . "'";
    $benutzer = $db->database->query($sql)->fetchAll();

    // Es gibt den eingetragenen Benutzer
    if (!empty($benutzer)) {
        // Das Passwort stimmt überein
        if ($benutzer[0]["Password"] == $_POST["mPasswort"]) {
            // Erfolgreicher Login!
            // Einloggen in Session
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $_POST["mBenutzer"];
            $_SESSION['id'] = $benutzer[0]['ID'];
            $_SESSION['loggedIn'] = true;

            // Check, ob user Adminrechte hat und vermerke das in Session
            if ($benutzer[0]["Type"] == "ADMIN") {
                $_SESSION["usertype"] = 1;
            } else {
                $_SESSION["usertype"] = 2;
            }

            // Nach Login geht es zurück auf die Startseite
            header("location: mehms");

        } // Passwort ist falsch
        else {
            $text = "Falsches Passwort";
            $error = true;
        }
    } // Es gibt den Benutzernamen nicht
    else {
        $text = "Benutzername unbekannt";
        $error = true;
    }
}

// Wird bei versuchter Registrierung ausgeführt
if (isset($_POST["mRegistrieren"])) {
    // Nutzername ist weder leer sein noch enthält er Leerzeichen
    if (count(explode(' ', $_POST["mBenutzerNeu"])) == 1 && $_POST["mBenutzerNeu"] != '') {
        // Passwort stimmt mit Wiederholung überein
        if ($_POST["mPasswort1"] == $_POST["mPasswort2"]) {
            $sql = BASE_QUERY . $_POST["mBenutzerNeu"] . "'";
            $benutzer = $db->database->query($sql)->fetchAll();
            // Es gibt den angefragten Benutzernamen noch nicht
            if (empty($benutzer)) {
                try {
                    $sql = "INSERT INTO users (Name, Password, Type) VALUES ('" . $_POST["mBenutzerNeu"] . "','" . $_POST["mPasswort1"] . "', 'USER')";
                    $db->database->query($sql);
                    $text = "Registrierung erfolgreich!";
                } catch (Exception $e) {
                    $text = $e;
                }
            } // Der angefragte Benutzername wurde bereits vergeben
            else {
                $text = "Benutzername bereits vergeben";
                $error = true;
            }
        } // Das Passwort stimmt nicht mit seiner Wiederholung überein
        else {
            $text = "Die Passwörter stimmen nicht überein!";
            $error = true;
        }
    } // Der Benutzername entspricht nicht vorgegebener Struktur
    else {
        $text = "Invalider Benutzername: der Benutzername darf weder leer sein noch Leerzeichen enthalten!";
        $error = true;
    }

}

// Wird bei versuchter Abmeldung ausgeführt
if (isset($_POST["mAbmelden"])) {
    $_SESSION = array();
    session_destroy();
}

// Wird ausgeführt, wenn Benutzer gelöscht werden soll
// Bei Löschung eines Benutzers werden auch alle seine Mehms gelöscht
if (isset($_POST["mDelete"])) {
    $sql = BASE_QUERY . $_SESSION["username"] . "'";
    $benutzer = $db->database->query($sql)->fetchAll();
    // Passwort ist korrekt
    if ($_POST['mPasswort'] == $benutzer[0]['Password']) {
        $db->deleteUser($benutzer[0]['ID']);
        $text = "Benutzer wurde erfolgreich gelöscht";
        $_SESSION = array();
        session_destroy();
    } // Passwort ist falsch
    else {
        $text = "Falsches Passwort";
        $error = true;
    }
}

// Wenn Passwort geändert werden soll
if (isset($_POST["mPwAendern"])) {
    // Passwörter stimmen überein
    if ($_POST["mPasswort1"] == $_POST["mPasswort2"]) {
        $sql = BASE_QUERY . $_SESSION["username"] . "'";
        $benutzer = $db->database->query($sql)->fetchAll();
        if (!empty($benutzer)) {
            $sql = "UPDATE users SET Password = '" . $_POST["mPasswort1"] . "' WHERE ID=" . $benutzer[0]["ID"];
            $db->database->query($sql);
            $text = "Passwort erfolgreich geändert!";
        }
    } // Passwörter sind verschieden
    else {
        $text = "Die Passwörter stimmen nicht überein!";
        $error = true;
    }
}

// Benutzername soll geändert werden
if (isset($_POST["mUnAendern"])) {
    $sql = BASE_QUERY . $_SESSION['username'] . "'";
    $benutzer = $db->database->query($sql)->fetchAll();
    // Benutzername entspricht Vorgaben
    if (count(explode(' ', $_POST["mUser"])) == 1 && $_POST["mUser"] != '') {
        // Passwort stimmt
        if ($_POST["mPasswort"] == $benutzer[0]['Password']) {
            $sql = BASE_QUERY . $_POST["mUser"] . "'";
            $benutzer = $db->database->query($sql)->fetchAll();
            // Benutzername wurde noch nicht vergeben
            if (empty($benutzer)) {
                try {
                    $sql = "UPDATE users SET Name='" . $_POST["mUser"] . "' WHERE ID=" . $_SESSION['id'];
                    $db->database->query($sql);
                    $text = "Erfolgreiche Umbenennung";
                } catch (Exception $e) {
                    $text = $e;
                }
            } // Benutzer existiert bereits
            else {
                $text = "Benutzer bereits vergeben";
                $error = true;
            }
        } // Passwort ist falsch
        else {
            $text = "Falsches Passwort";
            $error = true;
        }
    } // Benutzername ist invalide
    else {
        $text = "Invalider Benutzername: der Benutzername darf weder leer sein noch Leerzeichen enthalten!";
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <link href="../css/formular.css" rel="stylesheet">
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

// Überprüfung, ob man schon eingeloggt ist
if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true) {
    include("includes/login/logout.php");
} else {
    include("includes/login/login.php");
}

?>

<?php include("includes/footer.php"); ?>
<?php include("includes/bottom-navigation.php"); ?>
</body>
</html>