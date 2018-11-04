<?php
session_start();

require_once '../config/database.php';
require_once '../models/online_users.php';

$database = new Database();
$db = $database->getConnection();
$online_user = new OnlineUser($db);

//Delete this user from online_users table
$online_user->delete_online_user($_SESSION["ONLINE_USER_ID"]);
unset($_SESSION['SESS_LOGGEDIN']);
unset($_SESSION['SESS_USERNAME']);
unset($_SESSION['SESS_USEREMAIL']);
unset($_SESSION['SESS_USERID']);
session_destroy();
header("Location: " . "http://localhost/Project/presentation.php");
?>
