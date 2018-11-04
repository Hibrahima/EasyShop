<?php
// required headers
header("Access-Control-Allow-Origin: *");

require_once '../config/database.php';
require_once '../models/category.php';
 
$database = new Database();
$db = $database->getConnection();

$category = new Category($db);
 $stmt = $category->get_all_categories();
$num = $stmt->rowCount();

if($num>0){
    $categories_arr=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $category_item=array(
            "id" => $id,
            "name" => $name
        );
 
        array_push($categories_arr, $category_item);
    }
 
    echo json_encode($categories_arr);
}
 
else{
  $result->status = "empty";
    $result->message = "No categories found";
    echo json_encode($result);
}
?>