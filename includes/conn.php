<?php 

try{
    $host      = 'localhost';
    $dbname    = 'sunrise';
    $user      = 'root';
    $password  = '65178299';

    $DSN = "mysql:host=$host;dbname=$dbname";

    $conn = new PDO($DSN,$user,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e){
    echo $e->getMessage();
}

