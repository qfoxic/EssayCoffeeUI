<?php include 'include/header.php' ?>

		<main id="main">
			<div class="container">	

				<?php include 'include/nav.php' ?>

				<!-- BEGIN CONTENT -->
				<div class="row">
				
					<?php include 'include/sidebar-right.php' ?>

					<!-- BEGIN MIDDLE LAYOUT -->
					<div id="layout-middle" class="col-md-9 col-sm-9">
					
						<h1 class="page-title">Forgot Your Password?</h1>
						
						<div class="col-md-8 col-sm-8">
							<form id="forgot-form" class="form-horizontal form-without-legend">
								<div class="form-group">
									<label class="col-sm-4 control-label">Email</label>
									<div class="col-sm-8">
										<input type="email" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">&nbsp;</label>
									<div class="col-sm-8">
										<button type="submit" class="btn btn-primary">Send</button>
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