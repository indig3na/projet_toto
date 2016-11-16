<?php
session_start();

$key = '';
$value = '';
if(!empty($_POST)){
	$key = $_POST['key'];
	$value = $_POST['value'];
	$_SESSION[$key] = $value;
}

foreach ($_SESSION as $key => $value) {
	echo $key.' '.$value.'<br>';
	echo '<a href="session_delete.php?deletedId='.$key.'">Supprimer la variable session</a>';
	echo '<br>';

}

echo '<strong>identifiant session : '.session_id().'</strong><br>';


 ?>