<?php
/**
 * Search page content template.
 *
 * @package BLR_Base_Theme\Templates
 */

?>

<article <?php post_class(); ?>>

	<header class="entry__header">
		<h2 class="entry__title">
			<a class="entry__permalink" href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>

		<?php if ( 'post' === get_post_type() ) : ?>
			<?php get_template_part( 'templates/entry-meta' ); ?>
		<?php endif; ?>
	</header><!-- /.entry__header -->

	<div class="entry__content entry__content--summary">
		<?php the_excerpt(); ?>
	</div><!-- /.entry__content -->

</article>
