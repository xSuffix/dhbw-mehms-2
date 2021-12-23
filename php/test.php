<?php 
	session_start();
	if (isset($_POST["mAbmelden"])){
				// Unset all of the session variables
				$_SESSION = array();
				 
				// Destroy the session.
				session_destroy();
		}
?>
<!DOCTYPE html>
<html lang="de">

<head>
  <title>Home - DHBW Mehms</title>
  <link rel="stylesheet" href="../css/mehms.css">
  <link rel="stylesheet" href="../css/toolbar.css">
  <?php include("includes/meta.php"); ?>
</head>

<body>
	<?php
	if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true){
		echo "Hi user was geht. Ich kenn deinen Namen: ".$_SESSION["username"]." 
		<br> Dein Type ist: ".$_SESSION["usertype"];
			
		if($_SESSION["usertype"] == 1){
		echo"<br> oh jooo goil das kann nur der admin lesen";
		}
	}
	else{
		echo "hi";
	}
	?>
	<form action="test" method="post" enctype="multipart/form-data">				<!--//wohin geht der login aufruf??? -->
			<button name="mAbmelden">Abmelden</button>
	</form>
</body>