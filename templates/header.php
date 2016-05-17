<?php
/**
 * Default header template.
 *
 * @package BLR\Base_Theme\Templates
 */

?>

<div class="branding branding--header">
	<?php if ( get_theme_mod( 'blr_base_theme_logo_primary' ) ) : ?>
		<img
			class="logo logo--header"
			src="<?php echo esc_url( get_theme_mod( 'blr_base_theme_logo_primary' ) ) ?>"
			alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
		>
	<?php else : ?>
		<div class="logo logo--text logo--header">
			<p>
				<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
			</p>
			<p>
				<?php echo esc_html( get_bloginfo( 'description' ) ); ?>
			</p>
		</div>
	<?php endif; ?>
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
</div><!-- /.search -->

<?php if ( get_theme_mod( 'blr_base_theme_logo_search' ) ) : ?>
	<img
		class="logo logo--search"
		src="<?php echo esc_url( get_theme_mod( 'blr_base_theme_logo_search' ) ); ?>"
		alt="Powered by BLR"
	>
<?php endif; ?>
