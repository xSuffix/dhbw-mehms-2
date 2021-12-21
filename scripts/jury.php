<?php
    require_once 'Database.php';
    $db = new Database();

    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'a':
                approveMehm($_POST['id']);
                break;
            case 'd':
                declineMehm($_POST['id']);
                break;
            default:
                exit;
        }
    }

    function approveMehm($index) {
        global $db;
        $db->database->query("UPDATE mehms SET Visible = TRUE, VisibleOn = now() WHERE ID=" . $index);
    }

    function declineMehm($index) {
        global $db;
        $db->database->query("UPDATE mehms SET Visible = FALSE, VisibleOn = NULL WHERE ID=" . $index);
    }
?>