<?php
/**
 * Entry content template.
 *
 * @package BLR\Base_Theme\Templates
 */

?>

<div class="entry__content">

	<?php if ( is_singular() ) : ?>

		<?php the_content(); ?>

	<?php else : ?>

		<?php the_excerpt(); ?>

	<?php endif; ?>

</div><!-- /.entry__content -->
