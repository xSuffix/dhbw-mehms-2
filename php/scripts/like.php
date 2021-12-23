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

/**
 * Fügt der likes-Tabelle eine neue Spalte mit den Werten Mehm ID aus $index und User ID aus dem POST-Request hinzu.
 * @param int $index -> Index des Mehms
 * @return void
 */
function likeMehm(int $index)
{
    global $db;
    $db->database->query("INSERT INTO likes (MehmID, UserID) VALUES (" . $index . ", " . $_POST['user'] . ")");
}

/**
 * Löscht von der likes-Tabelle eine Spalte anhand der Mehm ID und User ID.
 * @param int $index -> Index des Mehms
 * @return void
 */
function dislikeMehm(int $index)
{
    global $db;
    $db->database->query("DELETE FROM likes WHERE MehmID = " . $index . " AND UserID = " . $_POST['user']);
}
