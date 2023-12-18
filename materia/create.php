<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/materia.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database= new Database();
    $db= $database->getConnection();
    $materia= new Materia($db);

    $nome= $_POST['nome'];

    $database= new Database();
    $db= $database->getConnection();
    $materia= new Materia($db);

    if ($materia->create($nome)) {
        http_response_code(201);
        echo json_encode(array('message' => 'Materia creato correttamente'));
    } else {
        http_response_code(503);
        echo json_encode(array('message' => 'Impossibile creare il corso'));
    }
} else {
    // Se la richiesta non è una richiesta POST, restituisci un errore
    http_response_code(405); // Metodo non consentito
    echo json_encode(array('message' => 'Metodo non consentito'));
}
?>