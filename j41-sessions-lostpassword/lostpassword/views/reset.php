<html>
<head>
	<title>Reset your password</title>
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
		  			<h1>Reset your password</h1>
				</div>
				<?php if (sizeof($errorList) > 0) : ?>
				<?php foreach ($errorList as $currentError) : ?>
					<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<?= $currentError ?></div>
				<?php endforeach; ?>
				<?php endif; ?>
				<?php if (sizeof($successList) > 0) : ?>
				<?php foreach ($successList as $currentSuccess) : ?>
					<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<?= $currentSuccess ?></div>
				<?php endforeach; ?>
				<?php endif; ?>
				<?php if ($displayForm===true): ?>
				<form action="" method="post">
					<fieldset>
						<input type="password" class="form-control" name="passwordToto1" value="" placeholder="Your new password" /><br />
						<input type="password" class="form-control" name="passwordToto2" value="" placeholder="Confirm your password" /><br />
						<input type="submit" class="btn btn-success btn-block" value="Reset password" />
					</fieldset>
				</form>
				<?php else : ?>
					<h1>Le token n'est pas correct</h1>
				<?php endif; ?>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-0"></div>
		</div>

	</div>

</body>
</html>