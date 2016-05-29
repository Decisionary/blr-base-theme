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
				<?php Wrapper\get_template( 'templates/header' ); ?>
			</div><!-- /.page-header -->
		</header><!-- /.page-header-container -->

		<?php if ( Setup\display_nav_menu( 'nav-primary' ) ) : ?>
			<div class="page-nav-container">
				<nav class="nav page-nav nav--primary">
					<?php Wrapper\get_template( 'templates/nav-primary' ); ?>
				</nav><!-- /.page-nav -->
			</div><!-- /.page-nav-container -->
		<?php endif; ?>


		<div class="page-content-container" role="document">

			<?php if ( Setup\display_breadcrumbs() ) : ?>
				<?php Wrapper\get_template( 'breadcrumbs' ); ?>
			<?php endif; ?>

			<?php Wrapper\before_template( 'page-content' ); ?>

			<div class="page-content">

				<?php if ( Setup\display_sidebar( 'sidebar-primary' ) ) : ?>
					<aside class="sidebar sidebar--primary" role="complementary">
						<?php Wrapper\get_template( 'sidebar-primary' ); ?>
					</aside><!-- /.sidebar -->
				<?php endif ?>

				<main class="main-content">
					<?php Wrapper\before_template( 'page-content' ); ?>
					<?php include Wrapper\main_template_path(); ?>
					<?php Wrapper\after_template( 'page-content' ); ?>
				</main><!-- /.main-content -->

				<?php if ( Setup\display_sidebar( 'sidebar-secondary' ) ) : ?>
					<aside class="sidebar sidebar--secondary" role="complementary">
						<?php Wrapper\get_template( 'sidebar-secondary' ); ?>
					</aside><!-- /.sidebar -->
				<?php endif; ?>

			</div><!-- /.page-content -->

			<?php Wrapper\after_template( 'page-content' ); ?>

		</div><!-- /.page-content-container -->


		<div class="page-footer-container">
			<div class="page-footer">
				<?php Wrapper\get_template( 'templates/footer' ); ?>
			</div><!-- /.page-footer -->
		</div><!-- /.page-footer-container -->

		<?php wp_footer(); ?>
	</body>
</html>
