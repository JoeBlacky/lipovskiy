<?php
/**
 * Template Name: Contact Page
 */
?>
<?php get_header(); ?>

	<?php while(have_posts()) : the_post(); ?>
		<?php get_template_part('common/page-intro'); ?>
		<div class="mw flex p-contacts">
			<div class="medium post-content post-entry">
				<?php echo the_content(); ?>
			</div>
			<div class="links-horizontal">
				<?php get_template_part('common/contact-links'); ?>
			</div>
		</div>
	<?php endwhile; ?>

<?php get_footer(); ?>