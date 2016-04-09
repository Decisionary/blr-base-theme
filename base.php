<?php
/**
 * Base theme template.
 *
 * @package BLR_Base_Theme/Bootstrap
 */

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
	<?php get_template_part( 'templates/head' ); ?>
	<body <?php body_class(); ?>>
		<!--[if IE]>
			<div class="alert alert-warning">
				<?php
				printf(
					esc_html__(
						'You are using an %1$s outdated %2$s browser. Please %3$s upgrade your browser %4$s to improve your experience.',
						'sage'
					),
					'<strong>',
					'</strong>',
					'<a href="http://browsehappy.com/">',
					'</a>'
				);
				?>
			</div>
		<![endif]-->
		<?php
		do_action( 'get_header' );
		get_template_part( 'templates/header' );
		?>
		<div class="wrap container" role="document">
			<div class="content row">
				<main class="main">
					<?php include Wrapper\template_path(); ?>
				</main><!-- /.main -->
				<?php if ( Setup\display_sidebar() ) : ?>
					<aside class="sidebar">
						<?php include Wrapper\sidebar_path(); ?>
					</aside><!-- /.sidebar -->
				<?php endif; ?>
			</div><!-- /.content -->
		</div><!-- /.wrap -->
		<?php
			do_action( 'get_footer' );
			get_template_part( 'templates/footer' );
			wp_footer();
		?>
	</body>
</html>
