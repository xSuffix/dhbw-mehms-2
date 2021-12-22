<?php
session_start();
?>
<!DOCTYPE html>
<html lang="de">

<head>
  <title>Home - DHBW Mehms</title>
  <link rel="stylesheet" href="./styles/index.css">
  <link rel="stylesheet" href="./styles/toolbar.css">
  <script type="text/javascript" src="./scripts/rick-roll.js"></script>
  <?php include("includes/meta.php"); ?>
  <style>
    :root {
      --banner-top: #b167eb;
      --banner-bottom: #4bd8f6;
    }

    /* Color for selected page in navigation */
    .home {
      animation: 0.2s color-p-primary forwards;
    }

    .scrolled .toolbar {
      background: #9054f0;
      background: linear-gradient(0deg, #8662f2 0%, #7A5FF1 100%);
    }

    @media (min-width: 720px) {
      .scrolled.scroll-up .toolbar {
        background: linear-gradient(0deg, #7874f4 0%, #8167f2 100%);
      }
    }
  </style>
</head>


<body>
  <?php include("includes/header.php");
  require_once "scripts/Database.php";
  require_once "scripts/Utils.php";
  $db = new Database();
  ?>

  <main class="container">
    <?php if (isset($_SESSION["loggedin"]) && $_SESSION["usertype"] == 1) echo '
      <div class="admin">
        <a href="./admin" class="box">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
          </svg>
          Admin
        </a>
      </div>'
    ?>

    <form id="query" name="query" method="GET" class="toolbar">
      <?php
      $myMehms = false;
      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
        include("includes/toolbar/mymehms.php");
      }
      include("includes/toolbar/search-box.php");
      include("includes/toolbar/filter-box.php");
      include("includes/toolbar/sort-box.php");
      include("includes/toolbar/order-box.php");
      ?>
    </form>

    <div id="mehm-gallery">
      <?php

      # Array (
      # [0] => Array (
      #   [ID] => 1
      #   [0] => 1
      #   [Path] => Algorithm_Parrot.jpg
      #   [1] => Algorithm_Parrot.jpg
      #   [Likes] => 20
      #   [2] => 20
      #   [Type] => PROGRAMMING
      #   [3] => PROGRAMMING
      #   [Description] =>
      #   [4] =>
      #   [Visible] => 1
      #   [5] => 1
      #   [VisibleOn] => 2021-12-20 11:23:44
      #   [6] => 2021-12-20 11:23:44
      # )
      $filter = Utils::extractUser($search);
      if (!$myMehms) {
        Utils::getMehmCards($db, $filter, $category, $sort, $desc, false, false);
      } else {
        Utils::getMehmCards($db, $filter, $category, $sort, $desc, false, true);
      }

      ?>
      <div id="theater"></div>
    </div>
  </main>

  <?php include("includes/footer.php"); ?>
  <?php include("includes/bottom-navigation.php"); ?>
</body>

</html>