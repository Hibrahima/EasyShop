<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
require_once '../config/database.php';
require_once '../models/user.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$user = new User($db);
 
// query users
$stmt = $user->get_all_users();
$num = $stmt->rowCount();

 
// check if more than 0 record found
if($num>0){
 
    // products array
    //$products_arr=array();
    $users_arr=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
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
        array("message" => "No users found.")
    );
}
?>