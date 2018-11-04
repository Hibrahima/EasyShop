<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../config/database.php';
require_once '../models/product.php';
 
$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
$stmt = $product->get_all_products_by_type("infusion");
$num = $stmt->rowCount();

 
// check if more than 0 record found
if($num>0){
 

    $products_arr=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $product_item=array(
            "id" => $id,
            "name" => $name,
            "image_url" => $image_url,
            "order_quantity" => $order_quantity,
            "stock" => $stock,
            "type" => $type,
            "category_id" => $category_id,
            "category_name" => $category_name,
            "price50_gr" => $price50_gr,
            "price100_gr" => $price100_gr,
            "price150_gr" => $price150_gr,
            "order_id" => $order_id
        );
 
        array_push($products_arr, $product_item);
    }
 
    echo json_encode($products_arr);
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>