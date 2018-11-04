<?php

class DeliveryAddress{

	// database connection and table name
    private $conn;
    private $table_name = "delivery_address";

	private $customer_first_name;
	private $customer_last_name;
	private $customer_email;
	private $customer_country;
	private $customer_city; 
	private $customer_postal_code; 
	private $customer_credit_card_number;
	private $customer_cvc; 
	private $customer_credit_card_expiry_date;

	// constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    public function create($customer_first_name, $customer_last_name, $customer_email, $customer_country, $customer_city, $customer_postal_code, $customer_credit_card_number, $customer_cvc, $customer_credit_card_expiry_date){

    	$query = "INSERT INTO ".$this->table_name . " SET customer_first_name=:customer_first_name, customer_last_name=:customer_last_name, customer_email=:customer_email, customer_country=:customer_country, customer_city=:customer_city, customer_postal_code=:customer_postal_code, customer_credit_card_number=:customer_credit_card_number, customer_cvc=:customer_cvc, customer_credit_card_expiry_date=:customer_credit_card_expiry_date";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":customer_first_name", $customer_first_name);
        $stmt->bindValue(":customer_last_name", $customer_last_name);
        $stmt->bindValue(":customer_email", $customer_email);
        $stmt->bindValue(":customer_country", $customer_country);
        $stmt->bindValue(":customer_city", $customer_city);
        $stmt->bindValue(":customer_postal_code", $customer_postal_code);
        $stmt->bindValue(":customer_credit_card_number", $customer_credit_card_number);
        $stmt->bindValue(":customer_cvc", $customer_cvc);
        $stmt->bindValue(":customer_credit_card_expiry_date", $customer_credit_card_expiry_date);

        if($stmt->execute()){
            return true;
        }
        
        return false;

    }


}

?>