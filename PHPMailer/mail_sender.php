<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'Exception.php';
require_once 'PHPMailer.php';
require_once 'SMTP.php';

class MailSender{


	function send_mail($email, $subject, $body){
		$mail = new PHPMailer(true); 
		try{

			$mail->isSMTP();        					// Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                     // Enable SMTP authentication
			$mail->Username = 'webdeveloper8102@gmail.com';          // SMTP username
			$mail->Password = 'WebDeveloper@1989'; // SMTP password
			$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                          // TCP port to connect to

			$mail->setFrom('webdeveloper8102@gmail.com', 'Web Developer');
			$mail->addReplyTo('webdeveloper8102@gmail.com', 'Web Developer');
			$mail->addAddress($email);   // Add a recipient
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');

			$mail->isHTML(true);  // Set email format to HTML

			$mail->Subject = $subject;
			$mail->Body    = $body;

			$mail->send();

			return true;

		}catch(Exception $e){
			return false;
		}
	}

}


?>