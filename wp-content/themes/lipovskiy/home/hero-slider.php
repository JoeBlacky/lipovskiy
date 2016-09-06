<?php
  $isEnabled = get_field('enable_recent_work');
  $posts     = getCategoryPosts('page', '-1','');
?>
<div class="slider wide-slider hero-slider">
  <ul class="slides">
    <?php foreach($posts as $post): ?>
      <li class="slide" style="background-image: url('<?php echo get_the_post_thumbnail_url($post->ID); ?>'); ">
        <section class="description">
          <h2 class="title">
            <?php echo $post->post_title; ?>
          </h2>
          <?php echo getFirstParagraph($post->post_content); ?>
          <a href="<?php echo get_permalink($post->ID); ?>" class="btn btn-success">
            <?php _e('Read more'); ?>
          </a>
        </section>
      </li>
    <?php endforeach; wp_reset_postdata(); ?>
  </ul>
</div>