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

    @media (min-width: 640px) {
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

    <form id="query" name="query" method="GET" class="toolbar">
      <?php include("includes/toolbar/search-box.php"); ?>
      <?php include("includes/toolbar/sort-box.php"); ?>
      <?php include("includes/toolbar/order-box.php"); ?>
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
      Utils::getMehmCards($db, $sort, $desc, false)

      ?>
      <div id="theater"></div>
    </div>
  </main>

  <?php include("includes/footer.php"); ?>
  <?php include("includes/bottom-navigation.php"); ?>
</body>

</html>