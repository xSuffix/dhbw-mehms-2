<?php

class Database
{
    public PDO $database;

    function __construct()
    {
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
        } catch (PDOException $exception) {
            # Database is not initialized yet
            $this->setupDatabase(new PDO("mysql:host=$mysql_host;dbname=", $mysql_user, $mysql_password));
            $this->database = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);

        }
    }

    // Setups the database
    // Executes init.sql on the $emptyDB
    private function setupDatabase($emptyDB)
    {

        $query = file_get_contents("scripts/init.sql");

        $stmt = $emptyDB->prepare($query);

        if ($stmt->execute())
            echo "<script>console.log('Database successfully created!');</script>";
        else
            echo "<script>console.log('Failed to create database!');</script>";
    }

    // Get Array of Mehms from database sorted after the parameters $sort and $desc.
    // $filter and $input filter the data from the database
    // Admin can see all Mehms or only NotApproved if he wants
    public function getMehms($filter, $category, $sort, $desc, $admin): array
    {
        $query = 'SELECT *, mehms.UserID as UserID, mehms.ID as ID FROM mehms';

        $hasConcatenatedFilter = false;

        if ($sort == 'comments') {
            $query .= ' LEFT JOIN comments c ON mehms.ID = c.MehmID';
        }

        if ($filter['user'] != '' || $filter['search'] != '') {
            $query .= ' LEFT JOIN Users u ON mehms.UserID = u.ID';
        }

        if (!$admin) {
            if ($sort == 'notVisibleOnly') {
                $query .= ' WHERE Visible = FALSE';
            } else {
                $query .= ' WHERE Visible = TRUE';
            }
            $hasConcatenatedFilter = true;
        } else if ($sort == 'notVisibleOnly') {
            $query .= ' WHERE Visible = FALSE';
            $hasConcatenatedFilter = true;
        }

        if ($filter['user'] != '' || $filter['search'] != '') {
            if ($hasConcatenatedFilter) {
                $query .= ' AND';
            } else {
                $query .= ' WHERE';
            }
            $user = $filter['user'];
            $search = $filter['search'];
            $query .= " Path LIKE '%$search%' AND Name LIKE '%$user%'";
        }

        if ($category != '') {
            if ($hasConcatenatedFilter) {
                $query .= ' AND';
            } else {
                $query .= ' WHERE';
            }
            switch ($category) {
                case "programmieren":
                    $query .= " mehms.Type = 'PROGRAMMING'";
                    break;
                case "dhbw":  
                    $query .= " mehms.Type = 'DHBW'";
                    break; 
                case "andere":
                    $query .= " mehms.Type = 'ANDERE'";
                    break; 
                default:    
            }
        }

        switch ($sort) {
            case 'date':
                $query .= ' ORDER BY VisibleOn';
                break;
            case 'likes':
                $query .= ' ORDER BY Likes';
                break;
            case 'comments':
                $query .= ' GROUP BY mehms.ID ORDER BY count(c.MehmID)';
                break;
            default:
                return $this->database->query($query)->fetchAll();
        }

        if ($desc) {
            $query .= ' DESC';
        }
        return $this->database->query($query)->fetchAll();
    }

}