<?php
require_once 'Database.php';
$db = new Database();
if ($_POST['user'] == '') {
    exit;
}
// Entscheidet anhand eingegangener Action, ob es sich um approve oder decline handelt
$status = $_POST['status'];
if ($status == 'true') {
    dislikeMehm($_POST['id']);
} else {
    likeMehm($_POST['id']);
}

function likeMehm($index)
{
    global $db;
    $db->database->query("INSERT INTO likes (MehmID, UserID) VALUES (" . $index . ", " . $_POST['user'] . ")");
}

function dislikeMehm($index)
{
    global $db;
    $db->database->query("DELETE FROM likes WHERE MehmID = " . $index . " AND UserID = " . $_POST['user']);
}
