<?php
  $prices = get_field('prices');
  $thumb  = get_field('thumbnail');
  $beforeAfter = get_field('before_after');
?>

  <?php if(is_single()): ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <?php get_template_part('common/page-intro'); ?>
      <div class="mw post-content">
        <?php echo the_content(); ?>
      </div>
      <?php if($beforeAfter): ?>
        <div class="b-service-example">
          <section class="mw">
            <h2 class="title">
              <?php _e('Work example'); ?>
            </h2>
            <div class="rounded-images" id="before-after">
              <?php foreach($beforeAfter as $item): ?>
                <figure class="before">
                  <img src="<?php echo $item['before']; ?>" alt="" width="275" height="275" />
                  <figcaption class="item-trigger a-false" data-trigger="before-after">
                    <?php _e('Before'); ?>
                  </figcaption>
                </figure>
                <figure class="after">
                  <img src="<?php echo $item['after']; ?>" alt="" width="275" height="275" />
                  <figcaption class="item-trigger a-false" data-trigger="before-after">
                    <?php _e('After'); ?>
                  </figcaption>
                </figure>
              <?php endforeach; ?>
            </div>
          </section>
        </div>
      <?php endif; ?>
      <?php if($prices): ?>
        <div class="mw">
          <div class="b-service">
            <header class="flex">
              <img
                src="<?php echo $thumb; ?>"
                alt="<?php echo $the_title; ?>"
                width="100"
                height="100"
              />
            </header>
            <?php if($prices): ?>
              <table class="price-table">
              <?php foreach($prices as $price): ?>
                <tr>
                  <td class="name"><?php echo $price['service']; ?></td>
                  <td class="price"><b class="icn ruble"><?php echo $price['price']; ?></b></td>
                </tr>
              <?php endforeach; ?>
              </table>
            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>
    </article>
  <?php else: ?>
    <div class="list-item">
      <a id="post-<?php the_ID(); ?>" class="post" href="<?php echo esc_url(get_permalink()); ?>">
        <div class="post-image" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>">
        </div>
        <div class="post-entry">
          <h2 class="post-title">
            <?php echo the_title() ?>
          </h2>
          <div class="post-content">
            <?php echo the_excerpt(); ?>
          </div>
          <span class="btn btn-small btn-light">
            <?php _e('Read more'); ?>
          </span>
        </div>
      </a>
    </div>
  <?php endif; ?>
