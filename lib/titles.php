<?php
/**
 * Page titles.
 *
 * @package BLR_Base_Theme\Titles
 */

namespace BLR_Base_Theme\Titles;

/**
 * Page titles.
 *
 * @since 0.1.0
 *
 * @return string
 */
function title() {
	if ( is_home() ) {
		if ( get_option( 'page_for_posts', true ) ) {
			return get_the_title( get_option( 'page_for_posts', true ) );
		} else {
			return __( 'Latest Posts', 'blr-base-theme' );
		}
	} elseif ( is_archive() ) {
		return get_the_archive_title();
	} elseif ( is_search() ) {
		return sprintf( __( 'Search Results for %s', 'blr-base-theme' ), get_search_query() );
	} elseif ( is_404() ) {
		return __( 'Not Found', 'blr-base-theme' );
	} else {
		return get_the_title();
	}
}
