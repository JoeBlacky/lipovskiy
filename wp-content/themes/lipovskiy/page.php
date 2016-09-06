<?php get_header(); ?>

	<?php if (have_posts()): ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <?php get_template_part('common/page-intro'); ?>
      <div class="mw post-content">
          <?php echo apply_filters('the_content', $post->post_content); ?>
      </div>
 		</article>
	<?php else: ?>
		<?get_template_part('template-parts/content', 'none'); ?>;
	<?php endif; ?>
<?php get_footer(); ?>
