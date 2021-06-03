<?php 
    //pdo nacin jr ima vise secure, to prevent sql_injection 
    //and reduce the need to connect to db every time we need to do smth regarding db
    // connections can be expensive, do we want to minimize how often we want someone to connect to db

    $host = '127.0.0.1';
    $db ='runningapk_db';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    //in PDO conectivity, ie data source name ie way of connecting
    //drivers=mysql
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    try{
        $pdo=new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //whenever there is error, tell me about it
        //echo 'Hello Databese';
    } 
    catch(PDOException $e){
        //throw will stop all execution and show error, mozes i samo da kazes echo 
       // echo "<h1 class=text-danger>No database found, file: conn.php </h1>";
       echo "Greska u conn.php";
        throw new PDOException($e->getMessage());
    }


    require_once 'crud.php';
    $crud = new crud($pdo); // instance of mine class, so that i can use functions whenever i want in Index

?>