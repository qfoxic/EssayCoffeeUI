<?php include 'include/header.php' ?>

		<main id="main">
			<div class="container">		

				<?php include 'include/nav.php' ?>
			
				<!-- BEGIN CONTENT -->
				<div class="row">
				
					<!-- BEGIN MIDDLE LAYOUT -->
					<div id="layout-middle" class="col-md-9 col-sm-9 content-page">
					
						<h1 class="page-title margin-top">Dissertation Online</h1>

						<div class="post-carousel owl-carousel">
							<div><img src="images/demo/post-carousel/slide-1.jpg" alt=""></div>
							<div><img src="images/demo/post-carousel/slide-1.jpg" alt=""></div>
						</div>

						<h4>Your Dissertation is important</h4>
						<p>When you write your dissertation you will find it is both lengthy and formal, which needs a lot of effort to get it completed. You must not only present original contributions, but you need to find evidence to support it. Once the long and thorough research is completed then come the hard part; writing a paper that is well organized, and presents the material and discussions in a flawless paper. It must demonstrate critical thinking and the ideas must be correctly expressed. This takes well developed writing skills as well as thorough time consuming research. If you find the task overwhelming you need to get help. The issue is where to find help that you can trust. You need professional assistance.</p>

						<h4>Your Dissertation is important</h4>
						<p>When you write your dissertation you will find it is both lengthy and formal, which needs a lot of effort to get it completed. You must not only present original contributions, but you need to find evidence to support it. Once the long and thorough research is completed then come the hard part; writing a paper that is well organized, and presents the material and discussions in a flawless paper. It must demonstrate critical thinking and the ideas must be correctly expressed. This takes well developed writing skills as well as thorough time consuming research. If you find the task overwhelming you need to get help. The issue is where to find help that you can trust. You need professional assistance.</p>

						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam quis varius orci, eu pretium mauris. Nulla ultricies sem tristique, eleifend libero et, viverra orci. Cras scelerisque vestibulum dolor, in fermentum sem. Nam et fermentum sem, quis adipiscing ligula. Quisque a tempus mi. Vivamus tristique arcu a convallis lobortis.</p>

						<blockquote>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
							<small>Adam Lorep Ipsum</small>
						</blockquote>

						<p>In sed malesuada arcu. Ut varius tellus accumsan tortor tempus, non consequat sapien hendrerit. Quisque blandit vestibulum fermentum. In condimentum odio sed odio ultrices ullamcorper. Vivamus sit amet varius mauris, in interdum nibh. Suspendisse eget purus vitae enim aliquam bibendum. In dignissim fringilla nunc ac elementum. Pellentesque sit amet nulla velit. Curabitur vel odio at urna iaculis ullamcorper non vitae metus.</p>

						<!-- BEGIN SOCIAL SHARE BUTTONS -->
						<div class="social-share">
							<!-- Google Plus Button -->
							<div class="g-plusone" data-size="medium" data-href="http://www.lipsum.com/"></div>
							<script type="text/javascript">
							  (function() {
							    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
							    po.src = 'https://apis.google.com/js/platform.js';
							    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
							  })();
							</script>
							<!-- end Google Plus Button -->

							<!-- Twitter Button -->
							<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.lipsum.com/">Tweet</a>
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
							<!-- end Twitter Button -->

							<!-- Facebook Button -->
							<div id="fb-root"></div>
							<script>(function(d, s, id) {
							  var js, fjs = d.getElementsByTagName(s)[0];
							  if (d.getElementById(id)) return;
							  js = d.createElement(s); js.id = id;
							  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=387897624670260&version=v2.0";
							  fjs.parentNode.insertBefore(js, fjs);
							}(document, 'script', 'facebook-jssdk'));</script>
							<div class="fb-like" data-href="http://www.lipsum.com/" data-width="100" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
							<!-- end Facebook Button -->
						</div>
						<!-- END SOCIAL SHARE BUTTONS -->

						<!-- BEGIN POST META -->
						<ul class="blog-meta">
							<li><i class="fa fa-user"></i> By admin</li>
							<li><i class="fa fa-calendar"></i> 25/07/2013</li>
							<li><i class="fa fa-comments"></i> 17</li>
							<li><i class="fa fa-tags"></i> Metronic, Keenthemes, UI Design</li>
						</ul>
						<!-- END POST META -->

						<!-- BEGIN COMMENTS -->
						<div id="disqus_thread"></div>
						    <script type="text/javascript">
						        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
						        var disqus_shortname = 'mythemetest'; // required: replace example with your forum shortname

						        /* * * DON'T EDIT BELOW THIS LINE * * */
						        (function() {
						            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
						            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
						            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
						        })();
						    </script>
						    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
						    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
						<!-- END COMMENTS -->


					</div>
					<!-- END MIDDLE LAYOUT -->

					<!-- BEGIN LEFT SIDEBAR LAYOUT -->
					<div id="layout-left" class="col-md-3 col-sm-12">
						<?php include 'include/slidebar-categories.php' ?>
						<?php include 'include/slidebar-tags.php' ?>
						<?php include 'include/sidebar-left.php' ?>
					</div>
					<!-- END LEFT SIDEBAR LAYOUT -->

				</div>
				<!-- END CONTENT -->
			</div>		
		</main>




<?php include 'include/footer.php' ?>