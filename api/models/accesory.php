<?php
class Accesory{
   
    // database connection and table name
    private $conn;
    private $table_name = "accesories";
    
    // object properties
    private $id;
    private $name;
    private $image_url;
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

    function get_image_url(){
        return $this->image_url;
    }

    function set_image_url($image_url){
        $this->image_url = $image_url;
    }

    function get_price(){
        return $this->price;
    }

    function set_price($price){
        $this->price = $price;
    }


    function get_all_accesories(){
        $query = "SELECT c.name as category_name, a.id, a.name, a.price, a.image_url, a.category_id  from ".$this->table_name." a inner join categories c on c.id = a.category_id" ;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }


    function create($name, $price){
        $query = "INSERT INTO ".$this->table_name . " SET name=:name, price=:price";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":price", $price);
        if($stmt->execute()){
            return true;
        }
        
        return false;
    }

    function get_accesory_by_id($id){
        $query ="SELECT c.name as category_name, a.id, a.name, a.price, a.image_url, a.category_id, a.type  from ".$this->table_name." a inner join categories c on c.id = a.category_id where a.id=:id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", $id);

        $stmt->execute();
        return $stmt;
    }
}
?>