<?php include 'include/header.php' ?>

		<main id="main">
			<div class="container">	

				<?php include 'include/nav.php' ?>	

				<!-- BEGIN CONTENT -->
				<div class="row">

					<?php include 'include/sidebar-account.php' ?>

					<!-- BEGIN MIDDLE LAYOUT -->
					<div id="layout-middle" class="col-md-9 col-sm-12 col-xs-12">
						
						<h1 class="page-title">My orders</h3>

						<div class="clearfix"></div>

						<!--BEGIN TABS-->
						<ul class="nav nav-tabs" role="tablist">
							<li class="active"><a href="#draft" role="tab" data-toggle="tab">Draft (2)</a></li>
							<li><a href="#processing" role="tab" data-toggle="tab">Processing</a></li>
							<li><a href="#completed" role="tab" data-toggle="tab">Completed (1)</a></li>
						</ul>
						
						<div class="tab-content">
							<!-- Begin Details Tab -->
  							<div class="tab-pane active" id="draft">
								<div class="table-responsive">
										<table class="table table-striped table-bordered tablesorter">
											<thead>
												<tr>
													<th>Order #</th>
													<th>Order name</th>
													<th>Writter</th>
													<th>Created date</th>
													<th>Deadline</th>
													<th>Revision</th>
													<th>Price</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td><a href="#">First calculation</a></td>
													<td>none</td>
													<td>June 25.2014, 3:26 pm</td>
													<td>in 2 hours</td>
													<td>False</td>
													<td>333$<a href="#" class="btn btn-primary btn-xs">Pay now</a></td>
													<td align="center">
														<a href="#" class="order-action-btn order-search"></a>
														<a href="#" class="order-action-btn order-edit"></a>
														<a href="#" class="order-action-btn order-remove"></a>
													</td>
												</tr>
												<tr>
													<td>2</td>
													<td><a href="#">First calculation</a><a href="#" class="btn btn-primary btn-xs btn-blue"><i class="fa fa-envelope-o"></i> New message</a></td>
													<td>none</td>
													<td>June 25.2014, 3:26 pm</td>
													<td>in 2 hours</td>
													<td>False</td>
													<td>333$</td>
													<td align="center">
														<a href="#" class="order-action-btn order-search"></a>
														<a href="#" class="order-action-btn order-edit"></a>
														<a href="#" class="order-action-btn order-remove"></a>
													</td>
												</tr>
											</tbody>
											<tbody>
											
											</tbody>
										</table>
								</div>
  							</div><!-- End Details Tab -->



  							<!-- Begin Processing Tab -->
  							<div class="tab-pane" id="processing">
  								Processing content
  							</div><!-- End Processing Tab -->



  							<!-- Begin Completed Tab -->
  							<div class="tab-pane" id="completed">
  								Completed content
  							</div><!-- End Completed Tab -->
  						</div>
						<!--END TABS-->

					</div>
					<!-- END MIDDLE LAYOUT -->
				</div>
				<!-- END CONTENT -->
			</div>		
		</main>




<?php include 'include/footer.php' ?>