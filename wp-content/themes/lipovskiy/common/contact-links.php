<ul class="b-contact-links">
	<?php if(get_option('address')): ?>
		<li>
      <span class="link i-link icn pin">
      	<?php echo get_option('address'); ?>
    	</span>
    </li>
	<?php endif; ?>
	<?php if(get_option('opening_hours')): ?>
		<li>
      <span class="link i-link icn time">
      	<?php echo get_option('opening_hours'); ?>
      </span>
    </li>
	<?php endif; ?>
	<?php if(get_option('phone_number')):?>
		<li>
      <a href="tel:<?php echo urlencode(get_option('phone_number')); ?>" class="link i-link icn phone">
      	<?php echo get_option('phone_number'); ?>
    	</a>
    </li>
	<?php endif; ?>
	<?php if(get_option('contact_email')):?>
		<li>
      <a class="link i-link icn mail" href="mailto:<?php echo get_option('contact_email'); ?>">
      	<?php echo get_option('contact_email'); ?>
    	</a>
    </li>
	<?php endif; ?>
</ul>