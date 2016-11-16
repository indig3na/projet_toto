<?php
require 'config.php';

?>
<h3>Ouvert à tous les user</h3>
<a href="signup.php">créer un compte</a><br>
<a href="admin.php">Page admin</a><br>
<a href="edit.php">edit</a><br>
<a href="signin.php">connexion</a><br>

<?php

print_r($_SESSION);

?>