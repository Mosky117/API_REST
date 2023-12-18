<?php

class Corso{
    private
    $conn;
    private $table_name = "corsi";
    private $table_join = "corsi_materie";
    public
    $nome;
    public
    $posti;
    public
    $materie;
    public
    $id;
    public function __construct($db){
        $this->conn= $db;
    }

    function read(){
        $query= "SELECT  posti, corsi.id AS id, corsi.nome AS corso, materie.nome AS materia 
        FROM corsi 
        JOIN corsi_materie ON corsi.id = corsi_materie.corso_id 
        JOIN materie ON corsi_materie.materia_id = materie.id";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }

    function create($nome, $posti, $materie) {
    // Inserisci il nuovo corso nella tabella "corsi"
    $query = "INSERT INTO " . $this->table_name . " (nome, posti) VALUES (:nome, :posti)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':posti', $posti);
    $stmt->execute();

    // Ottieni l'ID del corso appena creato
    $corso_id = $this->conn->lastInsertId();

    // Associa le materie al corso nella tabella "corsi_materie"
    foreach ($materie as $materia_nome) {
        // Recupera l'ID della materia in base al nome
        $query = "SELECT id FROM materie WHERE nome = :materia_nome";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':materia_nome', $materia_nome);
        $stmt->execute();
        $materia_id = $stmt->fetchColumn();

        // Inserisci l'associazione tra il corso e la materia nella tabella "corsi_materie"
        $query = "INSERT INTO " . $this->table_join . " (corso_id, materia_id) VALUES (:corso_id, :materia_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':corso_id', $corso_id);
        $stmt->bindParam(':materia_id', $materia_id);
        $stmt->execute();
    }

    // Restituisci l'ID del nuovo corso creato
    return $corso_id;
}
    function update($id,$nome,$posti,$materie) {
        $deleteQuery = "DELETE FROM " . $this->table_join . " WHERE corso_id = :corso_id";
        $stmtDelete = $this->conn->prepare($deleteQuery);
        $stmtDelete->bindParam(':corso_id', $id);
        $stmtDelete->execute();

        $query= "UPDATE ". $this->table_name . " SET nome=:nome, posti=:posti WHERE id=$id";
        
        $stmt= $this->conn->prepare($query);

        
        $this->nome= htmlspecialchars(strip_tags($this->nome));
        $this->posti= htmlspecialchars(strip_tags($this->posti));

        $stmt->bindParam(":nome",$nome);
        $stmt->bindParam(":posti",$posti);

        $stmt->execute();

        foreach($materie as $materia_nome) {
            $query= "SELECT id FROM materie WHERE nome=:materia_nome";
            $stmtNome= $this->conn->prepare($query);
            $stmtNome->bindParam(":materia_nome", $materia_nome);
            $stmtNome->execute();
            $materia_id= $stmtNome->fetchColumn();

            $query= "INSERT INTO ". $this->table_join ." (corso_id, materia_id) VALUES (:corso_id, :materia_id)";
            $stmtID= $this->conn->prepare($query);
            $stmtID->bindParam(':corso_id', $id);
            $stmtID->bindParam(':materia_id', $materia_id);
            $stmtID->execute();
        }
        return $id;
    }

    function delete($id){
        $queryJOIN= "DELETE FROM ". $this->table_join . " WHERE corso_id=$id";
        $stmtJOIN= $this->conn->prepare($queryJOIN);
        if($stmtJOIN->execute()){
            $query="DELETE FROM ". $this->table_name ." WHERE id=$id";
            $stmt=$this->conn->prepare($query);    
            $stmt->execute();
            return true;
        }else{
            return false;
        }
    }

    function search($param,$val){
        $query="SELECT  posti, corsi.id AS id, corsi.nome AS corso, materie.nome AS materia 
        FROM corsi
        JOIN corsi_materie ON corsi.id = corsi_materie.corso_id 
        JOIN materie ON corsi_materie.materia_id = materie.id
        WHERE 
        (:parametro = 'nome' AND corsi.nome = :value) OR 
        (:parametro = 'posti' AND corsi.posti = :value) OR
        (:parametro = 'materie' AND materie.nome = :value)";

        $stmt= $this->conn->prepare($query);
        $stmt->bindParam(':parametro', $param);
        $stmt->bindParam(':value', $val);
        if($stmt->execute()){
            return $stmt;
        }else{
            return false;
        }
    }
}

?>