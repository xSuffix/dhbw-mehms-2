<?php
// Dieses Skript löscht ein Mehm anhand seiner $id (ruft dafür deleteMehm von database.php auf)

// Definiert Pfad zum php-Ordner für includes
$ROOT = '../../';

require_once '../database.php';
$db = new Database($ROOT);

$id = $_POST['id'];
$db->deleteMehm($id, $ROOT);
