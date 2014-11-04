<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<!-- BEGIN MIDDLE LAYOUT -->
<div id="layout-middle" class="col-md-9 col-sm-9 content-page">
	<!-- BEGIN BREADCRUMBS -->
	<div class="breadcrumbs">
		<?php if(function_exists('bcn_display'))
	    {
	        bcn_display();
	    }?>
	</div>
	<!-- END BREADCRUMBS -->

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<header class="entry-header">
						<h3 class="page-title"><?php the_title(); ?></h3>
					</header>

					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				</article><!-- #post -->

			<?php endwhile; ?>

</div>
<!-- END MIDDLE LAYOUT -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>