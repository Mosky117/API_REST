<?php

include_once '../config/database.php';
include_once '../models/materia.php';

$database= new Database();
$db= $database->getConnection();
$materia= new Materia($db);
$stmt= $materia->read();
$num= $stmt->rowCount();

if($num> 0){
    $materia_arr= array();
    // $materia_arr['elenco']= array();
    while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
        $nome = $row['nome'];
        $id = $row['id'];

        $materia_arr[$nome]= array($id, $nome);
        
    }
    http_response_code(200); 
    echo json_encode($materia_arr); 

}else{
    http_response_code(404);
    echo json_encode(array("error"=> "nessuna materia trovata"));
}

?>