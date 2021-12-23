<?php
// Dieses PHP-Skript aktualisiert einen neuen Kommentar in der Datenbank anhand seiner $id mit $text.

// Define path to php folder for includes
$ROOT = '../../';

require_once '../database.php';
$db = new Database($ROOT);

$id = $_POST['id'];
$text = $_POST['text'];
$db->database->query("UPDATE comments SET Comment = '$text' WHERE ID = " . $id);
