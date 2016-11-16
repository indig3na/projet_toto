<html>
<head>
	<title>User sign in</title>
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
		  			<h1>Sign in</h1>
				</div>
<pre><?php
require 'config.php';

// Formulaire soumis
if (!empty($_POST)) {
	$emailLoginToto = isset($_POST['emailLoginToto']) ? trim($_POST['emailLoginToto']) : '';
	$passwordLoginToto1 = isset($_POST['passwordLoginToto1']) ? trim($_POST['passwordLoginToto1']) : '';

	$formOk = true;
	if (strlen($passwordLoginToto1) < 8) {
		echo 'Le password doit contenir au moins 8 caractères<br>';
		$formOk = false;
	}
	if (empty($emailLoginToto)) {
		echo 'Email est vide<br>';
		$formOk = false;
	}
	else if (!filter_var($emailLoginToto, FILTER_VALIDATE_EMAIL)) {
		echo 'Email invalide<br>';
		$formOk = false;
	}

	if ($formOk) {
		/*$sql = '
			SELECT *
			FROM user
			WHERE usr_email = :email
			AND usr_password = :pwd
			LIMIT 1
		';
		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindValue(':email', $emailLoginToto);
		//$pdoStatement->bindValue(':pwd', md5($passwordLoginToto1)); // md5 simple
		$pdoStatement->bindValue(':pwd', md5($passwordLoginToto1.'jhdvb9l78!okcvnflk')); // md5 + salt

		if ($pdoStatement->execute() === false) {
			print_r($pdoStatement->errorInfo());
		}
		else {
			if ($pdoStatement->rowCount() > 0) {
				echo 'login ok<br>';
			}
			else {
				echo 'bad password or login<br>';
			}
		}*/

		$sql = '
			SELECT *
			FROM user
			WHERE usr_email = :email
			LIMIT 1
		';
		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindValue(':email', $emailLoginToto);

		if ($pdoStatement->execute() === false) {
			print_r($pdoStatement->errorInfo());
		}
		else {
			if ($pdoStatement->rowCount() > 0) {
				$resList = $pdoStatement->fetch();
				$hashedPassword = $resList['usr_password'];

				// Je vérifie le mot de passe
				if (password_verify($passwordLoginToto1, $hashedPassword)) {
					echo 'login ok<br>';
				}
				else {
					echo 'bad password or login<br>';
				}
			}
			else {
				echo 'email not known<br>';
			}
		}
	}
}

?></pre>
				<form action="" method="post">
					<fieldset>
						<input type="email" class="form-control" name="emailLoginToto" value="" placeholder="Email address" /><br />
						<input type="password" class="form-control" name="passwordLoginToto1" value="" placeholder="Your password" /><br />
						<input type="submit" class="btn btn-success btn-block" value="Sign in" />
					</fieldset>
				</form>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-0"></div>
		</div>

	</div>

</body>
</html>