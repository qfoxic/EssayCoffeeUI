<?php include 'include/header.php' ?>

		<main id="main">
			<div class="container">	

				<?php include 'include/nav.php' ?>	

				<!-- BEGIN CONTENT -->
				<div class="row">

					<?php include 'include/sidebar-right.php' ?>

					<!-- BEGIN MIDDLE LAYOUT -->
					<div id="layout-middle" class="col-md-9 col-sm-9">
					
						<h1 class="page-title">Create an account</h1>
						
						<div class="col-md-8 col-sm-8">
							<form id="registration-form" class="form-horizontal">
								<fieldset>
									<legend>Your personal details</legend>
									<div class="form-group">
										<label class="col-sm-4 control-label">First Name <span class="require">*</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Last Name <span class="require">*</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Email <span class="require">*</span></label>
										<div class="col-sm-8">
											<input type="email" class="form-control" required>
										</div>
									</div>
								</fieldset>

								<fieldset>
									<legend>Your password</legend>
									<div class="form-group">
										<label class="col-sm-4 control-label">Password <span class="require">*</span></label>
										<div class="col-sm-8">
											<input type="password" class="form-control" required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Confirm password <span class="require">*</span></label>
										<div class="col-sm-8">
											<input type="password" class="form-control" required>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Email <span class="require">*</span></label>
										<div class="col-sm-8">
											<input type="email" class="form-control" required>
										</div>
									</div>
								</fieldset>

								<?/*
								
								// Тимчасово ми прибираєм цей функціонал
								
								<fieldset class="newsletter">
									<legend>Newsletter</legend>
									<div class="form-group">
										<label class="col-sm-4 control-label">Singup for<br>Newsletter</label>
										<div class="col-sm-8">
											<input type="checkbox">
										</div>
									</div>
								</fieldset>*/?>

								
								<div class="form-group submit-group">
									<label class="col-sm-4 control-label">&nbsp;</label>
									<div class="col-sm-8">
										<button type="submit" class="btn btn-primary">Create an account</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- END MIDDLE LAYOUT -->
				</div>
				<!-- END CONTENT -->
			</div>		
		</main>





<?php include 'include/footer.php' ?>