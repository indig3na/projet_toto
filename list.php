<?php
include ('inc/config.php');
$etudiantListe = array();
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

/*
QUERY pour les students
-----------------------
SELECT stu_id, stu_lname, stu_fname, cou_name, cit_name, stu_friendliness
FROM student
LEFT OUTER JOIN country ON country.cou_id = student.cou_id
LEFT OUTER JOIN city ON city.cit_id = student.cit_id
*/

// Connexion à ma db

	//Instanciation du PDO (PHP Data Object)
	try {
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE.';charset=utf8', DB_USER, DB_PASSWORD);
	}
	catch (Exception $e){
		echo $e->getMessage();
	}

	$sql2 = '
	SELECT 
    count(student.stu_id) as nb_lignes 
    from student
    ';

    $pdoStatement2 = $pdo->query($sql2);
    if($pdoStatement2===false){
    	print_r($pdo->errorInfo());
    }else{
    	$nbLignes = $pdoStatement2->fetch();
    	$nbPdts = $nbLignes['nb_lignes'];
    }

    //pour la recherche

    $search = isset($_GET['q'])? trim($_GET['q']) : '';
    //var_dump($search);

    // Recuperation de la valeur limite envoyée par le formumaire
    // Calcul de la valeur limite si elle existe et si la valeur n'existe pas nous lui donnons une valeur par défaut
    if (isset($_GET['limite_nb'])){
    	$limite = $_GET['limite_nb'];
    	$nbPagesMax = ceil($nbPdts/$limite);
	}else{
    	$limite = 5;
    	$nbPagesMax = ceil($nbPdts/5);
    }
    //GESTION PAGINATION

    //Nb max de pages qui vont servir au bouton suivant
   	
   
   	//Gestion de l'exception si la variable page n'existe pas
	$page = isset($_GET['page'])?$_GET['page'] : 1;

	//Définition de l'offset en fonction du nombre d'éléments à afficher
	$offset = ($page - 1)*$limite;
	
	$training_session_id =  isset($_GET['training_tra_id'])?$_GET['training_tra_id']:'';

	$sql = '
	SELECT 
    student.stu_id,
    student.stu_lname,
    student.stu_fname,
    stu_email,
    country.cou_name,
    student.training_tra_id,
    city.cit_name,
    student.city_cit_id,
	CASE student.stu_friendliness
    WHEN 1 THEN "Pas sympa"
    WHEN 2 THEN "Assez sympa"
    WHEN 3 THEN "Sympa"
    WHEN 4 THEN "Très sympa"
    WHEN 5 THEN "Génial"
	END as stu_friendliness,
	(2016-student.stu_age) as birthdate
	FROM 
    student
        LEFT OUTER JOIN
    city ON city.cit_id = student.city_cit_id	
    	LEFT OUTER JOIN
	country ON country.cou_id = city.country_cou_id
	';

	if (!empty($training_session_id)){
		$sql .= 'WHERE student.training_tra_id = :id_session LIMIT '.$offset.','.$limite;
	}else   if(!empty($search)){
		$sql .= '
			WHERE stu_lname LIKE :search
			OR stu_fname LIKE :search
			OR stu_email LIKE :search
			OR country.cou_name LIKE :search
			OR city.cit_name LIKE :search
			OR student.stu_age LIKE :search
			LIMIT '.$offset.','.$limite;
	}else{
		$sql .=' LIMIT '.$offset.','.$limite;
	}

	//	
	//AFFICHAGE DE LA REQUETE DEBUGGGGGGG
	//echo $sql;
	//	

	$pdoStatement = $pdo->prepare($sql);
	if (isset($training_session_id)){
		$pdoStatement->bindValue(':id_session', $training_session_id , PDO::PARAM_INT);
	}

	//NB :  dans le cadre d'une RECHERCHE via un bind il faut mettre les caractères % dans le bindValue
	
	if (!empty($search)){ // cette condition car la recherche ne doit pas s'effectuer tt le temps
	$pdoStatement->bindValue(':search', '%'.$search.'%' , PDO::PARAM_STR);
	}

	if (!($pdoStatement->execute())){
		print_r($pdoStatement->errorInfo());
	}else{
		//je récupére mes données
		$studentListe = $pdoStatement->fetchAll();
	}
	

  
    
	$name = '';
	$firstname = '';
	$email = '';
	$birhtdate = '';
	$city = '';
	$friendliness = '';
	$country = '';


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





}
require 'views/header.php';
require 'views/view.php';
require 'views/footer.php';
?>

