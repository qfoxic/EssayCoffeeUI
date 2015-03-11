<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<!-- BEGIN MIDDLE LAYOUT -->
<div id="layout-middle" class="col-md-9 col-sm-9">

		<h3 class="page-title">Blog</h3>

		<?php if ( have_posts() ) : ?>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				
				
				<div class="row blog-list-item">
					<div class="col-md-4 col-sm-4">
						<div>
							<div><?php the_post_thumbnail('medium'); ?></div>
						</div>
					</div>

					<div class="col-md-8 col-sm-8">
						<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
						<ul class="blog-meta">
							<li><i class="fa fa-calendar"></i> <?php echo get_the_date();?></li>
							<?php 
							$post_tags = wp_get_post_tags($post->ID);
							if(!empty($post_tags))
								{
								?>
								<li><i class="fa fa-tags"></i> <?php the_tags('<ul><li>','</li>,<li>','</li></ul>'); ?></li>
								<?php
								}
							?>
						</ul>
						<p class="blog-exp"><?php the_excerpt();?></p>
						<a href="<?php the_permalink();?>" class="more">Read more <i class="icon-angle-right"></i></a>
					</div>
				</div><!--blog-list-item-->

			<?php endwhile; ?>

			<?php //twentythirteen_paging_nav(); ?>

			<?php wp_paginate(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

</div>
<!-- END MIDDLE LAYOUT -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>