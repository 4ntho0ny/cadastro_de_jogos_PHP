<?php
    class DatabaseConnection {        
        private const DATABASE = "Jogos";
        private const DSN = "mysql:host=localhost;dbname="; //DataBase Server Name
        private const USER = "root";
        private const PASSWORD = "Your password";
        
        function getConstants() {
            $reflectionClass = new ReflectionClass($this);
            return $reflectionClass->getConstants();
        }

        function databaseConnection() {
            $constants = $this->getConstants();
            $dsn = $constants["DSN"];
            $user = $constants["USER"];
            $db = $constants["DATABASE"];
            $password = $constants["PASSWORD"];

            $pdo = null;
            try {
                // PDO Connection
                $pdo = new PDO($dsn.$db, $user, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
            return $pdo;
        }
    }
?>
