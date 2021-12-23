<?php
// Dieses PHP-Skript erstellt einen neuen Kommentar in der Datenbank mit $text und $id (MehmID) und $userId.

// Define path to php folder for includes
$ROOT = '../../';

require_once '../Database.php';
$db = new Database($ROOT);

$userId = $_POST["user"];
$id = $_POST['id'];
$text = $_POST['text'];
$result = $db->database->query("INSERT INTO comments (MehmID, UserID, Comment) VALUES ('$id','$userId','$text')");
