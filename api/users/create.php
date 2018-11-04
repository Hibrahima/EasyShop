<?php

// get database connection
require_once '../config/database.php';
require_once '../../PHPMailer/mail_sender.php';
require_once '../models/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
if(isset($_POST["user"])){

	$data = json_decode($_POST["user"]);
	$user->set_first_name($data->firstName);
	$user->set_last_name($data->surname);
	//echo "Encrypted password server side = : ".$data->password."------";
	$hashed_password = hash("sha256", $data->password);
	$user->set_password($hashed_password); ///sha2()
	$user->set_email($data->email);
	$user->set_street($data->street);
	$user->set_postal_code($data->postalCode);
	$user->set_city($data->city);
	$user->set_country($data->country);
	$user->set_credit_card_number($data->bankAccount);
	$user->set_cvc($data->cvc);
	$user->set_birthday($data->birthday);
	$user->set_credit_card_expiry_date($data->creditCardExpiryDate);

	$user_exists = does_user_already_exist($user, $user->get_email());
	if($user_exists){
		$result->status = "Fail";
		$result->message = "This email address already exists! Please, log in";
		echo json_encode($result);

	}
	else{
		if($user->create()){
			$is_mail_sent = send_confirmation($data, $data->password);
			if($is_mail_sent){
				$result->status = "success";
				$result->message = "Your account has been succcessfully created. A confirmation email has been sent to you. You can log in now.";
			}
			else{
				$result->status = "success";
				$result->message = "Your account has been succcessfully created. You can log in now.";
			}

			echo json_encode($result);
			
		}
		else{
			$result->status = "Fail";
			$result->message = "Oups! Something went wrong. Your accout cannot be created.";
			echo json_encode($result);
		}
	}

}
else{
	$result->status = "Empty";
	$result->message = "No information";
	echo json_encode($result);
}



function does_user_already_exist($user, $user_email){
	$stmt = $user->get_user_emails();
	$num = $stmt->rowCount();
	if($num > 0){

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
	        if($email == $user_email){
	        	return true;
	        }
	    }
	}
	return false;
}

function send_confirmation($data, $user_password){
	$mail_sender = new MailSender();
	$subject = "Go4Tea - Account Registration Confirmation";
	$body = "<h1>Thank you Mr./Mrs/ ".$data->firstName." ".$data->surname." for registering with us. <br/>Your account has been <strong>succcessfully created.</strong> </h1> This is a confirmation email. <strong>Please, do not reply!</strong>";
	$body .= "<br/>Here is your registration email :  <br/> Email : ".$data->email." <br/>";
	$is_mail_sent = $mail_sender->send_mail($data->email, $subject, $body);

	return $is_mail_sent;
}


?>