<?php
require_once 'scripts/Utils.php';
Utils::checkLogin(true);
?>

<!DOCTYPE html>
<html lang="de">

<head>
  <link href="../css/formular.css" rel="stylesheet">
  <meta charset="UTF-8">
  <title> Dein Mehm - Upload </title>
  <?php include("includes/meta.php"); ?>
  <style>
    :root {
      --banner-top: #b167eb;
      --banner-bottom: #4bd8f6;
    }
  </style>
</head>

<body>
  <?php include("includes/header.php"); ?>
  <main class="container">
    <section class="paper">
      <?php
      require_once 'scripts/Database.php';
      $db = new Database();

      if (!isset($_FILES["mDatei"])) {
        echo "<h1> Es wurde keine Datei hochgeladen. Versuche es bitte erneut.</h1>";
        return;
      }

      // Verschiebe das hochgeladene Mehm in den assets/mehm/ Ordner.
      $target_dir = "../assets/mehms/";
      $filename = $_FILES["mDatei"]["name"];

      // Ersetze böse Zeichen aus dem Pfad
      $filename = str_replace(' ', '-', $filename);
      $filename = str_replace('#', '-', $filename);
      $filename = str_replace('[', '-', $filename);
      $filename = str_replace(']', '-', $filename);
      $filename = str_replace('(', '-', $filename);
      $filename = str_replace(')', '-', $filename);
      $filename = str_replace('ä', '-', $filename);
      $filename = str_replace('ö', '-', $filename);
      $filename = str_replace('ü', '-', $filename);
      $filename = str_replace('&', '-', $filename);

      $target_file = $target_dir . $filename;
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

      // Prüfe, ob Dateiformat erlaubt ist.
      if ($imageFileType == 'png' || $imageFileType == 'jpg' || $imageFileType == 'jpeg' || $imageFileType == 'gif' || $imageFileType == 'webp') {

        if (move_uploaded_file($_FILES["mDatei"]["tmp_name"], $target_file)) {
          // Hole notwendige Parameter aus POST und schreibe die Informationen in die Datenbank.
          $desc = $_POST["mBildbeschreibung"] == '' ? NULL : $_POST["mBildbeschreibung"];
          $kategorie = $_POST["mKategorie"];
          $title = $_POST["mTitel"];
          $userID = $_SESSION['id'];

          try {
                $result = $db->database->query("INSERT INTO mehms (Path, Title, UserID, Type, Description) VALUES (
                    '$filename',
                    '$title',
                    '$userID',
                    '$kategorie',
                    '$desc');");
          } catch (PDOException $e) {
            echo "<h1> Ein Fehler ist aufgetreten. Möglicherweise existiert das Mehm schon. Versuche es ansonsten mit einem anderen Dateinamen.</h1>";
            return;
          }

          echo "<h1> Viele Dank für deine Einsendung der Kategorie " . $_POST["mKategorie"] . "!</h1> <br><p class=\"response\"> Die Datei " . htmlspecialchars(basename($_FILES["mDatei"]["name"])) . " wurde erfolgreich hochgeladen. </p>";
        } else {
          echo "<h1> Tut uns Leid, es ist ein Fehler aufgetreten. Bitte versuche es erneut!</h1>";
        }
      } else {
        echo "<h1>Falsches Dateiformat! Bitte benutze nur .png .jpg .jpeg .gif oder .webp</h1>";
      }
      ?>
    </section>
  </main>
  <?php include("includes/footer.php"); ?>
  <?php include("includes/bottom-navigation.php"); ?>
</body>

</html>