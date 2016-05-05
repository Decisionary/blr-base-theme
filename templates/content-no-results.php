<?php
/**
 * 404 page content template.
 *
 * @package BLR\Base_Theme\Templates
 */

?>

<div class="alert alert-warning">
	<?php esc_html_e( 'Sorry, no results were found.', 'blr-base-theme' ); ?>
</div>

<?php get_search_form(); ?>
