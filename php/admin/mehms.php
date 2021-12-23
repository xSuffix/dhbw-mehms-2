<?php
// Define path to php folder for includes
$ROOT = '../';

require_once $ROOT . 'scripts/Utils.php';
Utils::checkLogin(true);
?>

<!DOCTYPE html>
<html lang="de">

<head>
  <title>Admin - DHBW Mehms</title>
  <link rel="stylesheet" href="<?php echo $ROOT ?>../css/mehms.css">
  <link rel="stylesheet" href="<?php echo $ROOT ?>../css/admin.css">
  <link rel="stylesheet" href="<?php echo $ROOT ?>../css/toolbar.css">
  <script type="text/javascript" src="<?php echo $ROOT ?>../js/select-mehms.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <?php include($ROOT . "includes/meta.php"); ?>
  <style>
    :root {
      --banner-top: #60c9b1;
      --banner-bottom: #ffffff;
    }

    .scrolled .toolbar {
      background: #6E8ED9;
      background: linear-gradient(0deg, #6E8ED9 0%, #7293DC 100%);
    }

    @media (min-width: 720px) {
      .scrolled.scroll-up .toolbar {
        background: linear-gradient(0deg, #769BE0 0%, #7293DC 100%);
      }
    }
  </style>
</head>


<body>
  <script>
    // jQuery-Funktion, die bei Knopfdruck auf approve-/decline-Button das jury.php-Skript ausführt,
    // in dem die Änderung an der Datenbank vollführt werden.
    // Nach Ausführung des PHP-Skriptes wird die Seite neugeladen, sodass die Ansicht geupdated wird.
    jQuery(function() {
      $('.button').click(function() {
        const clickBtnValue = $(this).attr('id');
        const btnType = clickBtnValue[0];
        const mehmId = clickBtnValue.substring(1);
        const ajaxurl = '<?php echo $ROOT ?>scripts/jury.php',
          data = {
            'action': btnType,
            'id': mehmId
          };
        $.post(ajaxurl, data, function() {
          window.location.reload();
        });
      });
    });
  </script>
  <?php
  include($ROOT . "includes/header.php");
  require_once $ROOT . 'scripts/Database.php';
  $db = new Database($ROOT);
  ?>

  <main class="container">

    <form id="query" name="query" method="GET" class="toolbar">
      <?php include($ROOT . "includes/toolbar/search-box.php"); ?>
      <?php include($ROOT . "includes/toolbar/filter-box.php"); ?>
      <?php include($ROOT . "includes/toolbar/new-box.php"); ?>
      <?php include($ROOT . "includes/toolbar/order-box.php"); ?>
    </form>


    <div id="mehm-gallery">
      <?php

      $filter = Utils::extractUser($search);
      if ($new) {
        Utils::getMehmCards($ROOT, $db, $filter, $category, 'none', $asc, true, false);
      } else {
        Utils::getMehmCards($ROOT, $db, $filter, $category, 'notVisibleOnly', $asc, true, false);
      }

      ?>
      <div id="theater"></div>
    </div>
  </main>

  <?php include($ROOT . "includes/footer.php"); ?>
  <?php include($ROOT . "includes/bottom-navigation.php"); ?>
</body>

</html>