<?php
/**
 * Blog / home page template.
 *
 * @package BLR\Base_Theme\Templates
 */

while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'templates/page-header', 'home' ); ?>
	<?php get_template_part( 'templates/content', 'home' ); ?>

<?php endwhile; ?>
