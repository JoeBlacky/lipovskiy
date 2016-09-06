<?php
	if(get_field('enable_testimonials', $post->ID)):
	$cta 							= getAdditionalBlock('what-people-say');
	$testimonialsList = customPostListing('testimonials');
?>
	<div class="s-additional cta-testimonials" style="background-image: url(<?php echo get_the_post_thumbnail_url($cta->ID); ?>);">
		<section class="mw">
			<?php if($cta->post_title): ?>
				<h2 class="t-center">
					<?php echo $cta->post_title; ?>
				</h2>
			<?php endif;?>

			<?php if($cta->post_content): ?>
				<?php echo apply_filters('the_content', $cta->post_content); ?>
			<?php endif;?>

			<?php if($testimonialsList): ?>
				<ul class="flex testimonials">
					<?php
						foreach($testimonialsList->posts as $testimonial):
						$workTitle = array_shift(get_field('work_relation', $testimonial->ID))->post_title;
					?>
						<li class="testimonial">
							<header class="flex testimonial-header">
								<img
									class="testimonial-image"
									src="<?php echo get_the_post_thumbnail_url($testimonial->ID); ?>"
									alt="<?php echo $testimonial->post_name; ?>"
								/>
								<div class="headings">
									<h3 class="small-heading testimonial-title">
										<?php echo $testimonial->post_title; ?>
									</h3>
									<h4 class="small-heading work-title">
										<?php echo $workTitle; ?>
									</h4>
								</div>
							</header>
							<?php echo apply_filters('the_content', $testimonial->post_content); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</section>
	</div>
<?php endif; ?>