<!DOCTYPE html>
<html lang="de">

<head>
  <title>Mehm - DHBW Mehms</title>
  <link rel="stylesheet" href="./styles/toolbar.css">
  <link rel="stylesheet" href="./styles/mehm.css">
  <script src="https://cdn.jsdelivr.net/npm/jdenticon@3.1.1/dist/jdenticon.min.js" integrity="sha384-l0/0sn63N3mskDgRYJZA6Mogihu0VY3CusdLMiwpJ9LFPklOARUcOiWEIGGmFELx" crossorigin="anonymous"></script>
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
  <?php  
  require_once 'scripts/Database.php';
  require_once 'scripts/Utils.php';
  $db = new Database();

  // Get specific Mehms from Database by ID.
  /**
   * Return specific Mehm from database by ID inside array
   * 
   * @param integer $id ID of Mehm
   * @param boolean $admin if hidden Mehms should be found
   */

  function getMehm($id, $admin): array {
    $query = 'SELECT * FROM mehms WHERE ID = ' . $id;

    if (!$admin) {
      $query .= ' WHERE Visible = TRUE';
    }

    global $db;
    try {
      return $db->database->query($query)->fetchAll();
    } catch (PDOException $e) {
      return [];
    }
  }

  /** 
   * Convert formatted DateTime to a formatted string containing those values 
   * 
   * @param string $datetime Formatted DateTime
   * @param integer $level 7: all values (y,m,w,...); 1: only largest value
   * @return string 
   */

  function timeElapsedString($datetime, $level = 1) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
      'y' => ["Jahr", "Jahren"],
      'm' => ["Monat", "Monaten"],
      'w' => ["Woche", "Wochen"],
      'd' => ["Tag", "Tagen"],
      'h' => ["Stunde", "Stunden"],
      'i' => ["Minute", "Minuten"],
      's' => ["Sekunde", "Sekunden"],
    );

    foreach ($string as $k => &$v) {
      if ($diff->$k) {
        $v = $diff->$k . ' ' . ($diff->$k > 1 ? $v[1] : $v[0]);
      } else {
        unset($string[$k]);
      }
    }

    $string = array_slice($string, 0, $level);
    return $string ? 'vor ' . implode(', ', $string) : 'gerade eben';
  }

  $id = isset($_GET["id"]) ? $_GET["id"] : "";

  // Redirect to index.php if id parameter to specify mehm is not available
  if ($id == "") {
    header('Location: .');
    exit;
  }

  // Redirect to index.php if id parameter to specify mehm is not valid
  $mehms = getMehm($id, true);
  if (count($mehms) == 0) {
    header('Location: .');
    exit;
  }

  $mehm = $mehms[0];

  include("includes/header.php");
  ?>

  <main class="container">

    <form id="query" name="query" action="." method="GET" class="toolbar">
      <?php include("includes/toolbar/search-box.php"); ?>
    </form>

    <div class="content">
      <div class="paper">

      </div>
      <aside class="paper">
        <div class="profile-picture">
          <svg height="64" data-jdenticon-value="<?php echo $mehm["Autor"] ?>"></svg>
        </div>
        <p>Gepostet von <?php echo '<a href="./?search=u/' . $mehm["Autor"] . '">u/' . $mehm["Autor"] . "</a><br>" . timeElapsedString($mehm["VisibleOn"]) ?></p>
      </aside>
    </div>

  </main>

  <?php include("includes/footer.php"); ?>
  <?php include("includes/bottom-navigation.php"); ?>
</body>

</html>