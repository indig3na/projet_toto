<body>
	<div class="container">
		<div class="row">
			<div class="col-md-2 col-sm-2 col-xs-0"></div>
			<div class="col-md-8 col-sm-8 col-xs-12">
			<div class="page-header">
				<div class="panel panel-primary">
					<div  class="panel-heading">
			  			<h1>Sign In</h1>
					</div>
				</div>

			</div>
				<?php if(sizeof($errorList > 0)) : ?>
					<?php foreach ($errorList as $currentErrorList) : ?>
						<?php echo $currentErrorList; ?>
					<?php endforeach; ?>
				<?php endif; ?>
				<form action="" method="post" role = "form">
					<div class="form-group">
						<fieldset>
							<input type="email" class="form-control" name="emailLoginToto" value="" placeholder="Email address" /><br />
							<input type="password" class="form-control" name="passwordLoginToto1" value="" placeholder="Your password" /><br />
							<input type="submit" class="btn btn-success btn-block" value="Sign in" />
						</fieldset>
					</div>
				</form>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-0"></div>
		</div>

	</div>

</body>
