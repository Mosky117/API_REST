<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/corso.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assicurati di acquisire i dati inviati dal front-end
    $nome = $_POST['nome'];
    $posti = $_POST['posti'];
    $materie = $_POST['materie'];

    $array_materie = preg_split('/,\s*/', $materie);
    

    // Istanzia un'istanza del <link>Database</link> e del <link>Corso</link>
    $database = new Database();
    $db = $database->getConnection();
    $corso = new Corso($db);

    // Utilizza i dati estratti per creare il <link>corso</link>
    if ($corso->create($nome, $posti, $array_materie)) {
        http_response_code(201);
        echo json_encode(array('message' => 'Corso creato correttamente'));
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