<?php include 'include/header.php' ?>

		<main id="main">
			<div class="container">		

				<?php include 'include/nav.php' ?>
			
				<!-- BEGIN CONTENT -->
				<div class="row">

					<!-- BEGIN MIDDLE LAYOUT -->
					<div id="layout-middle" class="col-md-9 col-sm-9 content-page">

						<h1 class="page-title margin-top">Contacts</h1>
						
						<p class="page-descr">Lorem ipsum dolor sit amet, Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat consectetuer adipiscing elit, sed diam nonummy nibh euismod tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
						<form id="contacts" action="#">
							<div class="form-group">
								<label for="contacts-name">Name</label>
								<input type="text" class="form-control" id="contacts-name">
							</div>
							<div class="form-group has-error">
								<label for="contacts-email">Email</label>
								<input type="email" class="form-control" id="contacts-email">
								<span class="validation-message">Fill in this field</span>
							</div>
							<div class="form-group">
								<label for="contacts-message">Message</label>
								<textarea class="form-control" id="contacts-message"></textarea>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Send</button>		
							</div>
						</form>

					</div>
					<!-- END MIDDLE LAYOUT -->

					<!-- BEGIN LEFT SIDEBAR LAYOUT -->
					<div id="layout-left" class="col-md-3 col-sm-9">
						<address>
							<h3>Our location</h3>
							795 Park Ave, Suite 120<br>
							San Francisco, CA 94107<br>
							<abbr title="Phone">P:</abbr> (234) 145-1810
						</address>

						<address>
							<strong>Email</strong>
							<a href="mailto:info@email.com">info@email.com</a><br>
							<a href="mailto:support@example.com">support@example.com</a>
						</address>

						<section class="sibebar-section">
							<ul class="social-icons">
								<li><a href="#" title="Facebook" class="facebook"></a></li>
								<li><a href="#" title="Github" class="github"></a></li>
								<li><a href="#" title="Goole Plus" class="googleplus"></a></li>
								<li><a href="#" title="Linkedin" class="linkedin"></a></li>
								<li><a href="#" title="RSS" class="rss"></a></li>
							</ul>
						</section>

						<section id="sidebar-about" class="sibebar-section">
							<h3>About Us</h3>
							<p>Sediam nonummy nibh euismod tation ullamcorper suscipit</p>
							<ul class="list-unstyled">
								<li><i class="fa fa-check"></i> Officia deserunt molliti</li>
								<li><i class="fa fa-check"></i> Consectetur adipiscing </li>
								<li><i class="fa fa-check"></i> Deserunt fpicia</li>
							</ul>
						</section>
					</div>
					<!-- END LEFT SIDEBAR LAYOUT -->

				</div>
				<!-- END CONTENT -->
			</div>		
		</main>





<?php include 'include/footer.php' ?>