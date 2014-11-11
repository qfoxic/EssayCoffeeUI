<?php
/**
 * The template for displaying Tag pages
 *
 * Used to display archive-type pages for posts in a tag.
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

	<?php if ( have_posts() ) : ?>
		<h3 class="page-title"><?php printf( __( 'Tag: %s', 'twentythirteen' ), single_tag_title( '', false ) ); ?></h3>

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
						<li><i class="fa fa-comments"></i> 17</li>
						<?php 
							$post_tags = wp_get_post_tags($post->ID);
								if(!empty($post_tags)) { ?>
								<li><i class="fa fa-tags"></i> <?php the_tags('<ul><li>','</li>,<li>','</li></ul>'); ?></li>
						<?php } ?>
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