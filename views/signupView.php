<body>
	<div class="container">
		<div class="row">
			<div class="col-md-2 col-sm-2 col-xs-0"></div>
			<div class="col-md-8 col-sm-8 col-xs-12">
				<div class="page-header">
					<div class="panel panel-primary">
						<div  class="panel-heading">
				  			<h1>Sign up</h1>
						</div>
					</div>
				</div>
				<form action="" method="post" role = "form">
					<div class="form-group">
						<fieldset>
							<input type="email" class="form-control" name="emailToto" value="<?= $emailToto ?>" placeholder="Email address" /><br />
							<input type="password" class="form-control" name="passwordToto1" value="" placeholder="Your password" /><br />
							<input type="password" class="form-control" name="passwordToto2" value="" placeholder="Confirm your password" /><br />
							<input type="submit" class="btn btn-success btn-block" value="Sign up" />
						</fieldset>
					</div>
				</form>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-0"></div>
		</div>
	</div>
</body>