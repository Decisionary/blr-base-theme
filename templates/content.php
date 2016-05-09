<?php
/**
 * Default entry content template.
 *
 * @package BLR\Base_Theme\Templates
 */

?>

<article <?php post_class( 'entry' ); ?>>

	<header class="entry__header">
		<?php get_template_part( 'template/entry-title' ); ?>
		<?php get_template_part( 'templates/entry-meta' ); ?>
	</header><!-- /.entry__header -->

	<div class="entry__content entry__content--summary">
		<?php the_excerpt(); ?>
	</div><!-- /.entry__content -->

</article>
