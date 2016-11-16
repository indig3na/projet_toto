<pre>
<?php
session_start();
if(!empty($_GET)){
	$key_delete = $_GET['deletedId'];
	print_r($key_delete);
	unset($_SESSION[$key_delete]);
}
 print_r($_SESSION);
?>
</pre>