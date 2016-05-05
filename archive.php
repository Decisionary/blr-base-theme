<?php
/**
 * Archive page template.
 *
 * @package BLR\Base_Theme\Templates
 */

locate_template( [
	'templates/page-header-archive-' . get_post_type() . '.php',
	'templates/page-header-archive.php',
	'templates/page-header-' . get_post_type() . '.php',
	'templates/page-header.php',
], true );

locate_template( [
	'templates/content-archive-' . get_post_type() . '.php',
	'templates/content-archive.php',
	'templates/content-' . get_post_type() . '.php',
	'templates/content.php',
], true );
?>
