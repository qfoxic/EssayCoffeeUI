<?php include 'include/header.php' ?>

		<main id="main">
			<div class="container">	

				<?php include 'include/nav.php' ?>	

				<!-- BEGIN CONTENT -->
				<div class="row">

					<?php include 'include/sidebar-right.php' ?>

					<!-- BEGIN MIDDLE LAYOUT -->
					<div id="layout-middle" class="col-md-9 col-sm-9">
					
						<h1 class="page-title">Login</h1>
						
						<div class="col-md-8 col-sm-8">
							<form class="form-horizontal form-without-legend auth-form">
								<div class="form-group">
									<label class="col-sm-4 control-label">Email <span class="require">*</span></label>
									<div class="col-sm-8">
										<input type="email" class="form-control" required>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-4 control-label">Password <span class="require">*</span></label>
									<div class="col-sm-8">
										<input type="password" class="form-control" required>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-8 col-md-offset-4 forgot-link">
										<a href="forgot.html">Forget Password?</a>
									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-8 col-md-offset-4">
										<button type="submit" class="btn btn-primary">Login</button>
									</div>
								</div>

								<?/*
								
								// Тимчасово заморожуємо цей функціонал
								
								<div class="row ">
									<div class="col-sm-8 col-md-offset-4 login-socio">
										<p>or login using:</p>
										<ul class="social-icons">
											<li><a href="#" class="facebook" title="Facebook"></a></li>
											<li><a href="#" class="twitter" title="Twitter"></a></li>
											<li><a href="#" class="googleplus" title="Google Plus"></a></li>
											<li><a href="#" class="linkedin" title="Linkedin"></a></li>
											
										</ul>
									</div>
								</div>*/?>
								
							</form>
						</div>
					</div>
					<!-- END MIDDLE LAYOUT -->
				</div>
				<!-- END CONTENT -->
			</div>		
		</main>




<?php include 'include/footer.php' ?>