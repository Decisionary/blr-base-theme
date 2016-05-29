<?php
/**
 * Template Name: Full Width (no sidebars)
 *
 * @package BLR\Base_Theme\Page_Templates
 */

while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'templates/page-header' ); ?>
	<?php get_template_part( 'templates/content', 'page' ); ?>

<?php endwhile; ?>
