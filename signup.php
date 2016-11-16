<pre>
<?php

require 'inc/config.php';

try {
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE.';charset=utf8', DB_USER, DB_PASSWORD);
	}
	catch (Exception $e){
		echo $e->getMessage();
}

// J'initialise les variables
$emailToto = '';




// Formulaire soumis
if (!empty($_POST)) {
	print_r($_POST);
	
	$emailToto = isset($_POST['emailToto']) ? trim($_POST['emailToto']) : '';
	$passwordToto1 = isset($_POST['passwordToto1']) ? trim($_POST['passwordToto1']) : '';
	$passwordToto2 = isset($_POST['passwordToto2']) ? trim($_POST['passwordToto2']) : '';

	$formOk = true;
	if ($passwordToto1 != $passwordToto2) {
		echo 'Le mot de passe n\'est pas identique<br>';
		$formOk = false;
	}
	if (strlen($passwordToto1) < 8) {
		echo 'Le password doit contenir au moins 8 caractères<br>';
		$formOk = false;
	}
	if (empty($emailToto)) {
		echo 'Email est vide<br>';
		$formOk = false;
	}
	else if (!filter_var($emailToto, FILTER_VALIDATE_EMAIL)) {
		echo 'Email invalide<br>';
		$formOk = false;
	}

	$sql2 = 'SELECT usr_email 
		FROM user 
		where usr_email = :emailDoublon
		';

	$pdoStatement2 = $pdo->prepare($sql2);
	$pdoStatement2->bindValue(':emailDoublon', $emailToto);

	if ($pdoStatement2->execute() === false) {
		print_r($pdoStatement2->errorInfo());
	}

	// Gestion des doublons au niveau de la création d'un nouveau user
	else {
		$rows = $pdoStatement2->rowCount();
	//	print_r($rows);
	}

	if ($rows>0){
	//	echo 'Cet identifiant exite déjà<br>';
		$formOk = false;

	}


	if ($formOk) {
		// echo 'OK<br>TODO insérer en DB<br>';

		$sql = '
			INSERT INTO user (usr_email, 
			usr_password) VALUES (:email, :password)
		';
		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindValue(':email', $emailToto);
		//$pdoStatement->bindValue(':password', md5($passwordToto1)); // md5 simple
		//$pdoStatement->bindValue(':password', md5($passwordToto1.'jhdvb9l78!okcvnflk')); // md5 + salt
		$pdoStatement->bindValue(':password', password_hash($passwordToto1, PASSWORD_BCRYPT)); // password_hash

		if ($pdoStatement->execute() === false) {
			print_r($pdoStatement->errorInfo());
		}
		else {
			$resultat = $pdoStatement->fetchAll();
			$_SESSION['user_id'] = $pdo->lastInsertId();

			//header('Location: index.php');

		}
	}

}

?>
</pre>

<?php
require 'views/header.php';
require 'views/signupView.php';
require 'views/footer.php';
?>
				