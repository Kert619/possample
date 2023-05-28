<?php

    class DbConn{

       public function connect(){

        try {
            $dsn = "mysql:host=localhost;dbname=posdb";
            $username = "root";
            $password = "";
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
            return $pdo;
        } catch (PDOException $e) {
           die("Failed to connect to the database: " . $e->getMessage());
        }
        
       }
    }