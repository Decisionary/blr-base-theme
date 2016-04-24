<?php
/**
 * Default footer template.
 *
 * @package BLR_Base_Theme/Templates
 */

?>

<footer class="content-info">
	<div class="container">
		<?php
		if ( get_theme_mod( 'blr_base_theme_footer_logo' ) ) :
			echo '<img class="logo" src="' . esc_url( get_theme_mod( 'blr_base_theme_footer_logo' ) ) . '">';
		endif;
		?>
		<?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
		<?php dynamic_sidebar( 'sidebar-footer' ); ?>
	</div>
</footer>
