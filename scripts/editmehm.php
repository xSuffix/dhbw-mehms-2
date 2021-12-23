<?php
    require_once 'Database.php';
    $db = new Database();
    // Entscheidet anhand eingegangener Action, ob es sich um approve oder decline handelt
    print_r($_POST);
    $toChange = $_POST['changed'];
    if ($toChange == 'title') {
        changeTitle($_POST['id'], $_POST['new']);
    } else {
        changeDesc($_POST['id'], $_POST['new']);
    }

    function changeTitle($id, $new) {
        global $db;
        $db->database->query("UPDATE mehms SET Title = '" . $new . "' WHERE ID = " . $id); 
    }

    function changeDesc($id, $new) {
        global $db;
        $db->database->query("UPDATE mehms SET Description = '" . $new . "' WHERE ID = " . $id);  
    }
