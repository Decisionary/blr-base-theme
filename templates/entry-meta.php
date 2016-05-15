<?php
/**
 * Entry metadata template.
 *
 * @package BLR\Base_Theme\Templates
 */

$post_time   = get_post_time( 'c', true );
$author_name = get_the_author();
$author_url  = get_author_posts_url( get_the_author_meta( 'ID' ) );

if ( ! empty( $author_name ) && ! empty( $author_url ) ) {
	$author_name =
		'<a href="' . esc_url( $author_url ) . '" rel="author" class="fn">'
		. $author_name
		. '</a>';
}

$has_post_meta = ( ! empty( $post_time ) && ! empty( $author_name ) );
?>

<?php if ( $has_post_meta ) : ?>
	<div class="entry__meta">

		<?php if ( ! empty( $post_time ) ) : ?>
			<time class="updated" datetime="<?php echo esc_attr( $post_time ); ?>">
				<?php echo get_the_date(); ?>
			</time>
		<?php endif; ?>

		<?php if ( ! empty( $author_name ) ) : ?>
			<p class="byline author vcard">
				<?php esc_html_e( 'By', 'blr-base-theme' ); ?>
				<?php echo wp_kses_post( $author_name ); ?>
			</p>
		<?php endif; ?>

	</div><!-- /.entry__meta -->
<?php endif; ?>
