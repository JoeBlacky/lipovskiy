<?php
	$enabled = get_field('enable_prices_section');

  if($enabled):
		$service    = customPostListing('post', '1','services');
		$pricesPage = get_page_by_path('prices');
?>
	<div class="section s-prices" id="prices">
	  <div class="mw">
	    <?php if($service->have_posts()): ?>
		    <?php while($service->have_posts()): $service->the_post() ?>
		    <?php
		    	$prices = get_field('prices');
		  		$thumb  = get_field('thumbnail');
		    ?>
			    <section class="b-service">
			      <header class="flex">
			        <img
			        	src="<?php echo $thumb; ?>"
			        	alt="<?php echo the_title(); ?>"
			        	width="50"
			        	height="50"
			        />
			        <h3 class="sub-title">
                <a href="<?php echo get_permalink(); ?>">
                  <?php echo the_title(); ?>
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
				<?php endwhile; wp_reset_postdata(); ?>
			<?php endif; ?>
			<a href="<?php echo get_permalink($pricesPage->ID); ?>" class="btn">
				<?php _e('Watch all prices'); ?>
			</a>
	  </div>
	</div>
<?php endif; ?>