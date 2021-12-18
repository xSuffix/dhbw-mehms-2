<?php

class Database
{
    # This function connects to the database specified by host, database name, user and password and returns a PDO.
    # If the database is not initialized yet, it calls setupDatabase
    public function connectToDatabase(): PDO
    {
        $mysql_host = "localhost";
        $mysql_database = "main";
        $mysql_user = "root";
        $mysql_password = "";
        # MySQL with PDO_MYSQL
        try {
            return new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
        } catch (PDOException $exception)
        {
            # Database is not initialized yet
            $database = new PDO("mysql:host=$mysql_host;dbname=", $mysql_user, $mysql_password);
            $this->setupDatabase($database);
            return new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);
        }
    }

    // Setups the database
    // Executes init.sql on the $database
    private function setupDatabase(PDO $database) {

        $query = file_get_contents("scripts/init.sql");

        $stmt = $database->prepare($query);

        if ($stmt->execute())
            echo "<script>console.log('Database successfully created!');</script>";
        else
            echo "<script>console.log('Failed to create database!');</script>";
    }
}