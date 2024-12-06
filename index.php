<?php
    require 'modelo/databaseConnection.php';
    $connection = new DatabaseConnection();
    $connection->databaseConnection();
    die();
    header("location: ./layout/login.php");
?>