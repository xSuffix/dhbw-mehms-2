<!DOCTYPE html>
<html lang="de">

<head>
  <title>Home - DHBW Mehms</title>
  <link rel="stylesheet" href="./styles/index.css">
  <?php include("includes/meta.php"); ?>
</head>


<body>
  <?php include("includes/header.php"); ?>
  <?php
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
        <select name="sort" id="sort" onchange="document.getElementById('query').submit()">
          <?php
            for ($i = 0; $i < count($sortOptions); $i++) {
              echo '<option value="' . $sortOptions[$i]["value"] . '" ' . ($sortOptions[$i]["value"] == $sort ? 'selected ' : '') . '>' . $sortOptions[$i]["name"] . '</option>';
            }
          ?>
        </select>
        <label for="desc">desc</label>
        <input type="checkbox" id="desc" name="desc" <?php echo ' value="' . ($desc ? 'true" checked' : 'false"'); ?> onchange="document.getElementById('query').submit()">
      </div>
</form>


    <div id="mehm-gallery">
      <?php 

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