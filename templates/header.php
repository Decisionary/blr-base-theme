<?php
/**
 * Default header template.
 *
 * @package BLR\Base_Theme\Templates
 */

$logo_header_image_url = get_theme_mod( 'blr_base_theme_logo_primary' );
$logo_header_link_url  = apply_filters( 'blr/logo-header/link-url', home_url( '/' ) );
$logo_header_alt_text  = apply_filters( 'blr/logo-header/alt-text', get_bloginfo( 'name' ) );

$logo_search_image_url = get_theme_mod( 'blr_base_theme_logo_search' );
$logo_search_link_url  = apply_filters( 'blr/logo-search/link-url', '' );
$logo_search_alt_text  = apply_filters( 'blr/logo-search/alt-text', 'Powered by BLR' );

$phone_number = get_theme_mod( 'blr_base_theme_phone_number' );
?>

<div class="branding branding--header">

	<?php if ( ! empty( $logo_header_link_url ) ) : ?>
		<a class="logo logo--header" href="<?php echo esc_url( $logo_header_link_url ); ?>">
	<?php else : ?>
		<div class="logo logo--header">
	<?php endif; ?>

	<?php if ( ! empty( $logo_header_image_url ) ) : ?>
		<img
			class="logo__image"
			src="<?php echo esc_url( $logo_header_image_url ) ?>"
			alt="<?php echo esc_attr( $logo_header_alt_text ); ?>"
		>
	<?php else : ?>
		<p class="logo__text">
			<?php echo esc_html( $logo_header_alt_text ); ?>
		</p>
	<?php endif; ?>

	<?php if ( ! empty( $logo_header_link_url ) ) : ?>
		</a><!-- /.logo -->
	<?php else : ?>
		</div><!-- /.logo -->
	<?php endif; ?>

</div><!-- /.branding -->
<div class="header--right-side" role="contentinfo">
	<div class="header--row header--top-row">
		<!--Phone Number-->
		<?php if ( ! empty( $phone_number ) ) : ?>
			<p class="site-info__phone-number">
				<?php echo wp_kses_post( $phone_number ); ?>
			</p>
		<?php endif; ?>
		<!--Social Icons-->
		<?php if ( class_exists( 'ET_Monarch' ) && is_callable( [ ET_Monarch, 'display_widget' ] ) ) : ?>
			<span class="site-info__social-icons">
			<?php ET_Monarch::display_widget( 'shortcode' ); ?>
		</span>
		<?php endif; ?>
	</div>
	<div class="header--row">
		<!--Search-->
		<div class="header--search">
			<?php if ( has_nav_menu( 'nav-search' ) ) : ?>
				<nav class="nav nav--search">
					<?php wp_nav_menu( [ 'theme_location' => 'nav-search' ] ); ?>
				</nav><!-- /.nav -->
			<?php endif; ?>
			<?php echo get_search_form(); ?>
		</div>
		<?php if ( ! empty( $logo_search_image_url ) ) : ?>
			<!--Right logo-->
			<div class="header--right-logo">
				<?php if ( ! empty( $logo_search_link_url ) ) : ?>
					<a class="logo logo--search" href="<?php echo esc_url( $logo_search_link_url ); ?>">
				<?php else : ?>
					<div class="logo logo--search">
				<?php endif; ?>

				<img
					class="logo__image"
					src="<?php echo esc_url( $logo_search_image_url ); ?>"
					alt="<?php echo esc_attr( $logo_search_alt_text ); ?>"
				>

				<?php if ( ! empty( $logo_search_link_url ) ) : ?>
					</a><!-- /.logo -->
				<?php else : ?>
					</div><!-- /.logo -->
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
