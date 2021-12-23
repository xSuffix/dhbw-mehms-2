<?php
// Define path to php folder for includes
$ROOT = '../../';

require_once '../Database.php';
$db = new Database($ROOT);

$id = $_POST['id'];
$text = $_POST['text'];
$db->database->query("UPDATE comments SET Comment = '$text' WHERE ID = " . $id);
