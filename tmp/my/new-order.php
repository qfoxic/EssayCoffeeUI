<?php include 'include/header.php' ?>

		<main id="main">
			<div class="container">
			
				<?php include 'include/nav.php' ?>

				<!-- BEGIN CONTENT -->
				<div class="row">
				
					<!-- BEGIN MIDDLE LAYOUT -->
					<div id="layout-middle" class="col-md-9 col-sm-9 pricing-page content-page">

						<h1 class="page-title margin-top">Place a new order</h1>
						
						<p><b>Please fill out all the required fields below to proceed with your order.<br>
						Provide maximum details about your future paper. This will help us complete it with maximum accuracy.</b></p>

						<!-- BEGIN PRICE FORM -->
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<form class="form-horizontal new-order-form-wrapper">
									<div class="price-form">
										<div class="form-group">
											<label class="col-sm-5 control-label">
												Your Email
												<span class="tooltip-wrapper">
													<a href="#" class="custom-tooltip" data-toggle="tooltip" data-placement="top" title="Please fill out all the required fields below to proceed with your order. Provide maximum details about your future paper. This will help us complete it with maximum accuracy.">
														<i class="icon-info-popup"></i>
													</a>
												</span>
											</label>
											<div class="col-sm-5">
												<input type="email" class="form-control">
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-5 control-label">Type of Paper Needed</label>
											<div class="col-sm-5">
												<select class="form-control">
													<option value="" disabled selected>Select One</option>
													<option>Option 1</option>
													<option>Option 2</option>
													<option>Option 3</option>
													<option>Option 4</option>
													<option>Option 5</option>
												</select>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-5 control-label">Paper Format</label>
											<div class="col-sm-5">
												<select class="form-control">
													<option value="" disabled selected>Please select</option>
													<option>Option 1</option>
													<option>Option 2</option>
													<option>Option 3</option>
													<option>Option 4</option>
													<option>Option 5</option>
												</select>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-5 control-label">
												Subject or Discipline
												<span class="tooltip-wrapper">
													<a href="#" class="custom-tooltip" data-toggle="tooltip" data-placement="top" title="Subject or Discipline tooltip">
														<i class="icon-info-popup"></i>
													</a>
												</span>
											</label>
											<div class="col-sm-5">
												<select class="form-control">
													<option value="" disabled selected>Please select</option>
													<option>Option 1</option>
													<option>Option 2</option>
													<option>Option 3</option>
													<option>Option 4</option>
													<option>Option 5</option>
												</select>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-5 control-label">
												Topic
												<span class="tooltip-wrapper">
													<a href="#" class="custom-tooltip" data-toggle="tooltip" data-placement="top" title="Topic tooltip">
														<i class="icon-info-popup"></i>
													</a>
												</span>
											</label>
											<div class="col-sm-5">
												<input type="text" class="form-control">
											</div>
										</div>

										<div class="form-group has-error">
											<label class="col-sm-5 control-label">Number of Sources Required</label>
											<div class="col-sm-5">
												<select class="form-control">
													<option value="" disabled selected>Please select</option>
													<option>Option 1</option>
													<option>Option 2</option>
													<option>Option 3</option>
													<option>Option 4</option>
													<option>Option 5</option>
												</select>
												<span class="validation-message">Fill in this field</span>
											</div>
										</div>

										<div class="form-group has-error">
											<label class="col-sm-5 control-label">
												Paper Instructions
												<span class="tooltip-wrapper">
													<a href="#" class="custom-tooltip" data-toggle="tooltip" data-placement="top" title="Paper Instructions tooltip">
														<i class="icon-info-popup"></i>
													</a>
												</span>
											</label>
											<div class="col-sm-5">
												<textarea class="form-control" rows="2"></textarea>
												<span class="validation-message">Fill in this field</span>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-5 control-label">
												Pages
												<span class="tooltip-wrapper">
													<a href="#" class="custom-tooltip" data-toggle="tooltip" data-placement="top" title="Pages tooltip">
														<i class="icon-info-popup"></i>
													</a>
												</span>
											</label>
											<div class="col-sm-5">
												<select class="form-control">
													<option value="" disabled selected>Please select</option>
													<option>Option 1</option>
													<option>Option 2</option>
													<option>Option 3</option>
													<option>Option 4</option>
													<option>Option 5</option>
												</select>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-5 control-label">
												Will you upload any additional materials?
												<span class="tooltip-wrapper">
													<a href="#" class="custom-tooltip" data-toggle="tooltip" data-placement="top" title="Additional materials tooltip">
														<i class="icon-info-popup"></i>
													</a>
												</span>
											</label>
											<div class="col-sm-6">
												<label class="radio-inline">
													<input type="radio" name="materials"><span>Yes</span>
												</label>

												<label class="radio-inline">
													<input type="radio" name="materials" checked><span>No</span>
												</label>

												<p>Please note that in case your paper requires specific information/materials to be used, your writer will need additional time to retrieve them.</p>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-5 control-label">Academic Level</label>
											<div class="col-sm-5">
												<select class="form-control">
													<option value="" disabled selected>Select One</option>
													<option>Option 1</option>
													<option>Option 2</option>
													<option>Option 3</option>
													<option>Option 4</option>
													<option>Option 5</option>
												</select>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-5 control-label">
												First Draft Deadline
												<span class="tooltip-wrapper">
													<a href="#" class="custom-tooltip" data-toggle="tooltip" data-placement="top" title="First Draft Deadline tooltip">
														<i class="icon-info-popup"></i>
													</a>
												</span>
											</label>
											<label class="col-sm-5 control-label text-left">
												Select <a href="#">Academic Level</a> first!
											</label>
										</div>

										<div class="form-group">
											<label class="col-sm-5 control-label">
												Final Submission Deadline
												<span class="tooltip-wrapper">
													<a href="#" class="custom-tooltip" data-toggle="tooltip" data-placement="top" title="Final Submission Deadline tooltip">
														<i class="icon-info-popup"></i>
													</a>
												</span>
											</label>
											<div class="col-sm-5">
												<input type="text" class="form-control">
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-5 control-label">
												Writers Preferences
												<span class="tooltip-wrapper">
													<a href="#" class="custom-tooltip" data-toggle="tooltip" data-placement="top" title="Writers Preferences tooltip">
														<i class="icon-info-popup"></i>
													</a>
												</span>
											</label>
											<div class="col-sm-6">
												<div class="radio-inline-list">
													<label class="radio-inline">
														<input type="radio" name="name3"><span>Please assign the best available writer (standard pricing)</span>
													</label>


													<label class="radio-inline">
														<input type="radio" name="name3"><span>I want to choose the category of writer (price depends on the category)</span>
														<span class="tooltip-wrapper">
															<a href="#" class="custom-tooltip" data-toggle="tooltip" data-placement="top" title="Tooltip: I want to choose the category of writer (price depends on the category)">
																<i class="icon-info-popup"></i>
															</a>
														</span>
													</label>

													<label class="radio-inline">
														<input type="radio" name="name3"><span>I want a specific writer to complete my order, if possible</span>
														<span class="tooltip-wrapper">
															<a href="#" class="custom-tooltip" data-toggle="tooltip" data-placement="top" title="Tooltip: I want a specific writer to complete my order, if possible">
																<i class="icon-info-popup"></i>
															</a>
														</span>
													</label>
												</div>
											</div>
										</div>
										

										<div class="form-note">
											Mind that no particular level of writing quality may be guaranteed (if the high quality writers are busy, your order may go to the best writer available at the moment). Those who seek only high writing quality results, may choose "ENL" or "Advanced writer" options.
										</div>

										<div class="form-group">
											<label class="col-sm-5 control-label">
												Get a copy of sources used
												<span class="tooltip-wrapper">
													<a href="#" class="custom-tooltip" data-toggle="tooltip" data-placement="top" title="Get a copy of sources used tooltip">
														<i class="icon-info-popup"></i>
													</a>
												</span>
											</label>
											<div class="col-sm-6">
												<label class="radio-inline">
													<input type="radio" name="copy"><span>Yes</span>
												</label>

												<label class="radio-inline">
													<input type="radio" name="copy" checked><span>No</span>
												</label>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-5 control-label">
												Progressive Delivery
												<span class="tooltip-wrapper">
													<a href="#" class="custom-tooltip" data-toggle="tooltip" data-placement="top" title="Progressive Delivery tooltip">
														<i class="icon-info-popup"></i>
													</a>
												</span>
											</label>
											<div class="col-sm-6">
												<div class="checkbox disabled">
													<label>
														<input type="checkbox" disabled>&nbsp;
													</label>
												</div>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-5 control-label">
												Order Writer's Samples
												<span class="tooltip-wrapper">
													<a href="#" class="custom-tooltip" data-toggle="tooltip" data-placement="top" title="Order Writer's Samples tooltip">
														<i class="icon-info-popup"></i>
													</a>
												</span>
											</label>
											<div class="col-sm-6">
												<div class="checkbox">
													<label>
														<input type="checkbox">&nbsp;
													</label>
												</div>
											</div>
										</div>

										<?/*
										
										// Тимчасово ця функція відключена
										
										<div class="form-group">
											<label class="col-sm-5 control-label">
												Discount												
												<span class="tooltip-wrapper">
													<a href="#" class="custom-tooltip" data-toggle="tooltip" data-placement="top" title="Discount tooltip">
														<i class="icon-info-popup"></i>
													</a>
												</span>
											</label>
											<div class="col-sm-3">
												<input type="text" class="form-control">
											</div>
											<div class="col-sm-3">												
												<a href="#" class="btn btn-default">Apply Discount</a>
											</div>
										</div>*/?>

										</br></br>
										<div class="form-group captcha">
											<label class="col-sm-5 control-label">
												Security Code
												<span class="tooltip-wrapper">
													<a href="#" class="custom-tooltip" data-toggle="tooltip" data-placement="top" title="Discount tooltip">
														<i class="icon-info-popup"></i>
													</a>
												</span>
											</label>
											<div>
												<div class="col-sm-2">
													<div class="captcha-wrapper">
														<img src="images/demo/captcha.png" alt="">
													</div>
												</div>
												<div class="col-sm-3">												
													<input type="text" class="form-control captcha-control">
												</div>
											</div>
										</div>

										<div class="form-group total">
											<label class="col-sm-5 control-label large-text">Total Price</label>
											<label class="col-sm-5 control-label text-left">Select <a href="#">type of paper</a> first!</label>
										</div>

										<div class="form-group">
											<div class="checkbox col-sm-12 text-center">
												<label class=" control-label">
													<input type="checkbox"> I agree with <a href="#">Terms and Conditions</a>  and <a href="#">MoneyBack Policy</a> and <a href="#">Privacy Policy</a>
												</label>
											</div>
										</div>

										<div class="form-group pay-systems">
											<div class="col-sm-6 text-right"><a href="#"><img src="images/demo/paypal_btn.png" alt=""></a></div>
											<div class="col-sm-6 text-left"><a href="#"><img src="images/demo/moneybookers_btn.png" alt=""></a></div>
										</div>

									</div><!--price-form-->
								</form>
							</div>
						</div>
						<!-- END PRICE FORM -->
						
					</div>
					<!-- END MIDDLE LAYOUT -->

					<!-- BEGIN LEFT SIDEBAR LAYOUT -->
					<div id="layout-left" class="col-md-3 col-sm-12">
						<?php include 'include/sidebar-left.php' ?>
					</div>
					<!-- END LEFT SIDEBAR LAYOUT -->

				</div>
				<!-- END CONTENT -->
			</div>		
		</main>




<?php include 'include/footer.php' ?>