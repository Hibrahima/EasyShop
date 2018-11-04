<?php
class Delivery{
   
    // database connection and table name
    private $conn;
    private $table_name = "delivery_type";
    
    // object properties
    private $id;
    private $name;
    private $price;
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

    function get_price(){
        return $this->price;
    }

    function set_price($price){
        $this->price= $price;
    }


    function get_all_delivery_types(){
        $query = "SELECT * from ".$this->table_name ;
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        
        return $stmt;
    }


    function create($name, $price){
        $query = "INSERT INTO
        " . $this->table_name . "SET name=:name, price=:price";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":price", $price);
        
        if($stmt->execute()){
            return true;
        }
        
        return false;
    }
}
?>