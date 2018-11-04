<?php
// required headers
header("Access-Control-Allow-Origin: *");

require_once '../config/database.php';
require_once '../models/accesory.php';
 
$database = new Database();
$db = $database->getConnection();
 
$accesory = new Accesory($db);
$stmt = $accesory->get_all_accesories();
$num = $stmt->rowCount();

if($num>0){
    $accesories_arr=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $accesory_item=array(
            "id" => $id,
            "name" => $name,
            "image_url" =>$image_url,
            "price" =>$price,
            "category_name" =>$category_name
        );
 
        array_push($accesories_arr, $accesory_item);
    }
 
    echo json_encode($accesories_arr);
}
 
else{
    $result->status = "empty";
    $result->message = "No accesories found";
    echo json_encode($result);
}
?>