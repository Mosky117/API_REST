<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/corso.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decodifica i dati JSON dalla richiesta
    $data = json_decode(file_get_contents('php://input'),true);

    // Verifica se l'ID del corso è presente nei dati ricevuti
    if (isset($data['id'])) {
        $id = $data['id'];

        // Inizializza l'oggetto del corso e connettiti al database
        $database = new Database();
        $db = $database->getConnection();
        $corso = new Corso($db);

        // Chiama la funzione delete per eliminare il corso
        if ($corso->delete($id)) {
            // Invia una risposta di successo
            http_response_code(200);
            echo json_encode(array("message" => "Corso eliminato con successo."));
        } else {
            // Invia una risposta di errore
            http_response_code(503);
            echo json_encode(array("message" => "Impossibile eliminare il corso."));
        }
    } else {
        // Invia una risposta di errore se l'ID non è presente nei dati ricevuti
        http_response_code(400);
        echo json_encode(array("message" => "ID del corso non fornito."));
    }
} else {
    // Invia una risposta di errore se la richiesta non è di tipo POST
    http_response_code(405);
    echo json_encode(array("message" => "Metodo non consentito."));
}

?>