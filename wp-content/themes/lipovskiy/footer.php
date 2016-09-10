	<?php get_template_part('common/map'); ?>
	</main>
	<footer id="footer" class="footer">
    <div class="mw flex">
      <section class="contact-info">
        <h3 class="sub-title">
          <?php _e('Contact information'); ?>
        </h3>
        <?php get_template_part('common/contact-links'); ?>
      </section>
      <div class="contact-form">
        <h3 class="sub-title">
          <?php _e('Feedback'); ?>
        </h3>
        <?php get_template_part('common/forms/contact-form'); ?>
      </div>
    </div>
  </footer>
  <a href="#" id="scroll-top" class="icn d-angle-top scroll-top"></a>
</div>
<?php wp_footer(); ?>
</body>
</html>
