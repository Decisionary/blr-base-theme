<?php
/**
 * Default footer template.
 *
 * @package BLR\Base_Theme\Templates
 */

use BLR\Base_Theme\Setup;
?>

<?php if ( get_theme_mod( 'blr_base_theme_logo_footer' ) ) : ?>
	<div class="logo logo--footer">
		<img class="logo__image"
			src="<?php echo esc_url( get_theme_mod( 'blr_base_theme_logo_footer' ) ) ?>"
			alt="BLR Footer Logo">
	</div>
<?php endif; ?>


<div class="site-info" role="contentinfo">

	<?php if ( has_nav_menu( 'nav-footer' ) ) : ?>
		<nav class="nav nav--footer">
			<?php
			wp_nav_menu( [ 'theme_location' => 'nav-footer' ] );
			?>
		</nav><!-- /.nav -->
	<?php endif; ?>

	<?php if ( get_theme_mod( 'blr_base_theme_copyright_text' ) ) : ?>
		<p class="copyright">
			<?php echo esc_html( get_theme_mod( 'blr_base_theme_copyright_text' ) ); ?>
		</p>
	<?php endif; ?>

</div><!-- /.site-info -->

<?php if ( Setup\display_sidebar( 'sidebar-footer' ) ) : ?>
	<aside class="sidebar sidebar--footer" role="complementary">
		<?php get_template_part( 'templates/sidebar', 'footer' ); ?>
	</aside><!-- /.sidebar -->
<?php endif; ?>
