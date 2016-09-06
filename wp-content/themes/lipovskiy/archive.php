<?php get_header(); ?>

	<div class="mw p-category">
		<?php if (have_posts()): ?>
			<div class="post-content post-entry">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</div>

			<div class="post-listing">
				<?php	while (have_posts()) : the_post(); ?>
					<?php get_template_part('content', get_post_format()); ?>
				<?php endwhile; ?>
			</div>
			<?php the_posts_navigation(); ?>
		<?php else: ?>
			<?get_template_part('template-parts/content', 'none'); ?>;
		<?php endif; ?>
	</div>

<?php get_footer(); ?>