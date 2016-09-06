<form id="contact-form" action="<?php echo get_template_directory_uri() . '/ajax/forms.php' ?>" method="POST">
  <fieldset class="flex fields">
    <fieldset class="field">
      <label for="contact-name">
        <?php _e('Name'); ?>
      </label>
      <input class="required" type="text" id="contact-name" name="name"/>
    </fieldset>
    <fieldset class="field">
      <label for="contact-email">
        <?php _e('E-mail'); ?>
      </label>
      <input class="required" type="email" id="contact-email" name="email"/>
    </fieldset>
    <fieldset class="field wide">
      <label for="contact-message">
        <?php _e('Message'); ?>
      </label>
      <textarea id="contact-message" name="message"></textarea>
    </fieldset>
  </fieldset>
  <input class="btn btn-small btn-success" type="submit" value="<?php _e('Send'); ?>" />
</form>