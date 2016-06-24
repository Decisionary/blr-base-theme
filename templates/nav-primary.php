<?php
/**
 * Primary nav menu template.
 *
 * @package BLR\Base_Theme\Templates
 */

$trial_link  = apply_filters( 'blr/user-nav/trial-url', home_url( '/trial' ) );
$login_link  = apply_filters( 'blr/user-nav/login-url', home_url( '/login' ) );
$logout_link = apply_filters( 'blr/user-nav/logout-url', home_url( '/logout' ) );
?>

<button class="nav-toggle" aria-label="Toggle Navigation">
	<span class="nav-toggle__icon"></span>
</button>

<?php wp_nav_menu( [ 'theme_location' => 'nav-primary' ] ); ?>

<ul class="menu--user">
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
