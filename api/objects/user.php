<?php

class User{

    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $email;
    public $password;
    public $remember_token;
    public $created;


    public function __construct($db){
        $this->conn = $db;
    }

    function register(){

        $query = "INSERT INTO " . $this->table_name . " (username,password) VALUES(:username, :password)";

        $stmt = $this->conn->prepare($query);

        //sanitize
        $this->username=htmlspecialchars(strip_tags($this->username));

        // pwd hashing
        $this->password=password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function usernameExists(){

        $query = "SELECT id, email, password
         FROM " . $this->table_name . "
         WHERE username = ? LIMIT 0,1";

         $stmt = $this->conn->prepare($query);

    // sanitize
    $this->username=htmlspecialchars(strip_tags($this->username));
 
    // bind given username value
    $stmt->bindParam(1, $this->username);
 
    // execute the query
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
 
    // if username exists, assign values to object properties for easy access and use for php sessions
    if($num>0){
 
        // get record details / values
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
        // assign values to object properties
        $this->id = $row['id'];
        $this->email = $row['email'];
        $this->password = $row['password'];
 
        // return true because username exists in the database
        return true;
    }
 
    // return false if username does not exist in the database
    return false;
}

 
// update() method will be here
    }

    
    