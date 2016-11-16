<form >
Nombre d'éléments à afficher par page :<br/>
<select class="form-control" name="limite_nb">
	<option value="0">choisissez :</option>
	<option value="5" <?php if(isset($_GET['limite_nb']) && $_GET['limite_nb']== 5) echo 'selected="selected"' ?>>5</option>
	<option value="10" <?php if(isset($_GET['limite_nb']) && $_GET['limite_nb']== 10) echo 'selected="selected"' ?>>10</option>
	<option value="15" <?php if(isset($_GET['limite_nb']) && $_GET['limite_nb']== 15) echo 'selected="selected"' ?>>15</option>
</select><br/>
 <button type="submit" class="btn btn-default">Limiter</button><br/>
</form>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3>Liste des étudiants</h3>
	</div>
<?php if (isset($studentListe) && sizeof($studentListe) > 0) : ?>
	<table class="table-hover table">
		<thead>
			<tr>
				<td><strong>Nom</strong></td>
				<td><strong>Prénom</strong></td>
				<td><strong>Ville</strong></td>
				<td><strong>Nationalité</strong></td>
			</tr>
		</thead>
		<tbody>
<?php foreach ($studentListe as $currentEtudiant) : ?>
			<tr>
				<td>
				<a href="studentDetail.php?student_id=<?= $currentEtudiant['stu_id'] ?>">
				<?= $currentEtudiant['stu_lname'] ?>
				</a>	
				</td>
				<td><?= $currentEtudiant['stu_fname'] ?></td>
				<td><?= $currentEtudiant['cit_name'] ?></td>
				<td><?= $currentEtudiant['cou_name'] ?></td>

			</tr>
<?php endforeach; ?>

		</tbody>

	</table>
		<ul class="pagination">
		<?php if (!($page==1)){ 
			//Gestion de la pagination  des pages précédentes 
			//et suivantes en gardant le training_id en cours et la limite définie par le user
			?>
		<li><a class="btn " href="list.php?page=<?php echo ($page-1).'&training_tra_id='.$training_session_id.'&limite_nb='.$limite ?>">Précédent</a></li>
		<?php } ?>
		<?php if ($page<$nbPagesMax) {?>
		<li><a class="btn " href="list.php?page=<?php echo ($page+1).'&training_tra_id='.$training_session_id.'&limite_nb='.$limite ?>">Suivant</a></li>	
		<?php } ?>
	</ul>
<?php else :?>
	aucun étudiant
<?php endif; ?>
</div>
