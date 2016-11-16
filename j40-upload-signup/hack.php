<html>
<head>
	<title>Scan des fichiers</title>
</head>
<body>
	<pre>
<?php

echo 'DIR='.dirname(__FILE__).'<br>';

$dirContent = scandir('./');
$result = array();
foreach ($dirContent as $key => $currentFile) {
	if ($currentFile != '.' && $currentFile != '..') {
		if (is_dir($currentFile)) {
			$result[$currentFile] = scandir($currentFile);
		}
		else {
			$result[$currentFile] = $currentFile;
		}
	}
}
print_r($result);

?>
	</pre>
</body>
</html>