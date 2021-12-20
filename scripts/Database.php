<?php

class Database
{
    public PDO $database;

    function __construct() {
        $this->connectToDatabase();
    }

    # This function connects to the database specified by host, database name, user and password and returns a PDO.
    # If the database is not initialized yet, it calls setupDatabase
    public function connectToDatabase()
    {
        $mysql_host = "localhost";
        $mysql_database = "main";
        $mysql_user = "root";
        $mysql_password = "";
        # MySQL with PDO_MYSQL
        try {
            $this->database = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
        } catch (PDOException $exception)
        {
            # Database is not initialized yet
            $this->setupDatabase(new PDO("mysql:host=$mysql_host;dbname=", $mysql_user, $mysql_password));
            $this->database = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);

        }
    }

    // Setups the database
    // Executes init.sql on the $database
    private function setupDatabase($emptyDB) {

        $query = file_get_contents("scripts/init.sql");

        $stmt = $emptyDB->prepare($query);

        if ($stmt->execute())
            echo "<script>console.log('Database successfully created!');</script>";
        else
            echo "<script>console.log('Failed to create database!');</script>";
    }

    // Get Array of Mehms from Database sorted after the parameters $sort and $desc.
    // If admin gets all Mehms, otherwise only Approved
    public function getMehms($sort, $desc, $admin): Array {
        $query = 'SELECT * FROM mehms ';

        if (!$admin && $sort != 'comments') {
            $query .= 'WHERE Visible = TRUE';
        }

        switch ($sort) {
            case 'date': $query .= ' ORDER BY VisibleOn';
                break;
            case 'likes': $query .= ' ORDER BY Likes';
                break;
            case 'comments': $query .= 
                $admin
                    ? ' LEFT JOIN comments c ON mehms.ID = c.MehmID GROUP BY mehms.ID ORDER BY count(c.MehmID)' 
                    : ' LEFT JOIN comments c ON mehms.ID = c.MehmID WHERE Visible = TRUE GROUP BY mehms.ID ORDER BY count(c.MehmID)';
                break;
            case 'notVisibleOnly': $query .= ' WHERE Visible = FALSE';
                return $this->database->query($query)->fetchAll();
            default:
                return $this->database->query($query)->fetchAll();
        }

        if ($desc) {
            $query .= ' DESC';
        }
     
        return $this->database->query($query)->fetchAll();
    }

}