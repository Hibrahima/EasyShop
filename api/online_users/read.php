<?php
// required headers
header("Access-Control-Allow-Origin: *");
require_once '../config/database.php';
require_once '../models/online_users.php';
 
$database = new Database();
$db = $database->getConnection();

$online_user = new OnlineUser($db);
 
$stmt = $online_user->get_all_online_users();
$num = $stmt->rowCount();

if($num > 0){
    $online_users_arr=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        $online_user_item=array(
            "id" => $id,
            "name" => $name
        );
 
        array_push($online_users_arr, $online_user_item);
    }
 
    echo json_encode($online_users_arr);
}
 
else{
   $result->status = "empty";
   $result->message = "No online users";
   echo json_encode($result);
}
?>