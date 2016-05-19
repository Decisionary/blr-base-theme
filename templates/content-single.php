<?php
/**
 * Entry content template for single posts, pages, and custom post type entries.
 *
 * @package BLR\Base_Theme\Templates
 */

?>

<?php while (have_posts()) : the_post(); ?>
	<article <?php post_class( 'entry entry--single'); ?>>
    <header class="entry__header">
      <?php get_template_part( 'templates/entry-title', 'single' ); ?>

      <?php get_template_part( 'templates/entry-meta', 'single' ); ?>
    </header>

    <div class="entry-content">
      <?php the_content(); ?>
    </div>

    <footer class="entry__footer">
      <?php
      wp_link_pages([
	      'before' => '<nav class="pagination"><p>' . __( 'Pages:', 'blr-base-theme' ),
	      'after'  => '</p></nav>',
      ]);
      ?>
    </footer>
		<?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
