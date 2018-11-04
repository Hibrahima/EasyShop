<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../config/database.php';
require_once '../models/product.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
if(isset($_GET["product_id"])){
    $product_id = $_GET["product_id"];
    $stmt = $product->get_product_by_id($product_id);
    $num = $stmt->rowCount();

    if($num == 1){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
         $product_item=array(
                "id" => $id,
                "name" => $name,
                "image_url" => $image_url,
                "stock" => $stock,
                "type" => $type,
                "category_id" => $category_id,
                "category_name" => $category_name,
                "price50_gr" => $price50_gr,
                "price100_gr" => $price100_gr,
                "price150_gr" => $price150_gr
            );       

        echo json_encode($product_item);
    }

    else{
        $result->message = "There is no product with id = ".$product_id;
        echo json_encode($result);
    }
    
}


?>