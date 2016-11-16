<html>
<head>
	<title>User sign up</title>
	<meta charset="utf-8">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-2 col-sm-2 col-xs-0"></div>
			<div class="col-md-8 col-sm-8 col-xs-12">
				<div class="page-header">
		  			<h1>Sign up</h1>
				</div>

<pre>
<?php

require 'config.php';

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

	if ($formOk) {
		echo 'OK<br>TODO insérer en DB<br>';

		$sql = '
			INSERT INTO user (usr_email, 
usr_password) VALUES (:email, :password)
		';
		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindValue(':email', $emailToto);
		$pdoStatement->bindValue(':password', $passwordToto1);

		if ($pdoStatement->execute() === false) {
			print_r($pdoStatement->errorInfo());
		}
		else {
			$resultat = $pdoStatement->fetchAll();
			header('Location: signup.php');
		}
	}

}

?>
</pre>
				<form action="" method="post">
					<fieldset>
						<input type="email" class="form-control" name="emailToto" value="<?= $emailToto ?>" placeholder="Email address" /><br />
						<input type="password" class="form-control" name="passwordToto1" value="" placeholder="Your password" /><br />
						<input type="password" class="form-control" name="passwordToto2" value="" placeholder="Confirm your password" /><br />
						<input type="submit" class="btn btn-success btn-block" value="Sign up" />
					</fieldset>
				</form>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-0"></div>
		</div>

	</div>

</body>
</html>