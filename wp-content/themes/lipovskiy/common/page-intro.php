<div
	class="b-page-intro"
	style="background-image: url('<?php echo get_the_post_thumbnail_url($post->ID); ?>"
>
  <div class="description">
    <?php the_title( '<h1 class="post-title page-title">', '</h1>' ); ?>
  </div>
</div>
<?php breadcrumbs(); ?>