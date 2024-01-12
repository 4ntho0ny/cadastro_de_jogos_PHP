<?php

const banco = "Jogos";
const usuario = "postgres";
const senha = "postgres";
//DataBase Server Name
const dsn = "pgsql:dbname=Jogos;host=localhost";

function conectaBanco()
{
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