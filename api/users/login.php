<?php

session_start();

include_once '../config/database.php';
include_once '../config/config.php';
include_once '../models/user.php';
include_once '../models/order.php';
include_once '../models/online_users.php';

if(isset($_SESSION['SESS_LOGGEDIN']) == TRUE) {
	header("Location: " . $config_basedir);
}

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$order = new Order($db);
$online_user = new OnlineUser($db);
if(isset($_POST["user_credentials"])){
	$data = json_decode($_POST["user_credentials"]);
	$email = $data->email;
	$hashed_password = hash("sha256", $data->password);
	$stmt = $user->get_user_credentials($email, $hashed_password);
	$num = $stmt->rowCount();
	if($num == 1){
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$user_info_sql = $user->get_user_by_email($email);
		$user_info_row = $user_info_sql->fetch(PDO::FETCH_ASSOC);
		$_SESSION['SESS_LOGGEDIN'] = 1;

		$_SESSION['SESS_USERNAME'] = $user_info_row['first_name']." ".$user_info_row['last_name'];

		$_SESSION['SESS_USEREMAIL'] = $user_info_row["email"];

		$_SESSION['SESS_USERID'] = $user_info_row['id'];

		//Extra info for delivery address popup modal
		$_SESSION['SESS_USER_FIRST_NAME'] = $user_info_row["first_name"];

		$_SESSION['SESS_USER_LAST_NAME'] = $user_info_row["last_name"];

		$_SESSION['SESS_USER_COUNTRY'] = $user_info_row["country"];

		$_SESSION['SESS_USER_CITY'] = $user_info_row["city"];

		$_SESSION['SESS_USER_POSTAL_CODE'] = $user_info_row["postal_code"];

		$_SESSION['SESS_USER_CREDIT_CARD_NUMBER'] = $user_info_row["credit_card_number"];

		$_SESSION['SESS_USER_CVC'] = $user_info_row["cvc"];

		$_SESSION['SESS_USER_CREDIT_CARD_EXPIRY_DATE'] = $user_info_row["credit_card_expiry_date"];

		$order_sql = $order->get_user_orders($_SESSION['SESS_USERID']);
		$user_orders = $order_sql->fetch(PDO::FETCH_ASSOC);
		$_SESSION['SESS_ORDERNUM'] = $user_orders['id'];
		$result->status = true;

		//Add this user to online_users table;
		$user_exists = does_online_user_already_exist($online_user, $_SESSION['SESS_USEREMAIL']);
        if(!$user_exists){
        	$online_user->create($_SESSION['SESS_USERNAME'], $_SESSION['SESS_USEREMAIL']);
			$_SESSION["ONLINE_USER_ID"] = $db->lastInsertId();
        }
		
		echo json_encode($result);

	}
	else{
		$result->status ="fail";
		$result->message = "The email address or the password is wrong! Please, try again!";
		echo json_encode($result);
	}
}
else{
	$result->status = "fail";
	$result->message ="Empty, no information";
	echo json_encode($result);
}

function does_online_user_already_exist($online_user, $user_email){
        $stmt = $online_user->get_all_online_users();
        //$num = $stmt->rowCount();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            if($email === $user_email){
                //echo "does already exist in inline users";
                return true;
            }
        }

        return false;
    }

?>