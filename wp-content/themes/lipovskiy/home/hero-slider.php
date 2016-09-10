<?php
  $enabled = get_field('enable_hero_slider');

  if($enabled):
    $page = customPostListing('page');
?>
  <?php if($page->have_posts()): ?>
    <div class="slider wide-slider hero-slider">
      <ul class="slides">
        <?php while($page->have_posts()): $page->the_post(); ?>
          <li class="slide" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>'); ">
            <section class="description">
              <h2 class="title">
                <?php echo the_title(); ?>
              </h2>
              <?php echo the_excerpt(); ?>
              <a href="<?php echo get_permalink(); ?>" class="btn btn-success">
                <?php _e('Read more'); ?>
              </a>
            </section>
          </li>
        <?php endwhile; wp_reset_postdata(); ?>
      </ul>
    </div>
  <?php endif; ?>
<?php endif; ?>