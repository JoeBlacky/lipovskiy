<?php
  $enabled = get_field('enable_about_us_section');

  if($enabled):
    $aboutPage  = get_page_by_path('about-company');
    $sContent   = customStringLength(apply_filters('the_content', $aboutPage->post_content), 1273);
    $licenseImg = get_field('license', $aboutPage->ID);
?>
  <div class="section about-company">
    <div class="mw flex">
      <section class="post-content description">
        <div class="floated-content">
          <?php if($licenseImg): ?>
            <div class="flex b-license">
              <?php foreach($licenseImg as $image): ?>
                <a class="image" target="_blank" href="<?php echo $image['img']; ?>">
                  <img src="<?php echo $image['preview']; ?>" alt="" width="220" height="304" />
                </a>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
        <h2 class="title">
          <?php echo $aboutPage->post_title; ?>
        </h2>
        <?php echo $sContent; ?>
        <a href="<?php echo get_permalink($aboutPage->ID); ?>" class="btn">
          <?php _e('Read more'); ?>
        </a>
      </section>
    </div>
  </div>
<?php endif; ?>