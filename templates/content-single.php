<?php
/**
 * Entry content template for single posts, pages, and custom post type entries.
 *
 * @package BLR_Base_Theme\Templates
 */

?>

<?php while ( have_posts() ) : the_post(); ?>

	<article <?php post_class(); ?>>

		<header class="entry__header">
			<h1 class="entry__title">
				<?php the_title(); ?>
			</h1>

			<?php get_template_part( 'templates/entry-meta' ); ?>
		</header><!-- /.entry__header -->

		<div class="entry__content">
			<?php the_content(); ?>
		</div><!-- /.entry__content -->

		<footer class="entry__footer">
			<?php
			wp_link_pages([
				'before' => '<nav class="pagination"><p>' . __( 'Pages:', 'blr-base-theme' ),
				'after'  => '</p></nav>',
			]);
			?>
		</footer><!-- /.entry__footer -->

		<?php comments_template( '/templates/comments.php' ); ?>

	</article>

<?php endwhile; ?>
