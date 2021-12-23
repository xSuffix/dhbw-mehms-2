<?php
    require_once '../Database.php';
    $db = new Database();

    $id = $_POST['id'];
    $text = $_POST['text'];
    $db->database->query("UPDATE comments SET Comment = '$text' WHERE ID = " . $id);

