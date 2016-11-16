
	<form  class="class" action="update.php" method="post" id="myForm">
		<div class="list-group">
		<!-- a href="#" class="list-group-item disabled" name="studentId"><?= $studentDetailListe['stu_id'] ?></a-->
		  <a href="#" class="list-group-item disabled"><?= $studentDetailListe['stu_lname'].' '.$studentDetailListe['stu_fname'] ?></a>
		  <a href="#" class="list-group-item"><?= $studentDetailListe['stu_email'] ?></a>
		  <a href="#" class="list-group-item"><?= $studentDetailListe['cit_name'] ?></a>
		  <a href="#" class="list-group-item"><?= $studentDetailListe['cou_name'] ?></a>
		  <a href="#" class="list-group-item"><?= $studentDetailListe['stu_friendliness'] ?></a>
		  <a href="#" class="list-group-item"><?= $studentDetailListe['birthdate'] ?></a>
		  <input type="submit"  class="btn btn-default form-control list-group-item" value="Modifier">
		</div>
	</form>

$.get('ajax/student.php', {student_id: <?= $studentDetailListe['stu_id'] ?> });