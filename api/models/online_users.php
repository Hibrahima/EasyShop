<?php
class OnlineUser{
   
    // database connection and table name
    private $conn;
    private $table_name = "online_users";
    
    // object properties
    private $id;
    private $name;
    private $email;
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function get_id(){
        return $this->id;
    }

    function set_id($id){
        $this->id = $id;
    }


    function get_name(){
        return $this->name;
    }

    function set_name($name){
        $this->name= $name;
    }

    function get_email(){
        return $this->email;
    }

    function set_email($email){
        $this->email = $email;
    }


    function get_all_online_users(){
        $query = "SELECT * from ".$this->table_name ;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }


    function create($full_name, $email){
        $query = "INSERT INTO ".$this->table_name." set name = :name, email=:email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":name", $full_name);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
    }

    

    function delete_online_user($online_user_id){
        echo " online user id ".$online_user_id;
        $query = "delete from ".$this->table_name." where id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", $online_user_id);
        $stmt->execute();
    }
}
?>