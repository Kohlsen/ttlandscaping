<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function sendMail($name, $email, $phone, $subject, $message) {
	$mail = new PHPMailer(true);
	try {
		//Server settings
		$mail->isSMTP();    
		$mail->SMTPDebug = 2;
		$mail->SMTPAutoTLS = FALSE;                                  // Set mailer to use SMTP
		$mail->Host = 'smtpout.secureserver.net';                       // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authenication
		$mail->Username = 'jimmy@toptierlandscapingkc.com';             // SMTP username
		$mail->Password = 'UMKCRoos123';                    // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		//Recipients
		$recipientEmail = 'jimmy@toptierlandscapingkc.com';
		$mail->setFrom($recipientEmail, 'Mailer');
		$mail->addAddress('kohlsenburton@gmail.com');
		$mail->addReplyTo($email);

		//Content
		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body    = "Email: '$email'<br />Name: '$name'<br />Phone: '$phone'<br />Message: '$message'";
		$mail->AltBody = "Email: '$email'\nName: '$name'\nMessage: '$message'";

		$mail->send();

		return true;
	} catch (Exception $e) {
		$result["sent"] = false;
		$result["error"] = $mail->ErrorInfo;
		return $mail->ErrorInfo;
	}
}