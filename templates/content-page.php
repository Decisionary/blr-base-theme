<?php
/**
 * Page content template.
 *
 * @package BLR_Base_Theme\Templates
 */

the_content();

wp_link_pages([
	'before' => '<nav class="page-nav"><p>' . __( 'Pages:', 'blr-base-theme' ),
	'after'  => '</p></nav>',
]);
