<?php
require 'inc/config.php';

$errorList = array();
$successList = array();


// Récupérer le token
$token = (isset($_GET['token']))? $_GET['token'] : '';
//print_r($token);

// Vérifier la validité du token et récupérer les données du user
$sql ='
	SELECT * 
	from user 
	where usr_token = :token
';

$pdoStatement=$pdo->prepare($sql);
$pdoStatement->bindValue(':token', $token);
if ($pdoStatement->execute() === false){
	$pdoStatement->errorInfo();
}else{
	// Si valide, afficher le formulaire de modification du mot de passe, sinon, afficher une erreur
	$rslt = $pdoStatement->fetch();
	//print_r($rslt);
	if($rslt){
		$displayForm = true;
		//print_r($rslt['usr_id']);

	}else{
		$displayForm = false;
		$errorList[]='Access denied!';
	}
}

	$formOk = true;
// 
if(!isset($rslt) || $rslt==false){
	$formOk = false;
}

// Formulaire soumis
if (!empty($_POST)) {
	// Récupérer les données du formulaire en POST
		$passwordToto1 = isset($_POST['passwordToto1']) ? trim($_POST['passwordToto1']) : '';
		$passwordToto2 = isset($_POST['passwordToto2']) ? trim($_POST['passwordToto2']) : '';
		if ($passwordToto1 != $passwordToto2) {
		echo 'Le mot de passe n\'est pas identique<br>';
		$formOk = false;
		}else{

			// Modifier le mot de passe du user
			// Supprimer le token dans la table user

			$token='';
			$sql2 = "UPDATE user 
					SET usr_password= :password 
					, usr_token= :token
					WHERE usr_id= :user_id
					";
					
			$pdoStatement2=$pdo->prepare($sql2);
			$pdoStatement2->bindValue(':password', password_hash($passwordToto1, PASSWORD_BCRYPT));
			$pdoStatement2->bindValue(':user_id', $rslt['usr_id']);
			$pdoStatement2->bindValue(':token', $token);
			if($pdoStatement2->execute() === false){
				$pdoStatement2->errorInfo();
			}else{
				$rslt2 = $pdoStatement2->fetch();
				$successList[]='Password réinitialisé';
			}
		}
	
}


// View
require 'views/reset.php';