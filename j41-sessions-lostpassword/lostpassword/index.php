
<?php
require 'inc/config.php';
//require 'PHPMailer/PHPMailerAutoload.php';
require 'functions/functions.php';

$errorList = array();
$successList = array();
$emailLoginToto = '';

// Formulaire soumis
if (!empty($_POST)) {
	$emailLoginToto = isset($_POST['emailLoginToto']) ? trim($_POST['emailLoginToto']) : '';

	$formOk = true;
	if (empty($emailLoginToto)) {
		$errorList[] = 'Email est vide<br>';
		$formOk = false;
	}
	else if (!filter_var($emailLoginToto, FILTER_VALIDATE_EMAIL)) {
		$errorList[] = 'Email invalide<br>';
		$formOk = false;
	}

	if ($formOk) {
		// Récupérer les données de l'utilisateur s'il existe

		$sql = 'select * 
			from user 
			where usr_email= :email
			';

		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindValue(':email', $emailLoginToto);

		if ($pdoStatement->execute() === false) {
			$pdoStatement->errorInfo();
		}else{
				$rslt = $pdoStatement->fetch();
				if ($rslt){
					//Création du token
					$token = md5(time().'lostpassword'.$rslt['usr_id']);
					//print_r($token);

					$sql2 = 'UPDATE user 
					set usr_token= :token 
					where usr_id= :user_id
					';

					$pdoStatement2 = $pdo->prepare($sql2);
					$pdoStatement2->bindValue(':token', $token);
					$pdoStatement2->bindValue(':user_id', $rslt['usr_id']);
					if($pdoStatement2->execute() === false){
						$pdoStatement2->errorInfo();
					}else{
						// J'appelle la fonction créée dans functions/function.php
							$response = emailSent($emailLoginToto , $token);

						
						/*	$mail = new PHPMailer;

							//$mail->SMTPDebug = 3;                               // Enable verbose debug output

							$mail->isSMTP();                                      // Set mailer to use SMTP
							$mail->Host = 'smtp.googlemail.com';  // Specify main and backup SMTP servers
							$mail->SMTPAuth = true;                               // Enable SMTP authentication
							$mail->Username = 'formationwf3@gmail.com';                 // SMTP username
							$mail->Password = 'formationwf3123';                           // SMTP password
							$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
							$mail->Port = 587;                                    // TCP port to connect to

							$mail->setFrom('formationwf3@gmail.com', 'formationwf3');
							$mail->addAddress($emailLoginToto);     

							$mail->Subject = 'Réinitialisation de l\'email';
							$mail->Body    = 'This is the HTML message body <b>Merci de cliquer sur le lien ci-dessous pour réinitialiser votre email<br>
								<a href="http://localhost/j41-sessions-lostpassword/lostpassword/reset.php">'.$token.'</a> </b>';
							$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
							$success=true;
							if(!$mail->send()) {
							    $success=false;
							} 
							else {
							    echo 'Message has been sent';
							}*/


						//
						$successList[] = 'Un email vous permettant de réinitialiser votre mot de passe vient de vous être envoyé<br>';	
					}
				}else{
					$errorList[]='User inconnu!';
				}
			}
		// Générer un token à partir d'une donnée du user

		// Modifier la ligne du user dans la table user pour y mettre le token généré

		// Envoyer un email avec le lien pour réinitialiser le password (token)

		// Si tout est ok
		// $successList[] = 'Un email vous permettant de réinitialiser votre mot de passe vient de vous être envoyé<br>';
	}
}

// View
require 'views/lostpassword.php';

?>

