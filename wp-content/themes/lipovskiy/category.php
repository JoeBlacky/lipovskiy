<?php
/**
 * The template for displaying Category pages
 *
**/
?>
<?php get_header(); ?>

	<?php if (have_posts()) : ?>
		<div class="mw p-category">
			<div class="description post-entry">
				<h1 class="title page-title">
					<?php echo single_cat_title( '', false ); ?>
				</h1>
				<?php echo term_description(); ?>
			</div>

			<div class="post-listing">
				<?php	while (have_posts()) : the_post(); ?>
					<?php get_template_part('content', get_post_format()); ?>
				<?php endwhile; ?>
			</div>
		</div>
	<?php else: ?>
		<?get_template_part('template-parts/content', 'none'); ?>;
	<?php endif; ?>

<?php get_footer(); ?>
