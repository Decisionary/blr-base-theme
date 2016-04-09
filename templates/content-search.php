<?php
/**
 * Search page content template.
 *
 * @package BLR_Base_Theme/Templates
 */

?>

<article <?php post_class(); ?>>
	<header>
		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		<?php if ( 'post' === get_post_type() ) : ?>
			<?php get_template_part( 'templates/entry-meta' ); ?>
		<?php endif; ?>
  </header>
  <div class="entry-summary">
	<?php the_excerpt(); ?>
  </div>
</article>
