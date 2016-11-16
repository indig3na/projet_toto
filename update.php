<?php
include 'inc/config.php';
try {
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE.';charset=utf8', DB_USER, DB_PASSWORD);
	}
	catch (Exception $e){
		echo $e->getMessage();
}

	$citiesList = array(
	19 => 'Arlon',
	3 => 'Luxembourg',
	2 => 'Verdun',
	20 => 'Longwy',
	21 => 'Rodange',
	22 => 'Pissange',
	23 => 'Pétange',
);
$countriesList = array(
	1 => 'France',
	2 => 'Luxembourg',
	3 => 'Belgique',
	4 => 'Chine',
);
$sympathieList = array(
	1 => 'Pas sympa',
	2 => 'Assez sympa',
	3 => 'Sympa',
	4 => 'Très sympa',
	5 => 'Génial',
);

// $student_id = $_POST['studentId'];

print_r($student_id);

$name= '';
$firstname = '';
$email = '';
$birhtdate = '';
$city = '';
$country = '';
$friendliness = '';

// $studentId= isset ($_GET['student_id'])?$_GET['student_id'] : '';

// print_r($studentId);


if (!empty($_POST)) { 
	// Je debug les données
	//print_r($_POST);
	// Je récupère les données et je les traite (trim())

	$name = isset($_POST['studentName']) ? htmlspecialchars(strtoupper(trim($_POST['studentName']))) : '';
	$firstname = isset($_POST['studentFirstname']) ? htmlspecialchars(trim($_POST['studentFirstname'])) : '';
	$email = isset($_POST['studentEmail']) ? htmlspecialchars(trim($_POST['studentEmail'])) : '';
	$birhtdate = isset($_POST['studentBirhtdate']) ? htmlspecialchars(trim($_POST['studentBirhtdate'])) : '';
	$city = isset($_POST['cit_id']) ? htmlspecialchars(trim($_POST['cit_id'])) : '';
	$country = isset($_POST['cou_id']) ? htmlspecialchars(trim($_POST['cit_id'])) : '';
	$friendliness = isset($_POST['stu_friendliness']) ? htmlspecialchars(trim($_POST['stu_friendliness'])) : '';


	// Validation des données
	$formOk = true;
	if (empty($name)) {
	//	echo 'Le nom est vide<br>';
		$formOk = false;
	}
	else if (strlen($name) < 2) {
	//	echo 'Le nom est incorrect (2 caractères minimum)<br>';
		$formOk = false;
	}
	if (empty($firstname)) {
	//	echo 'Le prénom est vide<br>';
		$formOk = false;
	}
	else if (strlen($firstname) < 2) {
	//	echo 'Le prénom est incorrect (2 caractères minimum)<br>';
		$formOk = false;
	}
	if (empty($email)) {
	//	echo 'Email est vide<br>';
		$formOk = false;
	}
	 else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	//					echo 'L\'email est invalide<br>';
						$formOk = false;
	}
	if(empty($birhtdate)){
	//	echo 'Date de naissance de vide<br>';
		$formOk = false;
	}
	else if (!(preg_match("/^[0-9]/", $birhtdate))) {
	//	echo 'Date de naissance incorrecte<br>';
		$formOk = false;
	}

	if(empty($city)){
	// echo 'Aucune ville sélectionnée<br>';
	$formOk = false;
	}
	else if ($city < 0) {
	//	echo 'Ville incorrecte<br>';
		$formOk = false;
	}
	if(empty($friendliness)){
	//	echo 'Le champ sympathie n\'est pas renseigné';
	}else if ($friendliness<0 && $friendliness>6){
	//	echo 'Valeur du champ sympathie incorrecte';
		$formOk = false;
	}

		//Je récupére le fichier

	if (sizeof($_FILES) > 0){
		if ($fileUpload['size'] <= 200000) { // gestion de la taille des fichiers
			$fileUpload = $_FILES['fileForm'];
			$extension = substr($fileUpload['name'], -4);
			$extension2 = substr($fileUpload['name'], -5);

			  if (($extension !='.php') || ($extension === '.jpg') || ($extension === '.png') || ($extension === '.gif') || ($extension === '.svf') || ($extension2 === '.jpeg')){
				//Je téléverse le fichier
				if (move_uploaded_file($fileUpload['tmp_name'],'photos/'.$fileUpload['name'])){
				}else{
					$formOk = false;
				}
			
			}else{ 
				// echo 'extension incorrecte';
				$formOk = false;
			}
		}else{
			$formOk = false;
		}
	}

	if ($formOk) {
		// echo 'formulaire ok<br>';
		//echo str_ireplace(array('m','l'), array('*' ,'-'), $nom);

		$sql1 = "
			INSERT INTO student (
			stu_lname, 
			stu_fname, 
			stu_image,
			stu_email, 
			stu_friendliness, 
			city_cit_id, 
			training_tra_id) 
			VALUES( :name , 
			:firstname ,
			:image, 
			:email , 
			:friendliness , 
			:city, 
			3
			)
		";
		$pdoStatement1 = $pdo->prepare($sql1);
		$pdoStatement1->bindValue(':name', $name);
		$pdoStatement1->bindValue(':firstname', $firstname);
		$pdoStatement1->bindValue(':email', $email);
		$pdoStatement1->bindValue(':friendliness', $friendliness);
		$pdoStatement1->bindValue(':city', $city);
		$pdoStatement1->bindValue(':image', 'photos/'.$fileUpload['name']);
		if (!$pdoStatement1->execute()) {
		print_r($pdoStatement1->errorInfo());
		}
		else {
			//$resultat = $pdoStatement1->fetchAll();
			header("Location: list.php"); 
		}
	}
}



require 'views/header.php';
require 'views/updateView.php';
require 'views/footer.php';
?>