<?php
class Utils {
  /**
   * Wandelt $input-String aus Suchleiste in ein $filter-Array um (['user' => (string), 'search' => (string)])
   * Notwendig, da in Suchleiste durch "u/xyz abc" nach allen Mehms passend zur Suche "abc" von einem User
   * passend zu "xyz" gesucht wird.
   * @param string $input -> die Eingabe über die Suchleiste
   * @return array -> die verarbeitete Suche
   */
  public static function extractUser(string $input): array {
    $words = explode(' ', $input);
    $ret = ["user" => '', "search" => ''];
    switch (count($words)) {
      case 0:
        break;
      case 1:
        if (substr($words[0], 0, 2) == "u/") {
          $ret = ["user" => substr($words[0], 2), "search" => ''];
          break;
        }
        $ret = ["user" => '', "search" => $words[0]];
        break;
      default:
        if (substr($words[0], 0, 2) == "u/") {
          $user = substr($words[0], 2);
          $ret = ["user" => $user, "search" => implode(' ', array_slice($words, 1))];
          break;
        }
        $ret = ["user" => '', "search" => $input];
    }
    return $ret;
  }

  /**
   * getMehmCards holt sich die gewollten Mehms aus der Datenbank, wandelt sie in cards um und gibt diese aus.
   * Hier wird auch entschieden, ob zusätzliche Features genutzt werden, z.B. für einen Admin.
   * @param Database $db -> Eine Database.php-Instanz
   * @param array $filter -> ein Array der Struktur ['user' => (string), 'search' => (string)], notwendig für die Suchleiste
   * @param string $category -> die gewünschte Mehm-Kategorie ("Alle", Programmieren", "DHBW", "Andere")
   * @param string $sort -> der Parameter, nach dem sortiert werden soll ("date", "likes", "comments", "notVisibleOnly")
   * @param bool $asc -> Reihenfolge: ascending (true), oder descending (false)
   * @param bool $admin -> Adminansicht (true) oder normale Useransicht (false)
   * @param bool $myMehms -> nur eigene Mehms anzeigen (true), andere Filter (false)
   * @return void
   */
  public static function getMehmCards(string $ROOT, Database $db, array $filter, string $category, string $sort, bool $asc, bool $admin, bool $myMehms) {
    $images = $db->getMehms($filter, $category, $sort, $asc, $admin);

    if ($myMehms) {
      $count = count($images);
      for ($i = 0; $i < $count; $i++) {
        if ($images[$i]['UserID'] != $_SESSION['id']) {
          unset($images[$i]);
        }
      }
    }
    $dirname = $ROOT . "../assets/mehms/";

    foreach ($images as $image) {
      $imageID = $image["ID"];
      $imageName = $image["Title"];
      $imageFile = $dirname . $image["Path"];
      if ($imageFile != "../assets/mehms/rick.gif") {
        try {
          $sizes = getimagesize($imageFile);
        } catch (Exception $e) {
          echo '<script>console.log("Picture could not be found.");</script>';
        }
        try {
          if ($admin) {
            $infix = Utils::adminInfix($image["ID"]);
            $href = "";
          } else {
            $infix = "";
            $href = 'href="./mehm?id=' . $imageID . '" ';
          }

          echo '<a class="mehm-card" ' . $href . 'style="width:' . $sizes[0] * 300 / $sizes[1] .
            'px; flex-grow: ' . $sizes[0] * 300 / $sizes[1] . '"><div style="padding-top: ' .
            $sizes[1] / $sizes[0] * 100 . '%"></div><img src="' . $imageFile . '" loading="lazy" name="' . $imageName . '" alt="' . $imageName . '" />' . $infix . '</a>';
        } catch (DivisionByZeroError $e) {
          echo '<script>console.log("Invalid Picture");</script>';
        }
      }
    }
  }

  /**
   * Fügt Approve/Decline-Button zur Card hinzu.
   * @param int $index -> die ID des Mehms
   * @return string -> die approve- und decline-Buttons für dieses Mehm in der Adminansicht
   */
  public static function adminInfix(int $index): string {
    return '<div class="admin-overlay">' .
      '<div><div class="box a-button" id="a' . $index . '"><svg xmlns="http://www.w3.org/2000/svg" class="icon-md" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg></div> Approve </div>' .
      '<div><div class="box a-button" id="d' . $index . '"><svg xmlns="http://www.w3.org/2000/svg" class="icon-md" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd" /></svg></div> Decline </div>' .
      '</div>';
  }


  /**
   * Prüft, ob man eingeloggt ist (und optional, ob man Admin-Privilegien hat).
   * @param bool $requireAdmin -> True, wenn die Seite Admin-Privilegien benötigt.
   * @return void
   */
  public static function checkLogin(bool $requireAdmin) {
    session_start();

    if ((isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true)) {
      if ($requireAdmin && (!$_SESSION["usertype"] == 1)) {
        header("location: ../mehms.php");
        exit;
      }
    } else {
      header("location: mehms.php");
      exit;
    }
  }
}
