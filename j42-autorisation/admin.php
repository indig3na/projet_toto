<?php
require 'config.php';
 
if (!isset($_SESSION['usr_id'])){
	die('Vous devez vous connecter <a href="signin.php">connecter</a>');
}

if ($_SESSION['usr_role'] != 'admin'){
	header('HTTP/1.0 403 Forbidden');
	die('Pas autorisé Forbidden');

}
?>
<h3>Ouvert uniquement aux admin</h3>
<a href="signin.php">connexion</a><br>
<a href="index.php">index</a><br>
<a href="edit.php">edit</a><br>

