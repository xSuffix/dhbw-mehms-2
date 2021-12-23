<!DOCTYPE html>
<html lang="de">

<head>
  <link href="../css/formular.css" rel="stylesheet">
  <meta charset="UTF-8">
  <title> Kontaktformular - erfolgreich gesendet </title>
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
      <h2>Sehr geehrte/-r
        <strong>
          <?php
          echo $_POST["kName"];
          ?>
        </strong>
      </h2>
      Vielen Dank, dass du uns diese Nachricht gesendet hast:
      <div class="response">
        <?php
        echo $_POST["kNachricht"];
        ?>
      </div>

      Wir werden dir schnellstmöglich an
      <strong>
        <?php
        echo $_POST["kMail"];
        ?>
      </strong>
      antworten.
    </section>
  </main>

  <?php include("includes/footer.php"); ?>
  <?php include("includes/bottom-navigation.php"); ?>
</body>

</html>