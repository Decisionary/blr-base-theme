<?php
/**
 * Base theme template.
 *
 * @package BLR\Base_Theme\Bootstrap
 */

use BLR\Base_Theme\Setup;
use BLR\Base_Theme\Wrapper;
?>
<!doctype html>
<html <?php language_attributes(); ?>>

	<?php get_template_part( 'templates/head' ); ?>

	<body <?php body_class(); ?>>

		<header class="page-header-container">
			<div class="page-header">
				<?php
				do_action( 'header_before' );
				get_template_part( 'templates/header' );
				do_action( 'header_after' );
				?>
			</div><!-- /.page-header -->
		</header><!-- /.page-header-container -->

		<?php if ( Setup\display_nav_menu( 'nav-primary' ) ) : ?>
			<div class="page-nav-container">
				<nav class="nav page-nav nav--primary">
					<?php
					do_action( 'nav_before' );
					get_template_part( 'templates/nav-primary' );
					do_action( 'nav_after' );
					?>
				</nav><!-- /.page-nav -->
			</div><!-- /.page-nav-container -->
		<?php endif; ?>


		<div class="page-content-container" role="document">
			<div class="page-content">

				<?php do_action( 'content_before' ); ?>

				<?php if ( Setup\display_sidebar( 'sidebar-primary' ) ) : ?>
					<aside class="sidebar sidebar--primary" role="complementary">
						<?php include Wrapper\sidebar_path( 'sidebar-primary' ); ?>
					</aside><!-- /.sidebar -->
				<?php endif ?>

				<main class="main-content">
					<?php include Wrapper\template_path(); ?>
				</main><!-- /.main-content -->

				<?php if ( Setup\display_sidebar( 'sidebar-secondary' ) ) : ?>
					<aside class="sidebar sidebar--secondary" role="complementary">
						<?php include Wrapper\sidebar_path( 'sidebar-secondary' ); ?>
					</aside><!-- /.sidebar -->
				<?php endif ?>

				<?php do_action( 'content_after' ); ?>

			</div><!-- /.page-content -->
		</div><!-- /.page-content-container -->


		<div class="page-footer-container">
			<div class="page-footer">
				<?php
				do_action( 'footer_before' );
				get_template_part( 'templates/footer' );
				do_action( 'footer_after' );
				?>
			</div><!-- /.page-footer -->
		</div><!-- /.page-footer-container -->

		<?php wp_footer(); ?>
	</body>
</html>
