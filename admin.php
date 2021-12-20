<!DOCTYPE html>
<html lang="de">

<head>
  <title>Admin - DHBW Mehms</title>
  <link rel="stylesheet" href="./styles/index.css">
  <link rel="stylesheet" href="./styles/admin.css">
  <link rel="stylesheet" href="./styles/toolbar.css">
  <script type="text/javascript" src="./scripts/select-mehms.js"></script>
  <?php include("includes/meta.php"); ?>
  <style>
    :root {
      --banner-top: #60c9b1;
      --banner-bottom: #ffffff;
    }

    .scrolled .toolbar {
      background: #6E8ED9;
      background: linear-gradient(0deg, #6E8ED9 0%, #7293DC 100%);
    }

    @media (min-width: 640px) {
      .scrolled.scroll-up .toolbar {
        background: linear-gradient(0deg, #769BE0 0%, #7293DC 100%);
      }
    }
  </style>
</head>


<body>
  <?php
  include("includes/header.php");
  require_once 'scripts/Database.php';
  require_once 'scripts/Utils.php';
  $db = new Database();


  ?>
  <?php

  ?>

  <main class="container">

    <form id="query" name="query" method="GET" class="toolbar">
      <?php include("includes/toolbar/search-box.php"); ?>
      <?php include("includes/toolbar/new-box.php"); ?>
      <?php include("includes/toolbar/order-box.php"); ?>
    </form>


    <div id="mehm-gallery">
      <?php

      function approveMehm($index) {
        global $db;
        $db->database->query("UPDATE mehms SET Visible = TRUE, VisibleOn = now() WHERE ID=" . $index);
      }

      function declineMehm($index) {
        global $db;
        $db->database->query("UPDATE mehms SET Visible = FALSE, VisibleOn = NULL WHERE ID=" . $index);
      }

      if ($new) {
        Utils::getMehmCards($db, "none", $desc, true);
      } else {
        Utils::getMehmCards($db, "notVisibleOnly", $desc, true);
      }

      ?>
      <div id="theater"></div>
    </div>
  </main>

  <?php include("includes/footer.php"); ?>
  <?php include("includes/bottom-navigation.php"); ?>
</body>

</html>