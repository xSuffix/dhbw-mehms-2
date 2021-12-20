<!DOCTYPE html>
<html lang="de">

<head>
  <title>Mehm - DHBW Mehms</title>
  <link rel="stylesheet" href="./styles/toolbar.css">
  <link rel="stylesheet" href="./styles/mehm.css">
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
  <?php
  require_once 'scripts/Database.php';
  require_once 'scripts/Utils.php';
  $db = new Database();

  // Get specific Mehms from Database by ID.
  function getMehm($id, $admin): array {
    $query = 'SELECT * FROM mehms WHERE ID = ' . $id;

    if (!$admin) {
      $query .= ' WHERE Visible = TRUE';
    }

    global $db;
    try {
      return $db->database->query($query)->fetchAll();
    } catch(PDOException $e) {
      return [];
    }
  }

  $id = isset($_GET["id"]) ? $_GET["id"] : "";
  $search = isset($_GET["search"]) ? $_GET["search"] : "";

  // Redirect to index.php if no id parameter to specify mehm is available
  if ($id == "") {
    header('Location: .');
    exit;
  }

  $mehms = getMehm($id, true);
  print_r($mehms);
  if (count($mehms) == 0) {
    header('Location: .');
    exit;
  }

  ?>

  <?php include("includes/header.php"); ?>

  <main class="container">

    <form id="query" name="query" action="." method="GET" class="toolbar-wrapper">
      <div class="searchbar">
        <svg xmlns="http://www.w3.org/2000/svg" class="i-search" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
        </svg>
        <input name="search" type="text" spellcheck="false" autocomplete="off" placeholder="Search Mehms" value="<?php echo $search ?>">

      </div>
    </form>

    <div class="content">
      <div class="paper">test</div>
      <aside class="paper"></aside>
    </div>

  </main>

  <?php include("includes/footer.php"); ?>
  <?php include("includes/bottom-navigation.php"); ?>
</body>

</html>