<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../config/database.php';
require_once '../models/accesory.php';

$database = new Database();
$db = $database->getConnection();
$accesory = new Accesory($db);
if(isset($_GET["product_id"])){
    $product_id = $_GET["product_id"];
    $stmt = $accesory->get_accesory_by_id($product_id);
    $num = $stmt->rowCount();

    if($num == 1){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
         $accesory_item=array(
                "id" => $id,
                "name" => $name,
                "image_url" => $image_url,
                "price" => $price,
                "category_name" => $category_name,
                "type" => $type
            );       

        echo json_encode($accesory_item);
    }

    else{
        $result->message = "There is no product with id = ".$product_id;
        echo json_encode($result);
    }
    
}


?>