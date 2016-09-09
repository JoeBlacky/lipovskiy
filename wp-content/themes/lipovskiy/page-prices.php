<?php
/**
 * Template Name: Page Prices
 */
?>
<?php
  $services = customPostListing('post', '-1','services');
?>

<?php get_header(); ?>

<?php while(have_posts()) : the_post(); ?>
  <?php get_template_part('common/page-intro'); ?>
  <div class="mw">
    <div class="post-content post-entry">
      <?php echo the_content(); ?>
    </div>
    <?php if($services->have_posts()): ?>
      <?php while($services->have_posts()): $services->the_post();
        $prices = get_field('prices');
        $thumb  = get_field('thumbnail');
      ?>
        <?php if($prices): ?>
          <section class="b-service">
            <header class="flex">
              <img
                src="<?php echo $thumb; ?>"
                alt="<?php echo the_title(); ?>"
                width="50"
                height="50"
              />
              <h3 class="sub-title">
                <a href="<?php echo get_permalink(); ?>">
                  <?php echo the_title(); ?>
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
      <?php endwhile; wp_reset_postdata(); ?>
    <?php endif; ?>
  </div>
<?php endwhile; ?>

<?php get_footer(); ?>