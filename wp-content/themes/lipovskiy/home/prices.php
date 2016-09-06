<?php
	$enabled   = get_field('enable_prices_section', $post->ID);
	$posts     = getCategoryPosts('post', '1','services');
	$pricePage = array_shift(get_field('page_prices_relation', $post->ID));
?>
<?php if($enabled): ?>
	<div class="section s-prices" id="prices">
	  <div class="mw">
	    <?php if($posts): ?>
		    <?php foreach($posts as $post):
		    	$prices = get_field('prices', $post->ID);
		  		$thumb  = get_field('thumbnail', $post->ID);
		    ?>
			    <section class="b-service">
			      <header class="flex">
			        <img
			        	src="<?php echo $thumb; ?>"
			        	alt="<?php echo $post->post_title; ?>"
			        	width="50"
			        	height="50"
			        />
			        <h3 class="sub-title">
                <a href="<?php echo get_permalink($post->ID); ?>">
                  <?php echo $post->post_title; ?>
                </a>
              </h3>
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
			    </section>
				<?php endforeach; wp_reset_postdata(); ?>
			<?php endif; ?>
			<a href="<?php echo get_permalink($pricePage->ID); ?>" class="btn">
				<?php _e('Watch all prices'); ?>
			</a>
	  </div>
	</div>
<?php endif; ?>