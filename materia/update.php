<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/materia.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome=$_POST['nome']; 
    $id=$_POST['idMateria'];

    $database=new Database();
    $db=$database->getConnection();
    $materia=new Materia($db);
    
    
    if($materia->update($id, $nome)){
        http_response_code(200);
        echo json_encode(array('risposta'=> 'materia aggiornata'));
    }else{
        http_response_code(503);
        echo json_encode(array('risposta'=> 'Impossibile aggiornare la materia'));
    }

} else {
    // Se la richiesta non è una richiesta POST, restituisci un errore
    http_response_code(405); // Metodo non consentito
    echo json_encode(array('message' => 'Metodo non consentito'));
}

?>