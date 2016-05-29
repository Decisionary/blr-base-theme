<?php
/**
 * Default footer template.
 *
 * @package BLR\Base_Theme\Templates
 */

use BLR\Base_Theme\Setup;
use BLR\Base_Theme\Customizer;

$logo_footer_enabled   = get_theme_mod( 'blr_base_theme_logo_footer_enabled', '1' );
$logo_footer_image_url = get_theme_mod(
	'blr_base_theme_logo_footer',
	Customizer\get_default( 'blr_base_theme_logo_footer' )
);
$site_info_footer = array_filter( [
	get_theme_mod(
		'blr_base_theme_company_name',
		Customizer\get_default( 'blr_base_theme_company_name' )
	),
	get_theme_mod(
		'blr_base_theme_address_1',
		Customizer\get_default( 'blr_base_theme_address_1' )
	),
	get_theme_mod(
		'blr_base_theme_address_2',
		Customizer\get_default( 'blr_base_theme_address_2' )
	),
	get_theme_mod(
		'blr_base_theme_phone_number',
		Customizer\get_default( 'blr_base_theme_phone_number' )
	),
	get_theme_mod(
		'blr_base_theme_copyright_text',
		Customizer\get_default( 'blr_base_theme_copyright_text' )
	),
] );
?>

<?php if ( ! empty( $logo_footer_enabled ) && ! empty( $logo_footer_image_url ) ) : ?>
	<div class="logo logo--footer">
		<img class="logo__image"
			src="<?php echo esc_url( $logo_footer_image_url ) ?>"
			alt="BLR Footer Logo">
	</div>
<?php endif; ?>

<?php if ( has_nav_menu( 'nav-footer' ) ) : ?>
	<nav class="nav nav--footer">
		<?php
		wp_nav_menu( [ 'theme_location' => 'nav-footer' ] );
		?>
	</nav><!-- /.nav -->
<?php endif; ?>

<?php if ( ! empty( $site_info_footer ) ) : ?>
	<div class="site-info site-info--footer" role="contentinfo">
		<?php echo wp_kses_post( implode( ' | ', $site_info_footer ) ); ?>
	</div><!-- /.site-info -->
<?php endif; ?>

<?php if ( Setup\display_sidebar( 'sidebar-footer' ) ) : ?>
	<aside class="sidebar sidebar--footer" role="complementary">
		<?php get_template_part( 'templates/sidebar', 'footer' ); ?>
	</aside><!-- /.sidebar -->
<?php endif; ?>
