<?php
/**
 * Default header template.
 *
 * @package BLR\Base_Theme\Templates
 */

?>

<div class="branding branding--header">
	<div class="logo logo--header">
		<?php if ( get_theme_mod( 'blr_base_theme_logo_primary' ) ) : ?>
			<img class="logo__image"
				src="<?php echo esc_url( get_theme_mod( 'blr_base_theme_logo_primary' ) ) ?>"
				alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
		<?php else : ?>
			<span class="logo__text">
				<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
				<br>
				<?php echo esc_html( get_bloginfo( 'description' ) ); ?>
			</span>
		<?php endif; ?>
	</div>
</div><!-- /.branding -->

<div class="search search--header">
	<?php if ( has_nav_menu( 'nav-search' ) ) : ?>
		<nav class="nav nav--search">
			<?php
			wp_nav_menu( [ 'theme_location' => 'nav-search' ] );
			?>
		</nav><!-- /.nav -->
	<?php endif; ?>

	<?php echo get_search_form(); ?>

	<div class="logo logo--search">
		<?php if ( get_theme_mod( 'blr_base_theme_logo_search' ) ) : ?>
			<img class="logo__image"
				src="<?php echo esc_url( get_theme_mod( 'blr_base_theme_logo_search' ) ); ?>"
				alt="Powered by BLR">
		<?php endif; ?>
	</div><!-- /.logo -->
</div><!-- /.search -->
