<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "users";
    
    // object properties
    private $id;
    private $first_name;
    private $last_name;
    private $password;
    private $password_confirm;
    private $email;
    private $street;
    private $postal_code;
    private $city;
    private $country;
    private $credit_card_number;
    private $cvc;
    private $credit_card_expiry_date;
    private $birthday;


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

    function get_first_name(){
        return $this->first_name;
    }

    function set_first_name($first_name){
        $this->first_name = $first_name;
    }

    function get_last_name(){
        return $this->last_name;
    }

    function set_last_name($last_name){
        $this->last_name = $last_name;
    }

    function get_password(){
        return $this->password;
    }

    function set_password($password){
        $this->password = $password;
    }

    function get_password_confirm(){
        return $this->password_confirm;
    }

    function set_password_confirm($password_confirm){
        $this->password_confirm = $password_confirm;
    }

    function get_email(){
        return $this->email;
    }

    function set_email($email){
        $this->email = $email;
    }

    function get_street(){
        return $this->street;
    }

    function set_street($street){
        $this->street = $street;
    }
    
    function get_postal_code(){
        return $this->postal_code;
    }

    function set_postal_code($postal_code){
        $this->postal_code = $postal_code;
    }
    
    function get_city(){
        return $this->city;
    }

    function set_city($city){
        $this->city= $city;
    }
    
    function get_country(){
        return $this->country;
    }

    function set_country($country){
        $this->country = $country;
    }
    
    function get_credit_card_number(){
        return $this->credit_card_number;
    }

    function set_credit_card_number($credit_card_number){
        $this->credit_card_number = $credit_card_number;
    }
    
    function get_cvc(){
        return $this->cvc;
    }

    function set_cvc($cvc){
        $this->cvc = $cvc;
    }
    
    function get_credit_card_expiry_date(){
        return $this->credit_card_expiry_date;
    }

    function set_credit_card_expiry_date($credit_card_expiry_date){
        $this->credit_card_expiry_date = $credit_card_expiry_date;
    }
    
    function get_birthday(){
        return $this->birthday;
    }

    function set_birthday($birthday){
        $this->birthday = $birthday;
    }
    
    function get_all_users(){
        // select all query
        $query = "SELECT * from ".$this->table_name ;
        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        
        // execute query
        $stmt->execute();
        
        return $stmt;
    }


    // create product
    function create(){
     
    // query to insert record
        $query = "INSERT INTO ".$this->table_name." SET first_name=:first_name, last_name=:last_name, password=:password, email=:email, street=:street, postal_code=:postal_code, city=:city, country=:country, credit_card_number=:credit_card_number, cvc=:cvc, credit_card_expiry_date=:credit_card_expiry_date, birthday=:birthday";
        
    // prepare query
        $stmt = $this->conn->prepare($query);
        
    // sanitize
        $this->first_name=htmlspecialchars(strip_tags($this->first_name));
        $this->last_name=htmlspecialchars(strip_tags($this->last_name));
        //$this->password=htmlspecialchars(strip_tags($this->password));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->street=htmlspecialchars(strip_tags($this->street));
        $this->postal_code=htmlspecialchars(strip_tags($this->postal_code));
        $this->city=htmlspecialchars(strip_tags($this->city));
        $this->country=htmlspecialchars(strip_tags($this->country));
        $this->credit_card_number=htmlspecialchars(strip_tags($this->credit_card_number));
        $this->cvc=htmlspecialchars(strip_tags($this->cvc));
        $this->credit_card_expiry_date=htmlspecialchars(strip_tags($this->credit_card_expiry_date));
        $this->birthday=htmlspecialchars(strip_tags($this->birthday));

    // bind values
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":street", $this->street);
        $stmt->bindParam(":postal_code", $this->postal_code);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":country", $this->country);
        $stmt->bindParam(":credit_card_number", $this->credit_card_number);
        $stmt->bindParam(":cvc", $this->cvc);
        $stmt->bindParam(":credit_card_expiry_date", $this->credit_card_expiry_date);
        $stmt->bindParam(":birthday", $this->birthday);

    // execute query
        if($stmt->execute()){
            return true;
        }
        
        return false;
        
    }

    function get_user_credentials($email, $password){
         $query = "SELECT email, password from ".$this->table_name." where email=:email and password=:password" ;

       // $query = "select email, password from users where email = "abc@gmail.com" and password= SHA2("abc", 256)";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":password", $password);
        // execute query
        $stmt->execute();

        return $stmt;
    }

    function get_user_emails(){
        $query = "SELECT email from ".$this->table_name ;

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function get_user_by_email($email){
        $query = "SELECT * from ".$this->table_name." where email=:email";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        return $stmt;
    }

    function get_user_by_id($user_id){
        $query = "SELECT * from ".$this->table_name." where id=:user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":user_id", $user_id);
        $stmt->execute();
        return $stmt;
    }
}
?>