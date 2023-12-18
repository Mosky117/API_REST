<?php

class Materia{
    private $conn;
	private $table_name = "materie";
	private $table_join = "corsi_materie";
    public $nome;
    public $id;
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $query = "SELECT id, nome FROM " . $this->table_name;
		$stmt = $this->conn->prepare($query);
		// execute query
		$stmt->execute();
		return $stmt;
    }

    function create($nome){
        $query = "INSERT INTO " . $this->table_name . " SET nome=:nome";

        $stmt = $this->conn->prepare($query);

        $this->nome= htmlspecialchars(strip_tags($nome));

        $stmt->bindParam(":nome",$this->nome);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function update($id, $nome){
        $query = "UPDATE ". $this->table_name . " SET nome=:nome WHERE id=$id";

        $stmt= $this->conn->prepare($query);

        $this->nome= htmlspecialchars(strip_tags($nome));

        $stmt->bindParam(":nome",$this->nome);
        
        if($stmt->execute()){
            return true;
        }
        return false;
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
}

?>