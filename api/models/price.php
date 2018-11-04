<?php
class Price{
   
    // database connection and table name
    private $conn;
    private $table_name = "prices";
    
    // object properties
    private $id;
    private $price;
    private $grammage;
    private $product_id;
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


    function get_price(){
        return $this->price;
    }

    function set_price($price){
        $this->price = $price;
    }


    function get_grammage(){
        return $this->grammage;
    }

    function set_grammage($grammage){
        $this->grammage = $grammage;
    }

    function get_product_id(){
        return $this->product_id;
    }

    function set_product_id($product_id){
        $this->product_id = $product_id;
    }


    function get_all_prices(){
        // select all query
        $query = "SELECT * from prices";
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        
        // execute query
        $stmt->execute();
        
        return $stmt;
    }


    // create product
    function create(){
       
    // query to insert record
        $query = "INSERT INTO ".$this->table_name." SET price=:price, grammage=:grammage, product_id=:product_id";

         
    // prepare query
        $stmt = $this->conn->prepare($query);
        
    // sanitize
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->grammage=htmlspecialchars(strip_tags($this->grammage));
        $this->product_id=htmlspecialchars(strip_tags($this->product_id));

       // echo "in price create method price ".$this->price." grammage ".$this->grammage;
        
    // bind values
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":grammage", $this->grammage); 
        $stmt->bindParam(":product_id", $this->product_id);
        //$prices = array();
        //$prices = get_all_prices();
       
        //echo "all prices ".$prices;
        //$stmt->bindValue(":product_id", $product_id);
        
    // execute query
        echo "+++++++++++++++++++++++++++++++++JUST BEFORE EXECEUTE";
        if($stmt->execute()){
            echo "++++++++++++++++++++++++++++++price should be inserted";
            return true;
        }
        
        return false;
        
    }
}
?>