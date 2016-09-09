<?php
	$services = customPostListing('post', '-1','services');
?>
<div class="slider wide-slider">
	<ul class="slides">
		<?php while($services->have_posts()): $services->the_post(); ?>
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