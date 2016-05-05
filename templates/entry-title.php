<?php
/**
 * Default entry title template.
 *
 * @package BLR\Base_Theme\Templates
 */

use BLR\Base_Theme\Titles;
?>

<?php if ( is_singular() ) : ?>

	<h1 class="entry__title">
		<?php echo esc_html( Titles\title() ); ?>
	</h1>

<?php else : ?>

	<h2 class="entry__title">
		<a class="entry__permalink" href="<?php the_permalink(); ?>">
			<?php echo esc_html( Titles\title() ); ?>
		</a>
	</h2>

<?php endif; ?>
