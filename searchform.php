
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="search-form__label">
		<input type="search" class="search-form__input" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder', 'blr-base-theme' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'blr-base-theme' ) ?>"/>
	</label>

	<i class="search-form__icon"></i>
</form>
