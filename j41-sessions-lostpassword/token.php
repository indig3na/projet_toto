<?php

require 'lostpassword/inc/config.php';

// Email fourni dans formulaire
$email = 'titi@toto.fr';

$sql = '
	SELECT *
	FROM user
	WHERE usr_email = :email
';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email);

if ($stmt->execute() !== false) {
	// Info sur le user
	$userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
	print_r($userInfo);
	// Token spécifique à l'utilisateur
	echo md5(time().'lostpassword'.$userInfo['usr_id']).'<br>';
}
else {
	print_r($stmt->errorInfo());
}
