<?php get_header(); ?>
	<section class="mw page-news">
		<h1 class="page-title">
			<?php echo _e('News'); ?>
		</h1>
		<?php if ( have_posts() ) : ?>
			<div class="post-listing">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; ?>
				<?php the_posts_pagination();  ?>
				</div>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
	</section>
<?php get_footer(); ?>
