<?php include 'include/header.php' ?>

		<main id="main">
			<div class="container">	

				<?php include 'include/nav.php' ?>	

				<!-- BEGIN CONTENT -->
				<div class="row">

					<?php include 'include/sidebar-account.php' ?>

					<!-- BEGIN MIDDLE LAYOUT -->
					<div id="layout-middle" class="col-md-9 col-sm-12 col-xs-12">
					
						<h1 class="page-title pull-left">Order ID: 454545454545</h1>
						
						<div style="margin-top: 16px; margin-bottom: 24px;"><a href="#" class="btn btn-default pull-right btn-back"><i class="fa fa-angle-left"></i> Back</a></div>

						<div class="clearfix"></div>

						<!--BEGIN TABS-->
						<ul class="nav nav-tabs" role="tablist">
							<li class="active"><a href="#details" role="tab" data-toggle="tab">Order details</a></li>
							<li><a href="#files" role="tab" data-toggle="tab">Files</a></li>
							<li><a href="#messages" role="tab" data-toggle="tab">messages (2)</a></li>
						</ul>
						
						<div class="tab-content">
							<!-- Begin Details Tab -->
  							<div class="tab-pane active" id="details">
  								<div class="table-responsive">
	  								<table class="table table-striped">
	  									<tbody>
		  									<tr>
		  										<th width="155px">Order</th>
		  										<td>4545454545</td>
		  									</tr>

		  									<tr>
		  										<th>Topic</th>
		  										<td>sgsdgjosddgj</td>
		  									</tr>

		  									<tr>
		  										<th>Type of assignment</th>
		  										<td>Dissertation chapter - Introduction</td>
		  									</tr>

		  									<tr>
		  										<th>Urgency</th>
		  										<td>14 days</td>
		  									</tr>

		  									<tr>
		  										<th>Writer level</th>
		  										<td>Master's</td>
		  									</tr>

		  									<tr>
		  										<th>Style</th>
		  										<td>APA</td>
		  									</tr>

		  									<tr>
		  										<th>Sources</th>
		  										<td>5</td>
		  									</tr>

		  									<tr>
		  										<th>Language</th>
		  										<td>English</td>
		  									</tr>

		  									<tr>
		  										<th>Description</th>
		  										<td>jsddfo;sdflkslkflskkfjlksdmklmlsdmf</td>
		  									</tr>

		  									<tr>
		  										<th>Added</th>
		  										<td>2014.06.26 12:26</td>
		  									</tr>

		  									
											
											<tr>
		  										<th>Delivery</th>
		  										<td>2014.07.10 12:16 
		  											<?/*
											
													// Тимчасово відсутня функція
													
													<a href="#" class="btn-extend" data-toggle="modal" data-target="#modalExtend">
			  											<span class="fa-stack">
															<i class="fa fa-circle-thin fa-stack-2x"></i>
															<i class="fa fa-plus fa-stack-1x"></i>
														</span>
														Extend
													</a>
													*/?>
		  										</td>
		  									</tr>

		  									<tr>
		  										<th>Spacing</th>
		  										<td>Single spaced</td>
		  									</tr>

		  									<tr>
		  										<th>Page price</th>
		  										<td>56$</td>
		  									</tr>

		  									<tr>
		  										<th>Pages</th>
		  										<td>6</td>
		  									</tr>

		  									<tr>
		  										<th>Additional services</th>
		  										<td>5</td>
		  									</tr>

		  									<tr>
		  										<th>Discount</th>
		  										<td>0%</td>
		  									</tr>

		  									<tr>
		  										<th>Price</th>
		  										<td>356$</td>
		  									</tr>

		  									<tr>
		  										<th>Payment details</th>
		  										<td>&nbsp;</td>
		  									</tr>

		  									<tr>
		  										<th>Writer ID</th>
		  										<td>&nbsp;</td>
		  									</tr>
	  									</tbody>
	  								</table>
  								</div>

  								<div class="row text-center order-actions">
  									<a href="#" class="btn btn-default" data-toggle="modal" data-target="#modalDelete">Delete</a> 
  									<a href="#" class="btn btn-default">Edit</a>
  									<a href="#" class="btn btn-primary">Pay now (356$)</a>  									
  								</div>

  							</div><!-- End Details Tab -->



  							<!-- Begin Files Tab -->
  							<div class="tab-pane" id="files">
  								<!-- Begin If no files found CODE -->
  								<form class="form-horizontal">
  									<div class="form-group">
  										<label class="col-sm-3 control-label">No files found</label>
										<div class="col-sm-9">
											<a class="btn btn-default" data-toggle="modal" data-target="#modalUploadFile">Upload file</a>
										</div>
  									</div>
  								</form>
  								<!-- End If no files found CODE -->

  								<!-- Begin If files uploaded -->
  								<br><br><br>
  								<div class="table-responsive">
	  								<table class="table table-striped table-bordered tablesorter">
	  									<thead>
	  										<tr>
	  											<th>Date created</th>
	  											<th>File name</th>
	  											<th>Comment</th>
	  										</tr>
	  									</thead>
	  									<tbody>
	  										<tr>
	  											<td>05.01.2011</td>
	  											<td><a href="#">546456.rtf</a></td>
	  											<td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tristique egestas tortor ut euismod. Curabitur quis sem consectetur</td>
	  										</tr>

	  										<tr>
	  											<td>05.01.2011</td>
	  											<td><a href="#">546456.rtf</a></td>
	  											<td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam tristique egestas tortor ut euismod. Curabitur quis sem consectetur</td>
	  										</tr>
	  									</tbody>
	  								</table>
  								</div>
  								<a class="btn btn-default" data-toggle="modal" data-target="#modalUploadFile">Upload file</a>
  								<!-- End If files uploaded -->

  							</div><!-- End Files Tab -->



  							<!-- Begin Messages Tab -->
  							<div class="tab-pane" id="messages">
  								<div id="messages-list">
	  								<div class="row message-mine">
	  									<div class="col-md-2 col-sm-2 col-xs-2">
	  										<div class="user-avatar"><img src="images/thumb-user-default.jpg" alt=""></div>
	  									</div>
	  									<div class="col-md-10 col-sm-10 col-xs-10 message">
	  										<div class="message-time">I am at 22:20</div>
	  										<div class="message-subj">Hi</div>
	  										<div class="message-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>
	  									</div>
	  								</div>

	  								<div class="row message-support">
	  									<div class="col-md-10 col-sm-10 col-xs-10 message">
	  										<div class="message-time">Support am at 22:20</div>
	  										<div class="message-subj">Re: Hi</div>
	  										<div class="message-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</div>
	  									</div>
	  									<div class="col-md-2 col-sm-2 col-xs-2">
	  										<div class="user-avatar"><img src="images/thumb-support-default.png" alt=""></div>
	  									</div>
	  								</div>

	  								<div class="row message-mine">
	  									<div class="col-md-2 col-sm-2 col-xs-2">
	  										<div class="user-avatar"><img src="images/thumb-user-default.png" alt=""></div>
	  									</div>
	  									<div class="col-md-10 col-sm-10 col-xs-10 message">
	  										<div class="message-time">I am at 22:20</div>
	  										<div class="message-subj">Hi</div>
	  										<div class="message-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</div>
	  									</div>
	  								</div>

	  								<div class="row message-support">
	  									<div class="col-md-10 col-sm-10 col-xs-10 message">
	  										<div class="message-time">Support am at 22:20</div>
	  										<div class="message-subj">Re: Hi</div>
	  										<div class="message-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</div>
	  									</div>
	  									<div class="col-md-2 col-sm-2 col-xs-2">
	  										<div class="user-avatar"><img src="images/thumb-support-default.png" alt=""></div>
	  									</div>
	  								</div>
  								</div>

  								<div class="row message-reply-form">
  									<form class="form-horizontal">
  										<div class="form-group">
  											<div class="col-md-12 col-sm-12">
	  											<label class="col-md-2 col-sm-2 col-xs-12 control-label">Send to:</label>
	  											<div class="col-md-4 col-sm-4 col-xs-12">
											    	<select class="form-control">
											    		<option>Writter</option>
											    		<option>Support</option>
											    	</select>
											    </div>
										    </div>
  										</div>

  										<div class="form-group">
  											<div class="col-md-12 col-sm-12">
  												<input type="text" class="form-control" placeholder="Subject">
  											</div>
  										</div>

  										<div class="form-group">
  											<div class="col-md-12 col-sm-12">
  											<textarea class="form-control" placeholder="Type a message here..." rows="3"></textarea>
  											</div>
  										</div>

  										<button class="btn btn-primary">Submit</button>

  									</form>
  								</div>
  							</div><!-- End Messages Tab -->
  						</div>
						<!--END TABS-->

						<!-- BEGIN MODALS -->
						<!-- begin Extend modal-->
						<div class="modal fade order-modal" id="modalExtend" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-md">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">
											<span aria-hidden="true"></span><span class="sr-only">Close</span>
										</button>
										<h4 class="modal-title" id="myModalLabel">Extend Deadline</h4>
									</div>

									<div class="modal-body">
										<form class="form-inline">
											<div class="form-group">
												<label>Add</label>
												<input type="text" class="form-control" placeholder="1">
											</div>
											<div class="form-group">
												<label>day(s) and</label>
												<input type="text" class="form-control" placeholder="0">
												<label>hours</label>
											</div>
											<div class="submit-group">
												<button class="btn btn-primary">Extend</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!-- end Extend modal-->
						
						<!-- begin Delete modal-->
						<div class="modal fade order-modal" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-md">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">
											<span aria-hidden="true"></span><span class="sr-only">Close</span>
										</button>
										<h4 class="modal-title" id="myModalLabel">Are you sure?</h4>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
										<button type="button" data-toggle="modal" data-target="#modalDeleteSuccess" class="btn btn-primary">Delete</button>
							    </div>
								</div>
							</div>
						</div>

						<!-- begin Upload File modal-->
						<div class="modal fade order-modal" id="modalUploadFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-md">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">
											<span aria-hidden="true"></span><span class="sr-only">Close</span>
										</button>
										<h4 class="modal-title" id="myModalLabel">Upload file</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal">
											<div class="form-group">
												<label class="col-sm-3 control-label">File input</label>
												<div class="col-sm-8">
													<input type="file" class="form-control">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Comment</label>
												<div class="col-sm-8">
													<textarea class="form-control"></textarea>
												</div>
											</div>
											<div class="submit-group">
												<button type="button" data-toggle="modal" data-target="#modalUploadSuccess" class="btn btn-primary">Upload</button>
											</div>
										</form>
									</div>

								</div>
							</div>
						</div>
						<!-- end Upload File modal-->

						<!-- begin Upload Success modal-->
						<div class="modal fade order-modal notification-modal" id="modalUploadSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-md">
								<div class="modal-content">
									<div class="modal-body">File uploaded successfull</div>
								</div>
							</div>
						</div>
						<!-- end Upload Success modal-->

						<!-- begin Delete Success modal-->
						<div class="modal fade order-modal notification-modal" id="modalDeleteSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-md">
								<div class="modal-content">
									<div class="modal-body">File deleted successfull</div>
								</div>
							</div>
						</div>
						<!-- end Delete Success modal-->
						<!-- END MODALS -->


					</div>
					<!-- END MIDDLE LAYOUT -->
				</div>
				<!-- END CONTENT -->
			</div>		
		</main>




<?php include 'include/footer.php' ?>