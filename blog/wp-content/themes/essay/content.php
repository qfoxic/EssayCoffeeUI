<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<!-- BEGIN MIDDLE LAYOUT -->
<div id="layout-middle" class="col-md-9 col-sm-9 content-page">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php if ( is_single() ) : ?>
			<h3 class="page-title"><?php the_title(); ?></h3>
			<?php else : ?>
			<h3 class="page-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h3>
			<?php endif; // is_single() ?>

		</header><!-- .entry-header -->

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>
	</article>

	<!-- BEGIN SOCIAL SHARE BUTTONS -->
	<div class="social-share">
		<!-- Google Plus Button -->
		<div class="g-plusone" data-size="medium" data-href="<?php the_permalink();?>"></div>
		<script type="text/javascript">
		  (function() {
		    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		    po.src = 'https://apis.google.com/js/platform.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>
		<!-- end Google Plus Button -->

		<!-- Twitter Button -->
		<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink();?>">Tweet</a>
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
		<div class="fb-like" data-href="<?php the_permalink();?>" data-width="100" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
		<!-- end Facebook Button -->
	</div>
	<!-- END SOCIAL SHARE BUTTONS -->

	<!-- BEGIN POST META -->
	<ul class="blog-meta">
		<li><i class="fa fa-user"></i> By <?php the_author();?></li>
		<li><i class="fa fa-calendar"></i> <?php echo get_the_date();?></li>
		<li class="comments-count"><i class="fa fa-comments"></i> </li>
		<?php 
			$post_tags = wp_get_post_tags($post->ID);
				if(!empty($post_tags)) { ?>
				<li><i class="fa fa-tags"></i> <?php the_tags('<ul><li>','</li>,<li>','</li></ul>'); ?></li>
		<?php } ?>
		
	</ul>
	<!-- END POST META -->

	<!-- BEGIN COMMENTS -->
	<div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'essaycoffee'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
	<!-- END COMMENTS -->






<?php
$disqus_shortname = 'essaycoffee';
function disqus_count($disqus_shortname) {
    wp_enqueue_script('disqus_count','http://essaycoffee.disqus.com/count.js');
    echo '<a href="'. get_permalink() .'#disqus_thread" class="comments-count-container"></a>';
};

disqus_count('essaycoffee');
?>

<script type="text/javascript">
setTimeout(function() { 
	var commentsCount = parseInt ($('.comments-count-container').text()); 
	$('.comments-count').append(commentsCount);
}, 1500)
</script>

</div>
<!-- END MIDDLE LAYOUT -->