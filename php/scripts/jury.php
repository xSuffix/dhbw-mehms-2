<?php
// Define path to php folder for includes
$ROOT = '../';

require_once 'Database.php';
$db = new Database($ROOT);

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

/**
 * approveMehm setzt ein gewähltes Mehm auf Visible = true, sodass jeder User es sehen kann.
 * @param int $index -> die ID des Mehms
 * @return void
 */
function approveMehm(int $index)
{
    global $db;
    $db->database->query("UPDATE mehms SET Visible = TRUE, VisibleOn = now() WHERE ID=" . $index);
}

/**
 * declineMehm setzt ein gewähltes Mehm auf Visible = false, sodass jeder User es sehen kann.
 * Ist das Mehm bereits nicht Visible, kann es durch ein weiteres decline vollends abgelehnt und entfernt werden.
 * @param int $index
 * @return void
 */
function declineMehm(int $index)
{
    global $db;
    $visible = $db->database->query("SELECT Visible FROM mehms WHERE ID=" . $index)->fetch();
    if ($visible['Visible']) {
        $db->database->query("UPDATE mehms SET Visible = FALSE, VisibleOn = NULL WHERE ID=" . $index);
    } else {
        $db->database->query("DELETE FROM mehms WHERE ID=" . $index);
    }
}
