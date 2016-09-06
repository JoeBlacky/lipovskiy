<?php
	if(get_field('enable_cta_1', $post->ID)):
	$cta     = getAdditionalBlock('speak-to-the-team');
	$ctaBg   = get_the_post_thumbnail_url($cta->ID);
	$ctaLink = get_field('button_link', $cta->ID);
?>
	<div class="s-additional s-cta t-center" style="background-image: url(<?php echo $ctaBg; ?>);">
		<section class="mw">
			<h2>
				<?php echo $cta->post_title; ?>
			</h2>

			<?php if($cta->post_content): ?>
				<?php echo apply_filters('the_content', $cta->post_content); ?>
			<?php endif; ?>

			<?php if($ctaLink): ?>
				<a class="btn btn-secondary" href="<?php echo get_permalink($ctaLink); ?>">
					<?php _e('Get in touch'); ?>
				</a>
			<?php endif; ?>
		</section>
	</div>
<?php endif; ?>