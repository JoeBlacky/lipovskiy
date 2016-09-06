<?php
	$enabled  = get_field('enable_about_us_section');

  $section    = array_shift(get_field('page_about_relation'));
  $sTitle     = $section->post_title;
  $sContent   = customStringLength(apply_filters ('the_content', $section->post_content), 1273);
  $licenseImg = get_field('license', $section->ID);
?>
<?php if($enabled): ?>
  <div class="section about-company" id="about-company">
    <div class="mw flex">
        <section class="post-content description">
          <h2 class="title">
            <?php echo $sTitle; ?>
          </h2>
          <?php echo $sContent; ?>
          <a href="<?php echo get_permalink($section->ID); ?>" class="btn">
            <?php _e('Read more'); ?>
          </a>
        </section>
        <?php if($licenseImg): ?>
          <div class="flex image">
            <?php foreach($licenseImg as $image): ?>
              <a target="_blank" href="<?php echo $image['img']; ?>">
                <img src="<?php echo $image['preview']; ?>" alt="" width="460" height="307" />
              </a>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
    </div>
  </div>
<?php endif; ?>