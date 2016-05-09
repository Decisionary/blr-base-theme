<?php
/**
 * 404 page content template.
 *
 * @package BLR\Base_Theme\Templates
 */

?>

<div class="alert alert-warning">
	<?php
	esc_html_e(
		'Sorry, but the page you were trying to view does not exist.',
		'blr-base-theme'
	);
	?>
</div>

<?php get_search_form(); ?>
