<?php
/**
 * Search page content template.
 *
 * @package BLR\Base_Theme\Templates
 */

?>

<article <?php post_class( 'entry entry--search' ); ?>>

	<header class="entry__header">
		<?php get_template_part( 'templates/entry-header', 'search' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
			<?php get_template_part( 'templates/entry-meta', 'search' ); ?>
		<?php endif; ?>
	</header><!-- /.entry__header -->

	<div class="entry__content entry__content--summary">
		<?php the_excerpt(); ?>
	</div><!-- /.entry__content -->

</article>
