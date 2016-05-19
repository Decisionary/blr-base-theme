<?php
/**
 * Default entry title template.
 *
 * @package BLR\Base_Theme\Templates
 */
?>

<?php if ( is_singular() ) : ?>

	<h1 class="entry__title">
		<?php the_title(); ?>
	</h1>

<?php else : ?>

	<h2 class="entry__title">
		<a class="entry__permalink" href="<?php the_permalink(); ?>">
			<?php the_title(); ?>
		</a>
	</h2>

<?php endif; ?>
