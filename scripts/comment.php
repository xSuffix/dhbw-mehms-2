<?php
require_once 'Database.php';
$db = new Database();

$userId = $_SESSION["id"];
$index = $_POST['id'];
$text =  $_POST['text'];
$db->database->query("INSERT INTO comments (MehmID, UserID, Comment) VALUES ('$userId','$index','$text')");

$db->database->query("DELETE comments WHERE ID = '$index");

$db->database->query("UPDATE comments SET Comment = '$text' WHERE ID = '$index'");

?>