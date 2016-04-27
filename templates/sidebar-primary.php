<?php
/**
 * Primary sidebar template.
 *
 * @package BLR_Base_Theme\Templates
 */

use BLR_Base_Theme\Setup;
?>

<?php if ( Setup\display_nav_menu( 'nav-sidebar' ) ) : ?>
	<nav class="nav nav--sidebar">
		<?php
		wp_nav_menu( [ 'theme_location' => 'nav-sidebar' ] );
		?>
	</nav>
<?php endif; ?>

<?php dynamic_sidebar( 'sidebar-primary' ); ?>
