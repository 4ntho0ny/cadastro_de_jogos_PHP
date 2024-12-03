<?php
    class DatabaseConnection {
        
    }
    const dsn = "pgsql:dbname=Jogos;host=localhost"; //DataBase Server Name
    const database = "Jogos";
    const user = "postgres";
    const password = "postgres";

    function conectaBanco() {
        $pdo = null;
        try {
            //Conexão sendo feita
            $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=Jogos", usuario, senha, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } catch (PDOExeption $e) {
            //Caso haja um erro é disparada uma mensagem de aviso
            die($e->getMessage());
        }
        return $pdo;
    }
?>