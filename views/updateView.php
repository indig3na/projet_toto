<form action="" method="post" role = "form" enctype="multipart/form-data">
	  <div class="form-group">
		<fieldset>
		<div class="panel panel-primary">
		<div  class="panel-heading">
			<h3>Ajout d'un étudiant</h3> 
			</div>
			</div>
			<label for="fileForm">Votre Nom :</label>
			<input class="form-control" type="text" name="studentName" value="<?php echo $name ?>" placeholder="Nom"><br />
			<label for="fileForm">Votre prénom :</label>
			<input class="form-control" type="text" name="studentFirstname" value="<?php echo $firstname ?>" placeholder="Prénom"><br />
			<label for="fileForm">Email :</label>
			<input class="form-control" type="email" name="studentEmail" value="<?php echo $email ?>" placeholder="E-mail"><br />
			<label for="fileForm">Date de naissance :</label>
			<input class="form-control" type="date" name="studentBirhtdate" value="<?php echo $birthdate ?>" placeholder="Date de naissance (aaaa-mm-jj)"><br />
			<label for="fileForm">Ville de résidence :</label><br/>
			<select class="form-control" name="cit_id">
				<option value="0">choisissez :</option>
				<?php foreach ($citiesList as $key=>$value) :?>
				<option value="<?= $key ?>" <?php if ($city==$value) 'selected = "selected"'  ?>" >
				<?= $value ?>
				</option>
				<?php endforeach; ?>
			</select><br />
			<label for="fileForm">Nationalité :</label><br/>
			<select class="form-control" name="cou_id">
				<option value="0">choisissez :</option>
				<?php foreach ($countriesList as $key=>$value) :?>
				<option value="<?= $key ?>" <?php if ($country==$value) 'selected = "selected"' ?>"  ><?= $value ?>
				</option>
				<?php endforeach; ?>
			</select><br />
			<label for="fileForm">Sympathie :</label><br/>
			<select class="form-control" name="stu_friendliness">
				<option value="0">choisissez :</option>
				<?php foreach ($sympathieList as $key=>$value) :?>
				<option value="<?= $key ?>" "<?php if ($friendliness==$value) 'selected = "selected"' ?>" ><?= $value ?>
				</option>
				<?php endforeach; ?>
			</select><br />
			<input type="hidden" name="submitFile" value="1" />
			<label for="fileForm">Votre photo</label>
			<input class="form-control" type="file" name="fileForm" id="fileForm" />
			<?php // if($formOk==false){echo "Extensions Incorrectes";} else{echo "" ;} ?>
			<p class="help-block">toutes les extensions spécifiques aux images sont autorisées</p>
			<br/>
			<input type="submit"  class="btn btn-default form-control" value="Valider"><br />
		</fieldset>
	  </div>
	</form>
</body>
