<?php
    require_once '../Database.php';
    $db = new Database();

    $id = $_POST['id'];
    $db->database->query("DELETE FROM comments WHERE ID = " .$id);
