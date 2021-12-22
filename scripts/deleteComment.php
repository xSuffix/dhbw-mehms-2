// $db->database->query("DELETE comments WHERE ID = '$index");

// $db->database->query("UPDATE comments SET Comment = '$text' WHERE ID = '$index'");

<?php
    require_once 'Database.php';
    $db = new Database();
    // Entscheidet anhand eingegangener Action, ob es sich um approve oder decline handelt
    print_r($_POST);
    $id = $_POST['id'];
    $db->database->query("DELETE FROM comments WHERE ID = " .$id);
?>