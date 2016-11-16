<?php
require 'config.php';


if (!isset($_SESSION['usr_id'])){
	die('Vous devez vous connecter <a href="signin.php">connecter</a>');
}

if ($_SESSION['usr_role'] != 'admin' && $_SESSION['usr_role'] != 'editeur'){
	die('Pas autorisé Forbidden');
}
?>
<h3>Ouvert uniquement aux admin et aux editeurs</h3>
<a href="signin.php">connexion</a><br>
<a href="index.php">index</a><br>
<a href="admin.php">admin</a><br>



