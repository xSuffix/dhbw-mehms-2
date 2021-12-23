<?php
// Dieses Skript führt die Aktion Approve und Decline aus der Admin-Page aus.

// Definiert Pfad zum php-Ordner für includes
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
 * declineMehm löscht ein Mehm aus der Datenbank
 * @param int $index
 * @return void
 */
function declineMehm(int $index)
{
    global $db, $ROOT;
    $db->deleteMehm($index, $ROOT);
}
