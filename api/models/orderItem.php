<?php
class OrderItem{
 
    // database connection and table name
    private $conn;
    private $table_name = "order_items";
    
    // object properties
    private $id;
    private $order_id;
    private $product_id;
    private $quantity;
    private $variation_price;
   

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

    function get_order_id(){
        return $this->order_id;
    }

    function set_order_id($order_id){
        $this->order_id = $order_id;
    }

    function get_product_id(){
        return $this->product_id;
    }

    function set_product_id($product_id){
        $this->product_id = $product_id;
    }

    function get_quantity(){
        return $this->quantity;
    }

    function set_quantity($quantity){
        $this->quantity = $quantity;
    }

    function get_variation_price(){
        return $this->variation_price;
    }

    function set_variation_price($variation_price){
        $this->variation_price = $variation_price;
    }

    
    
    function get_order_items(){
        // select all query
        $query = "SELECT * from ".$this->table_name ;
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    function insert_order_item_teas_and_infusions($order_id, $product_id, $quantity, $variation_price){
        $query = "INSERT INTO ".$this->table_name." SET order_id=:order_id, product_id=:product_id, quantity=:quantity, variation_price=:variation_price";
       //$query = "insert into order_items(order_id, product_id, quantity, variation_price) values(1, 1, 1, 50)";
         $stmt = $this->conn->prepare($query);
         $stmt->bindValue(":order_id", $order_id);
         $stmt->bindValue(":product_id", $product_id);
         $stmt->bindValue(":quantity", $quantity); 
         $stmt->bindValue(":variation_price", $variation_price); 

        if($stmt->execute()){
            return true;
         }
        
        return false;
    }

    function insert_order_item_accesories($order_id, $accesory_id, $quantity, $variation_price){
        $query = "INSERT INTO ".$this->table_name." SET order_id=:order_id, accesory_id=:accesory_id, quantity=:quantity, variation_price=:variation_price";
       //$query = "insert into order_items(order_id, product_id, quantity, variation_price) values(1, 1, 1, 50)";
         $stmt = $this->conn->prepare($query);
         $stmt->bindValue(":order_id", $order_id);
         $stmt->bindValue(":accesory_id", $accesory_id);
         $stmt->bindValue(":quantity", $quantity); 
         $stmt->bindValue(":variation_price", $variation_price); 

        if($stmt->execute()){
            return true;
         }
        
        return false;
    }

    // create product
    /*function create(){
     
    // query to insert record
        $query = "INSERT INTO ".$this->table_name." SET user_id=:user_id, registered=:registered, order_date=:order_date, status=:status, session=:session, total=:total, delivery_id=:delivery_id";
        
    // prepare query
        $stmt = $this->conn->prepare($query);
        
    // sanitize
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        $this->registered=htmlspecialchars(strip_tags($this->registered));
        $this->order_date=htmlspecialchars(strip_tags($this->order_date));
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->session=htmlspecialchars(strip_tags($this->session));
        $this->total=htmlspecialchars(strip_tags($this->total));
        $this->delivery_id=htmlspecialchars(strip_tags($this->delivery_id));
    // bind values
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":registered", $this->registered);
        $stmt->bindParam(":order_date", $this->order_date);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":session", $this->session);
        $stmt->bindParam(":total", $this->total);
        $stmt->bindParam(":delivery_id", $this->delivery_id);
    // execute query
        if($stmt->execute()){
            return true;
        }
        
        return false;
        
    }*/

    /*function get_user_orders($user_id){
        $query = "SELECT id from ".$this->table_name." where user_id=:user_id and status<:status";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":user_id", $user_id);
        $stmt->bindValue(":status", 2);
        
        // execute query
        $stmt->execute();
        
        return $stmt;
    }*/

    
}
?>