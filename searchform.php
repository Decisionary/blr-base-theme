<?php
/**
 * Search form template.
 *
 * @package BLR_Base_Theme\Templates
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="search-form__label">
		<input type="search" class="search-form__input" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder', 'blr-base-theme' ) ?>" value="<?php the_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'blr-base-theme' ) ?>">
	</label>

	<button class="search-form__button" type="submit">
		<i class="search-form__icon"></i>
	</button>
</form>
