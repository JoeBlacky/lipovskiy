<?php
/**
 * Template Name: Page Prices
 */
?>
<?php
  $prices = getCategoryPosts('post', '-1','services');
?>

<?php get_header(); ?>

<?php while(have_posts()) : the_post(); ?>
  <?php get_template_part('common/page-intro'); ?>
  <div class="mw">
    <div class="post-content post-entry">
      <?php echo the_content(); ?>
    </div>
    <?php if($prices): ?>
      <?php foreach($prices as $post):
        $prices = get_field('prices', $post->ID);
        $thumb  = get_field('thumbnail', $post->ID);
      ?>
        <?php if($prices): ?>
          <section class="b-service">
            <header class="flex">
              <img
                src="<?php echo $thumb; ?>"
                alt="<?php echo $post->post_title; ?>"
                width="50"
                height="50"
              />
              <h3 class="sub-title">
                <a href="<?php echo get_permalink($post->ID); ?>">
                  <?php echo $post->post_title; ?>
                </a>
              </h3>
            </header>
            <table class="price-table">
              <?php foreach($prices as $price): ?>
                <tr>
                  <td class="name"><?php echo $price['service']; ?></td>
                  <td class="price"><b class="icn ruble"><?php echo $price['price']; ?></b></td>
                </tr>
              <?php endforeach; ?>
            </table>
          </section>
        <?php endif; ?>
      <?php endforeach; wp_reset_postdata(); ?>
    <?php endif; ?>
  </div>
<?php endwhile; ?>

<?php get_footer(); ?>