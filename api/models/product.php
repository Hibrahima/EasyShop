<?php
class Product{

    // database connection and table name
    private $conn;
    private $table_name = "products";

    // object properties
    private $id;
    private $name;
    private $image_url;
    private $order_quantity;
    private $stock;
    private $type;
    private $order_id;
    private $category_id;
    private $price50_gr;
    private $price100_gr;
    private $price150_gr;

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


    function get_category_id(){
        return $this->category_id;
    }

    function set_category_id($category_id){
        $this->category_id = $category_id;
    }


    function get_order_quantity(){
        return $this->order_quantity;
    }

    function set_order_quantity($order_quantity){
        $this->order_quantity = $order_quantity;
    }


    function get_stock(){
        return $this->stock;
    }

    function set_stock($stock){
        $this->stock = $stock;
    }


    function get_type(){
        return $this->type;
    }

    function set_type($type){
        $this->type = $type;
    }

    function get_price50_gr(){
        return $this->price50_gr;
    }

    function set_price50_gr($price50_gr){
        $this->price50_gr = $price50_gr;
    }

    function get_price100_gr(){
        return $this->price100_gr;
    }

    function set_price100_gr($price100_gr){
        $this->price100_gr = $price100_gr;
    }


    function get_price150_gr(){
        return $this->price150_gr;
    }

    function set_price150_gr($price150_gr){
        $this->price150_gr = $price150_gr;
    }


    function get_all_products(){
        // select all query
        $query = "SELECT c.name as category_name, p.id, p.name, p.image_url, p.type, p.category_id, p.price50_gr, p.price100_gr, p.price150_gr from ".$this->table_name." p inner join categories c on p.category_id = c.id" ;

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function get_all_products_by_type($type){

        // select all query
        $query = "SELECT c.name as category_name, p.id, p.name, p.image_url, p.stock, p.type, p.category_id, p.price50_gr, p.price100_gr, p.price150_gr from ".$this->table_name." p inner join categories c on p.category_id = c.id where p.type=:type" ;

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(":type", $type);


        // execute query
        $stmt->execute();

        return $stmt;
    }



    // create product
    function create(){

    // query to insert record
        $query = "INSERT INTO " . $this->table_name . "
        SET
        name=:name, image_url=:image_url, stock=:stock, type=:type, category_id=:category_id, price50_gr=:price50_gr, price100_gr=:price100_gr, price150_gr=:price150_gr";

    // prepare query
        $stmt = $this->conn->prepare($query);

    // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->image_url=htmlspecialchars(strip_tags($this->image_url));
        $this->stock=htmlspecialchars(strip_tags($this->stock));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $this->type=htmlspecialchars(strip_tags($this->type));
        $this->price50_gr=htmlspecialchars(strip_tags($this->price50_gr));
        $this->price100_gr=htmlspecialchars(strip_tags($this->price100_gr));
        $this->price150_gr=htmlspecialchars(strip_tags($this->price150_gr));

    // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":image_url", $this->image_url);
        $stmt->bindParam(":stock", $this->stock);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":price50_gr", $this->price50_gr);
        $stmt->bindParam(":price100_gr", $this->price100_gr);
        $stmt->bindParam(":price150_gr", $this->price150_gr);

    // execute query
        if($stmt->execute()){
            return true;
        }

        return false;

    }

    function get_product_by_id($id){
        $query ="SELECT c.name as category_name, p.id, p.name, p.image_url, p.stock, p.type, p.category_id, p.price50_gr, p.price100_gr, p.price150_gr from ".$this->table_name." p inner join categories c on p.category_id = c.id where p.id=:id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":id", $id);

        $stmt->execute();
        return $stmt;
    }
}
?>