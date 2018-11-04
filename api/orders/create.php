<?php
session_start();
header("Access-Control-Allow-Origin: *");

require_once '../config/database.php';
require_once '../models/orderItem.php';
require_once '../models/order.php';
require_once '../../PHPMailer/mail_sender.php';
require_once '../models/delivery_address.php';

$database = new Database();
$db = $database->getConnection();
$order_item = new OrderItem($db);
$order = new Order($db);
$delivery_address = new DeliveryAddress($db);

if(isset($_POST["order"])){

	$data = json_decode($_POST["order"]);
	$products = $data->products;
	$delivery_address_info = $data->delivery_info;
	$shall_order_be_inserted = true;
	$shall_order_item_be_inserted = false;
	$is_order_ok = 0;
	$total_price = 0; 
	$delivery_price = $data->delivery_value;
	$delivery_id = $data->delivery_id;
	$non_logged_user_email = $data->email;

	//Delivery Address
	$customer_first_name = $delivery_address_info->customer_first_name;
	$customer_last_name  = $delivery_address_info->customer_last_name;
	$customer_email = $delivery_address_info->customer_email;
	$customer_country = $delivery_address_info->customer_country;
	$customer_city = $delivery_address_info->customer_city;
	$customer_postal_code = $delivery_address_info->customer_postal_code;
	$customer_credit_card_number = $delivery_address_info->customer_credit_card_number;
	$customer_cvc = $delivery_address_info->customer_cvc;
	$customer_credit_card_expiry_date = $delivery_address_info->customer_credit_card_expiry_date;

	foreach($products as $p){
		$product_id = $p->id;
		$product_quantity = $p->quantity;
		$variation_price = $p->variationPrice;
		//$delivery_id = $p->delivery_id;
		//$delivery_price = $p->delivery_value;
		$product_type = $p->type;
		if(isset($_SESSION['SESS_LOGGEDIN'])){
			if($shall_order_be_inserted == true){

				//Insert delivery address
				if($delivery_address->create($customer_first_name, $customer_last_name, $customer_email, $customer_country, $customer_city, $customer_postal_code, $customer_credit_card_number, $customer_cvc, $customer_credit_card_expiry_date)){

					$delivery_address_id = $db->lastInsertId();

					//Insert order
					if($order->insert_order_for_logged_in_user($_SESSION['SESS_USERID'], 1, $delivery_id, $delivery_address_id)){
						$_SESSION['SESS_ORDERNUM'] = $db->lastInsertId();
						$shall_order_be_inserted = false;
						$shall_order_item_be_inserted = true;
					}
				}

				
			}

			if($shall_order_item_be_inserted){
				if($product_type == "accesory"){
					if($order_item->insert_order_item_accesories($_SESSION['SESS_ORDERNUM'], $product_id, $product_quantity, $variation_price)){
						$is_order_ok = 1;
						$result->status = "completed";
						$result->message = "Order successfully received";
						//echo json_encode($result);
					}
					else{
						$result->status = "Fail";
						$result->message = "Cannot add order with id ".$_SESSION['SESS_ORDERNUM'];
						//echo json_encode($result);
					}
				}
				else{
					if($order_item->insert_order_item_teas_and_infusions($_SESSION['SESS_ORDERNUM'], $product_id, $product_quantity, $variation_price)){
						$is_order_ok = 1;
						$result->status = "completed";
						$result->message = "Order successfully received";
						//echo json_encode($result);
					}
					else{
						$result->status = "Fail";
						$result->message = "Cannot add order with id ".$_SESSION['SESS_ORDERNUM'];
						//echo json_encode($result);
					}
				}
			}

		}
		else{
			if($shall_order_be_inserted){	

				//Insert delivery address
				if($delivery_address->create($customer_first_name, $customer_last_name, $customer_email, $customer_country, $customer_city, $customer_postal_code, $customer_credit_card_number, $customer_cvc, $customer_credit_card_expiry_date)){

					$delivery_address_id = $db->lastInsertId();

					//Insert order
					if($order->insert_order_for_non_logged_in_user(0, session_id(), $delivery_id, $delivery_address_id)){
						$_SESSION['SESS_ORDERNUM'] = $db->lastInsertId();
						$shall_order_be_inserted = false;
						$shall_order_item_be_inserted = true;
					}
				}
			}
			

			if($shall_order_item_be_inserted){
				if($product_type == "accesory"){
					if($order_item->insert_order_item_accesories($_SESSION['SESS_ORDERNUM'], $product_id, $product_quantity, $variation_price)){
						$is_order_ok = 1;
						$result->status = "completed";
						$result->message = "Order successfully received";
						//echo json_encode($result);
					}
					else{
						$result->status = "Fail";
						$result->message = "Cannot add order with id ".$_SESSION['SESS_ORDERNUM'];
						//echo json_encode($result);
					}
				}else{
					if($order_item->insert_order_item_teas_and_infusions($_SESSION['SESS_ORDERNUM'], $product_id,    $product_quantity, $variation_price)){
						$is_order_ok = 1;
						$result->status = "completed";
						$result->message = "Order successfully received";
						//echo json_encode($result);
					}
					else{
						$result->status = "Fail";
						$result->message = "Cannot add order with id ".$_SESSION['SESS_ORDERNUM'];
						//echo json_encode($result);
					}
				}
				
			}

		}
		

		$total_price += $variation_price * $product_quantity;
	}

	$total_price += $delivery_price;

	if($is_order_ok == 1){

		if($order->update_order_status($_SESSION['SESS_ORDERNUM'], "complete")){
			$result->status = "success";
			$result->message= "Order status successfully updated";
			//echo json_encode($result);
		}

		if($order->update_order_total($_SESSION['SESS_ORDERNUM'], $total_price)){
			$result->status = "success";
			$result->message= "Order total successfully updated";
			$result->is_ok = true;
			$result->is_ok_message = "Thank you for your order. Your order has been successfully received.";
			$result->count = count($data);
			//if(isset($_SESSION['SESS_USEREMAIL']))
			//	send_confirmation($_SESSION['SESS_USEREMAIL'], $data);
			//else
				send_confirmation($customer_email, $data);

			echo json_encode($result);
		}
	}
	else{
		$result->status = "fail";
		$result->message= "Order cannot be processed";
		echo json_encode($result);
	}

}

function send_confirmation($email, $data){
	$mail_sender = new MailSender();
	$subject = "Go4Tea - Order Confirmation";
	$delivery_address_info = $data->delivery_info;

	$user_full_name = $delivery_address_info->customer_first_name." ".$delivery_address_info->customer_last_name;
	$body .= "<h1> Thank you Mr./Mrs./ ".$user_full_name." for your order. Your order has been successfully reveived and processed .</h1> </br>";
	$body .= "This is a confirmation email. <strong>Please, do not reply!</strong> <br/>";

	
	$body .= "Here is the order information <br/> <br/>";

    $th_td_style = "border: 1px solid #dddddd;text-align: left;padding: 8px;";
	$products_table = '<table style="font-family: arial, sans-serif;border-collapse: collapse;">';
	$products_table .= '<tr>';
	$products_table .= '<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> Product name </th>';
	$products_table .= '<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> Quantity </th>';
	$products_table .= '<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> Price </th>'; 
	$products_table .= '<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> Product Type </th>';
	$products_table .=  '</tr>';
	$total_price = 0; 
	$delivery_price = $data->delivery_value;
	$cpt = 0;
	foreach($data->products as $p){
		$cpt++;
		if($cpt %2 == 0)
			$products_table .= '<tr style="background-color: #dddddd">';
		else
			$products_table .= '<tr>';
		$products_table .= '<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$p->name.'</td>';
		$products_table .= '<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$p->quantity.'</td>';
		$products_table .= '<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$p->variationPrice.'</td>';
		$products_table .= '<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">'.$p->type.'</td>';
		$products_table .= "</tr>";
		$total_price += $p->variationPrice * $p->quantity;
		//$delivery_price = $p->delivery_value;
	}
	$products_table .= "</table>";
	$total_with_delivery = $total_price + $delivery_price;

	$body .= $products_table;
	$right_div = '<div style="margin-top: 20px;"> Total (Without Delivery) : '.$total_price.' &euro;'.' <br/> Delivery Cost : '.$delivery_price.' &euro;'. '<br/> Total (With Delivery) : '.$total_with_delivery.' &euro; <br/> </div>';
	$body .= $right_div;

	$mail_sender->send_mail($email, $subject, $body);
}

?>