<html>
<head>
	<title>UPLOAD</title>
	<meta charset="utf-8">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-2 col-sm-2 col-xs-0"></div>
			<div class="col-md-8 col-sm-8 col-xs-12">
				<div class="page-header">
		  			<h1>Upload d'un fichier <small>tout type de fichier</small></h1>
				</div>
				<pre>
				<?php
					// print_r($_POST);
					// print_r($_FILES);


					
					if (!empty($_POST)) {
						// Si des fichiers ont été téléversé
						if (sizeof($_FILES) > 0){
							//Je récupére le fichier
							$fileUpload = $_FILES['fileForm'];
							$extension = substr($fileUpload['name'], -4);
							
							if ($extension !='.php'){
								//Je téléverse le fichier
								if (move_uploaded_file($fileUpload['tmp_name'],'files/'.$fileUpload['name'])){
								echo 'Fichier téléversé';
								}else{
									echo 'Erreur de téléversement !';
								}
							
							}else{
								echo 'Saïï Saïï';
							}
						}
					}
				?>
				</pre>
				<form method="post" enctype="multipart/form-data">
					<fieldset>
					<input type="hidden" name="submitFile" value="1" />
					<label for="fileForm">Fichier</label>
					<input type="file" name="fileForm" id="fileForm" />
					<p class="help-block">toutes les extensions sont autorisées</p>
					<br />
					<input type="submit" class="btn btn-success btn-block" value="Téléverser" />
					</fieldset>
				</form>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-0"></div>
		</div>

	</div>

</body>
</html>

///

<html>
<head>
	<title>UPLOAD</title>
	<meta charset="utf-8">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-2 col-sm-2 col-xs-0"></div>
			<div class="col-md-8 col-sm-8 col-xs-12">
				<div class="page-header">
		  			<h1>Upload <small>d'une image</small></h1>
				</div>

<pre>
<?php

// Formulaire soumis
if (!empty($_POST)) {
	// Si des fichiers ont été téléversés
	if (sizeof($_FILES) > 0) {
		// Je récupère les données du fichier 'fileForm'
		$fileUpload = $_FILES['fileForm'];

		// Je teste si la taille n'est pas trop importante
		if ($fileUpload['size'] <= 100000) {
			// Je récupère l'extension
			$tmp = explode('.', $fileUpload['name']);
			$extension = end($tmp);

			// Tableau des extensions autorisées
			$allowedExtensions = array('png', 'svg', 'jpeg', 'jpg', 'gif');

			if (in_array($extension, $allowedExtensions)) {
				// Je téléverse le fichier
				if(move_uploaded_file($fileUpload['tmp_name'], 'files/test_upload'.$extension)) {
					echo 'fichier téléversé<br>';
				}
				else {
					echo 'Erreur dans le téléversement<br>';
				}
			}
			else {
				echo 'petit malin ^^<br>';
			}
		}
		else {
			echo 'Fichier trop grand...<br>';
		}
	}
}

?>
</pre>
	
				<form enctype="multipart/form-data" method="post" action="">
					<fieldset>
					<input type="hidden" name="submitFile" value="1" />
					<input type="hidden" name="MAX_FILE_SIZE" value=200000" />
					<label for="fileForm">Fichier</label>
					<input type="file" name="fileForm" id="fileForm" />
					<p class="help-block">svg, jpg, jpeg, gif &amp; png + taille max 200 Ko</p>
					<br />
					<input type="submit" class="btn btn-success btn-block" value="Téléverser" />
					</fieldset>
				</form>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-0"></div>
		</div>

	</div>

</body>
</html>