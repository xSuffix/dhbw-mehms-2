<!DOCTYPE html>
<html lang="de">

<head>
  <title>Mehm - DHBW Mehms</title>
  <link rel="stylesheet" href="./styles/toolbar.css">
  <link rel="stylesheet" href="./styles/mehm.css">
  <script src="https://cdn.jsdelivr.net/npm/jdenticon@3.1.1/dist/jdenticon.min.js" integrity="sha384-l0/0sn63N3mskDgRYJZA6Mogihu0VY3CusdLMiwpJ9LFPklOARUcOiWEIGGmFELx" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
  <script>
    // jQuery-Funktion, die bei Knopfdruck auf approve-/decline-Button das jury.php-Skript ausführt,
    // in dem die Änderung an der Datenbank vollführt werden.
    // Nach Ausführung des PHP-Skriptes wird die Seite neugeladen, sodass die Ansicht upgedated wird.
    $(document).ready(function() {
      $('button').click(function() {
        const child = $(this).children('svg')[0];
        const ids = $(child).attr('id').split(" ");
        const mehmId = ids[0];
        const uId = ids[1];
        const status = $(child).hasClass('beat');
        const ajaxurl = 'scripts/like.php',
          data = {
            'status': status,
            'id': mehmId,
            'user': uId
          };
        $.post(ajaxurl, data, function() {
          window.location.reload();
        });
      });
    });
  </script>
  <?php
  require_once 'scripts/Database.php';
  require_once 'scripts/Utils.php';
  $db = new Database();

  /**
   * Return specific Mehm from database by ID inside array
   *
   * @param integer $id ID of Mehm
   * @param boolean $admin if hidden Mehms should be found
   */
  function getMehm(int $id, bool $admin): array {
    $query = 'SELECT *, count(l.MehmID) AS likeCount, mehms.Type AS Type, mehms.ID AS ID
      FROM mehms
      LEFT JOIN Users u ON mehms.UserID = u.ID
      LEFT JOIN likes l on mehms.ID = l.MehmID
      WHERE mehms.ID =' . $id;

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
   * Konvertiert formatierte DateTime in einen formatted string mit dessen Werten
   *
   * @param string $datetime Formatted DateTime
   * @param integer $level 7: all values (y,m,w,...); 1: only largest value
   * @return string
   * @throws Exception
   */

  function timeElapsedString(string $datetime, int $level = 1): string {
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

  $id = $_GET["id"] ?? "";

  // Redirect auf index.php, wenn id-Parameter zur Mehm-Spezifikation nicht vorhanden ist
  if ($id == "") {
    header('Location: .');
    exit;
  }

  // Redirect auf index.php, wenn id-Parameter nicht valide ist
  $mehms = getMehm($id, true);
  if (empty($mehms)) {
    // header('Location: .');
    // exit;
  }

  $mehm = $mehms[0];

  include("includes/header.php");
  ?>

  <main class="container">

    <form id="query" name="query" action="." method="GET" class="toolbar">
      <?php include("includes/toolbar/search-box.php"); ?>
    </form>

    <div class="content">
      <div class="main">
        <div class="paperlike mehm">
          <img src="<?php echo "./assets/mehms/" . $mehm["Path"] ?>" alt="<?php echo $mehm["Description"] ?>">
        </div>
        <div class="paperlike comments">
          <?php if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
            echo '<form class="write-comment">
            <label for="message">Kommentiere als <a class="underline" href="./?search=u/' . $_SESSION["username"] . '">' . $_SESSION["username"] . '</a></p>
            <textarea id="message" placeholder="LOL!"></textarea>
            <button>Kommentieren</button>
            </form>';
          } else {
            echo "Melde dich an, um zu kommentieren.";
          }
          ?>
        </div>
      </div>

      <aside class="paperlike meta">
        <div class="posted">
          <div class="profile-picture">
            <svg height="36" data-jdenticon-value="<?php echo $mehm["Name"] ?>"></svg>
          </div>
          <div class="posted-text">
            <p><?php echo '<a class="underline" href="./?filter=' . $mehm["Type"] . '">#' . $mehm["Type"] . '</a>' ?> <br> Gepostet von <?php echo '<a class="underline" href="./?search=u%2F' . $mehm["Name"] . '">u/' . $mehm["Name"] . "</a> " . timeElapsedString($mehm["VisibleOn"]) ?></p>
          </div>
        </div>
        <h1><?php echo $mehm["Title"] ?></h1>
        <p><?php echo $mehm["Description"] ?></p>
        <div class="flex">

          <button class="meta-icon">
            <?php
            $beat = '';
            $sess = '';
            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
              $sess = $_SESSION['id'];
              $query = "SELECT * FROM likes WHERE MehmID = " . $mehm['ID'] . " AND UserID = " . $_SESSION['id'];
              $liked = $db->database->query($query)->fetchall();
              if (!empty($liked)) $beat = ' beat';
            }
            echo '<svg xmlns="http://www.w3.org/2000/svg" class="i-heart' . $beat . '" id="' . $mehm['ID'] . ' ' . $sess . '" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
              </svg>' ?>
            <?php echo $mehm['likeCount'] ?> Like<?php if ($mehm['likeCount'] != 1) echo "s"; ?>
          </button>
          <a class="meta-icon" href="#comments">
            <svg xmlns="http://www.w3.org/2000/svg" class="i-comment" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
            </svg>
            x Kommentare
          </a>
        </div>
      </aside>
    </div>

  </main>

  <?php include("includes/footer.php"); ?>
  <?php include("includes/bottom-navigation.php"); ?>
</body>

</html>