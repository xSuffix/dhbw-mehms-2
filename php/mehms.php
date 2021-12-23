<?php
session_start();
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <title>Home - DHBW Mehms</title>
    <link rel="stylesheet" href="./css/mehms.css">
    <link rel="stylesheet" href="./css/toolbar.css">
    <script type="text/javascript" src="./scripts/rick-roll.js"></script>
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
<?php
include("includes/header.php");
require_once "../scripts/Database.php";
require_once "../scripts/Utils.php";
$db = new Database();
?>

<main class="container">
    <?php if (isset($_SESSION["loggedIn"]) && $_SESSION['loggedIn'] === true && $_SESSION["usertype"] == 1) {
        echo '
      <div class="admin">
        <a href="./php/admin" class="box button">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
          </svg>
          Annahme
        </a>
        <a href="./php/benutzeruebersicht" class="box button">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
          </svg>
          Benutzer
        </a>
      </div>';
    }
    ?>

    <form id="query" name="query" method="GET" class="toolbar">
        <?php
        $myMehms = false;
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
            include("includes/toolbar/mymehms.php");
        }
        include("includes/toolbar/search-box.php");
        include("includes/toolbar/filter-box.php");
        include("includes/toolbar/sort-box.php");
        include("includes/toolbar/order-box.php");
        ?>
    </form>

    <div id="mehm-gallery">
        <?php
        $filter = Utils::extractUser($search);
        Utils::getMehmCards($db, $filter, $category, $sort, $asc, false, $myMehms);
        ?>
        <div id="theater"></div>
    </div>
</main>

<?php include("includes/footer.php"); ?>
<?php include("includes/bottom-navigation.php"); ?>
</body>

</html>