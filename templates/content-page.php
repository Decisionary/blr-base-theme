<?php
/**
 * Page content template.
 *
 * @package BLR_Base_Theme/Templates
 */

the_content();

wp_link_pages([
	'before' => '<nav class="page-nav"><p>' . __( 'Pages:', 'sage' ),
	'after'  => '</p></nav>',
]);
