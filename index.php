<!DOCTYPE html>
<html lang="de">

<head>
  <title>Home - DHBW Mehms</title>
  <link rel="stylesheet" href="./styles/index.css">
  <?php include("includes/meta.php"); ?>
</head>


<body>
  <?php include("includes/header.php"); ?>

  <main class="container">

    <div class="toolbar-wrapper">
      <div class="toolbar">
        <svg xmlns="http://www.w3.org/2000/svg" class="i-search" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
        </svg>
        <form name="search" method="GET">
          <input name="search" type="text" spellcheck="false" autocomplete="off" placeholder="Search Mehms">
        </form>
      </div>
    </div>


    <div id="mehm-gallery">
      <?php $search = "";
      if (isset($_GET['search'])) {
        $search = $_GET['search'];
      }

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