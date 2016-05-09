<?php
/**
 * Page template for single posts, pages, and custom post type entries.
 *
 * @package BLR\Base_Theme\Templates
 */

$type = ( 'post' !== get_post_type() ? get_post_type() : get_post_format() );

get_template_part( 'templates/content-single', $type );
