<?php
/**
 * Default header template.
 *
 * @package BLR_Base_Theme/Templates
 */

?>

<header class="banner">
	<div class="container">
		<div>
			<?php
				if ( get_theme_mod( 'blr_base_theme_primary_logo' ) ) :
					echo '<img src="' . esc_url( get_theme_mod( 'blr_base_theme_primary_logo' ) ) . '">';
				else:
					echo get_bloginfo('name') . '<span>' . get_bloginfo('description') . '</span>';
				endif;
			?>
		</div>
		<nav class="nav-primary">
			<?php
			if ( has_nav_menu( 'primary_navigation' ) ) :
				wp_nav_menu([
					'theme_location' => 'primary_navigation',
					'menu_class'     => 'nav',
				]);
			endif;
			?>
		</nav>
	</div>
</header>
