<!DOCTYPE html>
<html lang="en">

<head>
  <title>Math - DHBW Mehms</title>
  <link href="../css/zahlen.css" rel="stylesheet">
  <link href="../css/table.css" rel="stylesheet">
  <?php include("includes/meta.php"); ?>
  <style>
    :root {
      --banner-top: #c5c5c5;
      --banner-bottom: #64b1c1;
    }

    .zahlen {
      animation: 0.2s color-p-primary forwards;
    }
  </style>
</head>


<body>
  <?php include("includes/header.php"); ?>

  <?php $number = "ranking";
  if (isset($_GET['number'])) {
    $number = $_GET['number'];
  }

  include("includes/numbers/" . $number . ".php");
  ?>

  <?php include("includes/footer.php"); ?>
  <?php include("includes/bottom-navigation.php"); ?>
</body>

</html>