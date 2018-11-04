<?php
class Category{
   
    private $conn;
    private $table_name = "categories";
    
    private $id;
    private $name;
   
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


    function get_all_categories(){
        $query = "SELECT * from ".$this->table_name ;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }

    function create($name){
       
        $query = "INSERT INTO ".$this->table_name . " SET name=:name";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":name", $name);
    
        if($stmt->execute()){
            return true;
        }
        
        return false;
        
    }
}
?>