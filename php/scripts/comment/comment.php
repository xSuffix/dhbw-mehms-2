<?php
// Define path to php folder for includes
$ROOT = '../../';

require_once '../Database.php';
$db = new Database($ROOT);

$userId = $_POST["user"];
$index = $_POST['id'];
$text = $_POST['text'];
$result = $db->database->query("INSERT INTO comments (MehmID, UserID, Comment) VALUES ('$index','$userId','$text')");
