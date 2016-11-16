<form action="session_add.php" method="post">
	<fieldset>
		<legend>Play with PHP Session</legend>
		<input type="text" name="key" value="" placeholder="Clé tableau session" /><br />
		<input type="text" name="value" value="" placeholder="Valeur tableau session" /><br />
		<input type="submit" value="Add to $_SESSION" />

	</fieldset>
</form>
<pre>
<?php
print_r($_SERVER);
?>
</pre>
