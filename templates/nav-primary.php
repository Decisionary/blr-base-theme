<?php
/**
 * Primary nav menu template.
 *
 * @package BLR\Base_Theme\Templates
 */

wp_nav_menu( [ 'theme_location' => 'nav-primary' ] );

$trial_link  = apply_filters( 'blr-base-theme/user-menu/trial-url', home_url( '/trial' ) );
$login_link  = apply_filters( 'blr-base-theme/user-menu/login-url', home_url( '/login' ) );
$logout_link = apply_filters( 'blr-base-theme/user-menu/logout-url', home_url( '/logout' ) );
?>

<ul class="menu menu--user">
	<li class="menu__item menu__item--trial">
		<a class="menu__link" href="<?php echo esc_url( $trial_link ); ?>">
			Free Trial
		</a>
	</li>
	<li class="menu__item menu__item--login">
		<a class="menu__link" href="<?php echo esc_url( $login_link ); ?>">
			Sign In
		</a>
	</li>
</ul>
