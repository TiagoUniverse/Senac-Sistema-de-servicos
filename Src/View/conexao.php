<?php

session_start();

// Tiago
// $serverName = "desktop-f2g3ks7\sqlexpress";
// $database = "Placement";
// $username = "tiagolopes";
// $password = "gti2022";

// SEMAC
$serverName = "SQLSERVER";
$database = "Placement";
$username = "tiagolopes";
$password = "gti2022";


try{
    $pdo = new PDO("sqlsrv:Server=$serverName;Database=$database", $username, $password);
    // echo "Conectado ao banco com sucesso!";
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
}