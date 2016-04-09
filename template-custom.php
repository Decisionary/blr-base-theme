<?php
/**
 * Template Name: Custom Template
 *
 * @package BLR_Base_Theme/templates
 */

?>

<?php while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'templates/page', 'header' ); ?>
	<?php get_template_part( 'templates/content', 'page' ); ?>
<?php endwhile; ?>
