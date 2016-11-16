<?php

function emailSent ($email, $token){
	require '../PHPMailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.googlemail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'formationwf3@gmail.com';                 // SMTP username
	$mail->Password = 'formationwf3123';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;  
	$mail->setLanguage('fr', '/optional/path/to/language/directory/');                                  // TCP port to connect to

	$mail->setFrom('formationwf3@gmail.com', 'formationwf3');
	$mail->addAddress($email);     // Add a recipient
	// $mail->addAddress('ellen@example.com');               // Name is optional
	// $mail->addReplyTo('info@example.com', 'Information');
	// $mail->addCC('cc@example.com');
	// $mail->addBCC('bcc@example.com');

	// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	// $mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'Reinitialisation de l\'email';
	$mail->Body    = 'This is the HTML message body <b>Merci de cliquer sur le lien ci-dessous pour réinitialiser votre email<br>
		<a href="http://localhost/j41-sessions-lostpassword/lostpassword/reset.php?token='.$token.'">'.$token.'</a> </b>';
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	$success=true;
	if(!$mail->send()) {
	    $success=false;
	} 
	/*else {
	    echo 'Message has been sent';
	}*/

	return $success;
}
