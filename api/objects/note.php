<?php
class Note{

    //database connection and table name
    private $conn;
    private $table_name = "notes";

    //object properties

    public $id;
    public $body;
    public $status;
    public $user_id;
    public $created;

    //constructor with $db as database connection

    public function __construct($db){
        $this->conn = $db;
    }

    //get all notes
    function get_all(){

        // select all query
        $query = "SELECT * FROM $this->table_name WHERE user_id = ?";

        //prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->user_id);

        //execute query
        $stmt->execute();

        return $stmt;
}

    function create(){

        //query to insert
        $query = "INSERT INTO " . $this->table_name . " (body,user_id) VALUES(:body, :user_id)";
        
        //prepare query 
        $stmt = $this->conn->prepare($query);

         //sanitize
        $this->body=htmlspecialchars(strip_tags($this->body));
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));

        //bind values
        $stmt->bindParam(":body", $this->body);
        $stmt->bindParam(":user_id", $this->user_id);
        
         //execute query
         if($stmt->execute()){
            return $this->conn->lastInsertId();
        }

        return false;
    }

   
    function delete(){
 
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

    function update_status(){
 
        // update query
        $query = "UPDATE " . $this->table_name . " SET status = :status WHERE id = :id";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->status=htmlspecialchars(strip_tags($this->status));
     
        // bind new values
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':status', $this->status);
     
        // execute the query
        if($stmt->execute()){
            return true;
        }
     
        return false;
    }
}