<?php 

function createDbConnection(){

    try{
        $db = new PDO('mysql:host=localhost;dbname=imdb', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo $e->getMessage();
    }

    return $db;
}

function returnError(PDOException $pdoex) {
    header('HTTP/1.1. 500 Internal Error');
    $error = array('error' => $pdoex->getMessage());
    print json_encode($error);
    exit;
}