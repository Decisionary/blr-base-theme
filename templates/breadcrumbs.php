<?php
/**
 * Breadcrumbs template.
 *
 * @package BLR\Base_Theme\Templates
 */

$info = apply_filters( 'blr/breadcrumbs/info', [
	'icon'  => '',
	'title' => '',
] );
?>

<ul class="breadcrumbs page-breadcrumbs">

	<?php if ( ! empty( $info ) ) : ?>

		<?php if ( ! empty( $info['icon'] ) ) : ?>
			<li class="breadcrumb breadcrumb--icon">
				<i class="icon icon-<?php echo esc_attr( $info['icon'] ); ?>"></i>
			</li>
		<?php endif; ?>

		<?php if ( ! empty( $info['title'] ) ) : ?>
			<li class="breadcrumb breadcrumb--section">
				<?php echo wp_kses_post( $info['title'] ); ?>
			</li>
		<?php endif; ?>

	<?php endif; ?>

	<li class="breadcrumb breadcrumb--trail">

		<?php if ( function_exists( 'bcn_display' ) ) : ?>

			<?php bcn_display(); ?>

		<?php endif; ?>

	</li>

</ul>
