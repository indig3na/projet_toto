<div class="panel panel-primary">
	<div class="panel-heading">
		<h3>Etudiant détails</h3>
	</div>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script type="text/javascript">


	var data = ({student_id: <?= $studentDetailListe['stu_id'] ?> });

	
	$.post( "studentDetail.php", data );

	$('#myForm').serialize();

	</script>
</div>
