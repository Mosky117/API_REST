<?php

include_once '../config/database.php';
include_once '../models/corso.php';

$database= new Database();
$db= $database->getConnection();

$corso= new Corso($db);
$stmt= $corso->read();
$num= $stmt->rowCount();

if($num> 0){
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
}else{
    http_response_code(404);
    echo json_encode(array("error"=> "Corsi non trovati"));
}

?>