<?php
// Dieses Skript löscht ein Mehm anhand seiner $id (ruft dafür deleteMehm von Database.php auf) 

// Definiert Pfad zum php-Ordner für includes
$ROOT = '../../';

require_once '../Database.php';
$db = new Database($ROOT);

$id = $_POST['id'];
$db->deleteMehm($id, $ROOT);
