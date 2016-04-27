<?php
/**
 * Default entry content template.
 *
 * @package BLR_Base_Theme\Templates
 */

?>

<article <?php post_class( 'entry' ); ?>>

	<header class="entry__header">
		<h2 class="entry__title">
			<a class="entry__permalink" href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>

		<?php get_template_part( 'templates/entry-meta' ); ?>
	</header><!-- /.entry__header -->

	<div class="entry__content entry__content--summary">
		<?php the_excerpt(); ?>
	</div><!-- /.entry__content -->

</article>
