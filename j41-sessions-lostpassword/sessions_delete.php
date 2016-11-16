<?php
// Am mettre au début du debut du debut du debut du debut du debut

session_start();


UNSET($_SESSION['titi']);


// Il faut ajouter all dans l'url pour que tout soit supprimé

if (isset($_GET['all'])){
	session_unset();
}
echo 'suppression des varibles de session';

?>