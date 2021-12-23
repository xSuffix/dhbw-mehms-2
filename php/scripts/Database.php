<?php

class Database {
  public PDO $database;

  // Konstruktor der Klasse Database
  // Startet Verbindungsaufbau bei Instanziierung
  // $ROOT bezeichnet den relativen Pfad zum Ursprung
  function __construct(string $ROOT = "") {
    $this->connectToDatabase($ROOT);
  }


  /**
   * connectToDatabase verbindet die hier spezifizierte Datenbank und speichert sie als PDO in $database
   * Ist die Datenbank noch nicht initialisiert, wird setupDatabase() aufgerufen
   * @param string $ROOT -> Relativer Pfad
   * @return void
   */
  public function connectToDatabase(string $ROOT) {
    $mysql_host = "localhost";
    $mysql_database = "main";
    $mysql_user = "root";
    $mysql_password = "";
    // MySQL mit PDO_MYSQL
    try {
      $this->database = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
    } catch (PDOException $exception) {
      // Datenbank ist noch nicht initialisiert worden.
      $this->setupDatabase($ROOT, new PDO("mysql:host=$mysql_host;dbname=", $mysql_user, $mysql_password));
      $this->database = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
    }
  }

  /**
   * Datenbanksetup und Ausführen der init.sql auf die $emptyDB
   * @param PDO $emptyDB -> Eine leere Datenbank
   * @param string $ROOT -> Relativer Pfad
   * @return void
   */
  private function setupDatabase(string $ROOT, PDO $emptyDB) {

    $query = file_get_contents($ROOT . "../sql/init.sql");

    $stmt = $emptyDB->prepare($query);

    if ($stmt->execute()) {
      echo "<script>console.log('Database successfully created!');</script>";
    } else {
      echo "<script>console.log('Failed to create database!');</script>";
    }
  }

  /**
   * getMehms holt ein Array aus Mehms aus der Datenbank, sortiert nach den Parametern $sort and $asc sowie
   * gefiltert nach $filter und $category.
   * Ein Admin kann alle Mehms oder nur solche, die (noch) nicht approved sind, sehen
   * @param array $filter -> ein Array der Struktur ['user' => (string), 'search' => (string)], notwendig wegen der Suchleiste
   * @param string $category -> die gewünschte Mehm-Kategorie ("Alle", "Programmieren", "DHBW", "Andere")
   * @param string $sort -> der Parameter, nach dem sortiert werden soll ("date", "likes", "comments", "notVisibleOnly")
   * @param boolean $asc -> Reihenfolge: ascending (true), oder descending (false)
   * @return array -> alle Mehms, die von der Query erfasst wurden
   */
  public function getMehms(array $filter, string $category, string $sort, bool $asc): array {
    $query = 'SELECT *, mehms.UserID as UserID, mehms.ID as ID, mehms.Type as Type FROM mehms';

    switch ($sort) {
      case 'comments':
        $query .= ' LEFT JOIN comments c ON mehms.ID = c.MehmID';
        break;
      case 'likes':
        $query .= ' LEFT JOIN likes l ON mehms.ID = l.MehmID';
        break;
    }

    if ($filter['user'] != '' || $filter['search'] != '') {
      $query .= ' LEFT JOIN Users u ON mehms.UserID = u.ID';
    }

    if ($sort == 'notVisibleOnly') {
        $query .= ' WHERE Visible = FALSE';
    } else {
        $query .= ' WHERE Visible = TRUE';
    }

    if ($filter['user'] != '' || $filter['search'] != '') {
      $user = $filter['user'];
      $search = $filter['search'];
      $query .= " AND Title LIKE '%$search%' AND Name LIKE '%$user%'";
    }

    if ($category != '') {
      $query .= ' AND';

      switch ($category) {
        case "Programmieren":
          $query .= " mehms.Type = 'Programmieren'";
          break;
        case "DHBW":
          $query .= " mehms.Type = 'DHBW'";
          break;
        case "Andere":
          $query .= " mehms.Type = 'Andere'";
          break;
        default:
      }
    }

    switch ($sort) {
      case 'date':
        $query .= ' ORDER BY VisibleOn';
        break;
      case 'likes':
        $query .= ' GROUP BY mehms.ID ORDER BY count(l.MehmID)';
        break;
      case 'comments':
        $query .= ' GROUP BY mehms.ID ORDER BY count(c.MehmID)';
        break;
      default:
        return $this->database->query($query)->fetchAll();
    }

    if (!$asc) {
      $query .= ' DESC';
    }

    return $this->database->query($query)->fetchAll();
  }

    /**
     * Holt den User anhand seiner ID aus der Datenbank.
     * Wenn die ID=0 ist, dann gib alle User aus der Datenbank zurück.
     * @param int $id -> ID des Users
     * @return array
     */
    public function getUser(int $id): array {
    if ($id == 0) {
      return $this->database->query("SELECT * FROM users")->fetchAll();
    } {
      return $this->database->query("SELECT * FROM users WHERE ID = '$id'")->fetchAll();
    }
  }

    /**
     * Aktualisiert Parameter des Users in der Datenbank.
     * @param int $id -> ID des Users. Wird verwendet, um den richtigen User in der Datenbank auszuwählen.
     * @param string $name -> Neuer Username
     * @param string $password -> Neues Passwort
     * @param string $type -> Neuer User-Typ (USER, ADMIN)
     * @return void
     */
    public function updateUser(int $id, string $name, string $password, string $type) {
      $this->database->query("UPDATE users SET Name = '$name', Password = '$password', Type = '$type' WHERE ID = '$id'");
  }


  /**
   * Gibt ein spezifisches Mehm anhand seiner ID zurück.
   * Zusätzlich werden weitere Informationen aus User- und Likes-Tabelle geladen.
   * @param integer $id -> ID des Mehms
   * @param boolean $admin -> Ob nicht sichtbare Mehms erlaubt sind.
   * @return array -> Das Mehm
   */
  public function getMehm(int $id, bool $admin): array {
    $query = 'SELECT *, count(l.MehmID) AS likeCount, mehms.Type AS Type, mehms.ID AS ID, mehms.UserID as UID
      FROM mehms
      LEFT JOIN users u ON mehms.UserID = u.ID
      LEFT JOIN likes l ON mehms.ID = l.MehmID
      WHERE mehms.ID =' . $id;

    if (!$admin) {
      $query .= ' AND Visible = TRUE';
    }

    try {
      $result = $this->database->query($query)->fetchAll();
      if (empty($result[0])) {
        return [];
      }
      return $result[0];
    } catch (PDOException $e) {
      return [];
    }
  }

  /**
   * Löscht ein Mehm aus der Datenbank anhand seiner ID.
   * Löscht auch die physische Datei.
   * @param int $id -> ID des Mehms
   * @param string $ROOT -> Relativer Pfad
   * @return void
   */
  public function deleteMehm(int $id, string $ROOT) {
    $mehm = $this->database->query("SELECT Path FROM mehms WHERE ID = '$id'")->fetchAll();
    $mehmPath = $ROOT . "../assets/mehms/" . $mehm[0]["Path"];
    $result= unlink($mehmPath);
    if ($result) {
        $this->database->query("DELETE FROM mehms WHERE ID = '$id'");
    }
  }

  /**
   * Holt sich alle Kommentare anhand der Mehm-ID aus der Datenbank und gibt diese zurück.
   * @param int $id -> ID des Mehms
   * @return array -> Kommentare
   */
  public function getComments(int $id): array {
    $query = 'SELECT u.Name AS Name, Comment, u.ID as UID, Timestamp, comments.ID as ID
            FROM comments
            LEFT JOIN users u ON comments.UserID = u.ID
            WHERE MehmID = ' . $id . '
            ORDER BY Timestamp DESC';

    try {
      return $this->database->query($query)->fetchAll();
    } catch (PDOException $e) {
      return [];
    }
  }

  /**
   * Löscht einen User aus der Datenbank
   * @param int $id -> ID des Users
   * @return void
   */
  public function deleteUser(int $id) {
    $this->database->query("DELETE FROM users WHERE ID = '$id'");
  }
}
