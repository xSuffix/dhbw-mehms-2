<!DOCTYPE html>
<html lang="de">

<head>
  <title>Home - DHBW Mehms</title>
  <link rel="stylesheet" href="./styles/index.css">
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
  $db = new Database();
  $db = $db->connectToDatabase();

  $sortOptions = array(
    array("value" => "date", "name" => "Date"),
    array("value" => "likes", "name" => "Likes"),
    array("value" => "comments", "name" => "Comments"),
  );

  $search = isset($_GET['search']) ? $_GET["search"] : "";
  $sort = isset($_GET['sort']) ? $_GET["sort"] : "date";
  $desc = isset($_GET['desc']) ? $_GET["desc"] : false;
  ?>

  <main class="container">

    <form id="query" name="query" method="GET" class="toolbar-wrapper">
      <div class="searchbar">
        <svg xmlns="http://www.w3.org/2000/svg" class="i-search" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
        </svg>
        <input name="search" type="text" spellcheck="false" autocomplete="off" placeholder="Search Mehms" value="<?php echo $search ?>">

      </div>
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

      # TODO: Add comment
      function ignoreCase($str)
      {
        $res = "";
        $len = strlen($str);
        for ($i = 0; $i < $len; $i++) {
          $res = $res . "[" . strtolower($str[$i]) . strtoupper($str[$i]) . "]";
        }
        return $res;
      }

      $dirname = "./assets/mehms/";
      $images = glob($dirname . "*" . ignoreCase($search) . "*");
      if ($sort == "likes") {
          $images = $db->query("SELECT Path FROM mehms ORDER BY Likes ASC")->fetchAll();
#          $images = call_user_func_array('array_merge', $images);
          print_r($images);
          return;
      }

      foreach ($images as $image) {

        $imageName = explode("/", $image);
        $imageName = end($imageName);
        if ($image != "./assets/mehms/rick.gif") {
          $sizes = getimagesize($image);
          try {
            echo '<a class="mehm-card" style="width:' . $sizes[0] * 300 / $sizes[1] .
              'px; flex-grow: ' . $sizes[0] * 300 / $sizes[1] . '"><div style="padding-top: ' .
              $sizes[1] / $sizes[0] * 100 . '%"></div><img src="' . $image . '" loading="lazy" name="' . $imageName . '" alt="" /></a>';
          } catch (DivisionByZeroError $e) {
          }
        }
      } ?>
      <div id="theater"></div>
    </div>
  </main>

  <?php include("includes/footer.php"); ?>
  <?php include("includes/bottom-navigation.php"); ?>
</body>

</html>