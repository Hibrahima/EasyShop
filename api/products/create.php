<?php
include_once '../config/database.php';
include_once '../models/product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
if(isset($_POST["product"])){

	echo "data from client ".$_POST["product"];
	$data = json_decode($_POST["product"]);
	//echo "product name ".$data->name;
	$product->set_name($data->name);
	$product->set_image_url($data->image_url);
	$product->set_type($data->type);
	$product->set_stock($data->stock);
	$product->set_category_id($data->category_id);
	echo "data prices[0] ".$data->prices[0];
	$product->set_price50_gr($data->prices[0]);
	$product->set_price100_gr($data->prices[1]);
	$product->set_price150_gr($data->prices[2]);

	
	if($product->create()){
		$result->status = "success";
		$result->message = "Product ".$product->get_name()." was successfully created.";
		echo json_encode($result);
	}
	else{
		$result->status = "fail";
		$result->message = "Product ".$product->get_name()." cannot be created.";
		echo json_encode($result);
	}
	

}
else{
	$result->status = "empty";
	$result->message = "No data posted.";
	echo json_encode($result);
}


?>