<!DOCTYPE html>
<html lang="de">

<head>
  <title>Admin - DHBW Mehms</title>
  <link rel="stylesheet" href="./styles/index.css">
  <link rel="stylesheet" href="./styles/admin.css">
  <?php include("includes/meta.php"); ?>
  <style>
    :root {
      --banner-top: #60c9b1;
      --banner-bottom: #ffffff;
    }

    .scrolled .toolbar-wrapper {
      background: #6E8ED9;
      background: linear-gradient(0deg, #6E8ED9 0%, #7293DC 100%);
    }

    @media (min-width: 640px) {
      .scrolled.scroll-up .toolbar-wrapper {
        background: linear-gradient(0deg, #769BE0 0%, #7293DC 100%);
      }
    }
  </style>
  <script>
    function approveMehm() {
      console.log("Approving not implemented")
      return false
    }

    function declineMehm() {
      console.log("Declining not implemented")
      return false
    }
  </script>
</head>


<body>
  <?php include("includes/header.php"); ?>
  <?php

  $search = isset($_GET["search"]) ? $_GET["search"] : "";
  $new = isset($_GET["new"]) ? $_GET["new"] : false;
  $desc = isset($_GET["desc"]) ? $_GET["desc"] : false;
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
        <label for="new" class="<?php echo $new ? 'new' : 'all' ?>">
          <svg xmlns="http://www.w3.org/2000/svg" class="box new" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm0 2h10v7h-2l-1 2H8l-1-2H5V5z" clip-rule="evenodd" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" class="box all" viewBox="0 0 20 20" fill="currentColor">
            <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
            <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd" />
          </svg>
        </label>
        <input type="checkbox" id="new" name="new" <?php echo ' value="' . ($new ? 'true" checked' : 'false"'); ?> onchange="document.getElementById('query').submit()">

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
              $sizes[1] / $sizes[0] * 100 . '%"></div><img src="' . $image . '" loading="lazy" name="' .
              $imageName . '" alt="" /><div class="admin-overlay">' .
              '<div><div class="box" onclick="approveMehm()"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg></div> Approve </div>' .
              '<div><div class="box" onclick="declineMehm()"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd" /></svg></div> Decline </div>' .
              '</div></a>';
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