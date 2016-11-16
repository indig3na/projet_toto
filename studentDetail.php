<?php
include 'inc/config.php';
try {
		$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE.';charset=utf8', DB_USER, DB_PASSWORD);
	}
	catch (Exception $e){
		echo $e->getMessage();
	}

	 $studentId= isset ($_GET['student_id'])?$_GET['student_id'] : '';

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
	where student.stu_id= :studentId
	';

	$pdoStatement=$pdo->prepare($sql);
	$pdoStatement->bindValue(':studentId', $studentId, PDO::PARAM_INT);
	if (!($pdoStatement->execute())){
	print_r($pdoStatement->errorInfo());
	}else{
		//je récupére mes données
		$studentDetailListe = $pdoStatement->fetch();
//		print_r($studentDetailListe);
	}

//
require 'views/header.php';
require 'views/studentDetailView.php';
require 'views/footer.php';
?>