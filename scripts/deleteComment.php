$db->database->query("DELETE comments WHERE ID = '$index");

$db->database->query("UPDATE comments SET Comment = '$text' WHERE ID = '$index'");