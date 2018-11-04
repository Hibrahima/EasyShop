<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


require_once '../config/database.php';
require_once '../models/order.php';
$database = new Database();
$db = $database->getConnection();

$order = new Order($db);

if($_GET["id"]){
  $stmt = $order->get_user_full_orders_teas_and_infusions($_GET["id"]);
  $ac_stmt = $order->get_user_full_orders_accesories($_GET["id"]);
    $num = $stmt->rowCount(); $ac_num = $ac_stmt->rowCount();
    if($num > 0 || $ac_num > 0){
       $orders_arr=array();

       while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $order_item=array(
                "prod_id" => $prod_id,
                "prod_image_url" => $prod_image_url,
                "prod_name" => $prod_name,
                "prod_type" => $prod_type,
                "quantity" => $quantity,
                "unit_price" => $variation_price,
                "country" => $customer_country,
                "city" => $customer_city,
                "postal_code" => $customer_postal_code,
                "order_date" => $order_date,
                "order_status" => $status,
                "total" => $total,
                "delivery_type" => $delivery_type,
                "delivery_cost" => $delivery_cost 
            );

            array_push($orders_arr, $order_item);
        }

        
        while ($row = $ac_stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $order_item=array(
                "prod_id" => $ac_id,
                "prod_image_url" => $ac_image_url,
                "prod_name" => $ac_name,
                "prod_type" => $ac_type,
                "quantity" => $quantity,
                "unit_price" => $variation_price,
                "country" => $customer_country,
                "city" => $customer_city,
                "postal_code" => $customer_postal_code,
                "order_date" => $order_date,
                "order_status" => $status,
                "total" => $total,
                "delivery_type" => $delivery_type,
                "delivery_cost" => $delivery_cost 
            );

            array_push($orders_arr, $order_item);
        }

        echo json_encode($orders_arr);
    }   
    else{
        $result->status = "empty";
        $result->message = "No orders found.";
        echo json_encode($result);
    }
}
else{
    $result->status = "empty";
    $result->message = "No user id provided";
    json_encode($result);
}
?>