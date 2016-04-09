<?php
/**
 * Single page template.
 *
 * @package BLR_Base_Theme/Templates
 */

while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'templates/page', 'header' ); ?>
	<?php get_template_part( 'templates/content', 'page' ); ?>
<?php endwhile; ?>
