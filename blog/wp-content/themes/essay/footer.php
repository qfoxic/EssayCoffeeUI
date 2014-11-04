<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
</div>
				<!-- END CONTENT -->
				</div>		
			</main>
		</div><!--wrap-->

		<footer id="footer">
			<div id="copyright" class="blue-copyright">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-12">Copyright © 2013-2014 name.com All Rights Reserved | <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_url( home_url( '/' ) ); ?></a></div>
						<div class="col-md-6 col-sm-12 text-right">
							<span>We accept:</span>
							<ul class="merchants">
								<li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/demo/paypal.png" alt="paypal" title="Paypal"></a></li>
								<li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/demo/moneybookers.png" alt="moneybookers" title="Moneybookers"></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>


			<a href="#pre-header" id="toTop"></a>
			
		</footer>

	<?php wp_footer(); ?>

</body>
</html>