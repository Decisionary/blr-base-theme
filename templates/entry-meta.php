<?php
/**
 * Entry metadata template.
 *
 * @package BLR_Base_Theme/Templates
 */

$post_time  = get_post_time( 'c', true );
$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
?>

<time class="updated" datetime="<?php echo esc_attr( $post_time ); ?>">
	<?php echo get_the_date(); ?>
</time>

<p class="byline author vcard">
	<?php esc_html_e( 'By', 'sage' ); ?>

	<a href="<?php echo esc_url( $author_url ); ?>" rel="author" class="fn">
		<?php echo get_the_author(); ?>
	</a>
</p>
