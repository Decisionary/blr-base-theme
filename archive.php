<?php
/**
 * Archive page template.
 *
 * @package BLR\Base_Theme\Templates
 */

$post_type = get_post_type();
$tax_data  = get_queried_object();
$tax_name  = isset( $tax_data->taxonomy )  ? $tax_data->taxonomy  : '';
$term_id   = isset( $tax_data->term_id )   ? $tax_data->term_id   : '';
$term_name = isset( $tax_data->term_name ) ? $tax_data->term_name : '';

// Archive content templates to look for.
$header_templates = [
	"templates/page-header-archive-{$post_type}.php",
	'templates/page-header-archive.php',
	"templates/page-header-{$post_type}.php",
	'templates/page-header.php',
];

$content_templates = [
	"templates/content-archive-{$post_type}.php",
	'templates/content-archive.php',
	"templates/content-{$post_type}.php",
	'templates/content.php',
];

// Check if we're on a taxonomy archive page.
if ( ! empty( $tax_name ) ) {

	// If so, add taxonomy templates before the archive templates.
	$header_templates = array_merge( [
		"templates/page-header-taxonomy-{$tax_name}-{$term_name}.php",
		"templates/page-header-taxonomy-{$tax_name}.php",
		'templates/page-header-taxonomy.php',
	], $header_templates );

	$content_templates = array_merge( [
		"templates/content-taxonomy-{$tax_name}-{$term_name}.php",
		"templates/content-taxonomy-{$tax_name}.php",
		'templates/content-taxonomy.php',
	], $content_templates );

	// Enable the auto-embed feature for WYSIWYG fields on taxonomy pages.
	// By default WordPress restricts this functionality to posts only.
	if ( ! empty( $term_id ) ) {
		$GLOBALS['wp_embed']->post_ID = $tax_name . '_' . $term_id;
	}
}

// Locate and include the template files.
locate_template( $header_templates, true );
locate_template( $content_templates, true );
