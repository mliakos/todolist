<?php
class Note{

    //database connection and table name
    private $conn;
    private $table_name = "notes";

    //object properties

    public $id;
    public $body;
    public $status;
    public $category;
    public $created;

    //constructor with $db as database connection

    public function __construct($db){
        $this->conn = $db;
    }

    //get notes
    function get_all(){

        // select all query
        $query = "SELECT id, body, status, category, created
        FROM . $this->table_name";

        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
}

    function create(){

        //query to insert
        $query = "INSERT INTO " . $this->table_name . " (body,category) VALUES(:body, :category)";
        
        //prepare query 
        $stmt = $this->conn->prepare($query);

         //sanitize
        $this->body=htmlspecialchars(strip_tags($this->body));
        $this->category=htmlspecialchars(strip_tags($this->category));

        //bind values
        $stmt->bindParam(":body", $this->body);
        $stmt->bindParam(":category", $this->category);
        
         //execute query
         if($stmt->execute()){
            return true;
        }

        return false;
    }
}