<?php

include_once '../config/database.php';
include_once '../models/corso.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'),true);
    // Ottieni il parametro di ricerca inviato dal client
    $database= new Database();
    $db= $database->getConnection();

    $corso= new Corso($db);

    $param=$data['parametro'];
    $val=$data['valore'];

    $stmt= $corso->search($param,$val);
    $num= $stmt->rowCount();
    if($num>0){
        $corso_arr= array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $corso_nome = $row['corso'];
            $materia = $row['materia']; 
            $posti = $row['posti'];
            $id = $row['id'];
    
            // Se il corso non e' ancora presente nell'array, lo aggiungi con la materia
            if (!isset($corso_arr[$corso_nome])) {
                $corso_arr[$corso_nome] = array($id, $posti, $materia);
            } else {
            // Se il corso e' già presente, aggiungi solo la nuova materia
                array_push($corso_arr[$corso_nome], $materia);
            }
        }
        http_response_code(200); 
        echo json_encode($corso_arr);
    }else {
        // Invia una risposta di errore
        http_response_code(503);
        echo json_encode(array("message" => "Impossibile trovare il corso."));
    }

} else {
    // Se la richiesta non è una richiesta POST, restituisci un errore
    http_response_code(405); // Metodo non consentito
    echo json_encode(array('message' => 'Metodo non consentito'));
}

?>