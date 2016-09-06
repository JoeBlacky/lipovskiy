<?php
/**
 * Template Name: About Page
 */
?>

<?php
	$licenseImg = get_field('license');
?>

<?php get_header(); ?>

<?php while(have_posts()) : the_post(); ?>
  <?php get_template_part('common/page-intro'); ?>
    <div class="mw p-about">
      <div class="post-content">
	      <div class="floated-content">
	      	<?php if($licenseImg): ?>
	          <div class="flex b-license">
	            <?php foreach($licenseImg as $image): ?>
	              <a class="image" target="_blank" href="<?php echo $image['img']; ?>">
	                <img src="<?php echo $image['preview']; ?>" alt="" width="460" height="307" />
	              </a>
	            <?php endforeach; ?>
	          </div>
	        <?php endif; ?>
	      </div>
	      <?php echo the_content(); ?>
      </div>
    </div>
<?php endwhile; ?>

<?php get_footer(); ?>