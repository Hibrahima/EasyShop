<?php
class Order{
 
    // database connection and table name
    private $conn;
    private $table_name = "orders";
    
    // object properties
    private $id;
    private $user_id;
    private $registered;
    private $order_date;
    private $status;
    private $session;
    private $total;
    private $delivery_id;
   

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

    function get_user_id(){
        return $this->user_id;
    }

    function set_user_id($user_id){
        $this->user_id = $user_id;
    }

    function get_registered(){
        return $this->registered;
    }

    function set_registered($registered){
        $this->registered = $registered;
    }

    function get_order_date(){
        return $this->order_date;
    }

    function set_order_date($order_date){
        $this->order_date = $order_date;
    }

    function get_status(){
        return $this->status;
    }

    function set_status($status){
        $this->status = $status;
    }

    function get_session(){
        return $this->session;
    }

    function set_session($session){
        $this->session = $session;
    }

    function get_total(){
        return $this->total;
    }

    function set_total($total){
        $this->total = $total;
    }
    
    function get_delivery_id(){
        return $this->delivery_id;
    }

    function set_delivery_id($delivery_id){
        $this->delivery_id = $delivery_id;
    }
    

    function insert_order_for_logged_in_user($user_id, $registered, $delivery_id, $delivery_address_id){
        $query = "INSERT INTO ".$this->table_name." SET user_id=:user_id, registered=:registered, order_date=:order_date, delivery_id=:delivery_id, delivery_address_id=:delivery_address_id";
         $stmt = $this->conn->prepare($query);
         $stmt->bindValue(":user_id", $user_id);
         $stmt->bindValue(":registered", $registered);
         $today = date("d-m-Y"); 
         $stmt->bindValue(":order_date", $today);
         $stmt->bindValue(":delivery_id", $delivery_id);
         $stmt->bindValue(":delivery_address_id", $delivery_address_id); 

        if($stmt->execute()){
            return true;
         }
        
        return false;
    }

    function insert_order_for_non_logged_in_user($registered, $session, $delivery_id, $delivery_address_id){
        $query = "INSERT INTO ".$this->table_name." SET registered=:registered, order_date=:order_date, session=:session, delivery_id=:delivery_id, delivery_address_id=:delivery_address_id";

         $stmt = $this->conn->prepare($query);
         $stmt->bindValue(":registered", $registered);
         $today = date("d-m-y"); 
         $stmt->bindValue(":order_date", $today); 
         $stmt->bindValue(":session", $session);
         $stmt->bindValue(":delivery_id", $delivery_id);
         $stmt->bindValue(":delivery_address_id", $delivery_address_id);

        if($stmt->execute()){
            return true;
         }
        
        return false;
    }

    function update_order_total($order_id, $total){
        $query = "UPDATE ".$this->table_name." SET total=:total where id=:order_id";
         $stmt = $this->conn->prepare($query);
         $stmt->bindValue(":order_id", $order_id); 
         $stmt->bindValue(":total", $total);

        if($stmt->execute()){
            return true;
         }
        
        return false;
    }

    function update_order_status($order_id, $status){
        $query = "UPDATE ".$this->table_name." SET status=:status where id=:order_id";
         $stmt = $this->conn->prepare($query);
         $stmt->bindValue(":order_id", $order_id); 
         $stmt->bindValue(":status", $status);

        if($stmt->execute()){
            return true;
         }
        
        return false;
    }

    function get_user_full_orders_teas_and_infusions($user_id){
        $query = "select oi.order_id, oi.product_id, oi.quantity, oi.variation_price, p.id as prod_id, p.name as prod_name, p.image_url as prod_image_url, p.type as prod_type, u.id as logged_user_id, da.customer_country, da.customer_city, da.customer_postal_code, o.id, o.user_id, o.order_date, o.status, o.total, d.id, d.name as delivery_type, d.price as delivery_cost from orders o inner join order_items oi on o.id = oi.order_id inner join products p on p.id = oi.product_id inner join delivery_type d on o.delivery_id = d.id inner join delivery_address da on o.delivery_address_id = da.id inner join users u where u.id =:user_id and o.user_id=:user_id order by o.order_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":user_id", $user_id);

        $stmt->execute();
        return $stmt;
    }

    function get_user_full_orders_accesories($user_id){
        $query = "select oi.order_id, oi.product_id, oi.quantity, oi.variation_price, ac.id as ac_id, ac.name as ac_name, ac.image_url as ac_image_url, ac.type as ac_type, u.id as logged_user_id, da.customer_country, da.customer_city, da.customer_postal_code, o.id, o.user_id, o.order_date, o.status, o.total, d.id, d.name as delivery_type, d.price as delivery_cost from orders o inner join order_items oi on o.id = oi.order_id inner join accesories ac on ac.id = oi.accesory_id inner join delivery_type d on o.delivery_id = d.id inner join delivery_address da on o.delivery_address_id = da.id inner join users u where u.id =:user_id and o.user_id=:user_id order by o.order_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":user_id", $user_id);

        $stmt->execute();
        return $stmt;
    }



    function get_user_orders($user_id){
        $query = "SELECT * from ".$this->table_name." where user_id=:user_id and status<:status";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":user_id", $user_id);
        $stmt->bindValue(":status", 2);
        
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    
}
?>