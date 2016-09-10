<?php get_header(); ?>

<?php while(have_posts()) : the_post(); ?>
  <?php get_template_part('home/hero-slider'); ?>
  <?php get_template_part('home/about'); ?>
  <?php get_template_part('home/services'); ?>
  <?php get_template_part('home/prices'); ?>
<?php endwhile; ?>

<?php get_footer();?>
