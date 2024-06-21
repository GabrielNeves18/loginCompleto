<?php
    $server = 'localhost';
    $user = 'root';
    $pass=  '';
    $servername = 'login';

    try{
        $conn = new PDO("mysql:host=$server;dbname=$servername", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        

    } catch(PDOException $e){
        echo "Conexão falhou: " . $e->getMessage();
    }