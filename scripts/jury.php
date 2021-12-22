<?php
    require_once 'Database.php';
    $db = new Database();

    // Entscheidet anhand eingegangener Action, ob es sich um approve oder decline handelt
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

    // approveMehm setzt ein gewähltes Mehm auf Visible = true, sodass jeder User es sehen kann.
    // Parameter:
    // $index (Zahl) -> die ID des Mehms
    function approveMehm($index) {
        global $db;
        $db->database->query("UPDATE mehms SET Visible = TRUE, VisibleOn = now() WHERE ID=" . $index);
        print_r("approve");
    }

    // declineMehm setzt ein gewähltes Mehm auf Visible = false, sodass jeder User es sehen kann.
    // Ist das Mehm bereits nicht Visible, kann es durch ein weiteres decline vollends abgelehnt und entfernt werden.
    // Parameter:
    // $index (Zahl) -> die ID des Mehms
    function declineMehm($index) {
        global $db;
        $visible = $db->database->query("SELECT Visible FROM mehms WHERE ID=" . $index)->fetch();
        if ($visible['Visible']) {
            $db->database->query("UPDATE mehms SET Visible = FALSE, VisibleOn = NULL WHERE ID=" . $index);
            print_r("decline");
        } else {
            $db->database->query("DELETE FROM mehms WHERE ID=" . $index);
            printr("delete");
        }
    }
?>