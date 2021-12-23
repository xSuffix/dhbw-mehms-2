<!DOCTYPE html>
<html lang="de">

<head>
  <title>Mehm - DHBW Mehms</title>
  <link rel="stylesheet" href="../css/toolbar.css">
  <link rel="stylesheet" href="../css/mehm.css">
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

  </script>
  <?php
  require_once 'scripts/Database.php';
  require_once 'scripts/Utils.php';
  $db = new Database();

  $likeCount = 0;

  /**
   * Konvertiert formatiertes DateTime in einen formatted string mit entsprechenden Werten
   *
   * @param string $datetime Formatiertes DateTime
   * @param integer $level 7: all values (y,m,w,...); 1: only largest value
   * @return string Formatierter String
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

  // Redirect auf mehms.php, wenn id-Parameter zur Mehm-Spezifikation nicht vorhanden ist
  if ($id == "") {
    header('Location: .');
    exit;
  }

  // Redirect auf mehms.php, wenn id-Parameter nicht valide ist
  $isAdmin = isset($_SESSION) && $_SESSION["usertype"] == 1;
  $mehm = $db->getMehm($id, $isAdmin);
  if ($mehm["Title"] == '') {
    header('Location: .');
    exit;
  }

  $comments = $db->getComments($id);
  $commentCount = count($comments);

  include("includes/header.php");

  $isLogedin = isset($_SESSION["loggedIn"]) && $_SESSION['loggedIn'] === true;
  $isAdmin = $isLogedin && $_SESSION["usertype"] == 1;
  $isPrivileged = $isLogedin && $_SESSION['id'] == $mehm['UID'] || $isAdmin;

  ?>

  <main class="container">

    <form id="query" name="query" action="." method="GET" class="toolbar">
      <?php include("includes/toolbar/search-box.php"); ?>
    </form>

    <div class="content">
      <div class="main">
        <div class="paperlike mehm">
          <img src="<?php echo "../assets/mehms/" . $mehm["Path"] ?>" alt="<?php echo $mehm["Description"] ?>">
        </div>
        <div class="paperlike comments" id="comments">
          <?php if ($isLogedin) {
            echo '<form class="write-comment" id="comment">
            <label for="message">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
            </svg>
            <p>Kommentiere als <a class="underline" href="mehms?search=u/' . $_SESSION["username"] . '">' . $_SESSION["username"] . '</a></p>
            </label>
            <textarea id="message" placeholder="LOL!" required></textarea>
            <button id="' . $mehm['ID'] . ' ' . $_SESSION['id'] . '">Kommentieren</button>
            </form>';
          } else {
            echo '<a class="underline icon-text" href="./login">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon-sm" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z" clip-rule="evenodd" />
            </svg>
            Melde dich an, um zu kommentieren.
            </a>';
          }
          ?>

          <?php if (count($comments) > 0) {
            echo '<div class="comment-list">';

            foreach ($comments as $comment) {
              echo '<div class="flex">
                <div class="comment-left">
                  <a class="user" href="mehms?search=u/' . $comment["Name"] . '">
                    <svg class="box" height="32" data-jdenticon-value="' . $comment["Name"] . '"></svg>
                  </a>
                  <div class="v-line"></div>
                </div>
                <div class="comment-right">
                  <div class="flex">
                    <div>
                      <a class="user underline" href="mehms?search=u/' . $comment["Name"] . '">
                        ' . $comment["Name"] . '
                      </a>
                      <span class="p-a">· ' . timeElapsedString($comment["Timestamp"]) . '</span>
                    </div>';

              if ($isLogedin && $_SESSION['id'] == $comment['UID'] || $isAdmin) {
                echo '<button onclick="deleteComment(' . $comment['ID'] . ')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-sm" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                      </button>
                      <button onclick="editComment(this, ' . $comment['ID'] . ')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-sm" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                      </button>';
              }

              echo '</div><p>' . $comment["Comment"] . '</p>
                </div>
              </div>';
            }
            echo '</div>';
          } ?>

        </div>
      </div>

      <aside class="paperlike meta">
        <div class="posted">
          <div class="profile-picture">
            <svg height="36" data-jdenticon-value="<?php echo $mehm["Name"] ?>"></svg>
          </div>
          <div class="posted-text">
            <p><?php echo '<a class="underline" href="mehms?filter=' . $mehm["Type"] . '">#' . $mehm["Type"] . '</a>' ?>
              <br> Gepostet
              von <?php echo '<a class="underline" href="mehms?search=u%2F' . $mehm["Name"] . '">u/' . $mehm["Name"] . "</a> " . timeElapsedString($mehm["VisibleOn"]) ?>
            </p>
          </div>
        </div>
        <h1 id="title" <?php if ($isPrivileged) echo 'class="editable" contenteditable="true"' ?>><?php echo $mehm["Title"] ?></h1>
        <p <?php if ($isPrivileged && $mehm["Description"] != "") echo 'class="editable" id="descp" contenteditable="true"' ?>><?php echo $mehm["Description"] ?></p>
        <?php if ($isPrivileged && $mehm["Description"] == "") {
          echo '<textarea id="desct" placeholder="Beschreibe was du siehst"></textarea>';
        } ?>
        <div class="flex">

          <button class="meta-icon icon-text" id="like" <?php echo ($isLogedin) ? '' : ' style="cursor: not-allowed;"' ?>>
            <?php
            // Fragt ab, ob ein User das Mehm bereits geliked hat. Entsprechend dessen kann er das Mehm liken oder das Like zurücknehmen.
            $beat = '';
            $sess = '';
            if ($isLogedin) {
              $sess = $_SESSION['id'];
              $query = "SELECT * FROM likes WHERE MehmID = " . $mehm['ID'] . " AND UserID = " . $_SESSION['id'];
              $liked = $db->database->query($query)->fetchall();
              if (!empty($liked)) $beat = ' beat';
            }
            echo '<svg xmlns="http://www.w3.org/2000/svg" class="icon-md' . $beat . '" id="' . $mehm['ID'] . ' ' . $sess . '" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
              </svg>' ?>
            <?php echo $mehm['likeCount'] ?> Like<?php if ($mehm['likeCount'] != 1) echo "s"; ?>
          </button>
          <a class="meta-icon icon-text" href="#comments">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon-md" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
            </svg>
            <?php echo $commentCount ?> Kommentar<?php if ($commentCount != 1) echo "e"; ?>
          </a>
          <span class="meta-icon icon-text" onclick="copyURL()">
            <svg xmlns="http://www.w3.org/2000/svg" id="share-button" class="icon-md" viewBox="0 0 20 20" fill="currentColor">
              <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
            </svg>
            Teilen
          </span>
          <?php if ($isPrivileged) echo '
            <button class="meta-icon icon-text">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon-md" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
              </svg>
              Delete
            </button>'
          ?>
        </div>
      </aside>
    </div>
  </main>

  <?php include("includes/footer.php"); ?>
  <?php include("includes/bottom-navigation.php"); ?>
  <script>
    // jQuery-Funktion, die bei Knopfdruck auf den Like-Button das like.php-Skript ausführt,
    // in dem die Änderung an der Datenbank vollführt werden.
    // Nach Ausführung des PHP-Skriptes wird die Seite neu geladen, sodass die Ansicht upgedated wird.
    jQuery(function() {
      $('#like').click(function() {
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

    // Beim Submitten eines Kommentars wird stattdessen comment.php aufgerufen.
    jQuery(function() {
      $("#comment").submit(function(e) {
        e.preventDefault();

        let child = $(this).children('button')[0];
        const ids = $(child).attr('id').split(" ");
        const mehmId = ids[0];
        const uId = ids[1];
        child = $(this).children('textarea')[0];
        const text = $(child).val();
        const ajaxurl = 'scripts/comment/comment.php',
          data = {
            'text': text,
            'id': mehmId,
            'user': uId
          };
        $.post(ajaxurl, data, function() {
          window.location.reload();
        });
      });
    });

    // jQuery-Funktion, die bei Änderung des Mehm-Titels das edit-mehm.php-Skript ausführt,
    // in dem die Änderung an der Datenbank vollführt werden.
    // Nach Ausführung des PHP-Skriptes wird die Seite neugeladen, sodass die Ansicht upgedated wird.
    document.getElementById("title").oninput = function() {
      var t = document.getElementById("title");
      const url = window.location.href.split("id=");
      const mehmId = url[1];
      var edit = t.innerHTML.replace("<br>", " ");
      if (edit == " " || edit == "") {
        return;
      }
      const ajaxurl = 'scripts/edit-mehm.php',
        data = {
          'changed': 'title',
          'new': edit,
          'id': mehmId
        };
      $.post(ajaxurl, data, function() {});
    }
    // Dasselbe für Description (Part 1)
    if (document.getElementById("descp") != null) {
      const t = document.getElementById("descp");
      t.oninput = function() {
        const url = window.location.href.split("id=");
        const mehmId = url[1];
        var edit = t.innerHTML;
        if (edit == "<br>") {
          edit = "";
        }
        const ajaxurl = 'scripts/edit-mehm.php',
          data = {
            'changed': 'desc',
            'new': edit,
            'id': mehmId
          };
        $.post(ajaxurl, data, function() {});
      }
    }
    // Dasselbe für Description (Part 2)
    if (document.getElementById("desct") != null) {
      const t = document.getElementById("desct");
      t.oninput = function() {
        const url = window.location.href.split("id=");
        const mehmId = url[1];
        var edit = t.value.replace("\n", "<br>");
        if (edit == "<br>") {
          edit = "";
        }
        const ajaxurl = 'scripts/edit-mehm.php',
          data = {
            'changed': 'desc',
            'new': edit,
            'id': mehmId
          };
        $.post(ajaxurl, data, function() {});
      }
    }

    // Ruft delete-comment.php zur Löschung eines Kommentars auf.
    // Funktion wird durch Knopfdruck auf das Löschen-Icon getriggered.
    function deleteComment(commentId) {
      const ajaxurl = 'scripts/comment/delete-comment.php',
        data = {
          'id': commentId,
        };
      $.post(ajaxurl, data, function() {
        window.location.reload();
      });
    }

    // Ruft edit-comment.php für die Änderung eines Kommentars auf.
    // Funktion wird durch Knopfdruck auf das Edit-Icon getriggered.
    function editComment(e, commentId) {
      const p = e.parentNode.parentNode.getElementsByTagName("p")[0];
      p.classList.add("editable");
      p.setAttribute("contenteditable", true);

      p.oninput = function(e) {
        const text = p.innerText;
        if (text != null) {
          const ajaxurl = 'scripts/comment/edit-comment.php',
            data = {
              'id': commentId,
              'text': text
            };
          $.post(ajaxurl, data, function() {});
        }
      }
    }

    // Kopiert die aktuelle Mehm-URL in die Zwischenablage
    function copyURL() {
      const copy = document.createElement("input"),
        url = window.location.href;
      document.body.appendChild(copy);
      copy.value = url.split("#")[0];
      copy.select();
      document.execCommand("copy");
      document.body.removeChild(copy);
      document.getElementById("share-button").classList.add("pressed");
    }

    jdenticon.update("svg");
  </script>
</body>

</html>