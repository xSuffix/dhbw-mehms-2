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

    .scrolled .toolbar-wrapper {
      background: #9054f0;
      background: linear-gradient(0deg, #8662f2 0%, #7A5FF1 100%);
    }

    @media (min-width: 640px) {
      .scrolled.scroll-up .toolbar-wrapper {
        background: linear-gradient(0deg, #7874f4 0%, #8167f2 100%);
      }
    }
  </style>
</head>


<body>
  <?php include("includes/header.php"); ?>
  <?php
  require_once 'scripts/Database.php';
  require_once 'scripts/Utils.php';
  $db = new Database();

  $sortOptions = array(
    array("value" => "date", "name" => "Date"),
    array("value" => "likes", "name" => "Likes"),
    array("value" => "comments", "name" => "Comments"),
  );

  $sort = isset($_GET["sort"]) ? $_GET["sort"] : "date";
  $desc = isset($_GET["desc"]) ? $_GET["desc"] : false;
  ?>

  <main class="container">

    <form id="query" name="query" method="GET" class="toolbar-wrapper">
      <?php include("includes/toolbar/searchbar.php"); ?>

      <div class="sortbar">
        <select name="sort" id="sort" class="box" onchange="document.getElementById('query').submit()">
          <?php
          for ($i = 0; $i < count($sortOptions); $i++) {
            echo '<option value="' . $sortOptions[$i]["value"] . '" ' . ($sortOptions[$i]["value"] == $sort ? 'selected ' : '') . '>' . $sortOptions[$i]["name"] . '</option>';
          }
          ?>
        </select>
        <label for="desc" class="<?php echo $desc ? 'asc' : 'desc' ?>">
          <svg xmlns="http://www.w3.org/2000/svg" class="box desc" viewBox="0 0 20 20" fill="currentColor">
            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="box asc" viewBox="0 0 20 20" fill="currentColor">
            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
          </svg>
        </label>
        <input type="checkbox" id="desc" name="desc" <?php echo ' value="' . ($desc ? 'true" checked' : 'false"'); ?> onchange="document.getElementById('query').submit()">
      </div>
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