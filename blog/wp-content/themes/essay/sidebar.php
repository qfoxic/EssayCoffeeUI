<!-- BEGIN LEFT SIDEBAR LAYOUT -->
<div id="layout-left" class="col-md-3 col-sm-12">
	<div id="cat-list-wrapper">
		<section id="cat-list" class="sibebar-section">
			<a href="javascript:void(0);" class="mobi-toggler-cat"></a>
			<h3 class="page-title">Categories</h3>

			<div class="cat-list-menu">

				<ul class="nav nav-pills nav-stacked">
					<?php 
						$args = array(
							'title_li' => '',
							'style' => 'list'
						);
					?>
					<?php wp_list_categories($args); ?>
				</ul>

			</div>
		</section>
	</div>
	
	<section class="sibebar-section">
		<h3>Tags</h3>
		<?php //the_tags('<ul class="tags-list"><li>','</li><li>','</li></ul>'); ?>
		<ul class="tags-list custom-tags-list">
			<?php wp_tag_cloud(); ?>
		</ul>
	</section>
	
	<section class="sibebar-section">
		<div class="sibebar-banner" style="background: #F0EDED; padding:5px; color:#525050">
			<div style="padding-top:3px; padding-right:3px; background: rgba(255,255,255,0.6); font-size:14px; text-align:right; color:#525050">(Toll Free)</div>
			<div class="banner-title" style="position: relative; font-size:25px; color:#525050">+1 888 243 7406</div>
		</div>
	</section>

	<section class="sibebar-section">
		<h3>Best Prices!</h3>
		<ul class="price-list">
			<?php
				$aa = strlen(get_field('price_1_title',67));
				//echo 'len: '.$aa;


				for ($i = 1; $i <= 10; $i++) {
				    
				    if((strlen(get_field('price_'.$i.'_title',67))) > 0){
				    	?>
				    		<li>
				    			<span class="tariff-descr"><?php echo get_field('price_'.$i.'_title',67) ?></span>
				    			<div class="tag-bg"><span class="currency">$<span class="price-numb"><?php echo get_field('price_'.$i.'_number',67) ?></span></span>/page</div>
				    		</li>
				    	<?php
				    }
				}

			?>
		</ul>
		<a href="<?php the_field('url_for_button_full_price_table',22); ?>" class="btn-transparent btn-grey">Full Price Table</a>
		<!--  -->
	</section>

	<section class="sibebar-section">
		<div class="sibebar-banner">
			<img src="<?php the_field('image_for_banner',22); ?>" alt="">
			<div class="banner-title"><?php the_field('banner_title',22); ?></div>
			<a href="<?php the_field('url_for_button_order_now_in_banner',22); ?>" class="btn btn-primary">Order Now</a>
		</div>
	</section>

	<section class="sibebar-section">
		<h3>Our Benefits</h3>
		<ul class="benefits-list">
			<li><i class="box-icon-small" style="background-image: url(<?php the_field('benefits_item_1_icon',22); ?>);"></i><span><?php the_field('benefits_item_1_text',22); ?></span></li>
			<li><i class="box-icon-small" style="background-image: url(<?php the_field('benefits_item_2_icon',22); ?>);"></i><span><?php the_field('benefits_item_2_text',22); ?></span></li>
			<li><i class="box-icon-small" style="background-image: url(<?php the_field('benefits_item_3_icon',22); ?>);"></i><span><?php the_field('benefits_item_3_text',22); ?></span></li>
			<li><i class="box-icon-small" style="background-image: url(<?php the_field('benefits_item_4_icon',22); ?>);"></i><span><?php the_field('benefits_item_4_text',22); ?></span></li>
		</ul>
	</section>

	<section class="sibebar-section">
		<!-- BEGIN SOCIAL SHARE BUTTONS -->
		<div class="social-share">
			<!-- Google Plus Button -->
			<div class="g-plusone" data-size="medium" data-href="<?php echo esc_url( home_url( '/' ) ); ?>"></div>
			<script type="text/javascript">
			  (function() {
			    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			    po.src = 'https://apis.google.com/js/platform.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>
			<!-- end Google Plus Button -->

			<!-- Twitter Button -->
			<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo esc_url( home_url( '/' ) ); ?>">Tweet</a>
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
			<div class="fb-like" data-href="<?php echo esc_url( home_url( '/' ) ); ?>" data-width="100" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
			<!-- end Facebook Button -->
		</div>
		<!-- END SOCIAL SHARE BUTTONS -->
	</section>
</div>
<!-- END LEFT SIDEBAR LAYOUT -->