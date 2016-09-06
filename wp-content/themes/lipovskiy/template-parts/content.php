<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Creative_Seo
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
			<?php the_author(); ?>
			<?php the_date(); ?>
			<?php the_category(','); ?>

		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<?php ?>

	<footer class="entry-footer">
		<?php creativeseo_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
