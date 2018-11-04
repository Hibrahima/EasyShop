<?php
//header("Access-Control-Allow-Origin: *");

require_once '../config/database.php';
require_once '../models/user.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

if(isset($_GET["id"])){
     $stmt = $user->get_user_by_id($_GET["id"]);
     $num = $stmt->rowCount(); 
     if($num == 1){
       $row = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
        echo json_encode($row);
    }

    else{
      $result->status="unknown";
      $result->message = "Something uncommon happened";
      echo json_encode($result);
    }
}
?>