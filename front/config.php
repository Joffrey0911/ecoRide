<?php
    require_once 'variableConfig.php';

    try{

        $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $e){
        die('Erreur de connexion à la base de données :'.$e->getMessage());
    }

   