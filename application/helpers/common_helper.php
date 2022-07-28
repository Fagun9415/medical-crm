<?php 

function send_mail($email,$message,$subject)
{
	require(APPPATH . 'third_party/phpmailer/PHPMailerAutoload.php');
	//require(APPPATH . 'third_party/phpmailer/class.smtp.php');

	$mail = new PHPMailer;

	$mail->isSMTP(); // Set mailer to use SMTP
	$mail->Host = 'mail.appmessa.com'; // Specify main and backup SMTP servers
	$mail->SMTPAuth = true; // Enable SMTP authentication
	$mail->Username = 'info@appmessa.com'; // email address // SMTP username
	$mail->Password = 'MESSA@2020'; //password // SMTP password
	$mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465; // TCP port to connect to

	$mail->setfrom('info@appmessa.com');
	$mail->addAddress($email); // Add a recipient
	$mail->isHTML(true); // Set email format to HTML

	$mail->Subject = $subject;
	$mail->Body = $message;
	$mail->send();
}


?>