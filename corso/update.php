<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/corso.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nome = $_POST['nome'];
    $posti = $_POST['posti'];
    $id= $_POST['idCorso'];
    $materie = $_POST['materie'];

    $array_materie = preg_split('/,\s*/', $materie);

    $database= new Database();
    $db= $database->getConnection();
    $corso= new Corso($db);

    if($corso->update($id,$nome,$posti,$array_materie)){
        http_response_code(200);
        echo json_encode(array('risposta'=> 'Corso aggiornato'));
    }else{
        http_response_code(503);
        echo json_encode(array('risposte'=> 'Impossibile aggiornare il corso'));
    }

}

?>