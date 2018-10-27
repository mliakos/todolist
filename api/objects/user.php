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
}