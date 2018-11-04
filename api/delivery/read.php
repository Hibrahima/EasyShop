<?php
header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
 
require_once '../config/database.php';
require_once '../models/delivery.php';
 
$database = new Database();
$db = $database->getConnection();
 
$delivery = new Delivery($db);
$stmt = $delivery->get_all_delivery_types();
$num = $stmt->rowCount();
if($num>0){
    $delivery_arr=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $delivery_item=array(
            "id" => $id,
            "name" => $name,
            "price" => $price
        );
 
        array_push($delivery_arr, $delivery_item);
    }
 
    echo json_encode($delivery_arr);
}
 
else{
    $result->message = "No delivery found";
   echo json_encode($result);
}
?>